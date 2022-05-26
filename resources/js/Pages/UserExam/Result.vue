<template>
    <AuthenticatedLayout>
        <div class="result-page w-full h-screen flex flex-col justify-start items-center"
        >
            <h2
                class="w-full flex flex-col justify-start items-center"
            > 
                <h2 class="w-full text-center font-mono text-5xl" >Exam Finished</h2>
                <p class="w-full text-center font-mono text-4xl my-2">
                    Your obtained mark: <span class="text-green-800 font-bold">{{ result.obtained_mark }}</span>
                </p>
            </h2>

            <div class="section-2 w-full flex justify-between">
                <p class="unanswered bg-yellow-700 text-white text-center flex-grow">
                    Unanswered: {{ result.unanswered }}
                </p>
                <p class="answered bg-blue-700 text-white text-center flex-grow">
                    Answered: {{ result.answered }}
                </p>
                <p class="right bg-green-700 text-white text-center flex-grow">
                    Right: {{ result.right }}
                </p>
                <p class="wrong bg-red-800 text-white text-center flex-grow">
                    Wrong: {{ result.wrong }}
                </p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';

defineProps([
    'result'
]);
</script>