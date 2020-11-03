<template>
    <div>
        <h1>Route - Update {{ routeId }}</h1>
        <md-field v-if="item.id > 0">
            <label for="id">Id</label>
            <md-input id="id" name="id" disabled v-model="item.id" />
        </md-field>
        <md-field>
            <label for="placeOut">Place Out</label>
            <md-input name="placeOut" id="placeOut" v-model="item.placeOut" />
        </md-field>
        <md-field>
            <label for="outDirection">Out Direction</label>
            <md-input name="outDirection" id="outDirection" v-model="item.outDirection" />
        </md-field>
        <md-field>
            <label for="placeIn">Place In</label>
        <md-input name="placeIn" id="placeIn" v-model="item.placeIn" />
        </md-field>
        {{ item }}

        <vue-loading :active="loading"></vue-loading>
        <message-box v-if="displayError">{{ error }}</message-box>
    </div>
</template>

<script>
    import VueLoading from "vue-loading-overlay/src/js/Component";
    import MessageBox from "../global/message-box";
    export default {
        name: "route-update",
        components: {MessageBox, VueLoading},
        data() {
            return {
                loading: false,
                routeId: 0,
                displayError: false,
                item: {
                    id: 0,
                    placeOut: 0,
                    placeIn: 0,
                    outDirection: 0,
                    state: 0
                }
            }
        },
        async mounted() {
            this.item = await this.getRoute(this.$route.params.id);
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
            }
        }
    }
</script>

<style scoped>

</style>
