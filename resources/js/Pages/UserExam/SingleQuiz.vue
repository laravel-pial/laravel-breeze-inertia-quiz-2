<template>
    <AuthenticatedLayout>
        <div class="container p-4 w-full flex flex-col justify-center">
            <div class="header mb-4 flex flex-row justify-between text-3xl font-bold text-green-900">
                <span>Exam: {{ exam.title }}</span>
                <span>Time Left: {{ countDown.hours.toString().padStart(2, '0') }}:{{ countDown.minutes.toString().padStart(2, '0') }}:{{ countDown.seconds.toString().padStart(2, '0') }}</span>
            </div>
            <div class="single-quiz">
                <div class="row1">
                    <p class="title text-2xl font-bold text-gray-800 mb-2">
                        {{ quiz.title }}
                    </p>
                </div>
                <template
                    v-if="quiz.type && quiz.type.includes('mcq')"
                >
                    <div class="row2">
                        <input type="radio" id="option_a"
                            v-model="form.checked_value" class="mr-2"
                            value="option_a"
                        >
                        <label for="option_a">{{ quiz.option_a }} </label>
                    </div>
                    <div class="row2">
                        <input type="radio" id="option_b"
                            v-model="form.checked_value" class="mr-2"
                            value="option_b"
                        >
                        <label for="option_b">{{ quiz.option_b }}</label>
                    </div>
                    <div class="row2">
                        <input type="radio" id="option_c"
                            v-model="form.checked_value" class="mr-2"
                            value="option_c"
                        >
                        <label for="option_c">{{ quiz.option_c }}</label>
                    </div>
                </template>
                <div class="answere"
                    v-else
                >
                    <label for="">Answere: </label>
                    <input type="text" name="answere" id=""
                        v-model.trim="form.answere"
                    >
                </div>

                <button type="submit" class="p-2 mt-3 shadow rounded bg-blue-800 text-white"
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
        form.get(`/exams/${ props.exam.id }/result`);
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