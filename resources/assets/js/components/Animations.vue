<template>
    <grid :position="grid" modifiers="purple" v-bind:class="animationClass">
        <section class="current-time">
            <time class="current-time__content">
                <span class="current-time__time">{{ time }}</span>
                <br>
                <span class="current-time__date">{{ animation }}</span>
            </time>

        </section>
    </grid>
</template>

<script>
import Grid from './Grid';
import moment from 'moment';

export default {

    components: {
        Grid,
    },

    props: {
        dateformat: {
            type: String,
            default: 'DD-MM-YYYY',
        },
        timeformat: {
            type: String,
            default: 'h:mm:ss a',
        },
        grid: {
            type: String,
        },
    },

    data() {
        return {
            date: '2017-01-01',
            time: '12:00:00',
            animation: '',
            currentAnimation: 0,
            animationClass: '',
            animations : [
                'bounce','flash','pulse','shake','headShake','swing','tada','wobble','jello'
            ],
        };
    },

    created() {
        this.refreshTime();
        setInterval(this.refreshTime, 3000);
    },

    methods: {
        refreshTime() {
            this.date = moment().format(this.dateformat);
            this.time = moment().format(this.timeformat);
            this.animation = this.animations[this.currentAnimation];
            this.animationClass = 'animated ' + this.animation;
            this.currentAnimation++;
        },
    },
};
</script>
