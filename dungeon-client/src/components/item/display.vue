<template>
    <div>
        <div v-if="item.id > 0">
            <div class="md-layout md-gutter">
                <h1 class="md-layout-item">{{ item.name }} ({{ itemId }})</h1>
                <button-update :setClass="'md-primary md-layout-item'" @click="'/item/update/' + item.id"></button-update>
            </div>
            <div class="md-layout md-gutter">
                <div class="md-layout-item md-size-50">
                {{ item.description }}
                </div>
                <div class="md-layout-item md-size-50">{{ item.pic }}</div>
            </div>
            <div class="md-layout md-gutter">
                <div class="md-layout-item md-size-20">Category</div>
                <div class="md-layout-item md-size-80">{{ item.categoryName }}</div>
            </div>
            <div class="md-layout md-gutter">
                <div class="md-layout-item md-size-20">Weight</div>
                <div class="md-layout-item md-size-80">{{ item.weight }} Stone</div>
            </div>
            <div class="md-layout md-gutter">
                <div class="md-layout-item md-size-20">Worth</div>
                <div class="md-layout-item md-size-80">{{ item.worth}} Gold</div>
            </div>
            <div class="md-layout md-gutter">
                <div class="md-layout-item md-size-20">Attributes</div>
                <div class="md-layout-item md-size-80">{{ item.attributes}}</div>
            </div>
            <div class="md-layout md-gutter">
                <div class="md-layout-item md-size-20">State</div>
                <div class="md-layout-item md-size-80">{{ item.state}}</div>
            </div>
            <div class="md-layout md-gutter md-accent">
                <div class="md-layout-item md-accent">{{ item }}</div>
            </div>
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
    import ButtonUpdate from "../global/button-update";
    import VueLoading from "vue-loading-overlay/src/js/Component";
    import MessageBox from "../global/message-box";
    export default {
        name: "item-display",
        components: {MessageBox, VueLoading, ButtonUpdate},
        data() {
            return {
                loading: false,
                itemId: 0,
                response: {},
                item: {},
                error: {},
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
            }
        }
    }
</script>

<style scoped>

</style>
