<template>
    <div class="md-field">
        <select id="directionNew" required v-model="directionNew">
            <option v-for="item in directions" :key="item.out_direction" :selected="directionNew == item.out_direction"
                    :value="item.out_direction">{{ item.label }} ({{ item.out_direction }})
            </option>
        </select>
    </div>
</template>

<script>
    export default {
        name: "direction-select",
        props: {
            edit: {
                type: Boolean,
                default: false
            },
            routeId: {
                type: Number,
                default: 0
            },
            direction: {
                type: Number,
                default: 0
            }
        },
        data() {
            return {
                directionNew: 0,
                directions: {}
            }
        },
        async mounted() {
            this.directionNew = this.direction;
            await this.getDirections();
        },
        watch: {
            direction: async function () {
                this.directionNew = this.direction;
                await this.getDirections();
            },
            directionNew: async function () {
                this.$emit('setDirection', this.directionNew);
            }
        },
        methods: {
            async getDirections() {
                console.log('getDirections');
                try {
                    let response = await this.axios.post('/route/directions');
                    this.directions = response.data.items;
                } catch (error) {
                    this.error = error.response;
                }
            }
        }

    }
</script>
<style scoped>

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
