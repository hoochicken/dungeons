<template>
    <div>
        <md-button :class="'md-raised ' + this.setClass" @click="$router.push(clickRoute)">Display</md-button>
    </div>
</template>

<script>
    export default {
        name: "button-display",
        props: {
            clickRoute: {
                type: String
            },
            setClass: {
                type: String,
                default: '',
            }
        }
    }
</script>

<style scoped>

</style>
