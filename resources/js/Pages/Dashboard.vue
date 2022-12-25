<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex flex-col justify-center items-center">
                        <h2 class="underline uppercase decoration-4">Construction</h2>
                        <img alt="gif" src="https://media.giphy.com/media/mTPjPA6SSXgTsnZ1Dh/giphy.gif" class="max-h-fit max-w-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
