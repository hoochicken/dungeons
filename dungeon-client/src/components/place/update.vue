<template>
    <div>
        <div class="md-layout-item md-layout md-gutter">
            <div class="description-console md-layout-item md-size-50">
                <button-display :clickRoute="'/place/display/' + item.id"></button-display>
                <vue-loading :active="loading"></vue-loading>
                <route-console :edit="true" @moveTo="moveTo" @setLoading="setLoading" @sendError="methDisplayError" class="route-console"></route-console>
            </div>
            <div class="ambient-console md-layout-item md-size-50">
                <place-form :item=item @save="updatePlace" @cancel="$router.push('/place/list')"
                            @delete="deletePlace"></place-form>
            </div>
        </div>
        <vue-loading :active="loading"></vue-loading>
        <message-box v-if="error.data && error.data.length > 0">{{ error }}</message-box>
    </div>
</template>

<script>
    import PlaceForm from "./form";
    import MessageBox from "../global/message-box";
    import ButtonDisplay from "../global/button-display";
    import VueLoading from "vue-loading-overlay/src/js/Component";
    import RouteConsole from "./route-console";

    export default {
        name: "place-update",
        components: {RouteConsole, VueLoading, ButtonDisplay, MessageBox, PlaceForm},
        data() {
            return {
                item: {
                    id: 0,
                    name: '',
                    class: 0,
                    description: '',
                    misc: '',
                    pic: '',
                    state: 1
                },
                response: {},
                error: {data: {errors: {}}},
                msgtype: 'info',
                loading: false,
                displayError: false
            }
        },
        async mounted() {
            this.displayError = false;
            await this.getPlace(this.$route.params.id)
        },
        methods: {
            async getPlace(id) {
                try {
                    this.loading = true;
                    this.response = await this.axios.get('/place/get/' + id);
                    this.item = this.response.data;
                    this.displayError = false;
                    this.loading = false;
                } catch (error) {
                    this.error = error.response;
                    this.displayError = true;
                    this.loading = true;
                }
            },
            async updatePlace(item) {
                try {
                    this.loading = true;
                    let params = JSON.stringify(item);
                    this.response = await this.axios.post('/place/update/' + item.id, params);
                    this.displayError = false;
                    this.loading = false;
                } catch (error) {
                    this.error = error.response;
                    this.displayError = true;
                    this.loading = true;
                }
            },
            async deletePlace() {
                if (!confirm('Really delete this place???')) {
                    return;
                }
                try {
                    this.loading = true;
                    await this.axios.post('/place/delete/' + this.item.id);
                    this.displayError = false;
                    this.loading = false;
                } catch (error) {
                    this.error = error.response;
                    this.displayError = true;
                    this.loading = true;
                }
            },
            async methDisplayError(error) {
                this.error = error;
            },
            async moveTo(newPlaceId) {
                this.getPlace(newPlaceId);
            },
            async setLoading(loading) {
                this.loading = loading;
            }
        }
    }
</script>

<style scoped>
    .route-console {
        width: 100px;
        height: 100px;
        overflow: hidden;
        position: absolute;
        left: 20px;
        bottom: 70px;
    }
</style>
