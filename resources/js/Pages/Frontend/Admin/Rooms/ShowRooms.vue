<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DialogModal  from '@/Components/DialogModal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import MainButton from '@/Components/MainButton.vue';
import {    RoomStatusColor,
            RoomStatusLabel,
            RoomStatus
} from '@/Helpers/Rooms/RoomEnums';
import {    ref,
            onMounted } from 'vue';
import { router } from '@inertiajs/vue3'
import Logger from '@/Helpers/Logger';
import axios from 'axios';

/** Props */
const props = defineProps({
    Rooms: Object,
});

/** Const */
const Rooms = ref(props.Rooms.data);
const SelectedRoomType = ref(null);
const RoomList = ref([]);
const RoomSelected = ref(null);
const ShowEditRoomModal = ref(false);

/** Functions */
/** Room List Display */
const SetSelectedRoomType = (room) => {
    SelectedRoomType.value = room;
    FilterRoomList();    
}
const FilterRoomList = () => {
    RoomList.value = Rooms.value.find(room => room.id == SelectedRoomType.value).rooms;
}
/** Room */
const SetSelectedRoom = (room) => {
    RoomSelected.value = room;
    ShowEditRoomModal.value = true;
    Logger('ShowRooms:37:SelectedRoom', RoomSelected.value);

}
/** Request */
const UpdateRoomStatus = (value) => {
    Logger('ShowRooms:42:UpdateRoomStatus', RoomSelected.value);
    RoomSelected.value.status = value;
    axios.post(`/admin/rooms/api/rooms/${RoomSelected.value.id}/update`, {
        status: value
    }).then(response => {
        Logger('ShowRooms:46:UpdateRoomStatus:Response', response);
    }).catch(error => {
        Logger('ShowRooms:48:UpdateRoomStatus:Error', error);
        alert('Ocurrió un error al actualizar el estatus de la habitación');
    });
}

/** Mounted */
onMounted(() => {
    const room = Rooms.value[0].id;
    SetSelectedRoomType(room);
});
// console.log(Rooms.value);
</script>

<template>
<!-- Modal -->
<DialogModal :show="ShowEditRoomModal" @close="ShowEditRoomModal = false">
    <template #title>
        <p class="text-gray-600">
            Actualizando el estatus de la habitación: <span class="font-bold text-gray-800">{{ RoomSelected.room }}</span>
        </p>
    </template>

    <template #content>
        <div>

            <div v-for="status in RoomStatus" class="radio-group flex">
                <input @click.native="UpdateRoomStatus(status)" :checked="status == RoomSelected.status" class="radio-input" type="radio" :id="status" :name="status">
                <label class="radio-label" :for="status">
                <span class="radio-inner-circle"></span>
                    {{ RoomStatusLabel(status) }}
                </label>
            </div>

        </div>
    </template>

    <template #footer>
        <SecondaryButton @click.native="ShowEditRoomModal = false">
            Cancelar
        </SecondaryButton>

        <MainButton class="ml-2" @click.native="ShowEditRoomModal = false" :disabled="false">
            Realizar cambios
        </MainButton>
    </template>
</DialogModal>
<!-- /Modal -->
    <AppLayout title="Habitaciones">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Sistema hotelero - Habitaciones
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4">
                    <div @click="SetSelectedRoomType(room.id)" v-for="(room, index) in Rooms" :key="index" :class="(SelectedRoomType == room.id) ? 'bg-indigo-300' : ''" class="cursor-pointer border-2 border-gray-500 px-4 py-2 hover:bg-indigo-100 transition-colors duration-200">
                        {{ room.name }}
                    </div>
                </div>

                <div class="mt-4 grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4">
                    
                    <div @click.native="SetSelectedRoom(room)" v-if="RoomList.length > 0" v-for="(room, index) in RoomList" :key="index" :class="RoomStatusColor(room.status)" class="cursor-pointer max-w-xs overflow-hidden bg-white border border-gray-200 rounded-xl shadow-md transform transition-all duration-500 hover:shadow-lg hover:scale-105 relative group">
                        <div class="absolute inset-0 bg-gradient-to-br from-gray-100 to-white opacity-0 transition-opacity duration-500 group-hover:opacity-30 blur-md"></div>
                        <div class="p-6 relative z-10">
                            <p class="text-xl font-semibold text-gray-800">
                                {{ room.room }} - <span class="font-bold text-gray-600 text-base">{{ RoomStatusLabel(room.status) }}</span>
                            </p>
                            <p class="mt-2 font-bold text-gray-600">
                            </p>
                            <div class="flex items-center mt-4 text-gray-600">
                                <span class="ml-2 hidden">4.8 (24 reviews)</span>
                            </div>
                        </div>
                    </div>

                    <div v-else class="w-full flex justify-center col-span-3 mt-4">
                        <h4 class="text-2xl font-bold text-gray-600">No se encontraron habitaciones, por favor seleccione otro tipo de habitación</h4>
                    </div>
                
                </div>
            </div>
        </div>

        <!-- Load Clasess -->
        <span class="bg-green-200"></span>
        <span class="bg-red-200"></span>
        <span class="bg-yellow-100"></span>
    </AppLayout>
</template>

<style>
.radio-group {
  display: flex;
  flex-direction: column;
}

.radio-label {
  display: flex;
  align-items: center;
  padding: 0.5em;
  margin-bottom: 0.5em;
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 4px;
  transition: background-color 0.2s, border-color 0.2s;
}

.radio-label:hover {
  background-color: #e6e6e6;
}

.radio-input {
  position: absolute;
  opacity: 0;
}

.radio-input:checked + .radio-label {
  background-color: #e0f2fe;
  border-color: #0ea5e9;
}

.radio-input:focus + .radio-label {
  outline: 2px solid #0ea5e9;
}

.radio-inner-circle {
  display: inline-block;
  width: 1em;
  height: 1em;
  border: 2px solid #888;
  border-radius: 50%;
  margin-right: 0.5em;
  transition: border-color 0.2s;
  position: relative;
}

.radio-label:hover .radio-inner-circle {
  border-color: #555;
}

.radio-input:checked + .radio-label .radio-inner-circle {
  border-color: #0ea5e9;
}

.radio-input:checked + .radio-label .radio-inner-circle::after {
  content: '';
  display: block;
  width: 0.5em;
  height: 0.5em;
  background-color: #0ea5e9;
  border-radius: 50%;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
</style>
