<template>
    <div>
        <h1>{{ item.name }} ({{ item.id }})</h1>
        <div>{{ item.description }}</div>

        <youtube-audio :video-id="item.misc"></youtube-audio>
        <message-box>{{ message }}</message-box>
    </div>
</template>
<script>
    import MessageBox from "../global/message-box";
    import YoutubeAudio from "../global/youtube-audio";
    export default {
        name: "place-display",
        components: {YoutubeAudio, MessageBox},
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
                message: {}
            }
        },
        async mounted () {
            await this.getPlace(this.$route.params.id)
        },
        methods: {
            async getPlace(id) {
                this.response = await this.axios.get('/place/get/' + id);
                this.item = this.response.data;
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
