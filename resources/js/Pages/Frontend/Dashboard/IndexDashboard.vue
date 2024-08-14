<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import UpcomingArrivalsList from '@/Pages/Frontend/Dashboard/Partials/UpcomingArrivalsList.vue';
import DashboardActions from '@/Pages/Frontend/Dashboard/Partials/DashboardActions.vue';

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Sistema hotelero
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    
                <DashboardActions />

                <UpcomingArrivalsList />

            </div>
        </div>
    </AppLayout>
</template>
