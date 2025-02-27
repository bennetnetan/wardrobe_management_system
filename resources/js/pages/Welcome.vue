<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert'
import { Rocket, X } from 'lucide-vue-next'
import { ref } from 'vue';

</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div class="flex min-h-screen flex-col items-center bg-[#FDFDFC] p-6 text-[#1b1b18] dark:bg-[#0a0a0a] lg:justify-center lg:p-8">
        <header class="mb-6 w-full max-w-[335px] text-sm lg:max-w-4xl">
            <h1 class="text-3xl font-bold text-center text-blue-100">Wardrobe Management System</h1>
        </header>
        <header class="not-has-[nav]:hidden mb-6 w-full max-w-[335px] text-sm lg:max-w-4xl">
            <nav class="flex items-center justify-end gap-4">
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('dashboard')"
                    class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                >
                    Dashboard
                </Link>
                <template v-else>
                    <Link
                        :href="route('login')"
                        class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]"
                    >
                        Log in
                    </Link>
                    <Link
                        :href="route('register')"
                        class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                    >
                        Register
                    </Link>
                </template>
            </nav>
        </header>
        <Alert class="mb-6 w-full max-w-[335px] lg:max-w-4xl">
            <Rocket class="h-6 w-6 text-blue-500" />
            <AlertTitle class="text-xl font-bold">Welcome to Your Wardrobe Management System!</AlertTitle>
            <AlertDescription class="text-sm">
            We're excited to have you here. Explore the features to organize your wardrobe, plan your outfits, and track your usage. Happy organizing!
            </AlertDescription>
        </Alert>
        <div class="flex w-full items-center justify-center lg:grow">
            <main class="flex w-full max-w-[335px] flex-col overflow-hidden rounded-lg lg:max-w-4xl lg:flex-row">
            <div class="flex-1 bg-white p-6 text-[13px] leading-[20px] shadow-lg dark:bg-[#161615] dark:text-[#EDEDEC] lg:p-20">
                <div class="jumbotron bg-gray-100 p-6 rounded-lg mb-6 dark:bg-[#1D1D1D]">
                <h2 class="text-2xl font-semibold mb-2">Welcome to Wardrobe Management System</h2>
                <p class="text-[#706f6c] dark:text-[#A1A09A]">
                    Our app helps you organize and manage your wardrobe efficiently. Keep track of your clothes, plan outfits, and much more.
                </p>
                </div>
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                <div class="card bg-white p-4 rounded-lg shadow-md dark:bg-[#1D1D1D]">
                    <h3 class="text-xl font-semibold mb-2">Organize Your Wardrobe</h3>
                    <p class="text-[#706f6c] dark:text-[#A1A09A]">
                    Easily categorize and organize your clothes by type, season, and more.
                    </p>
                </div>
                <div class="card bg-white p-4 rounded-lg shadow-md dark:bg-[#1D1D1D]">
                    <h3 class="text-xl font-semibold mb-2">Plan Your Outfits</h3>
                    <p class="text-[#706f6c] dark:text-[#A1A09A]">
                    Plan your outfits for the week and never worry about what to wear again.
                    </p>
                </div>
                <div class="card bg-white p-4 rounded-lg shadow-md dark:bg-[#1D1D1D]">
                    <h3 class="text-xl font-semibold mb-2">Track Your Usage</h3>
                    <p class="text-[#706f6c] dark:text-[#A1A09A]">
                    Keep track of how often you wear each item and make the most of your wardrobe.
                    </p>
                </div>
                </div>
            </div>
            </main>
        </div>
        <footer class="mt-6 w-full text-center text-sm text-[#706f6c] dark:text-[#A1A09A]">
            &copy; 2023 Wardrobe Management System. All rights reserved.
        </footer>
    </div>
</template>
