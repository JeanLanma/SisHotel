<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import HorizontalCalendar from './Partials/HorizontalCalendar.vue';
import Logger from '@/Helpers/Logger';

const props = defineProps({
    Dates: Object,
    Rooms: Array | Object,
});

Logger('Fechas de la base datos',   props.Dates);
Logger('Habitaciones de la base datos',   props.Rooms);
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Sistema hotelero / Calendario
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                    <HorizontalCalendar 
                        :Dates="props.Dates"
                        :Rooms="props.Rooms"
                        />

                </div>
            </div>
        </div>
    </AppLayout>
</template>
