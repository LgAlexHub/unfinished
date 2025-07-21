export interface QueryParam {
    name : string,
    value : number|string|boolean,
}

export interface PaginatorLink {
    url: string | null;
    label: string;
    active: boolean;
}

export interface Paginator<T> {
    data: T[];
    links : {
        first : string,
        last : string,
        next? : string,
        prev? : string,
    },
    meta? : {
        current_page: number,
        from : number,
        to : number,
        total: number,
        last_page: number,
        path : string,
        per_page : number,
        links? : PaginatorLink[],
    }
}

export interface PaginationConfig {
    currentPage: number;
    lastPage?: number;
    displayCount?: number;
}

export function generatePaginationRange({
    currentPage,
    lastPage,
    displayCount = 3
}: PaginationConfig): number[] {
    if (!lastPage) return [];

    const actualDisplayCount = Math.min(displayCount, lastPage);
    
    if (currentPage === 1) {
        return Array.from(
            { length: actualDisplayCount },
            (_, i) => i + 1
        );
    }

    if (currentPage >= lastPage - (actualDisplayCount - 1)) {
        const start = Math.max(1, lastPage - (actualDisplayCount - 1));
        return Array.from(
            { length: Math.min(actualDisplayCount, lastPage - start + 1) },
            (_, i) => start + i
        );
    }

    const start = Math.max(1, currentPage - Math.floor(actualDisplayCount / 2));
    return Array.from(
        { length: actualDisplayCount },
        (_, i) => start + i
    );
}