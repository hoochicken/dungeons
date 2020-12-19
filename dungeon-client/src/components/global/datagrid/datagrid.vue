<template>
    <div>
        <search :searchterm="searchterm" @resetSearch="resetSearch"></search>
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
    import Search from "../search";
    export default {
        name: "datagrid",
        components: {Search},
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
            }
        },
        data() {
            return {
                searchterm: '',
                actionRoutes: {
                    get: '',
                    display: '',
                    update: '',
                    create: '',
                }
            }
        },
        methods: {
            async loadList(searchterm) {

            },
            search(searchterm) {
                this.loadList(searchterm);
            },
            resetSearch() {
                this.searchterm = '';
                this.search();
            }
        }
    }
</script>

<style scoped>

</style>
