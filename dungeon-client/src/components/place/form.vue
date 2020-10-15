<template>
    <div>
        <form>
            <md-field v-if="item.id > 0">
                <label for="id">Id</label>
                <md-input id="id" name="id" disabled v-model="item.id" />
            </md-field>

            <md-field>
                <label for="name">Name</label>
                <md-input id="name" name="name" v-model="item.name" />
            </md-field>

            <md-field>
                <md-input id="pic" name="pic" type="file" v-model="item.pic" />
            </md-field>

            <md-field>
                <label for="description">Description</label>
                <md-textarea id="description" name="description" v-model="item.description" />
            </md-field>

            <md-field>
                <label for="misc">Misc</label>
                <md-input id="misc" name="misc" v-model="item.misc" />
            </md-field>

            <md-alert v-if="0 < errors.length" class="primary">
                <p>Folgende Fehler sind aufgefallen:</p>
                <ul>
                    <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
                </ul>
            </md-alert>
            <button-line :itemId="item.id" @create="saveItem" @cancel="$emit('cancel')" @update="saveItem" @delete="$emit('delete')"></button-line>
        </form>
    </div>
</template>

<script>
    import ButtonLine from "../global/button-line";
    export default {
        name: "place-form",
        components: {ButtonLine},
        props: {item: {}},
        data () {
            return {
                placetype: {},
                errors: []
            }
        },
        async mounted () {
            // let classResponse = await this.axios.post('/place/getClass', {});
            // this.placetype = classResponse.data;
        },
        methods: {
            saveItem: function() {
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
    label::first-letter { text-transform: uppercase; }
    .alert {text-align:left;}
</style>
