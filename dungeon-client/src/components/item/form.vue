<template>
    <div>
        <form>
            <md-field v-if="item.id > 0">
                <label for="id">Id</label>
                <md-input id="id" name="id" disabled v-model="item.id" />
            </md-field>
            <md-field>
                <label>Name</label>
                <md-input v-model="item.name"></md-input>
            </md-field>
            <md-field>
                <label>Description</label>
                <md-input v-model="item.description"></md-input>
            </md-field>
            <md-field>
                <select-category v-model="item.itemtype" :target="'item'"></select-category>
            </md-field>
            <md-field>
                <label>Pic</label>
                <md-input v-model="item.pic"></md-input>
            </md-field>
            <md-field>
                <label>Worth</label>
                <md-input v-model="item.worth"></md-input>
            </md-field>
            <md-field>
                <label>Weight</label>
                <md-input v-model="item.weight"></md-input>
            </md-field>
            <md-field>
                <label>Attributes</label>
                <md-textarea>{{ item.attributes }}</md-textarea>
            </md-field>
            <md-field>
                <label>State</label>
                <input-state v-model="item.state"></input-state>
            </md-field>
        </form>
        <div>{{ item }}</div>
    </div>
</template>

<script>
    import InputState from "../global/input-state";
    import SelectCategory from "../global/select-category";
    export default {
        name: "item-form",
        components: {SelectCategory, InputState},
        props: {
            item: {}
        },
        data: function() {
            return {
                categories: {},
            }
        },
        mounted() {
            this.loadCategories()
        },
        methods: {
            async loadCategories() {
                try {
                    this.loading = true;
                    let response = await this.axios.get('/category/list/item');
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
