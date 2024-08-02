<script setup>
import InfoButton from '@/Components/InfoButton.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
const RoomsForm = useForm([{
    room_type_id: '',
    room: 0,
    status: 1,
}]);

const Rooms = ref([]);
const areRoomsLoaded = ref(false);

const props = defineProps({
    room_type: {
        default: '',
    },
    base_availability: {
        type: Number,
        default: 0,
    },
    starts_at: {
        type: Number,
        default: 1,
    },
})

const parseRoomNumber = (roomNumber) => {
    return props.starts_at + roomNumber
}
const addNewRoom = () => {
    Rooms.value.push({
        room_type_id: props.room_type,
        room: Rooms.value.length + 1,
        status: 1,
    });
}

function getRoomsByType(type) {
    return axios.get(`/admin/rooms/api/rooms/${type}`)
        .then(response => {
            console.log(response.data);
            return response.data;
        })
        .catch(error => {
            console.error(error);
            alert('Error al cargar las habitaciones');
        });
}
async function Dev() {
    Rooms.value = await getRoomsByType(props.room_type);
    Rooms.value = Rooms.value.data;
    console.log(Rooms.value);
} 
const SaveRooms = () => {
    RoomsForm.post(route('admin.rooms.room-types.store'), {
        errorBag: 'RoomsForm',
        preserveScroll: true,
        onSuccess: (data) => {
            RoomsForm.reset()
            // ToastSuccess('Cambios guardados');
        },
    });
}
getRoomsByType(props.room_type);
</script>

<template>
<!-- responsive table-->
<div class="mt-2">
      <table class="w-full table-auto">
        <thead class="justify-between">
          <tr class="bg-gray-600 text-left">
            <th class="pl-4 py-2">
              <span class="text-gray-100 font-semibold">Clave</span>
            </th>
          
            <th class="py-2 flex items-center justify-between">
              <span class="text-gray-100 font-semibold">Habitación</span>
              <InfoButton :type="'button'" class="">Guardar</InfoButton>
              <InfoButton @click="Dev" :type="'button'" class="mr-2">Actualizar</InfoButton>
            </th>

            <th class="px-16 py-2 hidden">
              <span class="text-gray-100 font-semibold">Setting</span>
            </th>
          </tr>
        </thead>
        <tbody class="bg-gray-200">
          <tr v-if="areRoomsLoaded && Rooms.length > 0" v-for="(availability, index) in Rooms" class="bg-white border-b-2 border-gray-200">

            <td class="pl-4 bg-indigo-200">
              <span class="text-center ml-2 font-semibold">{{props.room_type}}</span>
            </td>
           
            <td class="">
              <span>
                <input class="border-none w-full" type="text" name="DBL-1001" id="DBL-1001" :value="parseRoomNumber((index + 1))">
              </span>
            </td>

            <td class="px-16 py-2 hidden">
              <span class="text-yellow-500 flex">
              <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 text-green-700 mx-2"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"
                                            />
                                            <path
                                                fill-rule="evenodd"
                                                d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                 <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5 text-red-700"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
              </span>
            </td>
          </tr>
          <tr v-else>
            <td class="pl-4 bg-indigo-200">
              <span class="text-center ml-2 font-semibold">{{props.room_type}}</span>
            </td>
            <td class="px-16 py-2">
              <span class="text-center ml-2 font-semibold">Cargando habitaciones...</span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
</template>