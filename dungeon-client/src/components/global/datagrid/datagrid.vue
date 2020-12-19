<template>
    <div>
        {{ data }}
        {{ listState }}
        <search :searchterm="searchterm" @resetSearch="resetSearch"></search>
        <md-table>
            <thead>
            <md-table-row v-if="header !== undefined">
                <md-table-head v-for="(item, index) in header" :key="index">{{ item }}</md-table-head>
            </md-table-row>
            </thead>
            <tbody v-if="data !== undefined && data.length > 0">
            <md-table-row v-for="row in data" v-bind:key="row.id">
                <md-table-cell v-for="(label, columnName) in header" v-bind:key="columnName">{{ row[columnName] }}</md-table-cell>
            </md-table-row>
            </tbody>
        </md-table>
    </div>
</template>

<script>
    import Search from "../search";
    export default {
        name: "datagrid",
        components: {Search},
        props: {
            header: {
                type: Object,
                default: function () {
                }
            }
        },
        data() {
            return {
                searchterm: '',
                data: {},
                actionRoutes: {
                    get: '',
                    display: '',
                    update: '',
                    create: '',
                },
                loading: false,
                listState: {
                    maxResults: 3,
                    currentPage:0,
                    totalPage: 0,
                    totalItems: 0
                },
                listStateDefault: {
                    maxResults: 3,
                    currentPage:0,
                    totalPage: 0,
                    totalItems: 0
                }
            }
        },
        mounted() {
            this.loadList();
        },
        methods: {
            async loadList() {
                try {
                    this.loading = true;
                    let params = new URLSearchParams();
                    params.append('searchterm', this.searchterm);
                    params.append('listState', JSON.stringify(this.listState));
                    const response = await this.axios.post('/item/list', params);
                    this.data = response.data.items;
                    this.listState = response.data.listState;
                    this.loading = false;
                } catch(error) {
                    this.loading = false;
                }
            },
            search() {
                this.listState = this.listStateDefault;
                this.loadList();
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
