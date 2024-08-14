<script setup>
import { Link } from '@inertiajs/vue3';
</script>
<template>
<!-- Contenedor Principal -->
<div class="lg:flex gap-4 items-stretch">
    <!-- Caja Grande -->
    <div class="bg-white p-6 rounded-lg border border-gray-200 mb-4 lg:mb-0 shadow-md lg:w-[35%]">
        <div class="flex justify-center items-center space-x-5 h-full">
            <div>
                <p>Llegadas hoy</p>
                <h2 class="text-4xl font-bold text-gray-600">2</h2>
                <p>25.365 $</p>
            </div>
            <img src="https://www.emprenderconactitud.com/img/Wallet.png" alt="wallet" class="h-24 md:h-20 w-38">
        </div>
    </div>

    <!-- Caja Blanca -->
    <div class="bg-white font-bold p-4 rounded-lg xs:mb-4 max-w-full shadow-md lg:w-[65%]"> 
        <!-- Cajas pequeñas -->
        <div class="flex flex-wrap justify-between h-full">
            <!-- Caja pequeña 1 -->
            <div class="hover:cursor-pointer hover:shadow-select transition-all duration-300 flex-1 bg-gradient-to-r from-indigo-400 to-indigo-600 rounded-lg flex flex-col items-center justify-center p-4 space-y-2 border border-gray-200 m-2">
                <Link :href="route('admin.reservations.create')" class="w-full h-full flex flex-col justify-center items-center">
                    <svg width="48px" height="48px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12.75 9C12.75 8.58579 12.4142 8.25 12 8.25C11.5858 8.25 11.25 8.58579 11.25 9L11.25 11.25H9C8.58579 11.25 8.25 11.5858 8.25 12C8.25 12.4142 8.58579 12.75 9 12.75H11.25V15C11.25 15.4142 11.5858 15.75 12 15.75C12.4142 15.75 12.75 15.4142 12.75 15L12.75 12.75H15C15.4142 12.75 15.75 12.4142 15.75 12C15.75 11.5858 15.4142 11.25 15 11.25H12.75V9Z" fill="#ffffff"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0574 1.25H11.9426C9.63424 1.24999 7.82519 1.24998 6.41371 1.43975C4.96897 1.63399 3.82895 2.03933 2.93414 2.93414C2.03933 3.82895 1.63399 4.96897 1.43975 6.41371C1.24998 7.82519 1.24999 9.63422 1.25 11.9426V12.0574C1.24999 14.3658 1.24998 16.1748 1.43975 17.5863C1.63399 19.031 2.03933 20.1711 2.93414 21.0659C3.82895 21.9607 4.96897 22.366 6.41371 22.5603C7.82519 22.75 9.63423 22.75 11.9426 22.75H12.0574C14.3658 22.75 16.1748 22.75 17.5863 22.5603C19.031 22.366 20.1711 21.9607 21.0659 21.0659C21.9607 20.1711 22.366 19.031 22.5603 17.5863C22.75 16.1748 22.75 14.3658 22.75 12.0574V11.9426C22.75 9.63423 22.75 7.82519 22.5603 6.41371C22.366 4.96897 21.9607 3.82895 21.0659 2.93414C20.1711 2.03933 19.031 1.63399 17.5863 1.43975C16.1748 1.24998 14.3658 1.24999 12.0574 1.25ZM3.9948 3.9948C4.56445 3.42514 5.33517 3.09825 6.61358 2.92637C7.91356 2.75159 9.62177 2.75 12 2.75C14.3782 2.75 16.0864 2.75159 17.3864 2.92637C18.6648 3.09825 19.4355 3.42514 20.0052 3.9948C20.5749 4.56445 20.9018 5.33517 21.0736 6.61358C21.2484 7.91356 21.25 9.62177 21.25 12C21.25 14.3782 21.2484 16.0864 21.0736 17.3864C20.9018 18.6648 20.5749 19.4355 20.0052 20.0052C19.4355 20.5749 18.6648 20.9018 17.3864 21.0736C16.0864 21.2484 14.3782 21.25 12 21.25C9.62177 21.25 7.91356 21.2484 6.61358 21.0736C5.33517 20.9018 4.56445 20.5749 3.9948 20.0052C3.42514 19.4355 3.09825 18.6648 2.92637 17.3864C2.75159 16.0864 2.75 14.3782 2.75 12C2.75 9.62177 2.75159 7.91356 2.92637 6.61358C3.09825 5.33517 3.42514 4.56445 3.9948 3.9948Z" fill="#ffffff"></path> </g></svg>
                    <p class="text-white mt-2">Reservar ahora</p>
                </Link>
            </div>

            <!-- Caja pequeña 2 -->
            <div class="hover:cursor-pointer hover:shadow-select transition-all duration-300 flex-1 bg-gradient-to-r from-sky-400 to-sky-600 rounded-lg flex flex-col items-center justify-center p-4 space-y-2 border border-gray-200 m-2">
                <Link :href="route('dashboard')" class="w-full h-full flex flex-col justify-center items-center">
                    <svg width="48px" height="48px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M11.25 2C11.25 1.58579 11.5858 1.25 12 1.25C17.9371 1.25 22.75 6.06294 22.75 12C22.75 17.9371 17.9371 22.75 12 22.75C6.06294 22.75 1.25 17.9371 1.25 12C1.25 11.5858 1.58579 11.25 2 11.25C2.41421 11.25 2.75 11.5858 2.75 12C2.75 17.1086 6.89137 21.25 12 21.25C17.1086 21.25 21.25 17.1086 21.25 12C21.25 6.89137 17.1086 2.75 12 2.75C11.5858 2.75 11.25 2.41421 11.25 2ZM12 8.25C12.4142 8.25 12.75 8.58579 12.75 9V12.25H16C16.4142 12.25 16.75 12.5858 16.75 13C16.75 13.4142 16.4142 13.75 16 13.75H12C11.5858 13.75 11.25 13.4142 11.25 13V9C11.25 8.58579 11.5858 8.25 12 8.25Z" fill="#ffffff"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M9.09958 2.39754C9.24874 2.78396 9.05641 3.21814 8.66999 3.36731C8.52855 3.42191 8.38879 3.47988 8.2508 3.54114C7.87221 3.70921 7.42906 3.53856 7.261 3.15997C7.09293 2.78139 7.26358 2.33824 7.64217 2.17017C7.80267 2.09892 7.96526 2.03147 8.1298 1.96795C8.51623 1.81878 8.95041 2.01112 9.09958 2.39754ZM5.6477 4.24026C5.93337 4.54021 5.92178 5.01495 5.62183 5.30061C5.51216 5.40506 5.40505 5.51216 5.30061 5.62183C5.01495 5.92178 4.54021 5.93337 4.24026 5.6477C3.94031 5.36204 3.92873 4.88731 4.21439 4.58736C4.33566 4.46003 4.46002 4.33566 4.58736 4.21439C4.88731 3.92873 5.36204 3.94031 5.6477 4.24026ZM3.15997 7.261C3.53856 7.42907 3.70921 7.87222 3.54114 8.2508C3.47988 8.38879 3.42191 8.52855 3.36731 8.66999C3.21814 9.05641 2.78396 9.24874 2.39754 9.09958C2.01112 8.95041 1.81878 8.51623 1.96795 8.12981C2.03147 7.96526 2.09892 7.80267 2.17017 7.64217C2.33824 7.26358 2.78139 7.09293 3.15997 7.261Z" fill="#ffffff"></path> </g></svg>
                    <p class="text-white mt-2">Checkin & Chekout</p>
                </Link>
            </div>

            <!-- Caja pequeña 3 -->
            <div class="hover:cursor-pointer hover:shadow-select transition-all duration-300 flex-1 bg-gradient-to-r from-teal-400 to-teal-600 rounded-lg flex flex-col items-center justify-center p-4 space-y-2 border border-gray-200 m-2">
                <Link :href="route('admin.rooms.room-types.index')" class="w-full h-full flex flex-col justify-center items-center">
                    <svg width="48px" height="48px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M2.75 6C2.75 5.58579 2.41421 5.25 2 5.25C1.58579 5.25 1.25 5.58579 1.25 6V18C1.25 18.4142 1.58579 18.75 2 18.75C2.41421 18.75 2.75 18.4142 2.75 18V16.75L12 16.75L21.25 16.75V18C21.25 18.4142 21.5858 18.75 22 18.75C22.4142 18.75 22.75 18.4142 22.75 18V16.0048L22.75 16L22.75 15.9952L22.75 15.4694C22.7503 13.6408 22.7505 12.5245 22.4273 11.6009C21.8494 9.94923 20.5508 8.65062 18.8991 8.07267C17.9755 7.74949 16.8592 7.74967 15.0306 7.74998L14.7315 7.74993C14.0576 7.74936 13.5358 7.74892 13.0917 7.90432C12.3018 8.18073 11.6807 8.8018 11.4043 9.59173C11.2489 10.0358 11.2493 10.5577 11.2499 11.2315L11.25 15.25H2.75V6ZM21.2498 15.25H12.75V11.3571C12.75 10.4964 12.7606 10.2573 12.8201 10.0872C12.9458 9.72809 13.2281 9.44579 13.5871 9.32015C13.7573 9.26061 13.9964 9.25 14.8571 9.25C16.9148 9.25 17.7524 9.26061 18.4037 9.4885C19.6245 9.91567 20.5843 10.8755 21.0115 12.0963C21.2243 12.7045 21.2476 13.4751 21.2498 15.25Z" fill="#ffffff"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M7 7.75C5.20507 7.75 3.75 9.20507 3.75 11C3.75 12.7949 5.20507 14.25 7 14.25C8.79493 14.25 10.25 12.7949 10.25 11C10.25 9.20507 8.79493 7.75 7 7.75ZM5.25 11C5.25 10.0335 6.0335 9.25 7 9.25C7.9665 9.25 8.75 10.0335 8.75 11C8.75 11.9665 7.9665 12.75 7 12.75C6.0335 12.75 5.25 11.9665 5.25 11Z" fill="#ffffff"></path> </g></svg>
                    <p class="text-white">Habitaciones</p>
                </Link>
            </div>
        </div>
    </div>
</div>
</template>