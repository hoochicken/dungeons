<template>
    <div>
        <div class="md-layout md-gutter">
            <h1 class="md-layout-item">{{ item.name }} ({{ item.id }})</h1>
            <button-edit :setClass="'md-primary md-layout-item'" :clickRoute="'/item/update/' + item.id"></button-edit>
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
