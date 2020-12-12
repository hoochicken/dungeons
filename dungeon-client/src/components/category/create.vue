<template>
    <div>
        <h1>Create</h1>
        {{ item }}
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
                    name: '',
                    description: '',
                    target: '',
                    parentaux: 0,
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
