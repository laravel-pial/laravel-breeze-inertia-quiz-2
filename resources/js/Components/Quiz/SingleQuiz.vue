<script setup>
import { Link } from '@inertiajs/inertia-vue3';

defineProps([
    'id',
    'title',
    'type',
    'option_a',
    'option_b',
    'option_c',
    'answere'
]);
</script>

<template>
    <div class="single-quiz my-2 w-full flex flex-col bg-gray-100 shadow rounded">
        <div class="row1 p-1 rounded-t w-full flex flex-row justify-between bg-green-800 text-white">
            <p>Title: {{ title }}</p>
            <div class="btn-group w-1/4 flex flex-row justify-between">
                <Link :href="`quizes/${ id }/edit`" method="GET" as="button" 
                    class="p-1 bg-blue-700 text-white rounded"
                >
                    Edit
                </Link>
                <Link :href="`quizes/${ id }`" method="DELETE" as="button" 
                    class="p-1 bg-red-700 text-white rounded"
                >
                    Delete
                </Link>
            </div>
        </div>
        <div class="row2 w-full">
            <p>Type: {{ type }}</p>
        </div>
        <div class="row3 w-full">
            <p>A. {{ option_a }}</p>
        </div>
        <div class="row4 w-full">
            <p>B. {{ option_b }} </p>
        </div>
        <div class="row5 w-full">
            <p>C. {{ option_c }} </p>
        </div>
        <div class="row5 w-full">
            <p>Answere: {{ answere }} </p>
        </div>
    </div>
</template>