<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
defineProps(['exam']);
</script>

<template>
    <AuthenticatedLayout>
        <div id="exam-show">
            <Head title="View Exam" />
            <h5> Exam {{ exam && exam.title || '-' }}</h5>
        
        </div>
    </AuthenticatedLayout>
</template>