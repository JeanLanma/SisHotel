<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import { ToastSuccess } from '@/Shared/Toast.js'
import log from '@/Helpers/Logger.js';
import { GetNights,
         GetTotalPrice,
         ApplyTax
 } from '@/Helpers/Reservation/Reservation';

const props = defineProps({
    RoomTypes: Object,
});
const RoomTypes = ref(props.RoomTypes);
const ReservationForm = useForm({
    checkin: '',
    checkout: '',
    nights: 0,
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

    tax_free_account: 0,
    total: 0,
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

const HandleRoomTypeInput = (e) => {
    const RoomTypeRequested = {
        'room_type': e.target.value,
        'room': RoomTypes.value.find(rt => rt.id == e.target.value),
        'checkin': ReservationForm.checkin,
        'checkout': ReservationForm.checkout,
    }
    // Validate checkin and checkout
    if(ReservationForm.checkin == ''){
        ReservationForm.setError({
            checkin: 'Por favor selecciona una fecha',
        });
        setTimeout(() => {
            ReservationForm.clearErrors('checkin');
        }, 5000);
        return;
    } if(ReservationForm.checkout == ''){
        ReservationForm.setError({
            checkout: 'Por favor selecciona una fecha',
        });
        setTimeout(() => {
            ReservationForm.clearErrors('checkout');
        }, 5000);
        return;
    }
    // Validate if room is available
    log('Request Room Availability', RoomTypeRequested);
}
</script>

<template>
    <form >
    <!-- Reserva -->
    <div>
        <!-- Reserva -->
        <div class="flex">
            <!-- Checkin -->
            <div class="w-1/3 mr-4">
                <label for="checkin" class="block text-sm font-bold text-gray-700" :class="ReservationForm.errors.checkin ? 'text-red-500' : ''">Check in <span class="text-xs" v-show="ReservationForm.errors.checkin">({{ ReservationForm.errors.checkin ?? null }})</span></label>
                <TextInput v-model="ReservationForm.checkin" type="date" name="checkin" id="checkin" class="mt-1 w-full" :class="ReservationForm.errors.checkin ? 'border-red-500' : ''" />
            </div>
            <!-- Checkout -->
            <div class="w-1/3 mr-4">
                <label for="checkout" class="block text-sm font-bold text-gray-700" :class="ReservationForm.errors.checkout ? 'text-red-500' : ''">Check out <span class="text-xs" v-show="ReservationForm.errors.checkout">({{ ReservationForm.errors.checkout ?? null }})</span></label>
                <TextInput v-model="ReservationForm.checkout" type="date" name="checkout" id="checkout" class="mt-1 w-full" :class="ReservationForm.errors.checkout ? 'border-red-500' : ''"/>
            </div>
            <!-- Tipo de habitacion -->
            <div class="w-1/3">
                <label for="room_type" class="block text-sm font-bold text-gray-700">Tipo de habitación</label>
                <select @change="HandleRoomTypeInput" placeholder="-- Tipo de habitación --" v-model="ReservationForm.room_type" id="room_type" name="room_type" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full">
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
</template>