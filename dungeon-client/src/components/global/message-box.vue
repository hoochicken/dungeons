<template>
    <div :class="'box d-flex md-card' + msgtype">
        <slot></slot>
        <br/>
        {{ $slots.default }}
    </div>
</template>

<script>
    export default {
        name: "message-box",
        props: {
            msgtype: {
                type: String,
                default: 'warning',
            },
        }
    }
</script>

<style scoped>
    .box {
        background: #ffeeee;
        padding: 1rem;
        border-left: 3px solid #ffaaaa;
    }
</style>
