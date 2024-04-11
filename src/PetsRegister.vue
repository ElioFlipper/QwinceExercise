<script>
import { client } from './setup';
import config from './config';
export default {
    data() {
        return {
            pet: {
                name: "",
                species: ""
            }
        }
    },

    methods: {
        savePet(event) {
            event.preventDefault();

            const petData = {
                name: this.pet.name,
                species: this.pet.species,
            };

            const id = this.$route.params.id;

            client.post(`${config.backendUrl}/users/${id}/pet`, petData)
                .then(response => {
                    this.$router.push({ name: 'userDetail' });
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
        <form @submit.prevent="savePet" class="col-md-4">
            <div >
                <label for="petName">Nome:</label>
                <input id="petName" type="text" class="form-control custom-input" v-model="pet.name" placeholder="Nome dell'animale">
            </div>
            <div >
                <label for="petSpecies">Specie animale:</label>
                <select id="petSpecies" class="form-select custom-input" v-model="pet.species">
                    <option value="" disabled selected>Seleziona la specie</option>
                    <option value="cane">Cane</option>
                    <option value="gatto">Gatto</option>
                    <option value="canarino">Canarino</option>
                    <option value="iguana">Iguana</option>
                    <option value="serpente">Serpente</option>
                </select>
            </div>
            <div >
                <button class="btn btn-primary mt-2" type="submit">Save</button>
            </div>
        </form>
    </div>
</template>


<style>
.savePetButton {
    border-radius: 3px;
    padding: .5rem;
    background-color: rgba(134, 184, 134, 0.273);
    margin: 0 auto;
    margin-top: 1rem;
    border: none;
}

.savePetButton:hover {
    transform: scale(110%);
    transition: .5s;
}
</style>