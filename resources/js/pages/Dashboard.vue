<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];
</script>

<template>

    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <Link :href="route('membres.index')"
                    class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border flex justify-center items-center hover:bg-teal-800 transition-all duration-300 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" class="svg py-5"
                        viewBox="0 0 32 32" version="1.1">
                        <path
                            d="M15.116 16.884c0.226 0.224 0.537 0.363 0.881 0.363 0.69 0 1.25-0.56 1.25-1.25 0-0.344-0.139-0.655-0.363-0.881l-6.211-6.211c1.55-0.663 2.617-2.175 2.617-3.937 0-2.358-1.912-4.27-4.27-4.27s-4.27 1.912-4.27 4.27c0 1.666 0.955 3.11 2.347 3.813l0.024 0.011-3.918 3.245c-0.278 0.231-0.453 0.576-0.453 0.963 0 0.087 0.009 0.171 0.026 0.253l-0.001-0.008 1 5.001c0.119 0.576 0.622 1.004 1.225 1.004h0c0.087-0 0.172-0.009 0.255-0.025l-0.008 0.001c0.577-0.119 1.005-0.623 1.005-1.227 0-0.087-0.009-0.171-0.026-0.253l0.001 0.008-0.854-4.269 2.378-1.969v7.211l-4.888 10.754c-0.075 0.156-0.119 0.339-0.119 0.532 0 0.69 0.56 1.25 1.25 1.25 0.508 0 0.946-0.303 1.141-0.739l0.003-0.008 3.862-8.497 3.862 8.497c0.199 0.443 0.636 0.747 1.144 0.747 0.69 0 1.25-0.56 1.25-1.25 0-0.193-0.044-0.376-0.122-0.539l0.003 0.008-4.888-10.753v-6.712zM9 3.25c0.966 0 1.75 0.784 1.75 1.75s-0.784 1.75-1.75 1.75c-0.966 0-1.75-0.784-1.75-1.75v0c0.001-0.966 0.784-1.749 1.75-1.75h0zM28.961 29.199l-10-11.999c-0.231-0.276-0.575-0.45-0.96-0.45-0.69 0-1.25 0.56-1.25 1.25 0 0.305 0.109 0.585 0.291 0.802l-0.002-0.002 9.999 12c0.231 0.276 0.576 0.45 0.961 0.45 0.691 0 1.251-0.56 1.251-1.251 0-0.306-0.11-0.585-0.291-0.803l0.002 0.002z" />
                    </svg>
                    <h2 class="text-white">Membres</h2>
                </Link>
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
            </div>
            <div
                class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
                <PlaceholderPattern />
            </div>
        </div>
    </AppLayout>
</template>
