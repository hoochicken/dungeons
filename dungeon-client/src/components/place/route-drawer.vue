<template>
    <div>
        <md-toolbar class="md-transparent" md-elevation="0">
            <span class="md-title">Route</span>

            <div class="content">
            {{ placeId }}
            {{ outDirection }}
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

                }
                this.$router.push('place/display/' + this.placeId);
            }
        }
    }
</script>

<style scoped>

</style>
