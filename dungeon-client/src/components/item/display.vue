<template>
    <div>
        <h1>Item - Display</h1>
        {{ item }}
    </div>
</template>

<script>
    export default {
        name: "display",
        data() {
            return {
                loading: false,
                itemId: 0,
                response: {},
                item: {},
                displayError: false,
            }
        },
        mounted() {
          this.loadItem(this.$route.params.id);
        },
        methods: {
            async loadItem(id) {
                try {
                    this.loading = true;
                    this.itemId = parseInt(id);
                    this.response = await this.axios.get('/item/get/' + id);
                    this.item = this.response.data;
                    this.displayError = false;
                    this.loading = false;
                } catch (error) {
                    this.error = error;
                    this.displayError = true;
                    this.loading = true;
                }
            }
        }
    }
</script>

<style scoped>

</style>
