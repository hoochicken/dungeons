<template>
    <div>
        <select :value="value" v-model="value" v-on:input="$emit('input', $event.target.value)">
          <option disabled>- Please choose -</option>
          <option v-for="item in categories" v-bind:key="item.id" :value="item.id">{{ item.name }} ({{ item.id }})</option>
        </select>
        <message-box v-if="displayError">
            When getting the categories something went wrong.
        </message-box>
        <vue-loading v-if="loading"></vue-loading>
    </div>
</template>

<script>
    import MessageBox from "./message-box";
    import VueLoading from "vue-loading-overlay/src/js/Component";
    export default {
        name: "select-category",
        components: {VueLoading, MessageBox},
        props: ['target', 'value'],
        data: function() {
            return {
                displayError: false,
                categories: {},
                loading: false,
            }
        },
        mounted() {
            this.loadCategories()
        },
        methods: {
            async loadCategories() {
                try {
                    this.loading = true;
                    let response = await this.axios.get('/category/list/' + this.target);
                    this.categories = response.data.items;
                    this.displayError = false;
                    this.loading = false;
                } catch (error) {
                    this.error = error;
                    this.displayError = true;
                    this.loading = false;
                }
            },
        }
    }
</script>

<style scoped>

</style>
