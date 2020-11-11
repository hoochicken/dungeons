<template>
    <div :class="'btn btn' + direction + ' ' + type">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <span v-if="show_place">{{ place_in }}</span>
        <md-icon v-if="place_in > 0" class="fa fa-arrow-up md-primary"></md-icon>
        <md-icon v-else class="fa fa-arrow-up"></md-icon>
    </div>
</template>

<script>
    export default {
        name: "direction",
        props: {
            direction: {
                type: Number,
                default: 0
            },
            place_in: {
                type: Number,
                default: 0
            },
            type: {
                type: String,
                default: ''
            },
            show_place: {
                type: Boolean,
                default: false
            }
        }
    }
</script>

<style scoped>
    .btn {
        font-size: 20px;
        cursor: pointer;
        display: block;
        padding: 0;
        text-align: center;
    }

    .btn1 {
        transform: rotate(-45deg);
    }

    .btn2 {
    }

    .btn3 {
        transform: rotate(45deg);
    }

    .btn4 {
        transform: rotate(-90deg);
    }

    .btn5 {
        opacity: 0;
    }

    .btn6 {
        transform: rotate(90deg);
    }

    .btn7 {
        transform: rotate(-135deg);
    }

    .btn8 {
        transform: rotate(180deg);
    }

    .btn9 {
        transform: rotate(135deg);
    }
</style>
