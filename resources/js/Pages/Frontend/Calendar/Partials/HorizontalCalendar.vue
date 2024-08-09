<script setup>
import Logger from '@/Helpers/Logger';


const props = defineProps({
    Dates: Array,
});

</script>

<template>
    <div  class='flex bg-white shadow-md justify-start md:justify-center rounded-lg overflow-x-scroll mx-auto py-4 px-2'>
        
        <!-- Regular days -->
        <div v-for="(date, index) in props.Dates" :key="index" class='flex group border border-purple-500 hover:bg-purple-500 hover:shadow-lg hover-dark-shadow rounded-lg mx-1 transition-all	duration-300	 cursor-pointer justify-center w-16'>
            <div class='flex items-center px-4 py-4'>
                <div class='text-center'>
                   <p class='text-gray-900 group-hover:text-gray-100 text-sm transition-all	duration-300'> {{ date.day_name.substring(0,3) + '.' }} </p>
                   <p class='text-gray-900 group-hover:text-gray-100 mt-3 group-hover:font-bold transition-all	duration-300'> {{ date.day }} </p>
                </div>
            </div>
        </div>
       <!-- /Regular days -->

        <!-- Marked day -->
        <div class='hidden flex group bg-purple-600 shadow-lg dark-shadow rounded-lg mx-1 cursor-pointer justify-center relative  w-16'>
          <span class="flex h-3 w-3 absolute -top-1 -right-1">
            <span class="animate-ping absolute group-hover:opacity-75 opacity-0 inline-flex h-full w-full rounded-full bg-purple-400 "></span>
            <span class="relative inline-flex rounded-full h-3 w-3 bg-purple-100"></span>
          </span>
            <div class='flex items-center px-4 py-4'>
                <div class='text-center'>
                   <p class='text-gray-100 text-sm'> Wed </p>
                   <p class='text-gray-100  mt-3 font-bold'> 14 </p>
                </div>
            </div>
        </div>
        <!-- /Marked day -->
      
    </div>
</template>