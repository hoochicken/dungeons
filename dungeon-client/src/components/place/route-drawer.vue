<template>
    <div>
        <md-toolbar class="md-transparent" md-elevation="0">
            <span class="md-title">Route</span>
        </md-toolbar>
        <div class="md-content md-layout-default">
            <md-button v-if="0 === routeId" class="md-raised md-primary" @click="createRoute">Create</md-button>
            <md-button v-if="0 !== routeId" class="md-raised md-primary" @click="moveTo(placeIn)">Walk To ({{ placeIn }})
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
    </div>
</template>

<script>
    export default {
        name: "route-drawer",
        props: {
            placeId: {
                type: Number
            },
            outDirection: {
                type: Number
            },
            routeId: {
                type: Number
            },
            placeIn: {
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
                newPlace: 0
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
                    this.$emit('setLoading', true);
                    let params = {
                        place_out: this.placeId,
                        place_in: this.newPlace
                    };
                    console.log(this.routeId);
                    console.log(params);
                    let response = await this.axios.post('/route/update/' + this.routeId, params);
                    console.log(response);
                    this.$emit('setLoading', false);
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
                this.$emit('setLoading', true);
                await this.axios.post('/route/delete/' + this.routeId);
                this.$emit('closeDrawer');
            },
            async getPlaces()
            {
                let params = new URLSearchParams();
                params.append('listState', JSON.stringify(this.listState));
                let response = await this.axios.get('/place/list', params);
                this.places = response.data.items;
            }
        }
    }
</script>

<style scoped>
    .md-content {padding:0 20px;}
    .new-place {width:100%;}
</style>
