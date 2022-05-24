<template>
    <AuthenticatedLayout>
        <div class="result-page">
            <p class="answered">
                Answered: {{ result.answered }}
            </p>
            <p class="right">
                Right: {{ result.right }}
            </p>
            <p class="wrong">
                Wrong: {{ result.wrong }}
            </p>
            <p class="obtained_mark">
                Obtained Mark: {{ result.obtained_mark }}
            </p>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';

defineProps([
    'result'
]);
</script>