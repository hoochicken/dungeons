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
            editRoute() {
                if (this.edit) {

                    if (this.placeId === 0) {
                        this.createNewRoute(this.outDirection);
                        return;
                    }
                    else {
                        this.$router.push('/place/update/' + this.placeId);
                        location.reload();
                    }
                    return;
                }
                this.$router.push('place/display/' + this.placeId);
            },
            createRoute()
            {

            },
            updateRoute()
            {

            },
            deleteRoute()
            {
                this.axios('/route/delete/' + this.routeId)
            }
        }
    }
</script>

<style scoped>

</style>
