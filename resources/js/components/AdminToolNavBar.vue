<script setup lang="ts">
import { ref, type Ref } from 'vue';
import CustomCheckbox from './CustomCheckbox.vue';

interface adminNavProps {
    withSearch?: boolean,
    withAddAndDelete?: boolean,
}

const props = withDefaults(defineProps<adminNavProps>(), {
    withSearch: true,
    withAddAndDelete: true,
});

const checkAll: Ref<boolean> = ref(false);
</script>

<template>
    <div class="h-[10%] flex items-center justify-between px-6 bg-gradient-to-r from-gray-900 to-gray-800 border-b border-gray-700">
        <div class="flex items-center gap-3" v-if="props.withAddAndDelete">
            <div class="flex items-center gap-2 px-3 py-2 bg-gray-800/50 rounded-lg border border-gray-700/50 backdrop-blur-sm">
                <CustomCheckbox 
                    v-model="checkAll" 
                    class="transform scale-110" 
                />
                <span class="text-xs text-gray-400 font-medium">Tout sélectionner</span>
            </div>
            
            <div class="flex gap-2">
                <button class="group relative p-3 bg-emerald-600/20 hover:bg-emerald-600/30 border border-emerald-500/30 rounded-lg transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-emerald-500/20">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 fill-emerald-400 group-hover:fill-emerald-300 transition-colors">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M11.25 12.75V18H12.75V12.75H18V11.25H12.75V6H11.25V11.25H6V12.75H11.25Z" />
                    </svg>
                    <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 px-2 py-1 bg-gray-900 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                        Ajouter
                    </div>
                </button>
                
                <button class="group relative p-3 bg-red-600/20 hover:bg-red-600/30 border border-red-500/30 rounded-lg transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-red-500/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-red-400 group-hover:fill-red-300 transition-colors" viewBox="0 0 16 16">
                        <path d="M4 2H1V4H15V2H12V0H4V2Z" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M3 6H13V16H3V6ZM7 9H9V13H7V9Z" />
                    </svg>
                    <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 px-2 py-1 bg-gray-900 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                        Supprimer
                    </div>
                </button>
            </div>
        </div>

        <div class="flex items-center" v-if="props.withSearch">
            <div class="relative group">
                <input 
                    class="w-80 h-10 pl-4 pr-12 bg-gray-800/50 border border-gray-600/50 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 backdrop-blur-sm transition-all duration-300 focus:shadow-lg focus:shadow-blue-500/10" 
                    type="text" 
                    placeholder="Rechercher..."
                >
                <button class="absolute right-2 top-1/2 transform -translate-y-1/2 p-2 text-gray-400 hover:text-blue-400 hover:bg-blue-500/10 rounded-md transition-all duration-200 group-hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </button>
                
                <div class="absolute inset-0 rounded-lg bg-gradient-to-r from-blue-500/20 to-purple-500/20 opacity-0 group-focus-within:opacity-100 transition-opacity duration-300 -z-10 blur-sm"></div>
            </div>
        </div>
    </div>
</template>