<script>
import axios from 'axios'
import config from './config';
export default {
    data() {
        return {
            singleUser: {}
        }
    },

    mounted() {
        const id = this.$route.params.id;
        this.getSingleUser(id)
    },

    methods: {
        getSingleUser(id) {
            const accessToken = localStorage.getItem("token");
            axios.get(`${config.backendUrl}/users/${id}`, {
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + accessToken
                }
            })
                .then(response => {
                    this.singleUser = response.data;
                })
                .catch(error => {
                    console.error('There was a problem with your fetch operation:', error);
                });
        },

        handleSaveButton() {
            const id = this.$route.params.id;
            const accessToken = localStorage.getItem("token");
            axios.put(`${config.backendUrl}/modify/${id}`, this.singleUser, {
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + accessToken
                }
            })
                .then(response => {
                    this.singleUser = response.data;
                    console.log(response.data);
                    this.$router.push({ name: 'userDetail', params: { id: id } });
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
        <label>Username: </label>
        <input type="text" v-model="singleUser.username">
        <label>Name: </label>
        <input type="text" v-model="singleUser.name">
        <label>Surname: </label>
        <input type="text" v-model="singleUser.surname">
        <label>Email: </label>
        <input type="text" v-model="singleUser.email">
        <label>City: </label>
        <input type="text" v-model="singleUser.city">
        <label>activationStatus: </label>
        <input type="checkbox" v-model="singleUser.activationStatus">
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