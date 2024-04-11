<script>
import config from './config';
import { client } from './setup';
export default {
    data() {
        return {
            singleSubscription: {}
        }
    },

    mounted() {
        const id = this.$route.params.id;
        this.getSingleSubscription(id)
    },

    methods: {
        getSingleSubscription(id) {
            client.get(`${config.backendUrl}/subscriptions/${id}`)
                .then(response => {
                    this.singleSubscription = response.data;
                })
                .catch(error => {
                    console.error('There was a problem with your fetch operation:', error);
                });
        },

        handleSaveButton() {
            const id = this.$route.params.id;
            client.put(`${config.backendUrl}/modifySubscription/${id}`, this.singleSubscription)
                .then(response => {
                    this.singleUser = response.data;
                    console.log(response.data);
                    this.$router.push({ name: 'subscription' });
                })
                .catch(error => {
                    console.error('There was a problem with your fetch operation:', error);
                });
        }


    }
}
</script>

<template>
    <div class="custom-container ">
        <div class="d-flex justify-content-center">
            <div class="col-md-4">
                <div class="mb-3">
                    <label>Name: </label>
                    <input type="text" v-model="singleSubscription.name" class="form-control custom-input">
                </div>
                <div class="mb-3">
                    <label>Slug: </label>
                    <input type="text" v-model="singleSubscription.slug" class="form-control custom-input">
                </div>
                <div class="mb-3">
                    <label>Duration: </label>
                    <input type="number" v-model="singleSubscription.duration" class="form-control custom-input">
                </div>
                <div class="mb-3">
                    <label>StartingDate: </label>
                    <input type="date" v-model="singleSubscription.startingDate" class="form-control custom-input">
                </div>
                <div class="mb-3">
                    <label>EndingDate: </label>
                    <input type="date" v-model="singleSubscription.endingDate" class="form-control custom-input">
                </div>
                <button @click="handleSaveButton" class="btn custom-button">Save</button>
            </div>
        </div>
    </div>

</template>
<style>
.modifyUserContainer input {
    display: flex;
    flex-direction: column;
}

.modifyUserContainer {
    background-color: rgba(134, 184, 134, 0.273);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100vw;
}
</style>