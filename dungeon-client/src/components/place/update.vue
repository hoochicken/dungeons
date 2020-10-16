<template>
    <div>
        <button-display :clickRoute="'/place/display/' + item.id"></button-display>
        <message-box v-if="displayError">{{ error.data.errors }}</message-box>
        <h1>Update</h1>
        <place-form :item=item @save="updatePlace" @cancel="$router.push('/place/list')" @delete="deletePlace"></place-form>
    </div>
</template>

<script>
    import PlaceForm from "./form";
    import MessageBox from "../global/message-box";
    import ButtonDisplay from "../global/button-display";
    export default {
        name: "place-update",
        components: {ButtonDisplay, MessageBox, PlaceForm},
        data () {
            return {
                item: {
                    id: 0,
                    name: '',
                    class: 0,
                    description: '',
                    misc: '',
                    pic: '',
                    state: 1
                },
                response: {},
                error: {data: {errors: {}}},
                msgtype: 'info',
                displayError: false
            }
        },
        async mounted () {
            this.displayError = false;
            await this.getPlace(this.$route.params.id)
        },
        methods: {
            async getPlace(id) {
                try {
                    this.response = await this.axios.get('/place/get/' + id);
                    this.item = this.response.data;
                    this.displayError = false;
                } catch (error) {
                    this.error = error.response;
                    this.displayError = true;
                }
            },
            async updatePlace(item) {
                try {
                    let params = JSON.stringify(item);
                    this.response = await this.axios.post('/place/update/' + item.id, params);
                    this.displayError = false;
                } catch (error) {
                    this.error = error.response;
                    this.displayError = true;
                }
            },
            async deletePlace() {
                if (!confirm('Really delete this place???')) {
                    return;
                }
                try {
                    await this.axios.post('/place/delete/' + this.item.id);
                    this.displayError = false;
                } catch (error) {
                    this.error = error.response;
                    this.displayError = true;
                }
            }
        }
    }
</script>

<style scoped>

</style>
