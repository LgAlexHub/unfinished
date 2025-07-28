<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import AdminToolNavBar from '@/components/AdminToolNavBar.vue';
import Pagination from '@/components/Pagination.vue';

import { onMounted, ref, type Ref } from 'vue';
import { Head } from '@inertiajs/vue3';

import { type BreadcrumbItem } from '@/types';
import { Member } from '@/types/models/member';

const props = defineProps<{
    members: {
        data: Member[],
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

const wrappedCheckerMembers: Ref<{check: boolean, data:Member}[]> = ref([]);

onMounted(function () {
    wrappedCheckerMembers.value = props.members.data.map((member) => ({check : false, data : member}));
});

const onCheckALl = (newCheckAllValue:boolean) => {
    wrappedCheckerMembers.value.forEach(wrappedMember => wrappedMember.check = newCheckAllValue);
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Membres',
        href: '/membres',
    },
];
</script>

<template>

    <Head title="Membres" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <AdminToolNavBar @on-check-all="onCheckALl" :add-button-link="'members.form.add'" />
        <div class="min-h-[85%] flex flex-col px-6 py-4">
            <div
                class="h-[100%] bg-gradient-to-br from-gray-900 to-gray-800 rounded-xl border border-gray-700/50 shadow-2xl shadow-black/20 overflow-hidden backdrop-blur-sm">
                <div
                    class="flex items-center bg-gradient-to-r from-gray-800 to-gray-700 border-b border-gray-600/50 h-12 px-4">
                    <div class="flex-1 text-center">
                        <span class="text-sm font-semibold text-gray-300 tracking-wide uppercase">Nom</span>
                    </div>
                    <div class="flex-1 text-center">
                        <span class="text-sm font-semibold text-gray-300 tracking-wide uppercase">Prénom</span>
                    </div>
                    <div class="flex-1 text-center">
                        <span class="text-sm font-semibold text-gray-300 tracking-wide uppercase">Rejoint le</span>
                    </div>
                    <div class="flex-1 text-center">
                        <span class="text-sm font-semibold text-gray-300 tracking-wide uppercase">Actions</span>
                    </div>
                </div>
                <div
                    class="min-h-[100%] overflow-y-auto scrollbar-thin scrollbar-thumb-gray-600 scrollbar-track-gray-800">
                    <div v-for="(member, index) in wrappedCheckerMembers" :key="'member_' + index" :class="[
                        'group flex items-center h-14 px-4 border-b border-gray-700/30 transition-all duration-300 hover:bg-gray-800/50 hover:shadow-lg hover:shadow-gray-900/20',
                        index % 2 === 0 ? 'bg-gray-900/30' : 'bg-gray-800/20'
                    ]">
                        <div class="flex-1 text-center">
                            <span class="text-white font-medium group-hover:text-blue-200 transition-colors">
                                {{ member.data.firstName }}
                            </span>
                        </div>
                        <div class="flex-1 text-center">
                            <span class="text-white font-medium group-hover:text-blue-200 transition-colors">
                                {{ member.data.lastName }}
                            </span>
                        </div>
                        <div class="flex-1 text-center">
                            <span class="text-gray-300 text-sm group-hover:text-gray-100 transition-colors">
                                {{ member.data.joinedAt }}
                            </span>
                        </div>
                        <div class="flex-1 flex justify-center items-center gap-3">
                            <div class="relative">
                                <input type="checkbox" v-model="member.check" class="peer sr-only" :id="'checkbox_' + member.data.id">
                                <label :for="'checkbox_' + member.data.id"
                                    class="flex items-center justify-center w-5 h-5 bg-gray-700 border-2 border-gray-600 rounded cursor-pointer transition-all duration-200 peer-checked:bg-blue-600 peer-checked:border-blue-500 hover:border-blue-400 hover:shadow-lg hover:shadow-blue-500/20">
                                    <svg class="w-3 h-3 text-white opacity-0 peer-checked:opacity-100 transition-opacity"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </label>
                            </div>
                            <button
                                class="opacity-0 group-hover:opacity-100 p-2 bg-emerald-600/20 hover:bg-emerald-600/30 border border-emerald-500/30 rounded-lg transition-all duration-300 hover:scale-110 hover:shadow-lg hover:shadow-emerald-500/20">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    class="w-4 h-4 fill-emerald-400 hover:fill-emerald-300 transition-colors">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M11.25 12.75V18H12.75V12.75H18V11.25H12.75V6H11.25V11.25H6V12.75H11.25Z" />
                                </svg>
                            </button>
                            <button
                                class="opacity-0 group-hover:opacity-100 p-2 bg-red-600/20 hover:bg-red-600/30 border border-red-500/30 rounded-lg transition-all duration-300 hover:scale-110 hover:shadow-lg hover:shadow-red-500/20">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-4 h-4 fill-red-400 hover:fill-red-300 transition-colors"
                                    viewBox="0 0 16 16">
                                    <path d="M4 2H1V4H15V2H12V0H4V2Z" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3 6H13V16H3V6ZM7 9H9V13H7V9Z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <Pagination class="my-10" :pagination="{ links : props.members.links, meta : props.members.meta }" />
                </div>
                <div class="h-1 bg-gradient-to-r from-transparent via-gray-600/50 to-transparent"></div>
            </div>
        </div>
    </AppLayout>
</template>