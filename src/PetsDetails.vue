<script>
import { client } from './setup';
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
            client.get(`${config.backendUrl}/users/${id}/pets`)
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
    <div class="custom-container">
        <div class="row">
            <div class="col-md-4" v-for="pet in pets" :key="pet.id">
                <div class="card mb-3">
                    <div class="card-body">
                        <p class="card-text"><strong>Nome:</strong> {{ pet.name }}</p>
                        <p class="card-text"><strong>Specie:</strong> {{ pet.species }}</p>
                    </div>
                </div>
            </div>
        </div>
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