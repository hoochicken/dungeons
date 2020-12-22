<template>
    <div>
        <h1>Item - List</h1>
        <datagrid :header="header" :actionRoutes="actionRoutes"></datagrid>
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
                }
            }
        },
        mounted() {
            this.loadList();
            this.header = { id: 'Id', name: 'Name', description: 'Description' };
            this.actionRoutes = {
                    display: '/item/display/:id',
                    update: '/item/update/:id',
                    delete: '/item/delete/:id',
                    create: '/item/create',
            };
        },
        methods: {
            async loadList() {
                this.data = [
                    {id: 2, title: 'asdtitle', column: 'asdad', column2: 'sadadasdd'},
                    {id: 3, title: 'asd d a title', column: 'asdad', column2: 'sadadasdd'},
                    {id: 5, title: 'asdtiasd a sdf tle', column: 'asdad', column2: 'sadadasdd'},
                    {id: 13, title: 'as sf dtitle', column: 'asdad', column2: 'sadadasdd'},
                ];
            }
        }
    }
</script>

<style scoped>

</style>
