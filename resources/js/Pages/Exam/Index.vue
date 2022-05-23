<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import SingleExamCard from '@/Components/Exam/SingleExamCard.vue';

import { Head } from '@inertiajs/inertia-vue3';

 defineProps(['exams']);


</script>

<template>
<AuthenticatedLayout>
    <Head title="Exam List" /> 
    <div class="container flex flex-row justify-center">
        <div id="exam-index" class="w-1/2 flex flex-col">
    
            <h5>Exam List</h5>
            <SingleExamCard 
                v-for="( exam, index) in exams"
                :key="index"
    
                :id="exam.id"
                :title="exam.title"
                :duration="exam.duration"
                :mark="exam.mark"
                :has_negative_marking="exam.has_negative_marking"
                :negative_mark_rate="exam.negative_mark_rate"
                :no_of_quizes="exam.no_of_quizes"
            />
        </div>
    </div>
</AuthenticatedLayout>
</template>