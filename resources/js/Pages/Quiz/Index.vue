<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import SingleQuiz from '@/Components/Quiz/SingleQuiz.vue';

import { Head } from '@inertiajs/inertia-vue3'
defineProps(['quizes']);

</script>

<template>
    <AuthenticatedLayout>
        <Head title="Quiz List" />
        
        <div class="cotainer p-2 flex flex-col justify-center">
            <div id="quiz-index w-1/2">
                <h5> Quiz List</h5>
                <SingleQuiz 
                    v-for="(quiz, index) in quizes"
                    :key="index"

                    :id="quiz.id"
                    :title="quiz.title"
                    :type="quiz.type"
                    :option_a="quiz.option_a"
                    :option_b="quiz.option_b"
                    :option_c="quiz.option_c"
                    :answere="quiz.answere"
                />

            </div>
        </div>
    </AuthenticatedLayout>
</template>