<script setup>
import HorizontalCalendar from './Partials/HorizontalCalendar.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import Logger from '@/Helpers/Logger';

const props = defineProps({
    Dates: Object,
    Rooms: Array | Object,
    from_date: String,
    to_date: String,
});

Logger('Fechas de la base datos',   props.Dates);
Logger('Habitaciones de la base datos',   props.Rooms);
Logger('Parametros de fechas',   {from_date: props.from_date, to_date: props.to_date});
</script>

<template>
    <AppLayout title="Rack de habitaciones">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Sistema hotelero / Rack de habitaciones
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    
                    <div class="inner-shadow-xl bg-red-50">
                        <HorizontalCalendar 
                            :Dates="props.Dates"
                            :Rooms="props.Rooms"
                        />
                    </div>

                </div>
            </div>
        </div>
    </AppLayout>
</template>
