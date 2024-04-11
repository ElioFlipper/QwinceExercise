<script>
import config from './config';
import { client } from './setup';
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
            client.get(`${config.backendUrl}/users/${id}`)
                .then(response => {
                    this.singleUser = response.data;
                })
                .catch(error => {
                    console.error('There was a problem with your fetch operation:', error);
                });
        },

        handleSaveButton() {
            const id = this.$route.params.id;
            client.put(`${config.backendUrl}/modify/${id}`, this.singleUser)
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
    <div class="custom-container d-flex justify-content-center">
        <form @submit.prevent="handleSaveButton" class="col-md-4">
            <div class="mb-3">
                <label for="username">Username:</label>
                <input id="username" type="text" class="form-control custom-input" v-model="singleUser.username"
                    placeholder="Username">
            </div>
            <div class="mb-3">
                <label for="name">Nome:</label>
                <input id="name" type="text" class="form-control custom-input" v-model="singleUser.name" placeholder="Name">
            </div>
            <div class="mb-3">
                <label for="surname">Cognome:</label>
                <input id="surname" type="text" class="form-control custom-input" v-model="singleUser.surname" placeholder="Surname">
            </div>
            <div class="mb-3">
                <label for="email">Email:</label>
                <input id="email" type="text" class="form-control custom-input" v-model="singleUser.email" placeholder="Email">
            </div>
            <div class="mb-3">
                <label for="city">Città:</label>
                <input id="city" type="text" class="form-control custom-input" v-model="singleUser.city" placeholder="City">
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" v-model="singleUser.activationStatus">
                <label class="form-check-label" for="flexSwitchCheckDefault">Stato di attivazione</label>
            </div>
            <div class="mb-3">
                <button class="btn custom-button" type="submit">Salva</button>
            </div>
        </form>
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