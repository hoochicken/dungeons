<template>
    <div>
        <md-toolbar class="md-transparent" md-elevation="0">
            <span class="md-title">Route</span>
            <div class="content">
                <md-button v-if="0 === routeId" class="md-raised md-primary" @click="createRoute">Create</md-button>
                <md-button v-else class="md-raised md-primary" @click="updateRoute(placeIn)">Update ({{ placeIn }})</md-button>
                <md-button v-if="0 < routeId" class="md-raised md-accent" @click="deleteRoute">Delete</md-button>
                <md-button class="md-raised" @click="$emit('closeDrawer');">Cancel</md-button>


                <div v-if="0 < routeId">
                    {{ places }}
                    <md-select v-model="placeIn">
                        <md-option v-for="item in places" :value="item.id" :key="item.id">{{ item.name }}</md-option>
                    </md-select>
                </div>
            {{ placeId }}
            {{ outDirection }}
            {{ routeId }}
            </div>

        </md-toolbar>
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
                placeUpdated: this.placeIn
            }
        },
        async mounted() {
            this.getPlaces();
        },
        methods: {
            updateRoute(placeId)
            {
                this.$router.push('/place/update/' + placeId);
                location.reload();
            },
            async deleteRoute()
            {
                this.$emit('setLoading', true);
                await this.axios.post('/route/delete/' + this.routeId);
                this.$emit('closeDrawer');
                location.reload();
            },
            async getPlaces()
            {
                let params = new URLSearchParams();
                params.append('listState', JSON.stringify(this.listState));
                let response = await this.axios.post('/place/list', params);
                this.places = response.data.items;
            }
        }
    }
</script>

<style scoped>

</style>
