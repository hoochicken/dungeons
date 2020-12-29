<template>
    <div>
        <div class="md-layout md-gutter">
            <h1 class="md-layout-item">{{ item.name }} ({{ item.id }})</h1>
            <button-edit :setClass="'md-primary md-layout-item'" :clickRoute="'/item/display/' + item.id"></button-edit>
        </div>
        x{{ item }}x
        x{{ error }}x
        <item-form :item="item" />
        <message-box v-if="displayError">{{ error }}</message-box>
        <vue-loading :active="loading"></vue-loading>
    </div>
</template>

<script>
    import ButtonEdit from "../global/button-edit";
    import ItemForm from "./form";
    import VueLoading from "vue-loading-overlay/src/js/Component";
    import MessageBox from "../global/message-box";
    export default {
        name: "item-update",
        components: {MessageBox, VueLoading, ItemForm, ButtonEdit},
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
                    console.log('loadItem');
                    this.loading = true;
                    this.itemId = parseInt(id);
                    console.log('respond');
                    this.response = await this.axios.get('/item/get/' + id);
                    console.log('response');
                    console.log(this.response);
                    this.item = this.response.data;
                    this.displayError = false;
                    this.loading = false;
                } catch (error) {
                    console.log(error);
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
