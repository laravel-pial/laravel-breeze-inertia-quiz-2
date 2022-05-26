<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import BreezeButton from '@/Components/Button.vue';
import { ref } from '@vue/reactivity';
const props = defineProps([
    'exam',
    'exams'
]);

const selectedExamId = ref('');

const form = useForm({
    'title': 'Quiz 1',
    'type': 'mcq',
    'option_a': 'dhaka',
    'option_b': 'delhi',
    'option_c': 'beijing',
    'answere': 'dhaka',
    'exam_id': props.exam && props.exam.id.toString() || selectedExamId
});


const submit = () => {
    form.post( route('quizes.store') );
}
</script>

<template>
    <AuthenticatedLayout>
        <h5 v-if="!exam" >Create Quiz</h5>
        <h5 v-else>
            Add Quiz to {{ exam.title }}
        </h5>

        <div id="quiz-create" class="m-3 w-100 flex justify-center align-middle">
            <Head title="Create Quiz" />

            <BreezeValidationErrors class="mb-4" />
        
            <form @submit.prevent="submit">
                <div
                    v-if="exams"
                >
                    <BreezeLabel for="exams" value="Exam" />
                    <select class="w-full"
                        v-model="selectedExamId"
                    >
                        <option value="">Select an Exam</option>
                        <option
                            v-for="( ex, index ) in exams"
                            :key="index"
                            :value="ex.id.toString()"
                        > 
                            {{ ex.title }} 
                        </option>
                    </select>
                </div>
                
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
                        Create
                    </BreezeButton>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>