<template>
    <div>
        <table>
            <thead v-if="header.length > 0">
                <md-table-row>
                    <md-table-cell v-for="item = header">{{ item }}</md-table-cell>
                </md-table-row>
            </thead>
        </table>
    </div>
</template>

<script>
    export default {
        name: "datagrid",
        props: {
            data: {
                type: Array,
                default: []
            },
            header: {
                type: Array,
                default: []
            },
        }
    }
</script>

<style scoped>

</style>
