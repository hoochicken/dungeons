<template>
    <div>
        <div class="md-layout md-gutter">
            <h1 class="md-layout-item">{{ item.name }} ({{ item.id }})</h1>
            <button-edit :setClass="'md-primary md-layout-item'" :clickRoute="'/item/display/' + item.id"></button-edit>
        </div>
        <item-form :item="item" />
        <vue-loading :active="loading"></vue-loading>
    </div>
</template>

<script>
    import ButtonEdit from "../global/button-edit";
    import ItemForm from "./form";
    import VueLoading from "vue-loading-overlay/src/js/Component";
    export default {
        name: "item-update",
        components: {VueLoading, ItemForm, ButtonEdit},
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
