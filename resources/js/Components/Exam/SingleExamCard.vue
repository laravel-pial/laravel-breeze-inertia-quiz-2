<template>
    <div class="my-2 w-full flex flex-col bg-gray-300 shadow">

        <!-- Row 1 -->
        <div class="row1 w-full flex flex-row justify-between bg-green-400">
            <h5 class="p-1" >{{ title }}</h5>
            <div class="btn-group w-1/4 p-1 flex flex-row justify-between">
                <Link class="bg-pink-600 text-white" 
                    :href="`/exams/${ id }/attend`" 
                    method="POST" 
                    as="button"
                >
                    Attend
                </Link>
                <Link class="bg-blue-600 text-white" 
                    :href="`/exams/${ id }/edit`" 
                    method="GET" 
                    as="button"
                >
                    Edit
                </Link>
                <Link class="bg-red-600 text-white"
                    :href="`/exams/${ id }`" 
                    method="DELETE"
                    as="button" 
                >
                    Delete
                </Link>
            </div>
        </div>

        <!-- Row 2 -->
        <div class="row2 w-full flex flex-row justify-between">
            <p>Mark: {{ mark }} </p>
            <p>Duration: {{ duration }} minutes</p>
        </div>

        <!-- Row 3 -->
        <div class="row3 w-full flex flex-row justify-between">
            <p>Quizes: {{ no_of_quizes }} </p>
            <Link :href="`/exams/${ id }/quizes/create`" method="GET" as="button" >
                Add Quiz
            </Link>
        </div>

        <!-- Row 3 -->
        <div class="row3 w-full flex flex-row justify-between">
            <div class="w-full flex flex-row justify-between" >
                <div class="form-group flex flex-row justify-between">
                    <label for="">Negative Marking: </label>
                    <input type="checkbox" readonly
                        v-model="has_negative_marking"
                    >
                </div>

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
