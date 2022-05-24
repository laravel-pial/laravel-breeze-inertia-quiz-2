<template>
    <AuthenticatedLayout>
        <div class="container">
            <div class="timer">
                Exam: {{ exam.title }}
                Timer: {{ countDown.hours }}:{{ countDown.minutes }}:{{ countDown.seconds }}
            </div>
            <div class="single-quiz">
                <div class="row1">
                    <p class="title">
                        {{ quiz.title }}
                    </p>
                </div>
                <template
                    v-if="quiz.type && quiz.type.includes('mcq')"
                >
                    <div class="row2">
                        <label for="option_a">A. </label>
                        <input type="radio" id="option_a"
                            v-model="form.checked_value"
                            value="option_a"
                        >
                    </div>
                    <div class="row2">
                        <label for="option_b">B. </label>
                        <input type="radio" id="option_b"
                            v-model="form.checked_value"
                            value="option_b"
                        >
                    </div>
                    <div class="row2">
                        <label for="option_c">C. </label>
                        <input type="radio" id="option_c"
                            v-model="form.checked_value"
                            value="option_c"
                        >
                    </div>
                </template>
                <div class="answere"
                    v-else
                >
                    <label for="">Answere: </label>
                    <input type="text" name="answere" id=""
                        v-model="form.answere"
                    >
                </div>

                <button type="submit" class="p-1 shadow rounded bg-blue-800 text-white"
                    @click.prevent="submit"
                >
                    Submit
                </button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { onMounted, onUnmounted, ref, watchEffect } from 'vue';

const props = defineProps([
    'started_at',
    'exam',
    'quiz'
]);

const form = useForm({
    'answere': '',
    'checked_value': ''
});

const submit = () => {
    // alert(props.quiz.id);
    form.post(`/exams/${ props.exam.id }/quizes/${ props.quiz.id }`);
};


const countDown = ref({
    hours: 0,
    minutes: 0,
    seconds: 0
});

let interval = null;

const countDownFn = () => {
    if(  !(props.started_at && props.exam.duration) ) {
        return;
    }

    // Had use timezone into calculation to make sure it works properly
    let targetTime = new Date( props.started_at );
    let tTime = targetTime.getTime() - (targetTime.getTimezoneOffset() * 60 * 1000) + (Number(props.exam.duration) * 60 * 1000);

    let currentTime = new Date();
    let cTime = currentTime.getTime();

    let remainingTime =  tTime - cTime;

    if( remainingTime <= 0 ) {
        clearInterval( interval );
        return;
    }

    const second = 1000;
    const minute = second * 60;
    const hour = minute * 60;
    countDown.value.hours = Math.floor(remainingTime/hour);
    countDown.value.minutes = Math.floor((remainingTime%hour)/minute);
    countDown.value.seconds = Math.floor((remainingTime%minute)/second);
}

watchEffect( () => {
    console.log('quiz: ', props.quiz);
});

onMounted(() => {
    interval = setInterval(countDownFn, 1000);
});

onUnmounted(() => {
    clearInterval(interval);
})

</script>