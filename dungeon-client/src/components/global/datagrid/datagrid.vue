<template>
    <div>
        listState: {{ listState }}<br />
        data: {{ data }}<br />
        actionRoutes: {{ actionRoutes }}<br />
        dataCount: {{ dataCount }}<br />
        header: {{ header }}<br />
        <search :searchterm="searchterm" @search="search" @resetSearch="resetSearch"></search>
        <md-table>
            <thead>
            <md-table-row v-if="header !== undefined">
              <md-table-head v-for="(item, index) in header" :key="index"><span v-on:click="sort(index)">{{ item }}</span></md-table-head>
                <th v-if="button !== undefined && button.display"></th>
            </md-table-row>
            </thead>
            <tbody v-if="data !== undefined && data.length > 0">
            <md-table-row v-for="row in data" v-bind:key="row.id">
                <md-table-cell v-for="(label, columnName) in header" v-bind:key="label"><span :title="label" v-if="row[columnName] !== undefined">{{ row[columnName] }}</span></md-table-cell>
                <md-table-cell v-if="actionRoutes.display"><md-button class="md-raised md-primary" @click="$router.push(replaceInRoute(actionRoutes.display, row[idField]))">Display</md-button></md-table-cell>
                <md-table-cell v-if="actionRoutes.update"><md-button class="md-raised md-primary" @click="$router.push(replaceInRoute(actionRoutes.update, row[idField]))">Update</md-button></md-table-cell>
                <md-table-cell v-if="actionRoutes.delete"><md-button class="md-raised md-accent" @click="deleteById(row[idField])">Delete</md-button></md-table-cell>
            </md-table-row>
            </tbody>
        </md-table>
        <pagination :totalPage="listState.totalPage" :activeBGColor="'primary'" @btnClick="changePage"></pagination>
    </div>
</template>

<script>
    import Search from "./search";
    export default {
        name: "datagrid",
        components: {Search},
        props: {
            header: {
                type: Object,
                default: function () {
                }
            },
            idField: {
                type: String,
                default: 'id'
            },
            button: {
                type: Object,
                default: function () {
                    return {
                        display: true,
                        update: true,
                        create: true,
                        delete: true,
                    }
                }
            },
            getData: {
                type: Function,
            },
            actionRoutes: {
                type: Object,
                default: function () {
                    return {
                        get: '',
                        display: '',
                        update: '',
                        create: '',
                    }
                }
            },
        },
        data() {
            return {
                searchterm: '',
                data: {},
                loading: false,
                listState: {
                    maxResults: 3,
                    currentPage: 0,
                    totalPage: 0,
                    sort: '',
                },
                listStateDefault: {
                    maxResults: 3,
                    currentPage: 0,
                    totalPage: 0,
                    totalItems: 0,
                    sort: '',
                }
            }
        },
        computed: {
            dataCount () {
                return typeof this.data === 'undefined' ? 0 : this.data.length;
            }
        },
        created() {
          this.loadList();
        },
        methods: {
            async loadList() {
                try {
                    this.loading = true;
                    let param = {searchterm: this.searchterm, listState:this.listState};
                    const data = await this.getData(param);
                    this.data = data.data;
                    this.listState = data.listState;
                } catch(error) {
                    this.loading = false;
                }
            },
            sort(sort) {
              if (sort === this.listState.sort) this.listState.sort = '-' + sort;
              else this.listState.sort = sort;

              this.loadList();
            },
            search(searchterm) {
                this.searchterm = searchterm;
                this.listState = this.listStateDefault;
                this.loadList();
            },
            resetSearch() {
                this.searchterm = '';
                this.search();
            },
            replaceInRoute(route, value) {
                let regex = new RegExp(':' + this.idField);
                return route.replace(regex, value);
            },
            async deleteById(id) {
                if (!confirm('Really deleted entry with ' + this.idField + ' \'' + id + '\'')) return;
                alert('Total Anihilation!');
            },
            changePage(currentPage) {
                this.listState.currentPage = currentPage - 1;
                this.loadList();
            }
        }
    }
</script>

<style scoped>

</style>
