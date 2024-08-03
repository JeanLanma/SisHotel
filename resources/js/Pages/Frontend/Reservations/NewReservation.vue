<script setup>
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

// Utils+
// returns date in format YYYY-MM-DD
const parseDate = (date) => {
    return date.toISOString().split('T')[0];
}

const checkin = ref(new Date());
// day afeter checkin
const checkout = ref(new Date(checkin.value.getTime() + 24 * 60 * 60 * 1000));
const firstname = ref('');
const lastname = ref('');
const email = ref('');

const nameRules = [
    v => !!v || 'Name is required',
    v => (v && v.length <= 10) || 'Name must be less than 10 characters',
];

const emailRules = [
    v => !!v || 'E-mail is required',
    v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
];

const valid = ref(false);

const submit = () => {
    if (valid.value) {
        alert('Form submitted');
    }
};

watch(checkin, (value) => {
    console.log(value);
});
</script>

<template>
    <AppLayout title="Tipos de habitaciones">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Sistema hotelero - Nueva Reservación
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg w-full h-full">
                    <!--  -->
                    <v-form v-model="valid">
                        <v-container>
                                
                            <v-row class="my-4">
                                    <!-- Checkin -->
                                    <v-dialog max-width="500">
                                        <template v-slot:activator="{ props: activatorProps }">
                                            <v-btn
                                                v-bind="activatorProps"
                                                text="Check In"
                                            ></v-btn>
                                        </template>

                                        <template v-slot:default="{ isActive }">
                                            <v-card title="Seleccionar Check In">
                                            <v-card-text>
                                                <v-date-picker v-model:model-value="checkin"></v-date-picker>
                                            </v-card-text>

                                            <v-card-actions>
                                                <v-spacer></v-spacer>

                                                <v-btn
                                                text="Aceptar"
                                                @click="isActive.value = false"
                                                ></v-btn>
                                            </v-card-actions>
                                            </v-card>
                                        </template>
                                    </v-dialog>
                                    <v-chip>
                                        {{ parseDate(checkin) }}
                                    </v-chip>
                                    <!--  -->
                                    <!-- checkout -->
                                    <v-dialog max-width="500">
                                        <template v-slot:activator="{ props: activatorProps }">
                                            <v-btn
                                                v-bind="activatorProps"
                                                text="Check Out"
                                            ></v-btn>
                                        </template>

                                        <template v-slot:default="{ isActive }">
                                            <v-card title="Seleccionar Check Out">
                                            <v-card-text>
                                                <v-date-picker v-model:model-value="checkout"></v-date-picker>
                                            </v-card-text>

                                            <v-card-actions>
                                                <v-spacer></v-spacer>

                                                <v-btn
                                                text="Aceptar"
                                                @click="isActive.value = false"
                                                ></v-btn>
                                            </v-card-actions>
                                            </v-card>
                                        </template>
                                    </v-dialog>
                                    <p class="">parseDate(checkout)</p>
                        
                                    <!--  -->
                            </v-row>

                            <v-row>
                                <v-col
                                    cols="12"
                                    md="4"
                                >
                                    <v-text-field
                                    v-model="firstname"
                                    :counter="10"
                                    :rules="nameRules"
                                    label="First name"
                                    hide-details
                                    required
                                    ></v-text-field>
                                </v-col>

                                <v-col
                                    cols="12"
                                    md="4"
                                >
                                    <v-text-field
                                    v-model="lastname"
                                    :counter="10"
                                    :rules="nameRules"
                                    label="Last name"
                                    hide-details
                                    required
                                    ></v-text-field>
                                </v-col>

                                <v-col
                                    cols="12"
                                    md="4"
                                >
                                    <v-text-field
                                    v-model="email"
                                    :rules="emailRules"
                                    label="E-mail"
                                    hide-details
                                    required
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-form>
                    <!--  -->
                </div>
            </div>
        </div>
    </AppLayout>
</template>
