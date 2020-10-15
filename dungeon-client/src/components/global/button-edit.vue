<template>
    <div>
        <md-button class="md-raised" @click="$router.push(clickRoute)">Edit</md-button>
    </div>
</template>

<script>
    export default {
        name: "button-edit",
        props: {
            clickRoute: {
                type: String
            }
        }
    }
</script>

<style scoped>

</style>
