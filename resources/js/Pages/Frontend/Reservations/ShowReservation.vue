<script setup>
import { ref } from 'vue';
import { ToastSuccess } from '@/Shared/Toast.js'
import AppLayout from '@/Layouts/AppLayout.vue';
import ReservationForm from '@/Pages/Frontend/Reservations/Partials/ReservationForm.vue';
const props = defineProps({
    RoomTypes: Object,
});
const RoomTypes = ref(props.RoomTypes.data);
</script>

<template>
    <AppLayout title="Nueva reservación">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Sistema hotelero / Reservaciones
            </h2>
        </template>

        <div class="py-12">
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
                                <!-- <ReservationForm :RoomTypes="RoomTypes"/> -->
                        </div>
                    </div>
                    <!--  -->
                </div>
            </div>
        </div>
    </AppLayout>
</template>
