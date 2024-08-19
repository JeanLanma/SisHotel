<script setup>
import { ref } from 'vue';
import { ToastSuccess } from '@/Shared/Toast.js'
import {
        FormatDateToHuman,
        FormatCurrency
    } from '@/Helpers/Reservation/Reservation.js';
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
                
                <div class="">
                    <button class="w-full py-2 px-4 bg-sky-500 text-white hover:bg-sky-600 hover:shadow-md transition-all duration-200 font-medium rounded-md mb-4">
                        Hacer Checkin ahora
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
                                <div class="flex justify-center items-center">
                                    <svg class="" width="24px" height="24px" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M4.5 6.25C4.91421 6.25 5.25 6.58579 5.25 7C5.25 8.75556 5.96468 9.7804 6.81323 10.3913C7.70002 11.0298 8.78668 11.25 9.5 11.25L17.6893 11.25L13.9697 7.53033C13.6768 7.23744 13.6768 6.76256 13.9697 6.46967C14.2626 6.17678 14.7374 6.17678 15.0303 6.46967L20.0303 11.4697C20.3232 11.7626 20.3232 12.2374 20.0303 12.5303L15.0303 17.5303C14.7374 17.8232 14.2626 17.8232 13.9697 17.5303C13.6768 17.2374 13.6768 16.7626 13.9697 16.4697L17.6893 12.75L9.5 12.75C8.54665 12.75 7.13332 12.4702 5.93677 11.6087C4.70198 10.7196 3.75 9.24444 3.75 7C3.75 6.58579 4.08579 6.25 4.5 6.25Z" fill="#1f2937"></path> </g></svg>
                                    <h3 class="text-lg font-semibold text-gray-800 text-center">Resumen</h3>
                                </div>
                                <div>
                                    <div class="flex justify-between border border-gray-300 px-3 py-3 rounded-2xl mb-4 transition-colors">
                                        <p class="text-gray-600 font-semibold">Habitación:</p>
                                        <p class="text-gray-800 font-semibold">{{ props.Reservation.room_type.name }} <span class="text-xs font-bold">(x2 noches)</span> </p>
                                    </div>
                                    <div class="flex justify-between border border-gray-300 px-3 py-3 rounded-2xl mb-4">
                                        <p class="text-gray-600 font-semibold">Llegada:</p>
                                        <p class="text-gray-800 font-semibold">{{ FormatDateToHuman(props.Reservation.checkin) }}</p>
                                    </div>
                                    <div class="flex justify-between border border-gray-300 px-3 py-3 rounded-2xl">
                                        <p class="text-gray-600 font-semibold">Salida:</p>
                                        <p class="text-gray-800 font-semibold">{{ FormatDateToHuman(props.Reservation.checkout) }}</p>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between border border-emerald-300 px-3 py-3 rounded-2xl mt-4 mb-4">
                                        <p class="text-gray-600 font-semibold">Subtotal:</p>
                                        <p class="text-gray-800 font-semibold">{{ FormatCurrency(props.Reservation.tax_free_account) }}</p>
                                    </div>
                                    <div class="flex justify-between bg-emerald-50 px-3 py-3 rounded-2xl">
                                        <p class="text-gray-600 font-semibold">Total:</p>
                                        <p class="text-gray-800 font-semibold">{{ FormatCurrency(props.Reservation.total) }}</p>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
