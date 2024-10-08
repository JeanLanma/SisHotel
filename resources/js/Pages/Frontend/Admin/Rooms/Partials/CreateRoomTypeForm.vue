<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue'; 
import DangerButton from '@/Components/DangerButton.vue'; 
import TextInput from '@/Components/TextInput.vue';
import { router } from '@inertiajs/vue3'
import MinimalRoomTable from '@/Pages/Frontend/Admin/Rooms/Partials/MinimalRoomsTable.vue';

const props = defineProps({
    RoomType: Object,
});

const passwordInput = ref(null);

const form = useForm({
    id: props.RoomType?.id,
    name: props.RoomType?.name || '',
    room_type: props.RoomType?.room_type || '',
    description: props.RoomType?.description || '',
    base_occupancy: props.RoomType?.base_occupancy || '',
    max_occupancy: props.RoomType?.max_occupancy || '',
    base_occupancy_kids: props.RoomType?.base_occupancy_kids || '',
    max_occupancy_kids: props.RoomType?.max_occupancy_kids || '',
    base_price: props.RoomType?.base_price || '',
    extra_adult_price: props.RoomType?.extra_adult_price || '',
    extra_kid_price: props.RoomType?.extra_kid_price || '',
    base_availability: props.RoomType?.base_availability || 0,
});

const updatePassword = () => {
    form.put(route('user-password.update'), {
        errorBag: 'updatePassword',
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }

            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};

const SubmitForm = () => {

    alert('Form submitted');
    form.post(route('admin.rooms.room-types.store'), {
        errorBag: 'createRoomType',
        preserveScroll: true,
        onSuccess: () => {
            RoomTypeForm.reset()
        },
        onError: () => {
            alert('Error al guardar el tipo de habitación');
            console.log(RoomTypeForm.errors);
        }
    });
}

const Delete = () => {
    if(confirm('¿Estás seguro de eliminar este tipo de habitación?')) {
        form.delete(route('admin.rooms.room-types.destroy', form.id), {
            errorBag: 'deleteRoomType',
            preserveScroll: true,
            onSuccess: () => {
                alert('Tipo de habitación eliminado');
                router.visit('admin.rooms.room-types.index')
            },
            onError: () => {
                alert('Error al eliminar el tipo de habitación');
                console.log(RoomTypeForm.errors);
            }
        });
    } else {
        alert('Operación cancelada');
    }
}
</script>

<template>
    <FormSection @submitted="SubmitForm">
        <template #title>
            {{RoomType?.id ? 'Nuevo' : 'Modificando'}} tipo de habitación
        </template>

        <template #description>
            Los tipos de habitación son las categorías que se pueden asignar, por ejemplo: "Doble", "Suit" etc...
        </template>

        <template #form>

            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="name" value="Nombre de la habitación" />
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="name"
                />
                <InputError :message="form.errors.name" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="room_type" value="Clave" />
                <TextInput
                    id="room_type"
                    v-model="form.room_type"
                    type="text"
                    class="mt-1 block w-full font-bold"
                    autocomplete="room-type"
                />
                <InputError :message="form.errors.name" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="description">
                    Descripción <span class="text-xs text-gray-500">(opcional)</span>
                </InputLabel>
                <TextInput
                    id="description"
                    v-model="form.description"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="description"
                />
                <InputError :message="form.errors.description" class="mt-2" />
            </div>

            <div class="col-span-4 grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <InputLabel for="base_occupancy" value="Ocupación base" />
                    <TextInput
                        id="base_occupancy"
                        v-model="form.base_occupancy"
                        type="number"
                        class="mt-1 block w-full"
                        autocomplete="base-occupancy"
                    />
                    <InputError :message="form.errors.base_occupancy" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <InputLabel for="max_occupancy" value="Ocupación maxima" />
                    <TextInput
                        id="max_occupancy"
                        v-model="form.max_occupancy"
                        type="number"
                        class="mt-1 block w-full"
                        autocomplete="base-occupancy"
                    />
                    <InputError :message="form.errors.max_occupancy" class="mt-2" />
                </div>
            </div>

            <div class="col-span-4 grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <InputLabel for="base_occupancy_kids" value="Ocupación base niños" />
                    <TextInput
                        id="base_occupancy_kids"
                        v-model="form.base_occupancy_kids"
                        type="number"
                        class="mt-1 block w-full"
                        autocomplete="base-occupancy-kid"
                    />
                    <InputError :message="form.errors.base_occupancy_kids" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <InputLabel for="max_occupancy_kids" value="Ocupación maxima niños" />
                    <TextInput
                        id="max_occupancy_kids"
                        v-model="form.max_occupancy_kids"
                        type="number"
                        class="mt-1 block w-full"
                        autocomplete="base-occupancy-kids"
                    />
                    <InputError :message="form.errors.max_occupancy_kids" class="mt-2" />
                </div>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="base_prie" value="Precio base" />
                <TextInput
                    id="base_prie"
                    v-model="form.base_price"
                    type="number"
                    class="mt-1 block w-full"
                    autocomplete="base-price"
                />
                <InputError :message="form.errors.base_prie" class="mt-2" />
            </div>

            <div class="col-span-4 grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <InputLabel for="extra_adult_price" value="Precio extra adulto" />
                    <TextInput
                        id="extra_adult_price"
                        v-model="form.extra_adult_price"
                        type="number"
                        class="mt-1 block w-full"
                        autocomplete="extra-adult-price"
                    />
                    <InputError :message="form.errors.extra_adult_price" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <InputLabel for="extra_kid_price" value="Precio extra niños" />
                    <TextInput
                        id="extra_kid_price"
                        v-model="form.extra_kid_price"
                        type="number"
                        class="mt-1 block w-full"
                        autocomplete="extra-kid-price"
                    />
                    <InputError :message="form.errors.extra_kid_price" class="mt-2" />
                </div>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="base_availability" value="Disponibilidad base" />
                <TextInput
                    id="base_availability"
                    v-model="form.base_availability"
                    type="number"
                    min="0"
                    class="mt-1 block w-full"
                    autocomplete="base-availability"
                />
                <InputError :message="form.errors.base_availability" class="mt-2" />
            </div>

            <!--  -->
            <div class="col-span-6 sm:col-span-4">
                <MinimalRoomTable 
                    :room_type="form.id" 
                    :base_availability="Number(form.base_availability)"
                    :RoomType="form.room_type"
                    />
            </div>
        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="me-3">
                Guardado.
            </ActionMessage>

            <DangerButton @click="Delete" :class="{ 'opacity-25': form.processing }" class="mr-24" :disabled="form.processing">
                ELIMINAR
            </DangerButton>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Guardar
            </PrimaryButton>
        </template>
    </FormSection>
</template>
