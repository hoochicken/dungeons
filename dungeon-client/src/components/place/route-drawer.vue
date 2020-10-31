<template>
    <div>
        <md-toolbar class="md-transparent" md-elevation="0">
            <span class="md-title">Route</span>
        </md-toolbar>
        <div class="md-content md-layout-default">
            <md-button v-if="0 < routeId && 0 < newPlace" class="md-raised md-primary" @click="$emit('moveTo', newPlace)">Walk To ({{ newPlace }})</md-button>
            <md-button v-if="0 < routeId && 0 < newPlace" class="md-raised md-primary" @click="updateRoute">Update Route ({{ newPlace }})</md-button>
            <md-button v-else-if="0 < newPlace" class="md-raised md-primary" @click="createRoute">Create Route ({{ newPlace }})</md-button>
            <md-button v-else class="md-raised md-primary" @click="buildRoute">Create New Place</md-button>
            <md-button class="md-raised" @click="$emit('closeDrawer');">Cancel</md-button>
        </div>
        <div class="md-content md-layout-default">
            <div>
                <md-field>
                    <label v-if="0 === places.length" for="newPlace">Place</label>
                    <select class="new-place" v-model="newPlace" name="newPlace" id="newPlace">
                        <option value="0">- New Place -</option>
                        <option v-for="item in places" v-bind:value="item.id" :key="item.id">{{ item.name }} ({{ item.id }})</option>
                    </select>
                </md-field>
            </div>
        </div>
        <div class="md-content md-layout-default">
            <md-button v-if="0 < routeId" class="md-raised md-accent" @click="deleteRoute">Delete</md-button>
        </div>
        <message-box v-if="0 < error.length">{{ error }}</message-box>
        <vue-loading :active="loading"></vue-loading>
    </div>
</template>

<script>
    import VueLoading from "vue-loading-overlay/src/js/Component";
    import MessageBox from "../global/message-box";
    export default {
        name: "route-drawer",
        components: {MessageBox, VueLoading},
        props: {
            placeId: {
                type: Number
            },
            routeId: {
                type: Number
            },
            placeIn: {
                type: Number
            },
            outDirection: {
                type: Number
            }
        },
        data() {
            return {
                places: [],
                listState: {
                    maxResults: 0,
                    currentPage: 1,
                    totalPage: 1,
                    totalItems: 0
                },
                newPlace: 0,
                hully: false,
                error: '',
                loading: false
            }
        },
        async mounted() {
            this.getPlaces();
            this.newPlace = this.placeIn;
        },
        methods: {
            async updateRoute()
            {
                try {
                    this.loading = true;
                    await this.overwriteRoutesExisting();
                    let params = {
                        place_out: this.placeId,
                        place_in: this.newPlace
                    };
                    await this.axios.post('/route/update/' + this.routeId, params);
                    this.$emit('reloadConsole');
                    this.loading = false;
                } catch (error) {
                    this.error = error.response;
                }
                this.error = '';
            },
            async createRoute()
            {
                this.loading = true;
                let params = {
                    place_out: this.placeId,
                    place_in: this.newPlace,
                    out_direction: this.outDirection
                };
                await this.axios.post('/route/create', params);
                this.loading = false;
                this.$emit('closeDrawer');
            },
            async getRoutesExistingExcept(placeId, direction)
            {
                try {
                    let routes = await this.getRoutesExisting(placeId, direction);
                    let routesExcept = [];
                    for (let i = 0; i < routes.length; i++ ) {
                        if (routes[i]['id'] === this.routeId) continue;
                        routesExcept.push(routes[i]);
                    }
                    return routesExcept;
                } catch (error) {
                    this.error = error.response;
                }
            },
            async overwriteRoutesExisting()
            {
                let routes = await this.getRoutesExistingExcept(this.newPlace, this.outDirection);
                if (0 >= routes.length) {
                    return true;
                }
                this.error = 'Route to place ' + this.newPlace + ' already exists';
                if (confirm('Force overwrite existing route?')) {
                    for (let i = 0; i < routes.length; i++) {
                        // delete only foreign routes, NOT the one we want to update
                        if (this.placeId === routes[i]['place_in'] || this.placeId === routes[i]['place_out']) continue;
                        await this.axios.post('/route/delete/' + routes[i]['id']);
                    }
                }
                return true;
            },
            async getRoutesExisting(placeId, direction)
            {
                try {
                    let response = await this.axios.post('/route/exists/' + placeId + '/' + direction);
                    return response.data.routes;
                } catch (error) {
                    this.error = error.response;
                }
            },
            async buildRoute()
            {
                // create new place and new route
                this.$emit('buildRoute', this.placeId);
            },
            async deleteRoute()
            {
                if (!confirm('Really delete this route???')) {
                    return;
                }
                this.loading = true;
                await this.axios.post('/route/delete/' + this.routeId);
                this.$emit('closeDrawer');
                this.loading = false;
            },
            async getPlaces()
            {
                this.loading = true;
                let params = new URLSearchParams();
                params.append('listState', JSON.stringify(this.listState));
                const response = await this.axios.post('/place/list', params);
                this.places = response.data.items;
                this.listState = response.data.listState;
                this.loading = false;
            }
        }
    }
</script>

<style scoped>
    .md-content {padding:0 20px;}
    .new-place {width:100%;}
</style>
