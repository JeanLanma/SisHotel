<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import { ReservationData } from '@/Helpers/Reservation/ReservationData';
import { ToastSuccess } from '@/Shared/Toast.js'
import Logger from '@/Helpers/Logger.js';
import { GetNights,
         GetTotalPrice,
         ApplyTax,
         FormatDate,
 } from '@/Helpers/Reservation/Reservation';

const props = defineProps({
    RoomTypes: Object,
    Reservation: Object,
});
const Reservation = ref(props.Reservation || ReservationData);
const RoomTypes = ref(props.RoomTypes);
Logger('ReservationForm:20', Reservation.value);
const ReservationForm = useForm({
    checkin: FormatDate(Reservation.value.checkin),
    checkout: FormatDate(Reservation.value.checkout),
    nights: 1,
    room_type: Reservation.value.room_type,
    adults: Reservation.value.adults,
    kids: Reservation.value.kids,
    rooms: Reservation.value.rooms,
    room_type_id: Reservation.value.room_type_id,

    name: Reservation.value.guest_name,
    lastname: Reservation.value.guests.lastname,
    email: Reservation.value.email,
    phone: Reservation.value.phone,
    gender: 'M',
    nationality: 'MX',
    observations: Reservation.value.observations,

    tax_free_account: Reservation.value.tax_free_account,
    total: Reservation.value.total,
});


const saveReservation = () =>{
    
    ReservationForm.nights = GetNights(ReservationForm.checkin, ReservationForm.checkout);
    ReservationForm.tax_free_account = GetTotalPrice(RoomTypes.value.find(rt => rt.id == ReservationForm.room_type).base_price, ReservationForm.nights, ReservationForm.rooms);
    ReservationForm.total = ApplyTax(ReservationForm.tax_free_account);
    ReservationForm.post(route('admin.reservations.store'), {
        preserveScroll: true,
        onSuccess: () => {
            ToastSuccess('Reservación guardada');
            ReservationForm.reset();
        },
        onError: (errors) => {
            log('Error', errors);
            alert('Error al guardar la reservación');
        }
    });
}
</script>

<template>
    <div class="-mt-2">
        <h1 class="text-2xl font-bold text-gray-700">Datos de la reservación</h1>
    </div>
    <form >
    <!-- Reserva -->
    <div>
        <!-- Reserva -->
        <div class="flex">
            <!-- Checkin -->
            <div class="w-1/3 mr-4">
                <label for="checkin" class="block text-sm font-bold text-gray-700">Check in</label>
                <TextInput disabled="true" v-model="ReservationForm.checkin" type="date" name="checkin" id="checkin" class="mt-1 w-full"/>
            </div>
            <!-- Checkout -->
            <div class="w-1/3 mr-4">
                <label for="checkout" class="block text-sm font-bold text-gray-700">Check out</label>
                <TextInput v-model="ReservationForm.checkout" type="date" name="checkout" id="checkout" class="mt-1 w-full"/>
            </div>
            <!-- Tipo de habitacion -->
            <div class="w-1/3">
                <label for="room_type" class="block text-sm font-bold text-gray-700">Tipo de habitación</label>
                <select v-model="ReservationForm.room_type_id" id="room_type" name="room_type" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full">
                    <option v-for="rt in RoomTypes" :value="rt.id" :selected="(Reservation.room_type_id == rt.id) ? true : false">{{ rt.name }} - {{ rt.room_type }}</option>
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
</template>