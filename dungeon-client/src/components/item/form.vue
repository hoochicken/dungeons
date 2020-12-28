<template>
    <div>
        <form>
            <md-field>
                <label>Name</label>
                <md-input v-model="item.name"></md-input>
            </md-field>
            <md-field>
                <label>Description</label>
                <md-input v-model="item.description"></md-input>
            </md-field>
            <md-field>
                <label>Category</label>
                <select>
                    <option>Dummie</option>
                </select>
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
    export default {
        name: "item-form",
        components: {InputState},
        props: {
            item: {}
        },
        data: function() {
            return {
                test: 1
            }
        }
    }
</script>

<style scoped>

</style>
