<template>
    <div>
        <button-edit :clickRoute="'/place/update/' + item.id"></button-edit>
        <h1>{{ item.name }} ({{ item.id }})</h1>
        <div class="pic">{{ item.pic }}</div>
        <div>{{ item.description }}</div>

        <youtube-audio :video-id="item.misc"></youtube-audio>
        <message-box v-if="error.data && error.data.length > 0">{{ error }}</message-box>
    </div>
</template>
<script>
    import MessageBox from "../global/message-box";
    import YoutubeAudio from "../global/youtube-audio";
    import ButtonEdit from "../global/button-edit";
    export default {
        name: "place-display",
        components: {ButtonEdit, YoutubeAudio, MessageBox},
        data () {
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
                displayError: false
            }
        },
        async mounted () {
            await this.getPlace(this.$route.params.id);
        },
        methods: {
            async getPlace(id) {
                try {
                    this.response = await this.axios.get('/place/get/' + id);
                    this.item = this.response.data;
                    this.displayError = false;
                } catch(error) {
                    this.error = error;
                    this.displayError = true;
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

</style>
