<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

const props = defineProps<{
    pagination: {
        links: {
            first: string | null,
            last: string | null,
            prev: string | null,
            next: string | null
        },
        meta: {
            current_page: number,
            last_page: number,
            per_page: number,
            total: number,
            links: Array<{
                url: string | null,
                label: string,
                active: boolean
            }>
        }
    }
}>();
</script>

<template>
    <div class="flex items-center justify-center px-5">
        <div class="flex items-center space-x-2">
            <Link v-if="props.pagination.links.prev" :href="props.pagination.links.prev"
                class="px-3 py-2 text-sm bg-gray-800 text-white rounded hover:bg-gray-700 transition-colors">
            ‹ Précédent
            </Link>
            <span v-else class="px-3 py-2 text-sm bg-gray-600 text-gray-400 rounded cursor-not-allowed">
                ‹ Précédent
            </span>

            <template v-for="link in props.pagination.meta.links" :key="link.label">
                <Link v-if="link.url && !link.label.includes('Previous') && !link.label.includes('Next')"
                    :href="link.url" :class="[
                        'px-3 py-2 text-sm rounded transition-colors',
                        link.active
                            ? 'bg-blue-600 text-white'
                            : 'bg-gray-800 text-white hover:bg-gray-700'
                    ]">
                {{ link.label }}
                </Link>
            </template>

            <Link v-if="props.pagination.links.next" :href="props.pagination.links.next"
                class="px-3 py-2 text-sm bg-gray-800 text-white rounded hover:bg-gray-700 transition-colors">
            Suivant ›
            </Link>
            <span v-else class="px-3 py-2 text-sm bg-gray-600 text-gray-400 rounded cursor-not-allowed">
                Suivant ›
            </span>
        </div>

        <div class="ml-6 text-sm text-gray-400">
            {{ props.pagination.meta.current_page }} sur {{ props.pagination.meta.last_page }}
            ({{ props.pagination.meta.total }})
        </div>
    </div>
</template>