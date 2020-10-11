<template>
    <div>
        <iframe :src="this.urlStreamingService + '/' + this.videoId + '?autoplay=' + autoplayString"></iframe>
        <md-button @click="asd();" class="md-raised primary">asd</md-button>
        <message-box>{{ error }}</message-box>
    </div>
</template>

<script>
    import MessageBox from "./message-box";
    export default {
        name: "youtube-audio",
        components: {MessageBox},
        props: {
            videoId: {
                type: String
            },
            controls: {
                type: Boolean,
                default: true
            },
            autoPlay: {
                type: Boolean,
                default: true
            }
        },
        data: function () {
            return {
                response: {},
                error: {},
                urlCors: 'https://cors-anywhere.herokuapp.com',
                urlStreamingService: 'https://www.youtube.com/embed',
                urlStreamingParam: 'video_id',
                autoplayString: this.autoPlay ? '1' : '0'
            }
        },
        mounted() {
            console.log(this.videoId);

        },
        methods: {
            async getAudio() {
                console.log(this.videoId);
            },
            asd: function () {
                this.getAudio();
            }

        }
    }
</script>

<style scoped>
    iframe {width:100%; height:55px; border:0;}
</style>
