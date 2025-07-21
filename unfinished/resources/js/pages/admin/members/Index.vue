<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Material } from '@/types/models/material';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Membres',
        href: '/membres',
    },
];

const materials: Material[] = [
    {
        name: 'Coupeur ZapZap',
        type: 'Sabre',
        etat: 'Bon',
        isBorrowed: true,
    },
    {
        name: 'Veste magique',
        type: 'Veste',
        etat: 'Moyen',
        isBorrowed: false,
    }
];

</script>

<template>

    <Head title="Membres" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="h-[10%] flex items-center justify-evenly">
            <div class="flex justify-evenly">
                <input type="checkbox" class="bg-gray-900 border-2 border-red-300" name="" id="">
                <button class="p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="fill-white h-4 hover:bg-sky-700"
                        fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M11.25 12.75V18H12.75V12.75H18V11.25H12.75V6H11.25V11.25H6V12.75H11.25Z" />
                    </svg>
                </button>
                <button class="p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-white h-4 hover:bg-amber-900 fill-white"
                        viewBox="0 0 16 16" fill="none">
                        <path d="M4 2H1V4H15V2H12V0H4V2Z" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M3 6H13V16H3V6ZM7 9H9V13H7V9Z" />
                    </svg>
                </button>
            </div>
            <button class="bg-lime-800 hover:bg-lime-600 px-2 py-1 rounded-md min-h-8">
                Ajouter
            </button>
            <div class="flex">
                <input class="bg-white h-[100%] min-h-8 rounded-l-lg" type="text">
                <button
                    class="h-full min-h-8 text-md text-left px-2 rounded-r-lg hover:bg-sky-800 bg-sky-900">Recherche</button>
            </div>
        </div>
        <div class="bg-black-900 h-[90%] flex flex-col">
            <div class="flex *:text-center bg-gray-800 rounded-t-lg h-10 items-center">
                <p class="flex-2">Nom</p>
                <p class="flex-2">Type</p>
                <p class="flex-1">Etat</p>
                <p class="flex-2">Prêt</p>
                <div class="flex-1"></div>
            </div>
            <div v-for="(material, index) in materials" :key="'material_' + index"
                :class="'group flex min-h-10 items-center ' + (index % 2 === 0 ? 'bg-gray-900' : '')">
                <p class="flex-2 text-center">{{ material.name }}</p>
                <p class="flex-2 text-center">{{ material.type }}</p>
                <p class="flex-1 text-center">{{ material.etat }}</p>
                <p class="flex-2 text-center">{{ material.isBorrowed ? 'Prêté' : 'Dispo' }}</p>
                <div class="flex-1 flex justify-evenly">
                    <input type="checkbox" class="bg-gray-900 border-2 border-red-300" name="" id="">
                    <button class="opacity-0 group-hover:opacity-100 transition-opacity duration-200 p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            class="fill-white h-4 hover:bg-sky-700" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M11.25 12.75V18H12.75V12.75H18V11.25H12.75V6H11.25V11.25H6V12.75H11.25Z" />
                        </svg>
                    </button>
                    <button class="opacity-0 group-hover:opacity-100 transition-opacity duration-200 p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-white h-4 hover:bg-amber-900 fill-white"
                            viewBox="0 0 16 16" fill="none">
                            <path d="M4 2H1V4H15V2H12V0H4V2Z" />
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3 6H13V16H3V6ZM7 9H9V13H7V9Z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
