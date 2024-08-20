<script setup>
import InfoButton from '@/Components/InfoButton.vue';
import ActionButton from '@/Components/ActionButton.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { ToastSuccess } from '@/Shared/Toast';
import Logger from '@/Helpers/Logger';

const props = defineProps({
    room_type: {
        default: '',
    },
    base_availability: {
        type: Number,
        default: 0,
    },
    RoomType: {
        type: String,
        default: '',
    },
})

const RoomsForm = useForm({
    id: null,
    room_type_id: '',
    room: 0,
    status: 1,
});

const Rooms = ref([]);
const areRoomsLoaded = ref(false);

const DefaultRoom = {
    id: null,
    room_type_id: props.RoomType,
    room: 1,
    status: 'unavailable',
};

const addNewRoom = () => {
    const room = ref({...DefaultRoom});
    room.value.room = Rooms.value.length + 1;
    Rooms.value = [...Rooms.value, room.value];
}

function getRoomsByType(type) {
    return axios.get(`/admin/rooms/api/rooms/${type}`)
        .then(response => {
            Logger('MinimalRoomsTable:49 axios call', response.data);
            return response.data;
        })
        .catch(error => {
            console.error(error);
            alert('Error al cargar las habitaciones');
        });
}
async function Dev() {
    Rooms.value = await getRoomsByType(props.room_type);
    Logger('MinimalRoomsTable', props.room_type);
    Rooms.value = Rooms.value.data;
    areRoomsLoaded.value = true;
    console.log(Rooms.value);
} 
const SaveRooms = (Room) => {
    RoomsForm.id = Room?.id ? Room.id : null;
    RoomsForm.room_type_id = props.room_type;
    RoomsForm.room = Room.room;
    RoomsForm.status = Room.status;

    RoomsForm.post(route('admin.rooms.rooms.store.json',{ room_type_id: props.room_type }), {
        errorBag: 'RoomsForm',
        preserveScroll: true,
        onSuccess: (data) => {
            RoomsForm.reset()
            ToastSuccess('Cambios guardados');
        },
        onError: () => {
            alert('Error al guardar la habitación');
            console.log(RoomsForm.errors);
        }
    });
}
Dev(props.room_type);
</script>

<template>
<!-- responsive table-->
<div class="mt-2">
      <div>
        <ActionButton @click="addNewRoom" :type="'button'" class="w-full mb-4">Agregar habitación</ActionButton>
      </div>
      <table class="w-full table-auto">
        <thead class="justify-between">
          <tr class="bg-gray-600 text-left">
            <th class="pl-4 py-2">
              <span class="text-gray-100 font-semibold">Clave</span>
            </th>
          
            <th class="py-2 flex items-center justify-between">
              <span class="text-gray-100 font-semibold">Habitación</span>
              <!-- <InfoButton :type="'button'" class="">Guardar</InfoButton> -->
              <InfoButton @click="Dev" :type="'button'" class="mr-2">Actualizar</InfoButton>
            </th>

            <th class="px-8 py-2 ">
              <span class="text-gray-100 font-semibold">...</span>
            </th>
          </tr>
        </thead>
        <tbody class="bg-gray-200">
          <tr v-if="areRoomsLoaded && Rooms.length > 0" v-for="r in Rooms" class="bg-white border-b-2 border-gray-200">

            <td class="pl-4 bg-indigo-200">
              <span class="text-center ml-2 font-semibold">{{props.RoomType}}</span>
            </td>
           
            <td>
              <span>
                <input class="border-none w-full" type="text" name="rooms" :id="RoomType + '-' + r.room" v-model="r.room">
              </span>
            </td>

            <td class="px-8 py-2 ">
              <span class="text-yellow-500 flex">
                <svg @click="SaveRooms(r)" title="Guardar cambios" class="h-5 w-5 text-indigo-500 hover:text-indigo-200 transition-colors duration-200 cursor-pointer" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="currentColor"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>save-floppy</title> <desc>Created with Sketch Beta.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="currentColor" fill-rule="evenodd" sketch:type="MSPage"> <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-152.000000, -515.000000)" fill="currentColor"> <path d="M171,525 C171.552,525 172,524.553 172,524 L172,520 C172,519.447 171.552,519 171,519 C170.448,519 170,519.447 170,520 L170,524 C170,524.553 170.448,525 171,525 L171,525 Z M182,543 C182,544.104 181.104,545 180,545 L156,545 C154.896,545 154,544.104 154,543 L154,519 C154,517.896 154.896,517 156,517 L158,517 L158,527 C158,528.104 158.896,529 160,529 L176,529 C177.104,529 178,528.104 178,527 L178,517 L180,517 C181.104,517 182,517.896 182,519 L182,543 L182,543 Z M160,517 L176,517 L176,526 C176,526.553 175.552,527 175,527 L161,527 C160.448,527 160,526.553 160,526 L160,517 L160,517 Z M180,515 L156,515 C153.791,515 152,516.791 152,519 L152,543 C152,545.209 153.791,547 156,547 L180,547 C182.209,547 184,545.209 184,543 L184,519 C184,516.791 182.209,515 180,515 L180,515 Z" id="save-floppy" sketch:type="MSShapeGroup"> </path> </g> </g> </g></svg>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 text-green-700 hover:text-green-500 mx-2 transition-colors duration-200"
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
              </span>
            </td>
          </tr>
          <tr v-else>
            <td class="pl-4 bg-indigo-200">
              <span class="text-center ml-2 font-semibold">{{props.RoomType}}</span>
            </td>
            <td class="px-16 py-2" colspan="2">
              <span class="text-center font-semibold">No se encontraron habitaciones...</span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
</template>