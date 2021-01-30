<template>
    <div>
        <h1>Item - List</h1>
        <datagrid :header="header" :actionRoutes="actionRoutes" :getData="loadList"></datagrid>
    </div>
</template>

<script>
    import Datagrid from "../global/datagrid/datagrid";

    export default {
        name: "list",
        components: {Datagrid},
        data() {
            return {
                data: {},
                header: {},
                actionRoutes: {
                    get: 'item/get/:id',
                    display: 'item/display/:id',
                    update: '/item/update/:id',
                    delete: '/item/delete/:id',
                    create: '/item/create',
                },
            }
        },
        mounted() {
            this.header = { id: 'Id', name: 'Name', description: 'Description' };
            this.actionRoutes = {
                    display: '/item/display/:id',
                    update: '/item/update/:id',
                    delete: '/item/delete/:id',
                    create: '/item/create',
            };
        },
        methods: {
            async loadList({searchterm, listState}) {
                try {
                    let params = new URLSearchParams();
                    params.append('listState', JSON.stringify(listState));
                    params.append('searchterm', searchterm);
                    const response = await this.axios.post('/item/list', params);
                  return {data: response.data.entries, listState: response.data.listState};
                } catch(error) {
                    this.loading = false;
                }
            },
        }
    }
</script>

<style scoped>

</style>
