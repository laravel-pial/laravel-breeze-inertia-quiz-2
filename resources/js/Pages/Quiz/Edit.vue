
<template>
    <AuthenticatedLayout>
        <h5>Edit Quiz</h5>

        <div id="quiz-update" class="m-3 w-100 flex justify-center align-middle">
            <Head title="Edit Quiz" />

            <BreezeValidationErrors class="mb-4" />
        
            <form @submit.prevent="submit">
                <div>
                    <BreezeLabel for="title" value="Title" />
                    <BreezeInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autofocus autocomplete="title" />
                </div>
                
                <div>
                    <BreezeLabel for="type" value="type" />
                    <select id="type" class="mt-1 block w-full" v-model="form.type" required autocomplete="type">
                        <option value=""> Select an option </option>
                        <option value="mcq"> MCQ </option>
                        <option value="blank"> Blank </option>
                    </select>
                </div>

                <div>
                    <BreezeLabel for="option_a" value="option_a" />
                    <BreezeInput id="option_a" type="text" class="mt-1 block w-full" v-model="form.option_a" required autocomplete="option_a" />
                </div>

                <div>
                    <BreezeLabel for="option_b" value="option_b" />
                    <BreezeInput id="option_b" type="text" class="mt-1 block w-full" v-model="form.option_b" required autocomplete="option_b" />
                </div>

                <div>
                    <BreezeLabel for="option_c" value="option_c" />
                    <BreezeInput id="option_c" type="text" class="mt-1 block w-full" v-model="form.option_c" required autocomplete="option_c" />
                </div>

                <div>
                    <BreezeLabel for="answere" value="answere" />
                    <BreezeInput id="answere" type="text" class="mt-1 block w-full" v-model="form.answere" required autocomplete="answere" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Update
                    </BreezeButton>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import BreezeButton from '@/Components/Button.vue';

const props = defineProps(['quiz']);

const form = useForm({
    'title': props.quiz && props.quiz.title || 'Quiz 1',
    'type': props.quiz && props.quiz.type || 'mcq',
    'option_a': props.quiz && props.quiz.option_a || 'dhaka',
    'option_b': props.quiz && props.quiz.option_b || 'delhi',
    'option_c': props.quiz && props.quiz.option_c || 'beijing',
    'answere': props.quiz && props.quiz.answere || 'dhaka'
});

const submit = () => {
    form.put(`/quizes/${ props.quiz.id }`);
}
</script>