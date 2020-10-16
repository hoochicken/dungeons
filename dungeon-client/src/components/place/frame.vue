<template>
    <div>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <div class="md-layout-item md-layout md-gutter">
            <div @click="createNewRoute(1)" class="btn btn1 md-layout-item md-size-10"><md-icon class="fa fa-arrow-up"></md-icon></div>
            <div @click="createNewRoute(2)" class="btn btn2 md-layout-item"><md-icon class="fa fa-arrow-up"></md-icon></div>
            <div @click="createNewRoute(3)" class="btn btn3 md-layout-item md-size-10"><md-icon class="fa fa-arrow-up"></md-icon></div>
        </div>

        <div class="md-layout-item md-layout md-gutter">
            <div @click="createNewRoute(4)" class="btn btn4 md-layout-item md-size-10"><md-icon class="fa fa-arrow-left"></md-icon></div>
            <div class="content md-layout-item">
                <slot></slot>
            </div>
            <div @click="createNewRoute(5)" class="btn btn5 md-layout-item md-size-10"><md-icon class="fa fa-arrow-right"></md-icon></div>
        </div>

        <div class="md-layout-item md-layout md-gutter">
            <div @click="createNewRoute(6)" class="btn btn6 md-layout-item md-size-10"><md-icon class="fa fa-arrow-down"></md-icon></div>
            <div @click="createNewRoute(7)" class="btn btn7 md-layout-item"><md-icon class="fa fa-arrow-down"></md-icon></div>
            <div @click="createNewRoute(8)" class="btn btn8 md-layout-item md-size-10"><md-icon class="fa fa-arrow-down"></md-icon></div>
        </div>
        <div class="btn btn5 md-layout-item md-size-10"><md-icon class="fa fa-arrow-right"></md-icon></div>

    </div>
</template>
<script>
    export default {
        name: "place-frame",
        props: ['placeId'],
        methods: {
            async createNewRoute(direction) {
                try {
                    this.error = {};
                    // create place
                    let newPlaceId = this.initiatePlace();

                    // create route
                    this.createRoute(this.placeId, newPlaceId, direction);

                    // move to place
                    this.$route.push('/place/display/' + newPlaceId);

                    return this.response.data.id;
                } catch (error) {
                    this.error = error.response;
                }



            },
            async initiatePlace() {
                try {
                    this.error = {};
                    this.response = await this.axios.post('/place/create', {});
                    return this.response.data.id;
                } catch (error) {
                    this.error = error.response;
                }
            },

            async createRoute(roomOut, roomIn, direction) {
                try {
                    // create route
                    let params = {
                        out: roomOut,
                        in: roomIn,
                        direction: direction
                    };
                    this.response = await this.axios.post('/place/create', params);
                } catch (error) {
                    this.error = error.response;
                }
            }
        }
    }
</script>


<style scoped>
    .btn {cursor:pointer;}
    .btn1 {text-align:left;transform: rotate(-45deg);}
    .btn2 {text-align:center;}
    .btn3 {text-align:right;transform: rotate(45deg);}
    .btn4 {text-align:left;margin-top: 20%;}
    .btn5 {text-align:right;margin-top: 20%;}
    .btn6 {text-align:left;transform: rotate(45deg);}
    .btn7 {text-align:center;}
    .btn8 {text-align:right;transform: rotate(-45deg);}
</style>
