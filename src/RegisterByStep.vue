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
            },
            registerFailed: false
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
                    this.registerFailed = true;
                    setTimeout(() => {
                        this.registerFailed = false;
                    }, 3000);
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
    <div class="custom-container">
        <div v-if="currentStep === 1">
            <h2 class="logIn">Signin</h2>
            <div class="d-flex justify-content-center mt-3">
                <form @submit.prevent="nextStep" class="col-md-4">
                    <div class="mb-3">
                        <input type="text" class="form-control" v-model="user.username" placeholder="Username">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" v-model="user.name" placeholder="Name">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" v-model="user.surname" placeholder="Surname">
                    </div>
                    <button type="submit" class="btn btn-primary">Avanti</button>
                </form>
            </div>
            <div class="registered">
                <h4>Are you already signed? <span class="login" @click="handleLogin">Login!</span></h4>
            </div>
        </div>


        <div v-if="currentStep === 2">
            <div class="d-flex justify-content-center mt-3">
                <form @submit.prevent="nextStep" class="col-md-4">
                    <div class="mb-3">
                        <input type="email" class="form-control" v-model="user.email" placeholder="Email">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" v-model="user.password" placeholder="Password">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" v-model="user.city" placeholder="City">
                    </div>
                    <div class="mb-3 d-flex justify-content-around">
                        <button class="btn btn-danger" @click.prevent="prevStep">Indietro</button>
                        <button class="btn btn-primary" type="submit">Avanti</button>
                    </div>
                </form>
            </div>
        </div>


        <div v-if="currentStep === 3">
            <div class="d-flex justify-content-center mt-3">
                <form @submit.prevent="submitForm" class="col-md-4">
                    <div class="mb-3">
                        <input type="file" name="file" class="form-control" ref="fileInput"
                            @change="uploadFile($event)">
                    </div>
                    <div class="alert alert-danger" role="alert" v-if="registerFailed">
                        Email già in uso, riprova!
                    </div>
                    <div class="mb-3 d-flex justify-content-around">
                        <button class="btn btn-danger" @click.prevent="prevStep">Indietro</button>
                        <button class="btn btn-success" type="submit">Registrati</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style>
.login {
    color: red
}

.custom-container h4 {
    margin-top: 1rem;
}
</style>