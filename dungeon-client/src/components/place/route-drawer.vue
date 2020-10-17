<template>
    <div>
        <md-toolbar class="md-transparent" md-elevation="0">
            <span class="md-title">Route</span>
            <div class="content">
                <md-button v-if="0 === routeId" class="md-raised md-primary" @click="createRoute">Create</md-button>
                <md-button v-else class="md-raised md-primary" @click="updateRoute(placeIn)">Update ({{ placeIn }})</md-button>
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
            },
            placeIn: {
                type: Number
            }
        },
        methods: {
            updateRoute(placeId)
            {
                this.$router.push('/place/update/' + placeId);
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
