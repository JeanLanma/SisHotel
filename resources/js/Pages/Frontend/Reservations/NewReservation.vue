<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

// DatePicker
import AirDatepicker from 'air-datepicker';
import localeEn from 'air-datepicker/locale/en';

new AirDatepicker('#checkin', {
    locale: localeEn
});

const checkin = ref(null);
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
                
                <div id="checkin" :ref="checkin">

                </div>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg w-full h-full">
                    <!--  -->
                    <v-form v-model="valid">
                        <v-container>
                                
                            <v-row class="my-4">
                                <v-btn>
                                    Check In
                                </v-btn>
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
