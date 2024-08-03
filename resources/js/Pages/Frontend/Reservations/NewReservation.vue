<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import { ToastSuccess } from '@/Shared/Toast.js'

const props = defineProps({
    RoomTypes: Object,
});
console.log(props.RoomTypes.data);

const RoomTypeForm = useForm({
    id: null,
    name: '',
    room_type: '',
    base_occupancy: '',
    base_occupancy_kids: '',
    base_price: '',
    base_availability: 0,
});

const RoomTypeDefault = ref({
    name: 'Nueva habitación',
    room_type: 'HAB',
    base_occupancy: '2',
    base_occupancy_kids: '2',
    base_price: '1000.00',
    base_availability: 1,
})
const RoomTypes = ref(props.RoomTypes.data || [RoomTypeDefault]);

const addNewRoomType = () => {
    const newRoomType = ref({...RoomTypeDefault.value});
    RoomTypes.value.push(newRoomType.value);
}

const saveRoomType = (roomType = null) => {
    if(roomType === null) {
        return;
    }
    submitForm(roomType);
}

const submitForm = ({id, name, room_type, base_occupancy, base_occupancy_kids, base_price, base_availability}) => {

    RoomTypeForm.id = id;
    RoomTypeForm.name = name;
    RoomTypeForm.room_type = room_type;
    RoomTypeForm.base_occupancy = base_occupancy;
    RoomTypeForm.base_occupancy_kids = base_occupancy_kids;
    RoomTypeForm.base_price = base_price;
    RoomTypeForm.base_availability = base_availability;

    RoomTypeForm.post(route('admin.rooms.room-types.store'), {
        errorBag: 'createRoomType',
        preserveScroll: true,
        onSuccess: () => {
            RoomTypeForm.reset()
            ToastSuccess('Cambios guardados');
        },
        onError: () => {
            alert('Error al guardar el tipo de habitación');
            console.log(RoomTypeForm.errors);
        }
    });
}

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
                    <button @click="addNewRoomType" class="py-2 px-4 bg-indigo-100 text-indigo-500 hover:bg-indigo-200 hover:shadow-md transition-all duration-200 font-medium rounded-md mb-4">
                        Añadir nueva
                    </button>
                </div>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg w-full">
                    <!--  -->
                    <table class="border-collapse w-full">
                        <thead>
                            <tr>
                                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-800 border border-gray-300 hidden lg:table-cell">Nombre</th>
                                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-800 border border-gray-300 hidden lg:table-cell">Clave</th>
                                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-800 border border-gray-300 hidden lg:table-cell">Adultos</th>
                                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-800 border border-gray-300 hidden lg:table-cell">Niños</th>
                                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-800 border border-gray-300 hidden lg:table-cell">Precio base</th>
                                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-800 border border-gray-300 hidden lg:table-cell">Num. habs.</th>
                                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-800 border border-gray-300 hidden lg:table-cell">...</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="roomType in RoomTypes" class="bg-white lg:hover:bg-indigo-50 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Nombre</span>
                                    <TextInput
                                        id="name"
                                        type="text"
                                        v-model="roomType.name"
                                        autocomplete="name"
                                    />
                                </td>
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Clave</span>
                                    <TextInput
                                        id="room_type"
                                        type="text"
                                        v-model="roomType.room_type"
                                        class="w-full"
                                        autocomplete="room_type"
                                    />
                                </td>
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Adults</span>
                                    <TextInput
                                        id="base_occupancy"
                                        type="number"
                                        v-model="roomType.base_occupancy"
                                        class="w-full"
                                        autocomplete="base_occupancy"
                                    />
                                </td>
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Niños</span>
                                    <TextInput
                                        id="base_occupancy_kids"
                                        type="number"
                                        v-model="roomType.base_occupancy_kids"
                                        class="w-full"
                                        autocomplete="base_occupancy_kids"
                                    />
                                </td>
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Precio base</span>
                                    <TextInput
                                        id="base_price"
                                        type="text"
                                        v-model="roomType.base_price"
                                        class="w-full"
                                        autocomplete="base_price"
                                    />
                                </td>
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Num. habs.</span>
                                    <TextInput
                                        id="base_availability"
                                        type="number"
                                        v-model="roomType.base_availability"
                                        class="w-full"
                                        autocomplete="base_availability"
                                    />
                                </td>
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Actions</span>
                                    <a @click="saveRoomType(roomType)" href="#" class="text-blue-400 hover:text-blue-600 underline">Guardar</a>
                                    <a :href="roomType?.id ? route('admin.rooms.room-types.edit', {roomType}) : '#'" class="text-blue-400 hover:text-blue-600 underline pl-6">Ver</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!--  -->
                </div>
            </div>
        </div>
    </AppLayout>
</template>
