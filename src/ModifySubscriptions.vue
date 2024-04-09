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
    <div class="modifyUserContainer">
        <label>Name: </label>
        <input type="text" v-model="singleSubscription.name">
        <label>Slug: </label>
        <input type="text" v-model="singleSubscription.slug">
        <label>Duration: </label>
        <input type="number" v-model="singleSubscription.duration">
        <label>StartingDate: </label>
        <input type="date" v-model="singleSubscription.startingDate">
        <label>EndingDate: </label>
        <input type="date" v-model="singleSubscription.endingDate">

        <button @click="handleSaveButton" class="saveButton">Save</button>

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