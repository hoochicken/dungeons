<template>
    <div>
        <h1>Create</h1>
        <category-form :item=item @save="createCategory" @cancel="$router.push('/category/list')"></category-form>
    </div>
</template>

<script>
    import CategoryForm from "./form";
    export default {
        name: "category-create",
        components: {CategoryForm},
        data () {
            return {
                item: {
                    id: 0,
                    name: '',
                    type: 1,
                    class: 0,
                    description: '',
                    pic: '',
                    le: 0,
                    le_current: 0,
                    ae: 0,
                    ae_current: 0,
                    inventory: '',
                    weapon: 1,
                    at: 0,
                    pa: 0,
                    attributes: '{}',
                    state: 1
                },
                response: {}
            }
        },
        methods: {
            async createCategory(item) {
                var params = JSON.stringify(item);
                this.response = await this.axios.post('/category/create', params);
                this.$router.push('/category/update/' + this.response.data.id)
            }
        }
    }
</script>

<style scoped>

</style>
