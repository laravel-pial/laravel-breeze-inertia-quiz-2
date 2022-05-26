<script setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { ref } from '@vue/reactivity';
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import NoExam from '@/Components/EmptyStates/NoExam.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import BreezeButton from '@/Components/Button.vue';
const props = defineProps([
    'exam',
    'exams'
]);

const selectedExamId = ref('');

const form = useForm({
    'title': '',
    'type': '',
    'option_a': '',
    'option_b': '',
    'option_c': '',
    'answere': '',
    'exam_id': props.exam && props.exam.id.toString() || selectedExamId
});


const submit = () => {
    form.post( route('quizes.store'), {
        onFinish: () => form.reset()
    } );
}
</script>

<template>
    <AuthenticatedLayout>
        <NoExam 
            v-if="!exam && exams.length == 0"
        />

        <template v-else>
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
            
                    <!-- title -->
                    <div>
                        <BreezeLabel for="title" value="Title" />
                        <BreezeInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autofocus autocomplete="title" />
                    </div>
            
                    <!-- quiz type -->
                    <div>
                        <BreezeLabel for="type" value="type" />
                        <select id="type" class="mt-1 block w-full" v-model="form.type" required autocomplete="type">
                            <option value=""> Select an option </option>
                            <option value="mcq"> MCQ </option>
                            <option value="blank"> Blank </option>
                        </select>
                    </div>
                    <!-- option_a -->
                    <template
                        v-if="form.type == 'mcq'"
                    >
                        <div>
                            <BreezeLabel for="option_a" value="option_a" />
                            <BreezeInput id="option_a" type="text" class="mt-1 block w-full" v-model="form.option_a" required autocomplete="option_a" />
                        </div>
                        <!-- option_b -->
                        <div>
                            <BreezeLabel for="option_b" value="option_b" />
                            <BreezeInput id="option_b" type="text" class="mt-1 block w-full" v-model="form.option_b" required autocomplete="option_b" />
                        </div>
                        <!-- option_c -->
                        <div>
                            <BreezeLabel for="option_c" value="option_c" />
                            <BreezeInput id="option_c" type="text" class="mt-1 block w-full" v-model="form.option_c" required autocomplete="option_c" />
                        </div>
                    </template>
                    <!-- answere -->
                    <div
                        v-if="form.type"
                    >
                        <BreezeLabel for="answere" value="answere" />
                        <BreezeInput id="answere" type="text" class="mt-1 block w-full" v-model.trim="form.answere" required autocomplete="answere"
                            v-if="form.type == 'blank'"
                        />
                        <select v-else class="w-full"
                            v-model="form.answere"
                        >
                            <option value="" disabled>Select an option</option>
                            <option value="option_a"> Option A</option>
                            <option value="option_b"> Option B</option>
                            <option value="option_c"> Option C</option>
                        </select>
                    </div>
                    <!-- option_e -->
                    <div class="flex items-center justify-end mt-4">
                        <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Create
                        </BreezeButton>
                    </div>
                </form>
            </div>
        </template>
    </AuthenticatedLayout>
</template>