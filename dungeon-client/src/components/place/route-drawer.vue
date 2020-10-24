<template>
    <div>
        <md-toolbar class="md-transparent" md-elevation="0">
            <span class="md-title">Route</span>
        </md-toolbar>
        <div class="md-content md-layout-default">
            <md-button v-if="0 === routeId" class="md-raised md-primary" @click="$emit('buildRoute')">Create</md-button>
            <md-button v-if="0 !== routeId" class="md-raised md-primary" @click="moveTo(newPlace)">Walk To ({{ newPlace }})
            </md-button>
            <md-button class="md-raised" @click="$emit('closeDrawer');">Cancel</md-button>
        </div>
        route {{ routeId }}<br />
        placeId {{ placeId }}<br />
        placeIn {{ placeIn }}<br />
        newPlace {{ newPlace }}<br />
        <div class="md-content md-layout-default">
            <div v-if="0 < routeId">
                <md-field>
                    <label for="newPlace">Place</label>
                    <select class="new-place" v-model="newPlace" name="newPlace" id="newPlace">
                        <option v-for="item in places" v-bind:value="item.id" :key="item.id">{{ item.name }} ({{ item.id }})
                        </option>
                    </select>
                </md-field>
            </div>
        </div>

        <div class="md-content md-layout-default">
            <md-button v-if="0 !== routeId" class="md-raised md-primary" @click="updateRoute()">Update (R{{ routeId }})
            </md-button>
        </div>

        <div class="md-content md-layout-default">
            <md-button v-if="0 < routeId" class="md-raised md-accent" @click="deleteRoute">Delete</md-button>
        </div>

        <vue-loading v-if="loading"></vue-loading>
    </div>
</template>

<script>
    import VueLoading from "vue-loading-overlay/src/js/Component";
    export default {
        name: "route-drawer",
        components: {VueLoading},
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
                listStateDefault: {
                    maxResults: 30,
                    currentPage: 0,
                    totalPage: 0,
                    totalItems: 0
                },
                newPlace: 0,
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
            },
            moveTo(placeId)
            {
                this.$router.push('/place/update/' + placeId);
                location.reload();
                /*
                this.$router.push({
                    name: 'placeUpdate',
                    // path: '/place/update/',
                    id: placeId
                });
                */

            },
            async deleteRoute()
            {
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
                let response = await this.axios.get('/place/list', params);
                this.places = response.data.items;
                this.loading = false;
            }
        }
    }
</script>

<style scoped>
    .md-content {padding:0 20px;}
    .new-place {width:100%;}
</style>
