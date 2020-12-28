<template>
    <div>
        <md-button :class="'md-raised ' + this.setClass" @click="$router.push(clickRoute)">Edit</md-button>
    </div>
</template>

<script>
    export default {
        name: "button-update",
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
