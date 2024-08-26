<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Logger from '@/Helpers/Logger';
import { ref } from 'vue';
import {
            FormatToDateHumanShort,
            IsCheckOutToday,
            FormatCurrency,
            IsCheckInToday,
            Pluralize,
            GetNights,
        } from '@/Helpers/Reservation/Reservation';
import { 
            ToastWarning,
            ToastSuccess    
        } from '@/Shared/Toast';
import axios from 'axios';

const props = defineProps({
    Reservation: Object,
    AvailableRooms: Object,
});
const Reservation = ref(props.Reservation);
const AvailableRooms = ref(props.AvailableRooms);
const checkedRooms = ref([]);
if(Reservation.value.room_id){
    checkedRooms.value.push(Reservation.value.room_id);
}
Reservation.value.nights = GetNights(Reservation.value.checkin, Reservation.value.checkout);
const handleCheckin = () => {
    if(checkedRooms.value.length == 0){
        ToastWarning('Selecciona al menos una habitación');
        return;
    }
    if(props.Reservation.rooms != checkedRooms.value.length){
        ToastWarning('Selecciona el número de habitaciones correcto');
        return;
    }
    axios.post(route('admin.reservations.arrivals.checkin', Reservation.value.id), {
        rooms: checkedRooms.value,
    }).then((response) => {
        ToastSuccess('Checkin realizado');
        Logger('CheckinIndex:RESPONSE:43', response.data);
    }).catch((error) => {
        Logger('CheckinIndex:ERROR:45', error);
        ToastWarning('Error al realizar el checkin');
    });
    // Logger('CheckinIndex:CheckedRoom:17', {
    //     data: checkedRooms.value,
    //     checked: checkedRooms.value.length,
    //     neccesary: props.Reservation.rooms,
    //     isGreaterThan: (checkedRooms.value.length > Reservation.rooms),
    // });
}
Logger('CheckinIndex:Arrival:17', props.Reservation);
Logger('CheckinIndex:Rooms:18', props.AvailableRooms);
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
                    
                <div class="max-w-lg mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-3xl m-5">
                    <div class="p-8 flex items-center">
                        <div class="pr-4">
                            <p v-if="IsCheckInToday(Reservation.checkin)" class="text-4xl font-bold">CI</p>
                            <p v-else class="tesxt-4xl font-bold">RE</p>
                            <p v-if="IsCheckOutToday(Reservation.checkout)" class="text-4xl font-bold">CO</p>
                        </div>
                        <div>
                        <!-- <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">23 de Noviembre, 2023</div> -->
                        <div class="uppercase tracking-wide text-indigo-500 font-semibold text-lg">
                            {{ FormatToDateHumanShort(props.Reservation.checkin) }}, 
                            <span class="font-bold text-indigo-400 text-base">{{ `${Reservation.nights} ${Pluralize('noche',Reservation.nights)} - ${Reservation.rooms} ${Pluralize('habitación', Reservation.rooms)} ${Reservation.room_type.name} (${Reservation.room_type.room_type})` }}</span>
                        </div>
                        <p class="mt-2 text-gray-500">{{ FormatToDateHumanShort(props.Reservation.checkin) }} - {{ FormatToDateHumanShort(props.Reservation.checkout) }}</p>
                        <p class="mt-2 text-gray-500">
                            <p>A nombre de: {{ Reservation.guests.full_name }} </p>
                            <p>{{ Reservation.adults }} {{ Pluralize('adulto', Reservation.adults) }}<span v-if="Reservation.kids > 0">, {{ Pluralize('niño', Reservation.kids) }} {{ Reservation.kids }} </span></p>
                            <p class="mt-2 text-lg text-gray-600"> Total: <span class="font-semibold">{{ FormatCurrency(Reservation.total) }}</span></p>
                        </p>
                        </div>
                    </div>
                    <!-- Rooms -->
                    <div class="p-8 grid grid-cols-3 gap-3">
                        <label
                            v-if="Reservation.room_id && Reservation.room"
                            :for="Reservation.room"
                            class="flex-1 flex space-x-2 justify-between items-center rounded-md px-2 py-1 border border-gray-400"
                        >
                            <span class="text-gray-700">Habitación <span class="font-bold text-black">{{ Reservation.room.room }}</span> <span class="text-xs">asignada</span> </span>
                            <input checked="cheked" class="rounded-2xl" type="checkbox" :value="Reservation.room.id" :id="Reservation.room.room" v-model="checkedRooms" />
                        </label>
                        <label
                            v-for="room in AvailableRooms.rooms"
                            :for="room.room"
                            class="flex-1 flex space-x-2 justify-between items-center rounded-md px-2 py-1 border border-gray-400"
                        >
                            <span class="text-gray-700">Habitación: <span class="font-bold text-black">{{ room.room }}</span></span>
                            <input class="rounded-2xl" type="checkbox" :value="room.id" :id="room.room" v-model="checkedRooms" />
                        </label>
                    </div>
                </div>
                <div class="md:max-w-3xl mx-auto">
                    <button @click.native="handleCheckin" class="w-full py-2 px-4 bg-sky-500 text-white hover:bg-sky-600 hover:shadow-md transition-all duration-200 font-medium rounded-md mb-4">
                        Hacer checkin ahora
                    </button>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
