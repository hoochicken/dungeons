<template>
    <div>
        {{ response }}
        <h1>Update</h1>
        <category-form :item=item @save="updateCategory" @cancel="$router.push('/category/list')" @delete="deleteCategory"></category-form>
    </div>
</template>

<script>
    import CategoryForm from "./form";
    export default {
        name: "category-update",
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
        async mounted () {
            await this.getCategory(this.$route.params.id)
        },
        methods: {
            async getCategory(id) {
                this.response = await this.axios.get('/category/get/' + id);
                this.item = this.response.data;
            },
            async updateCategory(item) {
                let params = JSON.stringify(item);
                this.response = await this.axios.post('/category/update/' + item.id, params);
            },
            async deleteCategory(id) {
                if (!confirm('Really delete this category???')) {
                    return;
                }
                await this.axios.post('/category/delete/' + id);
                this.$router.push('/category/list');
            }
        }
    }
</script>

<style scoped>

</style>
