<script>
import { client } from './setup';
import config from './config';
import axios from 'axios'
export default {
    data() {
        return {
            currentStep: 1,
            user: {
                username: '',
                name: '',
                surname: '',
                email: '',
                city: '',
                activationStatus: false,
                password: '',
                is_admin: false,
            }
        };
    },
    methods: {
        nextStep() {
            this.currentStep++;
        },
        prevStep() {
            this.currentStep--;
        },
        uploadFile() {
            this.file = this.$refs.file.files[0]
        },
        submitForm() {
            const userData = {
                username: this.user.username,
                name: this.user.name,
                surname: this.user.surname,
                email: this.user.email,
                city: this.user.city,
                activationStatus: this.user.activationStatus,
                is_admin: this.user.is_admin,
                password: this.user.password,
            };

            client.post(`${config.backendUrl}/register`, userData)
                .then(response => {
                    const userId = response.data.userId;
                    const token = response.data.token
                    const fileInput = this.$refs.fileInput;
                    const file = fileInput.files[0];
                    const formData = new FormData();
                    formData.append('file', file);
                    axios.post(`http://127.0.0.1:8000/api/users/${userId}/avatar`, formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                            'Authorization': `Bearer ${token}`
                        }
                    })
                        .then(updateResponse => {
                            this.$router.push({ name: 'login' });
                        })
                        .catch(updateError => {
                            console.error(updateError);
                        });
                })
                .catch(error => {
                    console.error('There was a problem with your fetch operation:', error);
                });

            console.log('Dati inviati al server:', userData);
        },

        handleLogin() {
            this.$router.push({ name: 'login' })
        }
    }
};
</script>
<template>
    <div>
        <div v-if="currentStep === 1">
            <h2>Step 1: Inserisci nome e cognome</h2>
            <form @submit.prevent="nextStep">
                <input type="text" v-model="user.username" placeholder="Username">
                <input type="text" v-model="user.name" placeholder="Name">
                <input type="text" v-model="user.surname" placeholder="Surname">
                <button type="submit">Avanti</button>
            </form>
            <h2 @click="handleLogin">Are you already signed? <span class="login">Login!</span></h2>
        </div>

        <div v-if="currentStep === 2">
            <h2>Step 2: Inserisci email</h2>
            <form @submit.prevent="nextStep">
                <input type="email" v-model="user.email" placeholder="Email">
                <input type="password" v-model="user.password" placeholder="Password">
                <input type="text" v-model="user.city" placeholder="City">
                <button @click.prevent="prevStep">Indietro</button>
                <button type="submit">Avanti</button>
            </form>
        </div>

        <div v-if="currentStep === 3">
            <h2>Step 3: Carica un'immagine</h2>
            <form @submit.prevent="submitForm">
                <input type="file" name="file" ref="fileInput" @change="uploadFile($event)">
                <button type="submit">Registrati</button>
                <button @click.prevent="prevStep">Indietro</button>
            </form>\
        </div>
    </div>
</template>

<style>
.login {
    color: red
}
</style>