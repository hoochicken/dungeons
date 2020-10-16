<template>
    <div>
        <iframe :src="this.urlStreamingService + '/' + this.videoId + '?autoplay=' + autoplayString" allow="autoplay;"></iframe>
    </div>
</template>


<script>
    export default {
        name: "youtube-audio",
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
                urlStreamingService: 'https://www.youtube.com/embed',
                autoplayString: this.autoPlay ? '1' : '0'
            }
        },
    }
</script>

<style scoped>
    iframe {width:100%; height:55px; border:0;}
</style>
