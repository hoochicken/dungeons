<template>
    <div>
        <form>
            <md-field v-if="item.id > 0">
                <label for="id">ID</label>
                <md-input id="id" v-model="item.id"/>
            </md-field>
            <md-field>
                <label for="name">name</label>
                <md-input id="name" v-model="item.name"/>
            </md-field>
            <md-field>
                <label for="description">description</label>
                <md-textarea id="description" v-model="item.description"></md-textarea>
            </md-field>
            <md-field>
                <label for="parentaux">parentaux</label>
                <md-input id="parentaux" v-model="item.parentaux"/>
            </md-field>
            <md-field>
                <label for="target">target</label>
                <md-input id="target" v-model="item.target"></md-input>
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
        name: "category-form",
        components: {ButtonLine},
        props: {item: {}},
        data() {
            return {
                errors: []
            }
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
