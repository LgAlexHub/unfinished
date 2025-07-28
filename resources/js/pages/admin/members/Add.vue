<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';

import { onMounted, ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';

import { type BreadcrumbItem } from '@/types';

const form = useForm({
    firstName: '',
    lastName: '',
    isMinor: false,
    joinedAt: ''
});

const errors = ref({
    firstName: '',
    lastName: '',
    joinedAt: ''
});

const isSubmitting = ref(false);

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Membres - Ajouter',
        href: route('members.form.add'),
    },
];

onMounted(() => {
    const today = new Date();
    form.joinedAt = today.toISOString().split('T')[0];
});

const validateForm = () => {
    errors.value = { firstName: '', lastName: '', joinedAt: '' };
    let isValid = true;

    if (!form.firstName.trim()) {
        errors.value.firstName = 'Le prénom est requis';
        isValid = false;
    }

    if (!form.lastName.trim()) {
        errors.value.lastName = 'Le nom est requis';
        isValid = false;
    }

    if (!form.joinedAt) {
        errors.value.joinedAt = 'La date d\'adhésion est requise';
        isValid = false;
    }

    return isValid;
};

const submitForm = async () => {
    if (!validateForm()) return;

    isSubmitting.value = true;

    try {
        form.post(route("membres.store"));
    } catch (error) {
        console.error('Error submitting form:', error);
    } finally {
        isSubmitting.value = false;
    }
};

const cancelForm = () => {
    console.log('Form cancelled');
};
</script>

<template>

    <Head title="Membres - Ajouter" />
    <AppLayout :breadcrumbs="breadcrumbs">

        <div class="min-h-[85%] flex flex-col px-6 py-4">
            <div class="max-w-2xl mx-auto w-full">
                <div
                    class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-xl border border-gray-700/50 shadow-2xl shadow-black/20 overflow-hidden backdrop-blur-sm">
                    <div
                        class="flex items-center bg-gradient-to-r from-gray-800 to-gray-700 border-b border-gray-600/50 h-16 px-6">
                        <h2 class="text-xl font-bold text-white">Ajouter un nouveau membre</h2>
                    </div>

                    <div class="p-8">
                        <form @submit.prevent="submitForm" class="space-y-6">
                            <div class="group">
                                <label for="firstName"
                                    class="block text-sm font-semibold text-gray-300 tracking-wide uppercase mb-3">
                                    Prénom *
                                </label>
                                <input type="text" id="firstName" v-model="form.firstName" :class="[
                                    'w-full px-4 py-3 bg-gray-800/50 border-2 rounded-lg text-white placeholder-gray-400 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:shadow-lg focus:shadow-blue-500/20',
                                    errors.firstName ? 'border-red-500/50 focus:border-red-400' : 'border-gray-600/50 focus:border-blue-400 hover:border-blue-400/70'
                                ]" placeholder="Entrez le prénom" :disabled="isSubmitting" />
                                <p v-if="errors.firstName" class="mt-2 text-sm text-red-400">{{ errors.firstName }}</p>
                            </div>

                            <div class="group">
                                <label for="lastName"
                                    class="block text-sm font-semibold text-gray-300 tracking-wide uppercase mb-3">
                                    Nom *
                                </label>
                                <input type="text" id="lastName" v-model="form.lastName" :class="[
                                    'w-full px-4 py-3 bg-gray-800/50 border-2 rounded-lg text-white placeholder-gray-400 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:shadow-lg focus:shadow-blue-500/20',
                                    errors.lastName ? 'border-red-500/50 focus:border-red-400' : 'border-gray-600/50 focus:border-blue-400 hover:border-blue-400/70'
                                ]" placeholder="Entrez le nom" :disabled="isSubmitting" />
                                <p v-if="errors.lastName" class="mt-2 text-sm text-red-400">{{ errors.lastName }}</p>
                            </div>

                            <div class="group">
                                <label class="block text-sm font-semibold text-gray-300 tracking-wide uppercase mb-4">
                                    Statut
                                </label>
                                <div class="flex items-center space-x-4">
                                    <div class="relative flex items-center">
                                        <input type="checkbox" id="isMinor" v-model="form.isMinor" class="peer sr-only"
                                            :disabled="isSubmitting">
                                        <label for="isMinor" class="flex items-center cursor-pointer group">
                                            <div
                                                class="flex items-center justify-center w-6 h-6 bg-gray-700 border-2 border-gray-600 rounded cursor-pointer transition-all duration-200 peer-checked:bg-blue-600 peer-checked:border-blue-500 hover:border-blue-400 hover:shadow-lg hover:shadow-blue-500/20 mr-3">
                                                <svg class="w-4 h-4 text-white opacity-0 peer-checked:opacity-100 transition-opacity"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <span
                                                class="text-white font-medium group-hover:text-blue-200 transition-colors">
                                                Membre mineur
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="group">
                                <label for="joinedAt"
                                    class="block text-sm font-semibold text-gray-300 tracking-wide uppercase mb-3">
                                    Date d'adhésion *
                                </label>
                                <input type="date" id="joinedAt" v-model="form.joinedAt" :class="[
                                    'w-full px-4 py-3 bg-gray-800/50 border-2 rounded-lg text-white transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:shadow-lg focus:shadow-blue-500/20',
                                    errors.joinedAt ? 'border-red-500/50 focus:border-red-400' : 'border-gray-600/50 focus:border-blue-400 hover:border-blue-400/70'
                                ]" :disabled="isSubmitting" />
                                <p v-if="errors.joinedAt" class="mt-2 text-sm text-red-400">{{ errors.joinedAt }}</p>
                            </div>

                            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-700/30">
                                <button type="button" @click="cancelForm" :disabled="isSubmitting"
                                    class="px-6 py-3 bg-red-600/20 hover:bg-red-600/30 border border-red-500/30 rounded-lg transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-red-500/20 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100">
                                    <span class="text-red-400 hover:text-red-300 transition-colors font-medium">
                                        Annuler
                                    </span>
                                </button>

                                <button type="submit" :disabled="isSubmitting"
                                    class="px-8 py-3 bg-emerald-600/20 hover:bg-emerald-600/30 border border-emerald-500/30 rounded-lg transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-emerald-500/20 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100 flex items-center space-x-2">
                                    <svg v-if="isSubmitting" class="animate-spin w-4 h-4 text-emerald-400" fill="none"
                                        viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                    <span class="text-emerald-400 hover:text-emerald-300 transition-colors font-medium">
                                        {{ isSubmitting ? 'Ajout en cours...' : 'Ajouter le membre' }}
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="h-1 bg-gradient-to-r from-transparent via-gray-600/50 to-transparent"></div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>