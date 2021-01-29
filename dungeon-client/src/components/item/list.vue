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
                // tableColumns: {}
            }
        },
        mounted() {
            // this.loadList();
            this.header = { id: 'Id', name: 'Name', description: 'Description' };
            this.actionRoutes = {
                    display: '/item/display/:id',
                    update: '/item/update/:id',
                    delete: '/item/delete/:id',
                    create: '/item/create',
            };
            // this.loadList();
            // this.loadList({searchterm:this.searchTerm, listState:this.listState});
        },
        methods: {
            async loadListX() {
                return [
                    {id: 2, title: 'asdtitle', column: 'asdad', column2: 'sadadasdd'},
                    {id: 3, title: 'asd d a title', column: 'asdad', column2: 'sadadasdd'},
                    {id: 5, title: 'asdtiasd a sdf tle', column: 'asdad', column2: 'sadadasdd'},
                    {id: 13, title: 'as sf dtitle', column: 'asdad', column2: 'sadadasdd'},
                ];
            },
            async loadList({searchterm, listState}) {
                try {
                    /*
                    console.log('loadListSlave');
                    console.log('searchterm');
                    console.log(searchterm);
                    console.log('listState');
                    console.log(listState);
                    */
                    let params = new URLSearchParams();
                    params.append('listState', JSON.stringify(listState));
                    params.append('searchterm', '');
                    const response = await this.axios.post('/item/list', params);
                    console.log('response.data');
                    console.log(searchterm);
                    console.log(response);
                  return {data: response.data.entries, listState: response.data.listState};
                } catch(error) {
                    console.log(error);
                    this.loading = false;
                }
            },
        }
    }
</script>

<style scoped>

</style>
