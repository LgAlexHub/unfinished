import { ref, reactive, computed } from "vue";

import type { Paginator } from "@/types/api/common";
import type { QueryParam } from "@/types/queryParam";
import type { ComputedRef, Reactive, Ref } from "vue";

export interface Sort {
    key : string,
    label : string,
    sortable : boolean,
    direction? : boolean
}

export class DataTableQueryBuilder<T> {
    public search : Ref<string>;
    public sortColumns : Reactive<Sort[]>;
    public paginator : Ref<Paginator<T>>;

    constructor(sorts : Sort[]){
        this.search = ref('');
        this.sortColumns = reactive(sorts);
        this.paginator = ref({
            data : [],
            links : {
                first : '',
                last : ''
            }
        });
    }

    public toggleSortDirection(columnKey : string){
        const columnIndex = this.sortColumns.findIndex(column => column.key === columnKey && column.sortable);
        if (columnIndex === -1)
            return;
        if (this.sortColumns[columnIndex].direction === undefined){
            this.sortColumns[columnIndex].direction = true;
        } else if (this.sortColumns[columnIndex].direction) {
            this.sortColumns[columnIndex].direction = false;
        } else {
            this.sortColumns[columnIndex].direction = undefined;
        }
    }

    public clearSortSettings() {
        this.sortColumns.forEach(column => column.direction = undefined);
    }

    public isInDefaultState() : ComputedRef<boolean> {
        return computed(() => 
            this.sortColumns.every(column => column.direction === undefined)
            && this.search.value.trim() === ''
        );
    }

    public buildQueryParameters() : QueryParam[] {
        return [
            ...this.sortColumns
                .filter(column => column.direction !== undefined)
                .map(column => ({ name : 'sort-'+column.key, value : column.direction ? 1 : 0})),
            ...this.search.value && this.search.value.trim().length > 1
                ? [{ name : 'search', value : encodeURIComponent(this.search.value) }]
                : []
        ];
    }

}