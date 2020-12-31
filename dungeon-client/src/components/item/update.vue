<template>
    <div>
        <div v-if="item.id > 0">
            y{{ item }}y<br />
            x{{ response }}x
            <div class="md-layout md-gutter">
                <h1 class="md-layout-item">{{ item.name }} ({{ itemId }})</h1>
                <button-line :item-id="itemId" @create="create" @display="display" @update="update" @delete="deleteItem" @cancel="cancel"></button-line>
            </div>
            <item-form :item="item" />
        </div>
        <div v-if="displayError">
            <div class="md-layout">
                <h1 class="md-layout-item">Item {{ itemId }}</h1>
                <div><md-button class="md-layout-item md-raised md-primary" @click="$router.push('/item/list')">Go To Item/List</md-button></div>
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
    import ItemForm from "./form";
    import VueLoading from "vue-loading-overlay/src/js/Component";
    import MessageBox from "../global/message-box";
    import ButtonLine from "../global/button-line";
    export default {
        name: "item-update",
        components: {ButtonLine, MessageBox, VueLoading, ItemForm},
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
                    this.loading = false;
                }
            },
            async create() {
                console.log('create');
            },
            async display() {
                this.$router.push('/item/display/' + this.itemId);
            },
            async update() {
                try {
                    this.loading = true;
                    let options = JSON.stringify(this.item);
                    this.response = await this.axios.post('/item/update/' + this.itemId, options);
                    // this.loadItem(this.itemId);
                    this.loading = false;
                } catch (error) {
                    this.error = error;
                    this.displayError = true;
                    this.loading = false;
                }
            },
            async deleteItem() {
                try {
                    this.loading = true;
                    let options = JSON.stringify(this.item);
                    this.response = await this.axios.post('/item/delete/' + this.item.id, options);
                } catch (error) {
                    this.error = error;
                    this.displayError = true;
                    this.loading = false;
                }
            },
            async cancel() {
                this.$router.push('/item/list');
            },
        }
    }
</script>

<style scoped>

</style>
