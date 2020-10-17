<template>
    <div>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <div class="md-layout-item md-layout md-gutter">
            <div @click="useRoute(1)" class="btn btn1 md-layout-item md-size-10"><md-icon class="fa fa-arrow-up"></md-icon></div>
            <div @click="useRoute(2)" class="btn btn2 md-layout-item"><md-icon class="fa fa-arrow-up"></md-icon></div>
            <div @click="useRoute(3)" class="btn btn3 md-layout-item md-size-10"><md-icon class="fa fa-arrow-up"></md-icon></div>
        </div>
        <div class="md-layout-item md-layout md-gutter">
            <div @click="useRoute(4)" class="btn btn4 md-layout-item md-size-10"><md-icon class="fa fa-arrow-left"></md-icon></div>
            <div class="btn content md-layout-item">
                &nbsp;
            </div>
            <div @click="useRoute(5)" class="btn btn5 md-layout-item md-size-10"><md-icon class="fa fa-arrow-right"></md-icon></div>
        </div>

        <div class="md-layout-item md-layout md-gutter">
            <div @click="useRoute(6)" class="btn btn6 md-layout-item md-size-10"><md-icon class="fa fa-arrow-down"></md-icon></div>
            <div @click="useRoute(7)" class="btn btn7 md-layout-item"><md-icon class="fa fa-arrow-down"></md-icon></div>
            <div @click="useRoute(8)" class="btn btn8 md-layout-item md-size-10"><md-icon class="fa fa-arrow-down"></md-icon></div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "route-console",
        props: ['placeId'],
        data() {
            return {
                error: {}
            }
        },
        methods: {
            async useRoute(direction) {
                this.createNewRoute(direction);
            },
            async createNewRoute(direction) {
                try {
                    this.error = {};

                    // create place
                    let newPlaceId = this.initiatePlace();
                    let asd = false;
                    if (asd) {

                    // create route
                    this.createRoute(this.placeId, newPlaceId, direction);

                    // move to place
                    this.$route.push('/place/display/' + newPlaceId);

                    return this.response.data.id;
                    }
                } catch (error) {
                    this.error = error.response;
                }
            },
            async initiatePlace() {
                try {
                    this.error = {};
                    let params = {
                        name: 'New Place'
                    };
                    this.response = await this.axios.post('/place/create', params);
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
                    this.response = await this.axios.post('/route/create', params);
                } catch (error) {
                    this.error = error.response;
                }
            }
        }
    }
</script>



<style scoped>
    .content {}
    .md-layout-item.md-layout.md-gutter {}
    .md-layout-item.md-layout.md-gutter > div {padding:0;width: 33px;height: 33px;text-align: center;}
    .btn {font-size:20px;cursor:pointer;display:block; padding:0;text-align: center;}
    .btn1 {transform: rotate(-45deg);}
    .btn2 {}
    .btn3 {transform: rotate(45deg);}
    .btn4 {}
    .btn5 {}
    .btn6 {transform: rotate(45deg);}
    .btn7 {text-align: center;}
    .btn8 {transform: rotate(-45deg);}
</style>
