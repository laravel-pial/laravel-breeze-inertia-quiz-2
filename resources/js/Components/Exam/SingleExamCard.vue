<template>
    <div class="my-2 w-full flex flex-col bg-gray-300 shadow rounded-t-xl bg-gradient-to-b">

        <!-- Row 1 -->
        <div class="p-2 row1 w-full flex flex-row justify-between bg-green-900">
            <h5 class="p-1 text-white font-bold text-2xl" >{{ title }}</h5>
            <div class="btn-group w-1/4 p-1 flex flex-row justify-between">
                <Link class="bg-pink-600 text-white p-2 rounded" 
                    :href="`/exams/${ id }/attend`" 
                    method="GET" 
                    as="button"
                >
                    Attend
                </Link>
                <Link class="bg-blue-600 text-white p-2 rounded mx-1" 
                    :href="`/exams/${ id }/edit`" 
                    method="GET" 
                    as="button"
                >
                    Edit
                </Link>
                <Link class="bg-red-600 text-white p-2 rounded"
                    :href="`/exams/${ id }`" 
                    method="DELETE"
                    as="button" 
                >
                    Delete
                </Link>
            </div>
        </div>

        <!-- Row 2 -->
        <div class="p-2 row2 w-full flex flex-row justify-between">
            <p>Mark: {{ mark }} </p>
            <p>Duration: {{ duration }} minutes</p>
        </div>

        <!-- Row 3 -->
        <div class="p-2 row3 w-full flex flex-row justify-between">
            <p>Quizes: {{ no_of_quizes }} </p>
            <Link :href="`/exams/${ id }/quizes/create`" method="GET" as="button" 
                class="p-2 bg-blue-800 text-white rounded"
            >
                Add Quiz
            </Link>
        </div>

        <!-- Row 3 -->
        <div class="p-2 row3 w-full flex flex-row justify-between">
            <div class="w-full flex flex-row justify-between" >
                <p class="negative-marking">
                    Negative Marking: {{ has_negative_marking ? 'Yes' : 'No' }}
                </p>

                <p
                    v-if="has_negative_marking"
                >
                    Negative Mark Rate: {{ negative_mark_rate }}
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
defineProps([
    'id',
    'title',
    'duration',
    'mark',
    'has_negative_marking',
    'negative_mark_rate',
    'no_of_quizes'
]);
</script>
