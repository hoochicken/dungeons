<template>
    <md-field>
        <md-input v-model="searchterm" v-on:keyup.enter="search"/>
        <md-button class="md-primary" @click="search">Search</md-button>
        <md-button class="md-accent" @click="resetSearch">Reset</md-button>
    </md-field>
</template>

<script>
    export default {
        name: "search",
        props: [],
        data() {
            return {
                searchterm: ''
            }
        },
        methods: {
            search() {
                this.$emit('search', this.searchterm);
            },
            resetSearch() {
                this.searchterm = '';
                this.$emit('resetSearch');
            }
        }
    }
</script>

<style scoped>

</style>

<docs>
    This search component displays a searchfield with a search and a reset button.

    ## Examples

    ```jsx
    <template>
        <search @resetSearch="resetSearch" @search="search"/>
    </template>

    <script>
        import Search from "./search";

        export default {
            data() {
                return {
                    searchterm: '',
                }
            },
            methods: {
                search(searchterm) {
                    this.searchterm = searchterm;
                    // some other code
                },
                resetSearch() {
                    this.searchterm = '';
                    // some other code
                }
            }
        }
    </script>
    ```
</docs>

