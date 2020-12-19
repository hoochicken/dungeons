<template>
    <div>
        <h1>Item - List</h1>
        {{ header }}
        <datagrid :data="data" :header="header"></datagrid>
    </div>
</template>

<script>
    import Datagrid from "../global/datagrid/datagrid";

    export default {
        name: "list",
        components: {Datagrid},
        mounted() {
            this.setHeader();
            this.loadList();
        },
        methods: {
            async loadList() {
                this.data = [
                    {id: 2, title: 'asdtitle', column: 'asdad', column2: 'sadadasdd'},
                    {id: 3, title: 'asd d a title', column: 'asdad', column2: 'sadadasdd'},
                    {id: 5, title: 'asdtiasd a sdf tle', column: 'asdad', column2: 'sadadasdd'},
                    {id: 13, title: 'as sf dtitle', column: 'asdad', column2: 'sadadasdd'},
                ];
            },
            setHeader() {
                this.header = [ 'Id', 'asdasd', '',  'what' ];
            }
        }
    }
</script>

<style scoped>

</style>
