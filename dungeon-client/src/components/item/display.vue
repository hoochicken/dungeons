<template>
    <div>
        <h1>{{ item.name }} ({{ item.id }})</h1>
        <div class="md-layout md-gutter">
            <button-edit :clickRoute="'/item/update/' + item.id"></button-edit>
            <div class="md-layout-item md-size-50">
            {{ item.description }}
            </div>
            <div class="md-layout-item md-size-50">{{ item.pic }}</div>
        </div>
        <div class="md-layout md-gutter">
            <div class="md-layout-item">{{ item }}</div>
            <div class="md-layout-item">{{ state }}</div>
        </div>
    </div>
</template>

<script>
    import ButtonEdit from "../global/button-edit";
    export default {
        name: "display",
        components: {ButtonEdit},
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
