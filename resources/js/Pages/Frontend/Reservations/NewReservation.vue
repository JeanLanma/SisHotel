<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import { ToastSuccess } from '@/Shared/Toast.js'
import log from '@/Helpers/Logger.js';

const props = defineProps({
    RoomTypes: Object,
});
const RoomTypes = ref(props.RoomTypes.data);
log('Room Types',RoomTypes.value);
const ReservationForm = useForm({
    checkin: '',
    checkout: '',
    room_type: '',
    adults: 2,
    kids: 0,
    rooms: 1,

    name: '',
    lastname: '',
    email: '',
    phone: '',
    gender: 'M',
    nationality: 'MX',
    observations: '',
});


const saveReservation = () =>{
    return log('Guardar Reserva', ReservationForm.data());
}
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
                            <form >
                                <!-- Reserva -->
                                <div>

                                    <!-- Reserva -->
                                    <div class="flex">
                                        <!-- Checkin -->
                                        <div class="w-1/3 mr-4">
                                            <label for="checkin" class="block text-sm font-bold text-gray-700">Check in</label>
                                            <TextInput v-model="ReservationForm.checkin" type="date" name="checkin" id="checkin" class="mt-1 w-full"/>
                                        </div>
                                        <!-- Checkout -->
                                        <div class="w-1/3 mr-4">
                                            <label for="checkout" class="block text-sm font-bold text-gray-700">Check out</label>
                                            <TextInput v-model="ReservationForm.checkout" type="date" name="checkout" id="checkout" class="mt-1 w-full"/>
                                        </div>
                                        <!-- Tipo de habitacion -->
                                        <div class="w-1/3">
                                            <label for="room_type" class="block text-sm font-bold text-gray-700">Tipo de habitación</label>
                                            <select placeholder="-- Tipo de habitación --" v-model="ReservationForm.room_type" id="room_type" name="room_type" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full">
                                                <option selected value="" disabled>-- seleccionar --</option>
                                                <option v-for="rt in RoomTypes" :value="rt.id">{{ rt.name }} - {{ rt.room_type }}</option>
                                            </select>
                                        </div>
                                        
                                    </div>

                                    <!-- Huespedes -->
                                    <div class="flex mt-6">
                                        <!-- Adultos -->
                                        <div class="w-1/8 mr-4">
                                            <label for="adults" class="block text-sm font-bold text-gray-700">Adultos</label>
                                            <TextInput min="0" v-model="ReservationForm.adults" type="number" name="adults" id="adults" class="mt-1 w-full"/>
                                        </div>
                                        <!-- Niños -->
                                        <div class="w-1/8 mr-4">
                                            <label for="children" class="block text-sm font-bold text-gray-700">Niños</label>
                                            <TextInput min="0" v-model="ReservationForm.kids" type="number" name="children" id="children" class="mt-1 -full"/>
                                        </div>
                                        <!-- Habitaciones -->
                                        <div class="w-1/8">
                                            <label for="rooms" class="block text-sm font-bold text-gray-700">Habitaciones</label>
                                            <TextInput min="0" v-model="ReservationForm.rooms" type="number" name="rooms" id="rooms" class="mt-1 w-full"/>
                                        </div>
                                    </div>
                                
                                </div>

                                <!-- Contacto -->
                                <div>
                                    
                                    <div class="flex justify-between gap-4">
                                        <!-- Nombre -->
                                        <div class="mt-6 w-full">
                                            <label for="name" class="block text-sm font-bold text-gray-700">Nombre(s)</label>
                                            <TextInput v-model="ReservationForm.name" type="text" name="name" id="name" class="mt-1 w-full"/>
                                        </div>
                                        <!-- Apellido -->
                                        <div class="mt-6 w-full">
                                            <label for="lastname" class="block text-sm font-bold text-gray-700">Apellido</label>
                                            <TextInput v-model="ReservationForm.lastname" type="text" name="lastname" id="lastname" class="mt-1 w-full"/>
                                        </div>
                                        <!-- Email -->
                                        <div class="mt-6 w-full">
                                            <label for="email" class="block text-sm font-bold text-gray-700">Correo electrónico</label>
                                            <TextInput v-model="ReservationForm.email" type="email" name="email" id="email" class="mt-1 w-full"/>
                                        </div>
                                        <!-- Telefono -->
                                        <div class="mt-6 w-full">
                                            <label for="phone" class="block text-sm font-bold text-gray-700">Telefono</label>
                                            <TextInput v-model="ReservationForm.phone" type="text" name="phone" id="phone" class="mt-1 w-full"/>
                                        </div>
                                    </div>

                                </div>

                                <div>

                                    <!-- Observaciones -->
                                    <div class="flex mt-6">
                                        <div class="w-full">
                                            <label for="observations" class="block text-sm font-bold text-gray-700">Observaciones</label>
                                            <textarea v-model="ReservationForm.observations" name="observations" id="observations" class="mt-1 focus :ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                                        </div>
                                    </div>
                                
                                </div>

                                <div class="mt-6">
                                    <button @click="saveReservation" type="button" class="py-2 px-4 bg-indigo-500 text-white hover:bg-indigo-600 transition-all duration-200 font-medium rounded-md">
                                        Guardar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--  -->
                </div>
            </div>
        </div>
    </AppLayout>
</template>
