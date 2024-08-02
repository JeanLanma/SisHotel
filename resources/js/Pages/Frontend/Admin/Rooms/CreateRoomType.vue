<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SectionBorder from '@/Components/SectionBorder.vue';
import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue';
import CreateRoomTypeForm from '@/Pages/Frontend/Admin/Rooms/Partials/CreateRoomTypeForm.vue';
import { ref } from 'vue';
// import ConfirmationEmailForm from '@/Pages/Customers/Partials/ConfirmationEmailForm.vue';
// import UpdateProfileInformationForm from '@/Pages/Customers/Partials/UpdateProfileInformationForm.vue';


const props = defineProps({
    RoomType: Object,
});

const RoomTypeDefault = ref({
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
})

const RoomType = ref(props.RoomType.data || RoomTypeDefault);

</script>

<template>
    <AppLayout title="Habitaciones - Tipo de habitacion">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{RoomType?.id ? 'Crear' : 'Editar' }} nuevo tipo de habitación
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div v-if="$page.props.jetstream.canUpdateProfileInformation">
                    <!-- <UpdateProfileInformationForm :customer="props.customer" /> -->

                    <SectionBorder />
                </div>

                <div v-if="true">
                    <CreateRoomTypeForm :RoomType="RoomType" class="mt-10 sm:mt-0" />

                    <SectionBorder />
                </div>

                <div v-if="true">
                    <!-- <ConfirmationEmailForm
                        :requiresConfirmation="false"
                        class="mt-10 sm:mt-0"
                    /> -->

                    <SectionBorder />
                </div>

                <!-- <template v-if="$page.props.jetstream.hasAccountDeletionFeatures"> -->
                <template v-if="false">
                    <SectionBorder />

                    <DeleteUserForm class="mt-10 sm:mt-0" />
                </template>
            </div>
        </div>
    </AppLayout>
</template>
