<script setup>
import { ref } from 'vue';
import { ToastSuccess } from '@/Shared/Toast.js'
import {FormatDateToHuman} from '@/Helpers/Reservation/Reservation.js';
import AppLayout from '@/Layouts/AppLayout.vue';
import ShowReservationForm from '@/Pages/Frontend/Reservations/Partials/ShowReservationForm.vue';
const props = defineProps({
    RoomTypes: Object,
    Reservation: Object,
});
const RoomTypes = ref(props.RoomTypes.data);
</script>

<template>
    <AppLayout title="Reservación">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Sistema hotelero / Reservación
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <div>
                    <button @click="addNewRoomType" class="hidden py-2 px-4 bg-indigo-100 text-indigo-500 hover:bg-indigo-200 hover:shadow-md transition-all duration-200 font-medium rounded-md mb-4">
                        Añadir nueva
                    </button>
                </div>

                <div class="flex">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg w-2/3 mr-8">
                        <!--  -->
                        <div class="px-4 py-8 flex flex-row-reverse justify-between">
                            <div class="ml-4 rounded-lg w-1/3 hidden">
                                <h3 class="text-lg font-semibold text-gray-800 w-full text-center">Resumen</h3>

                            </div>
                            <div class="w-full">
                                    <ShowReservationForm :Reservation="props.Reservation" :RoomTypes="RoomTypes"/>
                            </div>
                        </div>
                        <!--  -->
                    </div>

                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg w-1/3">
                        <!-- RESUMEN -->
                        <div class="p-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800 w-full text-center">Resumen</h3>
                                </div>
                                <div>
                                    <div class="flex justify-between bg-gray-100 px-3 py-3 rounded-2xl mb-4">
                                        <p class="text-gray-600 font-semibold">Habitación:</p>
                                        <p class="text-gray-800 font-semibold">{{ props.Reservation.room_type.name }}</p>
                                    </div>
                                    <div class="flex justify-between bg-gray-100 px-3 py-3 rounded-2xl mb-4">
                                        <p class="text-gray-600 font-semibold">Llegada:</p>
                                        <p class="text-gray-800 font-semibold">{{ FormatDateToHuman(props.Reservation.checkin) }}</p>
                                    </div>
                                    <div class="flex justify-between bg-gray-100 px-3 py-3 rounded-2xl">
                                        <p class="text-gray-600 font-semibold">Salida:</p>
                                        <p class="text-gray-800 font-semibold">{{ FormatDateToHuman(props.Reservation.checkout) }}</p>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
