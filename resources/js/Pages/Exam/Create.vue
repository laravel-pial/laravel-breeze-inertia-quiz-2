<script setup>
import BreezeButton from '@/Components/Button.vue';
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    'title': 'Exam 1',
    'duration': '2',
    'mark': '100',
    'has_negative_marking': false,
    'negative_mark_rate': '0.25',
    'no_of_quizes': '2',
});

const submit = () => {
    form.post(route('exams.store'));
};
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Create Exam" />

        <div class="m-3 w-100 flex justify-center align-middle">
            <BreezeValidationErrors class="mb-4" />
    
            <form @submit.prevent="submit">
                <div>
                    <BreezeLabel for="title" value="Title" />
                    <BreezeInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autofocus autocomplete="title" />
                </div>
    
                <div>
                    <BreezeLabel for="duration" value="Duration" />
                    <BreezeInput id="duration" type="number" class="mt-1 block w-full" v-model="form.duration" required autocomplete="duration" />
                </div>
    
                <div>
                    <BreezeLabel for="mark" value="mark" />
                    <BreezeInput id="mark" type="number" class="mt-1 block w-full" v-model="form.mark" required autocomplete="mark" />
                </div>
    
                <div>
                    <BreezeLabel for="has_negative_marking" value="has_negative_marking" />
                    <BreezeInput id="has_negative_marking" type="checkbox" class="mt-1 block" v-model="form.has_negative_marking" autocomplete="has_negative_marking" />
                </div>
    
                <div
                    v-if="form.has_negative_marking"
                >
                    <BreezeLabel for="negative_mark_rate" value="negative_mark_rate" />
                    <BreezeInput id="negative_mark_rate" type="number" step="0.01" class="mt-1 block w-full" v-model="form.negative_mark_rate" :required="form.has_negative_marking" autocomplete="negative_mark_rate" />
                </div>
    
                <div>
                    <BreezeLabel for="no_of_quizes" value="no_of_quizes" />
                    <BreezeInput id="no_of_quizes" type="number" class="mt-1 block w-full" v-model="form.no_of_quizes" required autocomplete="no_of_quizes" />
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
