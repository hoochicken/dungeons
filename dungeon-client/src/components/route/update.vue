<template>
    <div>
        <h1>Route - Update {{ routeId }}</h1>
        {{ item }}
        <div class="md-layout" v-if="undefined !== item">
            <md-field class="md-layout-item">
                <label for="id">Id</label>
                <md-input id="id" name="id" disabled v-model="item.id" />
            </md-field>
        </div>
        <div class="md-layout" v-if="undefined !== item">
            <md-field class="md-layout-item">
                <place-dropdown :placeId="item.place_out_id" @placeIdChanged="placeOutIdChanged"></place-dropdown>
            </md-field>
            <md-field class="md-layout-item">
                <direction-select @setDirection="setDirection" :routeId="routeId" :direction="item.out_direction" :edit="true"></direction-select>
                <direction-cross></direction-cross>
            </md-field>
            <md-field class="md-layout-item">
                <place-dropdown :placeId="item.place_in_id" :placeLabel="'Place In'" @placeIdChanged="placeInIdChanged"></place-dropdown>
            </md-field>
        </div>

        <button-line :itemId="routeId" @cancel="backToList" @delete="deleteRoute" @update="update" @create="create"></button-line>
        <vue-loading :active="loading"></vue-loading>
        <message-box v-if="displayError">{{ error }}</message-box>
    </div>
</template>

<script>
    import VueLoading from "vue-loading-overlay/src/js/Component";
    import MessageBox from "../global/message-box";
    import PlaceDropdown from "../global/place-dropdown";
    import DirectionSelect from "../global/direction-select";
    import ButtonLine from "../global/button-line";
    import DirectionCross from "../global/direction-cross";
    export default {
        name: "route-update",
        components: {DirectionCross, ButtonLine, DirectionSelect, PlaceDropdown, MessageBox, VueLoading},
        data() {
            return {
                loading: false,
                routeId: 0,
                displayError: false,
                item: {
                    id: 0,
                    place_out_id: 0,
                    place_in_id: 0,
                    out_direction: 0,
                    state: 0
                },
                routes: {}
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
            async placeOutIdChanged(placeId)  {
                this.item.place_out_id = placeId;
            },
            async placeInIdChanged(placeId)  {
                this.item.place_in_id = placeId;
            },
            async setDirection(directionNew)  {
                this.item.out_direction = directionNew;
            },
            async create()  {
                await this.axios.post('route/create');
            },
            async update()  {
                try {
                    this.loading = true;
                    this.routeId = parseInt(this.routeId);
                    let params = JSON.stringify(this.item);
                    this.response = await this.axios.post('route/update/' + this.routeId, params);
                    this.item = this.response.data;
                    this.displayError = false;
                    this.loading = false;
                } catch (error) {
                    this.error = error;
                    this.displayError = true;
                    this.loading = true;
                }
            },
            async deleteRoute()  {
                await this.axios.post('route/delete/' + this.routeId);
                this.backToList();
            },
            async backToList()  {
                this.$router.push('/route/list')
            }
        }
    }
</script>

<style scoped>

</style>
