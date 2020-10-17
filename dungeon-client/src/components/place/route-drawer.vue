<template>
    <div>
        <md-toolbar class="md-transparent" md-elevation="0">
            <span class="md-title">Route</span>
            <div class="content">
                <md-button v-if="0 === routeId" class="md-raised md-primary" @click="createRoute">Create</md-button>
                <md-button v-else class="md-raised md-primary" @click="updateRoute">Update</md-button>
                <md-button v-if="0 < routeId" class="md-raised md-accent" @click="deleteRoute">Delete</md-button>
                <md-button class="md-raised" @click="$emit('closeDrawer');">Cancel</md-button>
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
            }
        },
        methods: {
            async createRoute(out_direction) {
                try {
                    if (5 === out_direction) {
                        return;
                    }
                    this.$emit('setLoading', true);
                    this.error = {};

                    // create place
                    let newPlaceId = await this.initiatePlace();

                    // create route
                    await this.createRoute(this.placeId, newPlaceId, out_direction);

                    // move to new place
                    this.$router.push('/place/update/' + newPlaceId);
                    location.reload();
                } catch (error) {
                    this.error = error.response;
                    this.$emit('sendError', this.error);
                }
            },
            updateRoute()
            {
                this.$router.push('/place/update/' + this.placeId);
                location.reload();
            },
            async deleteRoute()
            {
                console.log(this.routeId);
                this.$emit('setLoading', true);
                await this.axios.post('/route/delete/' + this.routeId);
                this.$emit('closeDrawer');
                location.reload();
            }
        }
    }
</script>

<style scoped>

</style>
