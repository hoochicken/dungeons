<template>
    <div>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <md-drawer v-if="showRouteDrawer" :md-active.sync="showRouteDrawer" md-swipeable>
            <route-drawer :place-id="placeId" :place-in="placeIn" :route-id="routeId" :outDirection="outDirection"
                          @moveTo="moveTo" @buildRoute="buildRoute" @closeDrawer="closeDrawer()"
                          @reloadConsole="reload()"></route-drawer>
        </md-drawer>
        <div class="console">
            <div v-if="edit" class="md-layout md-gutter">
                <div class="md-layout-item">
                    <md-switch v-model="walkFastIntern" class="md-primary" @change="$emit('setWalkFast', walkFastIntern)">Walk fast</md-switch>
                </div>
                <div class="md-layout-item">
                    <md-switch v-model="createFast" class="md-primary">Create fast</md-switch>
                </div>
            </div>
            <div class="md-layout md-gutter">
                <div class="md-layout-item">
                    <wind-rose :routes="routes" :edit="edit" @clickDirection="clickDirection"></wind-rose>
                </div>
            </div>
        </div>
        <message-box v-if="error.length > 0">{{error}}</message-box>
    </div>
</template>
<script>
    import RouteDrawer from "./route-drawer";
    import WindRose from "../global/wind-rose";
    import MessageBox from "../global/message-box";

    export default {
        name: "route-console",
        components: {MessageBox, WindRose, RouteDrawer},
        props: {
            placeId: {
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
                walkFast: false,
                createFast: false,
                showRouteDrawer: false
            }
        },
        async mounted() {
            this.init();
        },
        watch: {
            placeId: function (value) {
                if (0 < value) this.getRoutesByPlace(value)
            }
        },
        methods: {
            async init() {
                this.response = await this.getRoutesByPlace(this.placeId);
            },
            async useRoute(routeId, placeId, placeIn, outDirection) {
                this.errorMessage = '';
                if (5 === outDirection) {
                    return;
                }

                // being in edit mode, opening drawer console to update route
                // if (this.edit && routeId > 0) {
                if (this.edit) {
                    this.outDirection = outDirection;
                    this.routeId = routeId;
                    this.placeIn = placeIn;
                    this.showRouteDrawer = true;
                    return;
                }
                // being in edit mode, creating new rout and moving there
                else if (this.edit) {
                    this.buildRoute(placeId);
                    return;
                }
                // being in display mode
                // 0 = no route, we don't do nothing
                if (0 >= placeIn) return;

                // being in display mode, moving to next place
                this.$emit('moveTo', placeIn);
            },
            async buildRoute() {
                console.log('buildRoute');
                try {
                    if (5 === this.outDirection) {
                        return;
                    }
                    this.$emit('setLoading', true);
                    this.error = {};

                    // create place
                    let newPlaceId = await this.initiatePlace();

                    // create route
                    await this.createRoute(placeId, newPlaceId, this.outDirection);

                    // move to new place
                    this.$emit('moveTo', newPlaceId);
                } catch (error) {
                    this.error = error.response;
                    this.$emit('sendError', this.error);
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
            async createRoute(placeOut, placeIn, direction) {
                try {
                    // create route
                    let params = {
                        place_out_id: placeOut,
                        place_in_id: placeIn,
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
            },
            async closeDrawer() {
                this.showRouteDrawer = false;
                this.init();
            },
            async moveTo(placeId) {
                this.$emit('moveTo', placeId);
            },
            async reload() {
                this.init();
            }
        }
    }
</script>
<style scoped>
</style>
