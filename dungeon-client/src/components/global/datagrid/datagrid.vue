<template>
    <div>
        <md-table>
            <thead v-if="header.length > 0">
            <md-table-row>
                <md-table-head v-for="item in header" v-bind:key="item.id">{{ item }}</md-table-head    >
            </md-table-row>
            <md-table-row v-for="row in data" v-bind:key="row.id">
                <md-table-cell v-for="item in row" v-bind:key="item.id">{{ item }}</md-table-cell>
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
                default: function () {
                }
            },
            header: {
                type: Array,
                default: function () {
                }
            },
        }
    }
</script>

<style scoped>

</style>
