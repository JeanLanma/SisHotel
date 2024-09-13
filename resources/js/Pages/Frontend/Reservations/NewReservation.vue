<script setup>
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import ReservationForm from '@/Pages/Frontend/Reservations/Partials/ReservationForm.vue';
import ConfirmationModal from '@/Components/ConfirmationModal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
const props = defineProps({
    RoomTypes: Object,
});
const RoomTypes = ref(props.RoomTypes.data);
// Rooms Available modal
const ShowingRoomAvailabilityModal = ref(true);
</script>

<template>
        <!-- Modal -->
    <ConfirmationModal :show="ShowingRoomAvailabilityModal" @close="ShowingRoomAvailabilityModal = false">
        <template #title>
            Delete Account
        </template>

        <template #content>
            Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted.
        </template>

        <template #footer>
            <SecondaryButton @click.native="ShowingRoomAvailabilityModal = false">
                Nevermind
            </SecondaryButton>

            <DangerButton class="ml-2" @click.native="ShowingRoomAvailabilityModal = false">
                Delete Account
            </DangerButton>
        </template>
    </ConfirmationModal>
    <!-- /Modal -->
    <AppLayout title="Nueva reservación">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Sistema hotelero / Reservaciones
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <div>
                    <button @click="addNewRoomType" class="hidden py-2 px-4 bg-indigo-100 text-indigo-500 hover:bg-indigo-200 hover:shadow-md transition-all duration-200 font-medium rounded-md mb-4">
                        Añadir nueva
                    </button>
                </div>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg w-full">
                    <!--  -->
                    <div class="px-4 py-8 flex flex-row-reverse justify-between">
                        <div class="ml-4 rounded-lg w-1/3 hidden">
                            <h3 class="text-lg font-semibold text-gray-800 w-full text-center">Resumen</h3>

                        </div>
                        <div class="w-full">
                                <ReservationForm :RoomTypes="RoomTypes"/>
                        </div>
                    </div>
                    <!--  -->
                </div>
            </div>
        </div>
    </AppLayout>
</template>
