<template>
    <div class="container">
        <h1>Heros</h1>
        <search @resetSearch="resetSearch" @search="search"/>
        <md-table class="table table-striped table-hover">
            <thead>
                <md-table-row>
                    <md-table-head>ID</md-table-head>
                    <md-table-head>Name</md-table-head>
                    <md-table-head>Category</md-table-head>
                    <md-table-head>LE</md-table-head>
                    <md-table-head>gerade</md-table-head>
                    <md-table-head>asd</md-table-head>
                </md-table-row>
            </thead>
            <tbody>
                <template v-for="item in heros">
                    <md-table-row v-bind:key="item.id"
                                  v-bind:class="(currentId === item.id) ? 'bg-dark text-light' : ''">
                        <md-table-cell>{{ item.id }}</md-table-cell>
                        <md-table-cell>{{ item.name}}</md-table-cell>
                        <md-table-cell>{{ item.category_label }} ({{ item.category }})</md-table-cell>
                        <md-table-cell>{{ item.le }}</md-table-cell>
                        <md-table-cell>{{ item.le_current }}</md-table-cell>
                        <md-table-cell>
                            <md-button class="md-raised md-primary update" @click="updateHero(item.id)">Update
                            </md-button>
                        </md-table-cell>
                        <md-table-cell>
                            <md-button class="md-raised md-accent delete" @click="deleteHero(item.id)">Delete</md-button>
                        </md-table-cell>
                    </md-table-row>
                </template>
                <md-table-row>
                    <md-table-cell></md-table-cell>
                    <md-table-cell></md-table-cell>
                    <md-table-cell></md-table-cell>
                    <md-table-cell></md-table-cell>
                    <md-table-cell>
                        <!--md-button disabled class="md-raised md-primary update" @click="updateHero(item.id)">Update
                        </md-button-->
                        <md-button class="md-raised md-primary" @click="$router.push('/hero/create')">Create</md-button>
                    </md-table-cell>
                    <md-table-cell>
                        <md-button disabled class="md-raised md-accent delete" @click="deleteHero(item.id)">Delete</md-button>
                    </md-table-cell>
                </md-table-row>
            </tbody>
        </md-table>
        <pagination :totalPage="listState.totalPage" :activeBGColor="'primary'" @btnClick="changePage"></pagination>
        <div class="container">
            <md-button style="float:right" class="md-primary" @click="$router.push('/hero/create')">Create New Hero</md-button>
        </div>
    </div>
</template>

<script>
    import Search from "../global/search";

    export default {
        name: 'hero-list',
        components: {Search},
        data() {
            return {
                heros: [],
                currentId: 0,
                response: {},
                searchterm: '',
                listState: {
                    maxResults: 3,
                    currentPage: 0,
                    totalPage: 0,
                    totalItems: 0
                },
                listStateDefault: {
                    maxResults: 3,
                    currentPage: 0,
                    totalPage: 0,
                    totalItems: 0
                }
            }
        },
        async mounted() {
            this.list()
        },
        methods: {
            async decrease(id) {
                this.currentId = id;
                var params = new URLSearchParams();
                params.append('id', id);
                this.response = await this.axios.post('/hero/decrease', params);
                this.list();
            },
            async list() {
                let params = new URLSearchParams();
                params.append('searchterm', this.searchterm);
                params.append('listState', JSON.stringify(this.listState));
                const response = await this.axios.post('/hero/list', params);
                this.heros = response.data.items;
                this.listState = response.data.listState;
            },
            async deleteHero(id) {
                if (!confirm('Really delete this hero???')) {
                    return;
                }
                await this.axios.post('/hero/delete/' + id);
                this.list();
            },
            updateHero(id) {
                this.$router.push('/hero/update/' + id);
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
            changePage: function (n) {
                this.listState.currentPage = n > 0 ? n - 1 : n;
                this.list();
            },
        }
    }
</script>

<style scoped>
    .delete {
        margin-left: 15px;
    }
</style>
