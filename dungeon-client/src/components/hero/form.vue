<template>
    <div>
        <form>
            c{{ categories }}c
            <md-field v-if="item.id > 0">
                <label for="id">ID</label>
                <md-input id="id" v-model="item.id"/>
            </md-field>
            <md-field>
                <label for="name">name</label>
                <md-input id="name" v-model="item.name"/>
            </md-field>
            <md-field>
                <label v-if="0 === item.category" for="category">category</label>
                <select id="category" required v-model="item.category">
                    <option v-if="0 !== item.category" value="0"> - please choose -</option>
                    <option v-for="cat in categories" :key="cat.id" :selected="cat.id === item.category"
                            :value="cat.id">{{ cat.name }} ({{ cat.id }})
                    </option>
                </select>
            </md-field>
            <md-field>
                <label for="description">description</label>
                <md-textarea id="description"
                             v-model="item.description"></md-textarea>
            </md-field>
            <md-field>
                <label for="pic">pic</label>
                <md-input id="pic" v-model="item.pic"/>
            </md-field>
            <md-field v-if="item.id > 0">
                <label for="le">le</label>
                <md-input id="le" type="number" v-model.number="item.le"/>
                <md-input id="le_current" type="number" v-model.number="item.le_current"/>
            </md-field>
            <md-field v-else>
                <label for="le">le</label>
                <md-input id="le" type="number" v-model.number="item.le"/>
            </md-field>
            <md-field v-if="item.id > 0">
                <label for="ae">ae</label>
                <md-input id="ae" type="number" v-model.number="item.ae"/>
                <md-input id="ae_current" type="number" v-model.number="item.ae_current"/>
            </md-field>
            <md-field v-else>
                <label for="ae">ae</label>
                <md-input id="ae" type="number" v-model.number="item.ae"/>
            </md-field>
            <md-field>
                <label for="inventory">inventory</label>
                <md-input id="inventory" v-model="item.inventory"/>
            </md-field>
            <md-field>
                <label for="weapon">weapon</label>
                <md-input id="weapon" v-model="item.weapon"/>
            </md-field>
            <md-field>
                <label for="at">at</label>
                <md-input id="at" type="number" v-model.number="item.at"/>
            </md-field>
            <md-field>
                <label for="pa">pa</label>
                <md-input id="pa" type="number" v-model.number="item.pa"/>
            </md-field>
            <md-field>
                <label for="attributes">attributes</label>
                <md-textarea id="attributes"
                             v-model="item.attributes"></md-textarea>
            </md-field>
            <md-field>
                <label for="state">state</label>
                <md-input id="state" type="number" v-model.number="item.state"/>
            </md-field>
            <md-field v-if="0 < errors.length" class="alert alert-danger">
                <p>Folgende Fehler sind aufgefallen:</p>
                <ul>
                    <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
                </ul>
            </md-field>
            <button-line :itemId="item.id" @create="saveItem" @update="saveItem" @delete="$emit('delete')"
                         @cancel="$emit('cancel')"></button-line>
        </form>
    </div>
</template>

<script>
    import ButtonLine from "../global/button-line";

    export default {
        name: "hero-form",
        components: {ButtonLine},
        props: {item: {}},
        data() {
            return {
                categories: {},
                errors: []
            }
        },
        async mounted() {
            let response = await this.axios.post('/category/list', {});
            this.categories  = response.data.items;
        },
        methods: {
            saveItem: function () {
                if (!this.checkForm()) {
                    return false;
                }
                this.$emit('save', this.item);
            },
            checkForm: function () {
                this.errors = [];

                if (!this.item.name) this.errors.push("Name required.");
                if (!this.item.category) this.errors.push('Your hero must have a category.');
                if (this.item.le < 1) this.errors.push('Life energy must be greater than 0.');
                if (this.item.ae < 1) this.errors.push('Astral energy must be greater than 0.');
                if (this.item.at < 1) this.errors.push('Attack value must be greater than 0.');
                if (this.item.pa < 1) this.errors.push('Parade value must be greater than 0.');

                if (!this.errors.length) return true;
            },
        }
    }
</script>

<style scoped>
    label::first-letter {
        text-transform: uppercase;
    }

    .alert {
        text-align: left;
    }
</style>
