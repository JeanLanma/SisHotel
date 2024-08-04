<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import { ToastSuccess } from '@/Shared/Toast.js'

const ReservationForm = useForm({
    checkin: '',
    checkout: '',
    room_type: '',
});

</script>

<template>
    <AppLayout title="Tipos de habitaciones">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Sistema hotelero - Tipos de habitaciones
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
                    <div class="px-4 py-8">

                        <form >
                            <!-- Reserva -->
                            <div class="flex">
                                <!-- Checkin -->
                                <div class="w-1/3 mr-4">
                                    <label for="checkin" class="block text-sm font-bold text-gray-700">Checkin</label>
                                    <input v-model="ReservationForm.checkin" type="date" name="checkin" id="checkin" class="mt-1 focus
                                    :ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <!-- Checkout -->
                                <div class="w-1/3 mr-4">
                                    <label for="checkout" class="block text-sm font-bold text-gray-700">Checkout</label>
                                    <input v-model="ReservationForm.checkout" type="date" name="checkout" id="checkout" class="mt-1 focus
                                    :ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <!-- Tipo de habitacion -->
                                <div class="w-1/3">
                                    <label for="room_type" class="block text-sm font-bold text-gray-700">Tipo de habitacion</label>
                                    <select v-model="ReservationForm.room_type" id="room_type" name="room_type" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        <option value="1">Simple</option>
                                        <option value="2">Doble</option>
                                        <option value="3">Triple</option>
                                    </select>
                                </div>
                                
                            </div>

                            <!-- Huespedes -->
                             <div class="flex">
                                <!-- Adultos -->
                                <div class="w-1/3 mr-4">
                                    <label for="adults" class="block text-sm font-bold text-gray-700">Adultos</label>
                                    <input type="number" name="adults" id="adults" class="mt-1 focus :ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                             </div>
                        </form>

                    </div>
                    <!--  -->
                </div>
            </div>
        </div>
    </AppLayout>
</template>
