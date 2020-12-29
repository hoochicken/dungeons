<template>
    <div>
        <div v-if="item.id > 0">
            <div class="md-layout md-gutter">
                <h1 class="md-layout-item">{{ item.name }} ({{ itemId }})</h1>
                <button-edit :setClass="'md-primary md-layout-item'" :clickRoute="'/item/display/' + item.id"></button-edit>
            </div>
            <item-form :item="item" />
        </div>
        <div v-if="displayError">
            <div class="md-layout">
                <h1 class="md-layout-item">Item {{ itemId }}</h1>
                <md-button class="md-raised md-primary md-layout-item" @click="$router.push('/item/list')">Go To Item/List</md-button>
            </div>
            <p>Something's wrong ... you might now guess what ... look at the clue down below:</p>
            <message-box>
                {{ error }}
            </message-box>
        </div>
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
                    this.loading = true;
                    this.itemId = parseInt(id);
                    this.response = await this.axios.get('/item/get/' + id);
                    this.item = this.response.data;
                    this.displayError = false;
                    this.loading = false;
                } catch (error) {
                    console.log(error);
                    this.error = error;
                    this.displayError = true;
                    this.loading = false;
                }
            }
        }
    }
</script>

<style scoped>

</style>
