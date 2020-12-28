<template>
    <div>
        <div>{{ item }}</div>
    </div>
</template>

<script>
    export default {
        name: "item-form",
        props: {
            item: {
                type: function() { return {}; },
                default: {},
            }
        }
    }
</script>

<style scoped>

</style>
