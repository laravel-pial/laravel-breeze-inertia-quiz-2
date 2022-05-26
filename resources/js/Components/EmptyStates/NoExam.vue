<template>
    <div class="es-state w-full flex flex-col p-4 justify-center items-center">
        <h5 class="text-red-700 text-3xl font-bold">
            No Exam Found to Add Quiz
        </h5>
        <p class="text-2xl"> 
            Create exam to add quiz 
        </p>
        <Link class="rounded p-2 bg-blue-900 text-white text-xl" 
            :href="`/exams/create`"
            method="GET"
            as="button"
        >
            Create New Exam 
        </Link>
    </div>

</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>