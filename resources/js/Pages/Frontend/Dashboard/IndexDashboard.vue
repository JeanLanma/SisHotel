<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import UpcomingArrivalsList from '@/Pages/Frontend/Dashboard/Partials/UpcomingArrivalsList.vue';
import TodayArrivalList from '@/Pages/Frontend/Dashboard/Partials/TodayArrivalsList.vue';
import DashboardActions from '@/Pages/Frontend/Dashboard/Partials/DashboardActions.vue';
import Logger from '@/Helpers/Logger';
import { ref } from 'vue';

const props = defineProps({
    Arrivals: Object,
});
Logger('IndexDashboard:Arrivals:8', props.Arrivals);
const RoomCount = ref({
    occupied: props.Arrivals.occupied_rooms,
    available: props.Arrivals.available_rooms,
});
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
                    
                <DashboardActions :UpcomingReservations="props.Arrivals.today" :RoomCount="RoomCount" />

                <div class="flex">

                    <div class="mr-2">
                        <TodayArrivalList :UpcomingReservations="props.Arrivals.today" />
                    </div>
                    <div>
                        <UpcomingArrivalsList :UpcomingReservations="props.Arrivals.upcoming" />
                    </div>
                
                </div>

            </div>
        </div>
    </AppLayout>
</template>
