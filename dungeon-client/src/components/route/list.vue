<template>
    <div>
        Route List
        <vue-loading v-if="loading"></vue-loading>
        <pagination :totalPage="listState.totalPage" :activeBGColor="'primary'" @btnClick="changePage"></pagination>
    </div>
</template>

<script>
    import VueLoading from "vue-loading-overlay/src/js/Component";
    export default {
        name: "route-list",
        components: {VueLoading},
        data() {
            return {
                routes: [],
                loading: false,
                listState: {
                    maxResults: 3,
                    currentPage: 0,
                    totalPage: 0,
                    totalItems: 0
                },
            }
        },
        methods: {
            changePage : function(n) {
                this.listState.currentPage = n > 0 ? n - 1 : n;
                this.list();
            },
        }
    }
</script>

<style scoped>

</style>
