<template>
    <div>
        Route List
        <vue-loading v-if="loading"></vue-loading>
        <!--pagination :totalPage="listState.totalPage" :activeBGColor="'primary'" @btnClick="changePage"></pagination-->
        <pagination :totalPage="5" :activeBGColor="'primary'" @btnClick="changePage"></pagination>
    </div>
</template>

<script>
    import VueLoading from "vue-loading-overlay/src/js/Component";
    export default {
        name: "route-list",
        components: {VueLoading},
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
                searchterm: '',
                listStateDefault: {
                    maxResults: 3,
                    currentPage:0,
                    totalPage: 0,
                    totalItems: 0
                }
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
            changePage : function(n) {
                this.listState.currentPage = n > 0 ? n - 1 : n;
                this.list();
            }
        }
    }
</script>

<style scoped>

</style>
