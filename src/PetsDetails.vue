<script>
import axios from 'axios'
import config from './config';
export default {
    data() {
        return {
            pets: []
        }
    },

    mounted() {
        const id = this.$route.params.id;
        this.getSinglePet(id);
    },

    methods: {
        getSinglePet(id) {
            const accessToken = localStorage.getItem("token");
            axios.get(`${config.backendUrl}/users/${id}/pets`, {
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + accessToken
                }
            })
                .then(response => {
                    this.pets = response.data;
                })
                .catch(error => {
                    console.error('There was a problem with your fetch operation:', error);
                });
            console.log(id);
        }
    },

}
</script>

<template>
    <div class="userPetContainer" v-for="pet in pets" key="pet.id">
        <p>Pet name: <span>{{ pet.name }}</span></p>
        <p>Pet species: <span>{{ pet.species }}</span></p>
    </div>
</template>

<style>
.userPetContainer {
    background-color: whitesmoke;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100vw;
}

.userPetContainer span {
    font-weight: bold;
}

.userPetContainer:nth-child(even) {
    background-color: rgba(134, 184, 134, 0.273);
    list-style-type: none;
}

.userPetContainer:nth-child(odd) {
    background-color: whitesmoke;
    list-style-type: none;
    width: 100%;
}
</style>