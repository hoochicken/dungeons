<template>
    <div class="wind-rose">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <div v-for="item in directions" @click="$emit('clickedDirection', item.out_direction)"
             :key="item.out_direction" :class="'btn btn' + item.out_direction + ' ' + item.type">
            <span v-if="edit">{{item.out_direction}}{{ item.place_out_id }}</span>
            <md-icon v-if="item.placeId > 0" class="fa fa-arrow-up md-primary"></md-icon>
            <md-icon v-else class="fa fa-arrow-up"></md-icon>
        </div>
    </div>
</template>

<script>
    export default {
        name: "wind-rose",
        props: {
           routes: {
               type: Array,
               default: () => []
           }
        },
        data() {
            return {
                directions: {},
                response: {}
            }
        },
        async mounted() {
            await this.getDirections(0);
        },
        methods: {
            async getDirections() {
                try {
                    this.response = await this.axios.post('/route/directions');
                    this.directions = this.response.data.items;
                } catch (error) {
                    this.error = error.response;
                }
            }
        }
    }
</script>

<style scoped>

    .wind-rose {
        width: 99px;
    }

    .wind-rose > div {
        width: 33%;
        float: left;
    }

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
