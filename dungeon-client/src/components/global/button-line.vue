<template>
    <div :class="'d-flex mb-3 ' + (itemId > 0 ? 'justify-content-end' : 'justify-content-end')">
        <md-button v-if="itemId > 0" class="md-raised md-accent" @click="deleteEntry">Delete</md-button>
        <md-button v-if="itemId > 0" class="md-raised md-primary" @click="$emit('update', itemId)">Update</md-button>
        <md-button v-if="itemId > 0" class="md-raised md-primary" @click="$emit('display', itemId)">Display</md-button>
        <md-button v-else class="md-raised md-primary" @click="$emit('create')">Create</md-button>
        <md-button class="md-raised" @click="$emit('cancel')">Cancel</md-button>
    </div>
</template>

<script>
    export default {
        name: "button-line",
        props: {
            itemId: {
                type: Number,
                default: 0
            }
        },
        methods: {
            deleteEntry() {
                if (!confirm('Really delete this entry with ' + this.itemId)) return;
                this.$emit('delete', this.itemId);
            }
        }
    }
</script>

<style scoped>

</style>
