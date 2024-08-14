<script setup>
import { ref } from 'vue';
import { ToastSuccess } from '@/Shared/Toast.js'
import AppLayout from '@/Layouts/AppLayout.vue';
import ReservationForm from '@/Pages/Frontend/Reservations/Partials/ReservationForm.vue';
import ReservationActions from '@/Pages/Frontend/Reservations/Partials/ReservationActions.vue';
import UpcomingArrivalsList from '@/Pages/Frontend/Reservations/Partials/UpcomingArrivalsList.vue';
const props = defineProps({
    UpcomingReservations: Object,
});

const UpcomingReservations = ref(props.UpcomingReservations.data);

const RoomTypes = ref(props.UpcomingReservations.data);
</script>

<template>
    <AppLayout title="Menu de Reservaciones">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Sistema hotelero / Reservas
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div>
                    <ReservationActions />
                </div>

                <div>
                    <UpcomingArrivalsList :UpcomingReservations="UpcomingReservations" />
                </div>

                <div class="mt-4 hidden">
                    <form class="form relative w-full">
                        <button class="absolute left-2 -translate-y-1/2 top-1/2 p-1">
                            <svg
                            width="17"
                            height="16"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            role="img"
                            aria-labelledby="search"
                            class="w-5 h-5 text-gray-700"
                            >
                            <path
                                d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9"
                                stroke="currentColor"
                                stroke-width="1.333"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            ></path>
                            </svg>
                        </button>
                        <input
                            class="w-full input rounded-full px-8 py-3 border-2 border-transparent focus:outline-none focus:border-blue-500 placeholder-gray-400 transition-all duration-300 shadow-md"
                            placeholder="Buscar..."
                            required=""
                            type="text"
                        />
                        <button type="reset" class="absolute right-3 -translate-y-1/2 top-1/2 p-1">
                            <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 text-gray-700"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 18L18 6M6 6l12 12"
                            ></path>
                            </svg>
                        </button>
                    </form>
                </div>

            </div>
        </div>

        <div class="py-12 hidden">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <div>
                    <button @click="addNewRoomType" class="hidden py-2 px-4 bg-indigo-100 text-indigo-500 hover:bg-indigo-200 hover:shadow-md transition-all duration-200 font-medium rounded-md mb-4">
                        Añadir nueva
                    </button>
                </div>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg w-full">
                    <!--  -->
                    <div class="px-4 py-8 flex flex-row-reverse justify-between">
                        <div class="ml-4 rounded-lg w-1/3 hidden">
                            <h3 class="text-lg font-semibold text-gray-800 w-full text-center">Resumen</h3>

                        </div>
                        <div class="w-full">
                                <ReservationForm :RoomTypes="RoomTypes"/>
                        </div>
                    </div>
                    <!--  -->
                </div>
            </div>
        </div>
    </AppLayout>
</template>