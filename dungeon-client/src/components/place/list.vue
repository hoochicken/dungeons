<template>
    <div class="container">
        <h1>Places</h1>
        <search @resetSearch="resetSearch" @search="search" />
        <md-table>
            <thead>
            <md-table-row>
                <md-table-head>ID</md-table-head>
                <md-table-head>Name</md-table-head>
                <md-table-head>Description</md-table-head>
                <md-table-head>Connections</md-table-head>
                <md-table-head></md-table-head>
                <md-table-head></md-table-head>
            </md-table-row>
            </thead>
            <tbody>
            <template v-for="item in places">
                <md-table-row v-bind:key="item.id" v-bind:class="(currentId === item.id) ? 'bg-dark text-light' : ''">
                    <md-table-cell>{{ item.id }}</md-table-cell>
                    <md-table-cell>{{ item.name }}</md-table-cell>
                    <md-table-cell>{{ item.description }}</md-table-cell>
                    <md-table-cell>Place A, place B, place C</md-table-cell>
                    <md-table-cell>
                        <md-button class="md-raised md-primary update" @click="updatePlace(item.id)">Update
                        </md-button>
                    </md-table-cell>
                    <md-table-cell>
                        <md-button class="md-raised md-accent delete" @click="deletePlace(item.id)">Delete</md-button>
                    </md-table-cell>
                </md-table-row>
            </template>
            <md-table-row>
                <md-table-cell></md-table-cell>
                <md-table-cell><i>New place</i></md-table-cell>
                <md-table-cell></md-table-cell>
                <md-table-cell></md-table-cell>
                <md-table-cell>
                    <md-button class="md-raised md-primary" @click="$router.push('/place/create')">Create</md-button>
                </md-table-cell>
                <md-table-cell>
                    <md-button disabled class="md-raised md-accent">Delete</md-button>
                </md-table-cell>
            </md-table-row>
            </tbody>
        </md-table>
        <pagination :totalPage="listState.totalPage" :activeBGColor="'primary'" @btnClick="changePage"></pagination>
        <vue-loading :active="loading"></vue-loading>
    </div>
</template>

<script>
  import Search from "../global/search";
  import VueLoading from "vue-loading-overlay/src/js/Component";
  export default {
    name: 'place-list',
      components: {VueLoading, Search},
      data() {
        return {
            places: [],
            currentId: 0,
            response: {},
            searchterm: '',
            loading: false,
            listState: {
                maxResults: 3,
                currentPage:0,
                totalPage: 0,
                totalItems: 0
            },
            listStateDefault: {
                maxResults: 3,
                currentPage:0,
                totalPage: 0,
                totalItems: 0
            }
        }
    },
    async mounted () {
      this.list()
    },
    methods: {
      async list() {
          try {
              this.loading = true;
              let params = new URLSearchParams();
              params.append('searchterm', this.searchterm);
              params.append('listState', JSON.stringify(this.listState));
              const response = await this.axios.post('/place/list', params);
              this.places = response.data.items;
              this.listState = response.data.listState;
              this.loading = false;
          } catch(error) {
              this.loading = false;
          }

      },
      async deletePlace(id) {
          if (!confirm('Really delete this place???')) {
              return;
          }
          await this.axios.post('/place/delete/' + id);
          this.list();
      },
      updatePlace(id) {
          this.$router.push('/place/update/' + id);
      },
      async search(searchterm) {
          this.searchterm = searchterm;
          this.listState = this.listStateDefault;
          this.list();
      },
      async resetSearch() {
          this.searchterm = '';
          this.listState = this.listStateDefault;
          this.list();
      },
      changePage : function(n) {
          this.listState.currentPage = n > 0 ? n - 1 : n;
          this.list();
      },
    }
  }
</script>

<style scoped>
    .delete {margin-left:15px;}
</style>
