<template>
    <div>
        <h1>Route - Update {{ routeId }}</h1>
        {{ item }}
        <div v-if="undefined !== item">
            <md-field>
                <label for="id">Id</label>
                <md-input id="id" name="id" disabled v-model="item.id" />
            </md-field>
            <md-field>
                <place-dropdown :placeId="item.place_out" @placeIdChanged="placeIdChanged"></place-dropdown>
            </md-field>
            <md-field>
                <label for="placeOut2">Place Out2</label>
                <md-input name="placeOut2" id="placeOut2" v-model="item.place_out" />
            </md-field>
            <md-field>
                <label for="outDirection">Out Direction</label>
                <md-input name="outDirection" id="outDirection" v-model="item.out_direction" />
            </md-field>
            <md-field>
                <label for="placeIn">Place In</label>
                <md-input name="placeIn" id="placeIn" v-model="item.place_in" />
            </md-field>
        </div>
        {{ item }}

        <vue-loading :active="loading"></vue-loading>
        <message-box v-if="displayError">{{ error }}</message-box>
    </div>
</template>

<script>
    import VueLoading from "vue-loading-overlay/src/js/Component";
    import MessageBox from "../global/message-box";
    import PlaceDropdown from "../global/place-dropdown";
    export default {
        name: "route-update",
        components: {PlaceDropdown, MessageBox, VueLoading},
        data() {
            return {
                loading: false,
                routeId: 0,
                displayError: false,
                item: {
                    id: 0,
                    place_out: 0,
                    place_in: 0,
                    out_direction: 0,
                    state: 0
                }
            }
        },
        async mounted() {
            await this.getRoute(this.$route.params.id);
        },
        methods: {
            async getRoute(id) {
                try {
                    this.loading = true;
                    this.routeId = parseInt(id);
                    this.response = await this.axios.get('/route/get/' + id);
                    this.item = this.response.data;
                    this.displayError = false;
                    this.loading = false;
                } catch (error) {
                    this.error = error;
                    this.displayError = true;
                    this.loading = true;
                }
            },
            async placeIdChanged(placeId)  {
                this.item.place_out = placeId;
            }

        }
    }
</script>

<style scoped>

</style>
