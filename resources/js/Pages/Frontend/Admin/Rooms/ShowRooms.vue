<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {    RoomStatusColor,
            RoomStatusLabel,
} from '@/Helpers/Rooms/RoomEnums';
import { ref } from 'vue';

/** Props */
const props = defineProps({
    Rooms: Object,
});

/** Const */
const Rooms = ref(props.Rooms.data);
const SelectedRoomType = ref(null);
const RoomList = ref([]);

/** Functions */
const SetSelectedRoomType = (room) => {
    SelectedRoomType.value = room;
    FilterRoomList();    
}
const FilterRoomList = () => {
    RoomList.value = Rooms.value.find(room => room.id == SelectedRoomType.value).rooms;
}
console.log(Rooms.value);
</script>

<template>
    <AppLayout title="Habitaciones">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Sistema hotelero - Habitaciones
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <div>
                    <button @click="addNewRoomType" class="py-2 px-4 bg-indigo-100 text-indigo-500 hover:bg-indigo-200 hover:shadow-md transition-all duration-200 font-medium rounded-md mb-4">
                        Añadir nueva
                    </button>
                </div>
                
                <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4">
                    <div @click="SetSelectedRoomType(room.id)" v-for="(room, index) in Rooms" :key="index" class="border-2 border-gray-500 px-4 py-2">
                        {{ room.name }}
                    </div>
                </div>

                <div class="mt-4 grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4">
                    
                    <div v-if="RoomList.length > 0" v-for="(room, index) in RoomList" :key="index" :class="RoomStatusColor(room.status)" class="cursor-pointer max-w-xs overflow-hidden bg-white border border-gray-200 rounded-xl shadow-md transform transition-all duration-500 hover:shadow-lg hover:scale-105 relative group">
                        <div class="absolute inset-0 bg-gradient-to-br from-gray-100 to-white opacity-0 transition-opacity duration-500 group-hover:opacity-30 blur-md"></div>
                        <div class="p-6 relative z-10">
                            <p class="text-xl font-semibold text-gray-800">
                                {{ room.room }} - <span class="font-bold text-gray-600 text-base">{{ RoomStatusLabel(room.status) }}</span>
                            </p>
                            <p class="mt-2 font-bold text-gray-600">
                            </p>
                            <div class="flex items-center mt-4 text-gray-600">
                                <span class="ml-2">4.8 (24 reviews)</span>
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
        <span class="bg-red-200"></span>
        <span class="bg-green-200"></span>
        <span class="bg-yellow-200"></span>
    </AppLayout>
</template>
