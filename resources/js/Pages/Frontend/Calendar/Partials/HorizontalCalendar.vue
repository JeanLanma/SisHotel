<script setup>
import Logger from '@/Helpers/Logger';
import { ref } from 'vue';
import Swal from 'sweetalert2'

const date = ref(new Date());
// Get today date in format YYYY-MM-DD
const today = date.value.toISOString().split('T')[0];
const TodayRef = ref(null);

const props = defineProps({
    Dates: Array,
    Rooms: Array | Object,
});


const HandleClickRoomDate = (event) => {
    Logger('Click en la celda', event.target.id);
    Swal.fire(event.target.id);
}
</script>

<template>
    <div  class='flex bg-white shadow-md justify-start md:justify-center rounded-lg overflow-x-scroll mx-auto py-4'>
      
        <div class="w-full">

            <div>
                <table class="border-collapse w-full">
                    <thead>
                        <tr class="flex overflow-hidden">
                            <th class="text-center py-3 bg-gray-200 border border-gray-300">
                                <div class="w-12 text-sm font-semibold text-gray-800">
                                    <p>{{ props.Dates[0].day_name }}</p>
                                </div>
                            </th>
                            
                            <th v-for="date in props.Dates" :class="{ 'bg-red-500' : (date.date_string == today)}" class="text-center py-3 bg-gray-200 border border-gray-300">
                                <div class="w-12 text-sm font-semibold text-gray-800">
                                    <p>{{ date.day_name.substring(0,3) }}</p>
                                    <p>{{ date.day }}</p>
                                </div>
                            </th>
                        </tr>
                    </thead>
                </table>
                <table v-for="(RoomType, key, index) in props.Rooms" :key="index" class="border-collapse">
                    <thead>
                        <tr>
                            <th class="text-center py-2 bg-gray-200 border border-gray-300">
                                {{ key }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="room in RoomType" class="flex overflow-hidden">
                            <td class="text-center py-2 border border-gray-300">
                                <div class="w-12 text-sm font-semibold text-gray-800">
                                    <p>{{ room.room }}</p>
                                </div>
                            </td>
                            <td @click="HandleClickRoomDate" v-for="date in props.Dates" :key="date.date_string" :id="date.date_string + '--' + room.room" class="text-center py-1 border border-gray-300 hover:bg-green-500 transition-colors duration-200">
                                <div class="w-12 text-sm font-semibold text-gray-800">
                                    <p></p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>


        </div>

    </div>
</template>