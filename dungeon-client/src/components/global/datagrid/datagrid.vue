<template>
    <div>
        <md-table>
            <thead v-if="header.length > 0">
                <md-table-row>
                    <md-table-cell v-for="item in header" v-bind:key="item.id">{{ item }}</md-table-cell>
                </md-table-row>
            </thead>
        </md-table>
    </div>
</template>

<script>
    export default {
        name: "datagrid",
        props: {
            data: {
                type: Object,
                default: function () {}
            },
            header: {
                type: Array,
                default: function () {}
            },
        }
    }
</script>

<style scoped>

</style>
