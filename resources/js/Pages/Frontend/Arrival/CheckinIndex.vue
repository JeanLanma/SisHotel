<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Logger from '@/Helpers/Logger';
import { ref } from 'vue';
import {
            FormatToDateHumanShort,
            IsCheckInToday,
            IsCheckOutToday,
        } from '@/Helpers/Reservation/Reservation';

const props = defineProps({
    Reservation: Object,
    AvailableRooms: Object,
});
const Reservation = ref(props.Reservation);
const AvailableRooms = ref(props.AvailableRooms);
Logger('CheckinIndex:Arrival:8', Reservation);
Logger('CheckinIndex:Rooms:8', props.AvailableRooms);
</script>

<template>
    <AppLayout title="Checkin">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Sistema hotelero / {{ IsCheckInToday(Reservation.checkin) ? 'Checkin' : 'Checkout'}} - {{ Reservation.guests.full_name }}
            </h2>
        </template>

        <div class="py-6">
            
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    
                <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl m-5">
                    <div class="p-8 flex items-center">
                        <div class="pr-4">
                            <p v-if="IsCheckInToday(Reservation.checkin)" class="text-4xl font-bold">CI</p>
                            <p v-else class="tesxt-4xl font-bold">RE</p>
                            <p v-if="IsCheckOutToday(Reservation.checkout)" class="text-4xl font-bold">CO</p>
                        </div>
                        <div>
                        <!-- <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">23 de Noviembre, 2023</div> -->
                        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">{{ FormatToDateHumanShort(props.Reservation.checkin) }}</div>
                        <p class="mt-2 text-gray-500 text-sm">{{ FormatToDateHumanShort(props.Reservation.checkin) }} - {{ FormatToDateHumanShort(props.Reservation.checkout) }}</p>
                        <p class="mt-2 text-gray-500">
                            <p>A nombre de: {{ Reservation.guests.full_name }} </p>
                            <p>{{ Reservation.adults }} Adultos<p v-if="Reservation.kids > 0">,{{ Reservation.kids }} </p></p>
                        </p>
                        </div>
                    </div>
                                            <!-- Rooms -->
                    <div class="p-8 grid grid-cols-3 gap-3">
                        <label
                            for="female"
                            class="flex-1 flex space-x-2 justify-between items-center rounded-md px-2 py-1 border border-gray-400"
                        >
                            <span>Female</span>
                            <input type="radio" id="female" name="gender" />
                        </label>
                    </div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
