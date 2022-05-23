<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';

import { Head } from '@inertiajs/inertia-vue3';
    defineProps(['quiz']);
</script>

<template>
    <AuthenticatedLayout>
        <div id="quiz-show">
            <Head title="View Quiz" />
            <h5> Quiz {{ quiz && quiz.title || '-' }}</h5>
        
            <div class="quiz">
                {{ JSON.stringify(quiz) }}
            </div>
        </div>
    </AuthenticatedLayout>
</template>