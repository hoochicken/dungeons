<template>
    <div>
        <h1>Routes</h1>
        <search @resetSearch="resetSearch" @search="search" />
        <md-table>
            <thead>
            <md-table-row>
                <md-table-head>ID</md-table-head>
                <md-table-head>From</md-table-head>
                <md-table-head>Direction</md-table-head>
                <md-table-head>To</md-table-head>
                <md-table-head>State</md-table-head>
                <md-table-head></md-table-head>
                <md-table-head></md-table-head>
            </md-table-row>
            </thead>
            <tbody>
            <template v-for="item in routes">
                <md-table-row v-bind:key="item.id" v-bind:class="(currentId === item.id) ? 'bg-dark text-light' : ''">
                    <md-table-cell>{{ item.id }}</md-table-cell>
                    <md-table-cell>{{ item.place_out }}</md-table-cell>
                    <md-table-cell><direction :direction="item.out_direction" :place_in="item.place_in" :type="item.type" /></md-table-cell>
                    <md-table-cell>{{ item.place_in}}</md-table-cell>
                    <md-table-cell>State</md-table-cell>
                    <md-table-cell>
                        <md-button class="md-raised md-primary update" @click="updateRoute(item.id)">Update
                        </md-button>
                    </md-table-cell>
                    <md-table-cell>
                        <md-button class="md-raised md-accent delete" @click="deleteRoute(item.id)">Delete</md-button>
                    </md-table-cell>
                </md-table-row>
            </template>
            <md-table-row>
                <md-table-cell></md-table-cell>
                <md-table-cell><i>New route</i></md-table-cell>
                <md-table-cell></md-table-cell>
                <md-table-cell></md-table-cell>
                <md-table-cell>
                    <md-button class="md-raised md-primary" @click="$router.push('/route/create')">Create</md-button>
                </md-table-cell>
                <md-table-cell>
                    <md-button disabled class="md-raised md-accent">Delete</md-button>
                </md-table-cell>
            </md-table-row>
            </tbody>
        </md-table>

        {{ places }}
        <vue-loading v-if="loading"></vue-loading>
        <!--pagination :totalPage="listState.totalPage" :activeBGColor="'primary'" @btnClick="changePage"></pagination-->
        <pagination :totalPage="5" :activeBGColor="'primary'" @btnClick="changePage"></pagination>
    </div>
</template>

<script>
    import VueLoading from "vue-loading-overlay/src/js/Component";
    import Search from "../global/search";
    import Direction from "../global/direction";
    export default {
        name: "route-list",
        components: {Direction, Search, VueLoading},
        data() {
            return {
                routes: {},
                loading: false,
                listState: {
                    maxResults: 3,
                    currentPage: 0,
                    totalPage: 0,
                    totalItems: 0
                },
                currentId: 0,
                searchterm: '',
                listStateDefault: {
                    maxResults: 3,
                    currentPage:0,
                    totalPage: 0,
                    totalItems: 0
                },
                places: {}
            }
        },
        mounted() {
            this.list()
        },
        methods: {
            async list() {
                try {
                    this.loading = true;
                    let params = new URLSearchParams();
                    params.append('searchterm', this.searchterm);
                    params.append('listState', JSON.stringify(this.listState));
                    const response = await this.axios.post('/route/list', params);
                    this.routes = response.data.items;
                    this.listState = response.data.listState;
                    this.loading = false;
                } catch(error) {
                    this.loading = false;
                }

            },
            async deleteRoute(id) {
                if (!confirm('Really delete this route???')) {
                    return;
                }
                await this.axios.post('/route/delete/' + id);
                this.list();
            },
            updateRoute(id) {
                this.$router.push('/route/update/' + id);
            },
            async search(searchterm) {
                this.searchterm = searchterm;
                this.listState = this.listStateDefault;
                this.list();
            },
            async resetSearch() {
                this.searchterm = '';
                this.listState = this.listStateDefault;
                this.list();
            },
            changePage : function(n) {
                this.listState.currentPage = n > 0 ? n - 1 : n;
                this.list();
            },
            async getPlaces() {
                this.places = await this.axios.post('place/list');
            }
        }
    }
</script>

<style scoped>

</style>
