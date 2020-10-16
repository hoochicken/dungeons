<template>
    <div>
        <div class="md-layout-item md-layout md-gutter">
            <div class="btn btn1 md-layout-item md-size-10">asd</div>
            <div class="btn btn2 md-layout-item">asd</div>
            <div class="btn btn3 md-layout-item md-size-10">asd</div>
        </div>
        <div class="md-layout-item md-layout md-gutter">
            <div class="btn btn4 md-layout-item md-size-10">asd</div>
            <div class="content md-layout-item">
                <button-edit :clickRoute="'/place/update/' + item.id"></button-edit>
                <h1>{{ item.name }} ({{ item.id }})</h1>
                <div class="pic">{{ item.pic }}</div>
                <div>{{ item.description }}</div>

                <vue-loading :active="loading"></vue-loading>

                <youtube-audio :video-id="item.misc"></youtube-audio>

            </div>
            <div class="btn btn5 md-layout-item md-size-10">asd</div>
        </div>

        <div class="md-layout-item md-layout md-gutter">
            <div class="btn btn6 md-layout-item md-size-10">asd</div>
            <div class="btn btn7 md-layout-item">asd</div>
            <div class="btn btn8 md-layout-item md-size-10">asd</div>
        </div>

        <message-box v-if="error.data && error.data.length > 0">{{ error }}</message-box>
        <md-progress-spinner v-if="loading" :md-diameter="30" :md-stroke="3" md-mode="indeterminate"></md-progress-spinner>
    </div>
</template>
<script>
    import MessageBox from "../global/message-box";
    import YoutubeAudio from "../global/youtube-audio";
    import ButtonEdit from "../global/button-edit";
    import VueLoading from "vue-loading-overlay/src/js/Component";

    export default {
        name: "place-display",
        components: {VueLoading, ButtonEdit, YoutubeAudio, MessageBox},
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
                    this.loading =  false;
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
        min-height: 600px;
        background: url('../../../../assets/img/place/default.jpg') no-repeat;
        background-size: cover;
    }
    .btn {}
    .btn1 {text-align:left;}
    .btn2 {text-align:center;}
    .btn3 {text-align:right;}
    .btn4 {text-align:left;}
    .btn5 {text-align:right;}
    .btn6 {text-align:left;}
    .btn7 {text-align:center;}
    .btn8 {text-align:right;}
</style>
