<template>
    <div>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <div class="md-layout-item md-layout md-gutter">
            <div @click="createRoute(1)" class="btn btn1 md-layout-item md-size-10"><md-icon class="fa fa-arrow-up"></md-icon></div>
            <div @click="createRoute(2)" class="btn btn2 md-layout-item"><md-icon class="fa fa-arrow-up"></md-icon></div>
            <div @click="createRoute(3)" class="btn btn3 md-layout-item md-size-10"><md-icon class="fa fa-arrow-up"></md-icon></div>
        </div>

        <div class="md-layout-item md-layout md-gutter">
            <div @click="createRoute(4)" class="btn btn4 md-layout-item md-size-10"><md-icon class="fa fa-arrow-left"></md-icon></div>
            <div class="content md-layout-item">
                <slot></slot>
            </div>
            <div @click="createRoute(5)" class="btn btn5 md-layout-item md-size-10"><md-icon class="fa fa-arrow-right"></md-icon></div>
        </div>

        <div class="md-layout-item md-layout md-gutter">
            <div @click="createRoute(6)" class="btn btn6 md-layout-item md-size-10"><md-icon class="fa fa-arrow-down"></md-icon></div>
            <div @click="createRoute(7)" class="btn btn7 md-layout-item"><md-icon class="fa fa-arrow-down"></md-icon></div>
            <div @click="createRoute(8)" class="btn btn8 md-layout-item md-size-10"><md-icon class="fa fa-arrow-down"></md-icon></div>
        </div>
        <div class="btn btn5 md-layout-item md-size-10"><md-icon class="fa fa-arrow-right"></md-icon></div>

    </div>
</template>
<script>
    export default {
        name: "place-frame",
        methods: {
            async createRoute(direction) {
                // create place
                let newPlaceId = this.initiatePlace();

                // create route


                // move to place
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
            async createRoute(roomIn, roomOut) {
                try {
                    this.error = {};
                    let params = {
                      in: roomIn,
                      out: roomOut,
                    };
                    this.response = await this.axios.post('/route/create', params);
                    return this.response.data.id;
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
