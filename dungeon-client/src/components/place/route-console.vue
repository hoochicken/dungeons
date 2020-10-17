<template>
    <div>

        <md-drawer v-if="showRouteDrawer" :md-active.sync="showRouteDrawer" md-swipeable>
            <route-drawer :place-id="placeId" :route-id="routeId" @closeDrawer="showRouteDrawer = false" :out-direction="outDirection"></route-drawer>
        </md-drawer>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        {{ edit }}
        <div class="console">
            <div v-for="item in routes" @click="useRoute(item.place_in, item.id, item.out_direction)" :key="item.out_direction" :class="'btn btn' + item.out_direction + ' ' + item.type">
                {{ item.place_in }}
                <md-icon v-if="item.place_in > 0" class="fa fa-arrow-up md-primary"></md-icon>
                <md-icon v-else class="fa fa-arrow-up"></md-icon>
            </div>
        </div>
    </div>
</template>
<script>
    import RouteDrawer from "./route-drawer";
    export default {
        name: "route-console",
        components: {RouteDrawer},
        props: {
            placeId: {
                type: Number
            },
            OutDirection: {
                type: Number
            },
            edit: {
                type: Boolean,
                default: false
            }
        },
        data() {
            return {
                error: {},
                response: {},
                routes: {},
                showRouteDrawer: false
            }
        },
        async mounted() {
            this.response = await this.getRoutesByPlace(this.placeId);
        },
        watch: {
            placeId: function(value) {
                if (0 < value) this.getRoutesByPlace(value)
            }
        },
        methods: {
            async useRoute(placeId, routeId, outDirection) {
                if (this.edit) {
                    this.outDirection = outDirection;
                    this.routeId = routeId;
                    this.showRouteDrawer = true;
                    return;
                }

                this.$router.push('/place/display/' + this.placeId);
                location.reload();
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
            async createRoute(placeOut, placeIn, direction) {
                try {
                    // create route
                    let params = {
                        place_out: placeOut,
                        place_in: placeIn,
                        out_direction: direction
                    };
                    this.response = await this.axios.post('/route/create', params);
                    return this.response;
                } catch (error) {
                    this.error = error.response;
                }
            },
            async getRoutesByPlace(placeId) {
                try {
                    if (placeId <= 0) return;
                    this.response = await this.axios.post('/route/place/' + placeId);
                    this.routes = this.response.data.items;
                    return this.routes;
                } catch (error) {
                    this.error = error.response;
                }
            }
        }
    }
</script>
<style scoped>
    .console {width:99px;}
    .console > div {width:33%;float:left;}
    .inner {height:100%;width:100%;}
    .btn {font-size:20px;cursor:pointer;display:block; padding:0;text-align: center;}
    .btn1 {transform: rotate(-45deg);}
    .btn2 {}
    .btn3 {transform: rotate(45deg);}
    .btn4 {transform: rotate(-90deg);}
    .btn5 {opacity: 0;}
    .btn6 {transform: rotate(90deg);}
    .btn7 {transform: rotate(-135deg);}
    .btn8 {transform: rotate(180deg);}
    .btn9 {transform: rotate(135deg);}
</style>
