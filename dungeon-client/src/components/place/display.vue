<template>
    <div>



        <button-edit :clickRoute="'/place/update/' + item.id"></button-edit>
        <h1>{{ item.name }} ({{ item.id }})</h1>
        <div>{{ item.description }}</div>

        <vue-loading :active="loading"></vue-loading>

        <youtube-audio :video-id="item.misc"></youtube-audio>

        <nav-console></nav-console>

        <md-progress-spinner v-if="loading" :md-diameter="30" :md-stroke="3"
                             md-mode="indeterminate"></md-progress-spinner>
        <message-box v-if="error.data && error.data.length > 0">{{ error }}</message-box>

    </div>
</template>
<script>
    import YoutubeAudio from "../global/youtube-audio";
    import ButtonEdit from "../global/button-edit";
    import VueLoading from "vue-loading-overlay/src/js/Component";
    import NavConsole from "./nav-console";

    export default {
        name: "place-display",
        components: {NavConsole, VueLoading, ButtonEdit, YoutubeAudio},
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
                    this.response = await this.axios.get('/place/get/' + id);
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
    /**
     * videoId: '',
     controls: true,
     autoPlay: true
     */
</script>


<style scoped>
    .pic {
        min-height: 350px;
        background: url('../../../../assets/img/place/default.jpg') no-repeat;
        background-size: cover;
    }
</style>
