<script setup>
import Logger from '@/Helpers/Logger.js';
import {    FormatDate,
            FormatCurrency
} from '@/Helpers/Reservation/Reservation.js';
const props = defineProps({
    UpcomingReservations: Array,
});
Logger('Upcoming Reservations List', props.UpcomingReservations);
</script>
<template>
<!-- Tabla -->
<div class="bg-white rounded-lg p-4 shadow-md my-4">
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left border-b-2 w-full">
                    <h2 class="text-ml font-bold text-gray-600">Proximas llegadas</h2>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(reservation, index) in props.UpcomingReservations" :key="index" class="border-b w-full">
                <td class="px-4 py-2 text-left align-top w-1/2">
                    <div>
                        <h2 class="font-bold text-gray-800">{{ reservation.guests_name }}</h2>
                        <div class="flex">
                            <p class="mr-2"><span class="bg-gray-200 rounded-xl text-sm px-2 py-1 text-gray-600 font-bold">Checkin:</span> {{ FormatDate(reservation.checkin) }}</p>
                            <p><span class="bg-gray-200 rounded-xl text-sm px-2 py-1 text-gray-600 font-bold">Checkout:</span> {{ FormatDate(reservation.checkout) }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-4 py-2 text-right text-cyan-500 w-1/2">
                    <p><span>{{ FormatCurrency(reservation.total) }}</span></p>
                </td>
            </tr>
        </tbody>
    </table>
</div>
</template>