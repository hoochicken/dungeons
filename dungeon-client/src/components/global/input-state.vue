<template>
    <div>
        <select v-bind:value="value" v-on:input="$emit('input', $event.target.value)">
            <option value="1">Published</option>
            <option value="0">Njet!</option>
        </select>
    </div>
</template>

<script>
    export default {
        name: "input-state",
        props: {
            value: {
                type: Number,
                default: 0
            }
        }
    }
</script>

<style scoped>

</style>
