<template>
    <div>
        <md-field>
            <span v-if="false">
                placeId {{placeId}}<br />
                newPlace{{newPlace}}<br/>
                {{places}}
            </span>
            <label v-if="0 === places.length" for="newPlace">Place</label>
            <select @change="$emit('placeIdChanged', newPlace)" class="new-place" v-model="newPlace" name="newPlace" id="newPlace">
                <option v-if="displayZeroPlace" value="0">- New Place -</option>
                <option v-for="item in places" v-bind:value="item.id" :key="item.id">{{ item.name }} ({{ item.id }})</option>
            </select>
        </md-field>
    </div>
</template>

<script>
    export default {
        name: "place-dropdown",
        props: {
            placeId: {
                type: Number,
                default: 0,
            },
            displayZeroPlace: {
                type: Boolean,
                default: true,
            }
        },
        data() {
            return {
                newPlace: 0,
                places: [],
                listState: {
                    maxResults: 0,
                    currentPage: 1,
                    totalPage: 1,
                    totalItems: 0
                },
            }
        },
        mounted() {
            this.getPlaces();
            this.newPlace = this.placeId;
        },
        watch: {
            placeId() {
                this.newPlace = this.placeId;
            }
        },
        methods: {
            async getPlaces()
            {
                try {
                    this.loading = true;
                    let params = new URLSearchParams();
                    params.append('listState', JSON.stringify(this.listState));
                    const response = await this.axios.post('/place/list', params);
                    this.places = response.data.items;
                    this.listState = response.data.listState;
                    this.loading = false;
                } catch (error) {
                    this.error = error.response;
                }
            },
        }
    }
</script>

<style scoped>

</style>
