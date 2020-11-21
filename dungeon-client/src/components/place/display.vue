<template>
    <div>
        <div class="md-layout-item md-layout md-gutter">
            <div class="description-console md-layout-item md-size-50">
                <button-edit :clickRoute="'/place/update/' + item.id"></button-edit>
                <h1>{{ item.name }} ({{ item.id }})</h1>
                <div>{{ item.description }}</div>
                <route-console :edit="false" :place-id="placeId" :key="placeId" @moveTo="moveTo" @setLoading="setLoading" @sendError="methDisplayError" class="route-console"></route-console>
            </div>
            <div class="ambient-console md-layout-item md-size-50">
                <div class="pic">{{ item.pic }}</div>
                <youtube-audio v-if="0 < item.misc.length" :video-id="item.misc"></youtube-audio>
            </div>
        </div>
        <vue-loading :active="loading"></vue-loading>
        <message-box v-if="error.data && error.data.length > 0">{{ error }}</message-box>
    </div>
</template>
<script>
    import YoutubeAudio from "../global/youtube-audio";
    import ButtonEdit from "../global/button-edit";
    import VueLoading from "vue-loading-overlay/src/js/Component";
    import RouteConsole from "./route-console";

    export default {
        name: "place-display",
        components: {RouteConsole, VueLoading, ButtonEdit, YoutubeAudio},
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
                error: {},
                placeId: 0,
                displayError: false,
                loading: false
            }
        },
        async mounted() {
            await this.getPlace(this.$route.params.id);
        },
        methods: {
            async getPlace(id) {
                try {
                    this.loading = true;
                    this.placeId = parseInt(id);
                    this.response = await this.axios.get('/place/get/' + id);
                    this.item = this.response.data;
                    this.displayError = false;
                    this.loading = false;
                } catch (error) {
                    this.error = error;
                    this.displayError = true;
                    this.loading = true;
                }
            },
            async methDisplayError(error) {
                this.error = error;
            },
            async moveTo(newPlaceId) {
                // this line should rerender, but doesn't, hmmm ...
                this.$router.push('/place/display/' + newPlaceId);
                this.getPlace(newPlaceId);
            },
            async setLoading(loading) {
                this.loading = loading;
            }
        }
    }
</script>


<style scoped>
    .pic {
        min-height: 350px;
        background: url('../../../../assets/img/place/default.jpg') no-repeat;
        background-size: cover;
    }

    .description-console {
        position: relative;
    }

    .route-console {
        width: 100px;
        height: 130px;
        position: absolute;
        left: 20px;
        bottom: 70px;
    }
</style>
