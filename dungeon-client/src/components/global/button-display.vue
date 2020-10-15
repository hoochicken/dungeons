<template>
    <div>
        <md-button class="md-raised" @click="$router.push(clickRoute)">Display</md-button>
    </div>
</template>

<script>
    export default {
        name: "button-display",
        props: {
            clickRoute: {
                type: String
            }
        }
    }
</script>

<style scoped>

</style>
