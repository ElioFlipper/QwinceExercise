<script>
import { client } from './setup'
import config from './config';
import axios from 'axios'
export default {
    data() {
        return {
            singleUser: {},
            subscription: [],
            file: null,
            avatarURL: ''
        }
    },

    mounted() {
        const id = this.$route.params.id;
        this.getSingleUser(id);
        this.getUsersSubscription(id);
        this.getAvatar()
    },

    methods: {
        getSingleUser(id) {
            client.get(`${config.backendUrl}/users/${id}`,)
                .then(response => {
                    this.singleUser = response.data;
                    console.log(response.data)
                })
                .catch(error => {
                    console.error(error);
                });
        },

        handleModifyButton() {
            this.$router.push({ name: 'modify' })
        },

        handleRemoveButton() {
            const id = this.$route.params.id;
            client.delete(`${config.backendUrl}/delete/${id}`)
                .then(response => {
                    this.singleUser = response.data;
                    this.$router.push({ name: 'users' });
                })
                .catch(error => {
                    console.error(error);
                });
        },

        handleDeactiveButton() {
            this.singleUser.activationStatus = !this.singleUser.activationStatus
        },

        handleActiveButton() {
            this.singleUser.activationStatus = !this.singleUser.activationStatus
        },

        handlePetRegisterButton() {
            this.$router.push({ name: 'petsRegister', params: { id: this.singleUser.id } })
        },
        handlePetDetailButton() {
            this.$router.push({ name: 'petsDetails', params: { id: this.singleUser.id } })
        },
        handleAddSubscriptionButton() {
            this.$router.push({ name: 'addSubToUser', params: { id: this.singleUser.id } })
        },
        getUsersSubscription() {
            const id = this.$route.params.id;
            client.get(`${config.backendUrl}/users/${id}/subscriptions`)
                .then(response => {
                    this.subscription = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        handleRemoveSubscription(sub) {
            const user_id = this.$route.params.id;
            const subscription_id = sub.id;
            console.log(user_id, subscription_id);

            client.delete(`${config.backendUrl}/users/${user_id}/subscriptions/${subscription_id}`)
                .then(response => {
                    this.subscription = response.data;
                    window.location.reload();
                })
                .catch(error => {
                    console.error(error);
                });
        },
        uploadFile() {
            this.file = this.$refs.file.files[0]
        },

        handleUploadButton() {
            const fileInput = this.$refs.fileInput;
            const file = fileInput.files[0];
            const formData = new FormData();
            formData.append('file', file);
            const userId = this.$route.params.id;

            client.post(`${config.backendUrl}/users/${userId}/avatar`, formData)
                .then(updateResponse => {
                    this.getAvatar();
                })
                .catch(updateError => {
                    console.error(updateError);
                });
        },


        getAvatar() {
            const userId = this.$route.params.id;
            client.get(`${config.backendUrl}/users/${userId}/avatar`, {
                responseType: 'blob'
            })
                .then(response => {
                    const contentType = response.headers['content-type'];
                    const imageUrl = URL.createObjectURL(new Blob([response.data], { type: contentType }));
                    this.avatarURL = imageUrl;
                })
                .catch(error => {
                    console.error(error);
                });
        }

    }
}
</script>

<template>
    <div class="custom-container d-flex justify-content-center" style="flex-direction: column; align-items: center;">
        <div class="card col-md-6">
            <div class="row g-5">
                <div class="col-md-5">
                    <img :src="avatarURL" class="img-fluid rounded-start" alt="User Avatar">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <p class="card-text"><strong>Username:</strong> {{ singleUser.username }}</p>
                        <p class="card-text"><strong>Name:</strong> {{ singleUser.name }}</p>
                        <p class="card-text"><strong>Surname:</strong> {{ singleUser.surname }}</p>
                        <p class="card-text"><strong>Email:</strong> {{ singleUser.email }}</p>
                        <p class="card-text"><strong>City:</strong> {{ singleUser.city }}</p>
                        <p class="card-text"><strong>Date of Submission:</strong> {{ singleUser.date_of_submission
                            }}
                        </p>
                        <p class="card-text"><strong>Activation Status:</strong> {{ singleUser.activationStatus }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3 col-md-6">
            <div class="d-flex justify-content-between">
                <button class="btn custom-button mt-3" @click="handleModifyButton">Modify</button>
                <button class="btn custom-button mt-3" @click="handleRemoveButton">Remove</button>
                <button class="btn custom-button mt-3" v-if="singleUser.activationStatus"
                    @click="handleDeactiveButton">Deactive</button>
                <button class="btn custom-button mt-3" v-else @click="handleActiveButton">Active</button>
                <button class="btn custom-button mt-3" @click="handlePetRegisterButton">Add a pet</button>
                <button class="btn custom-button mt-3" @click="handlePetDetailButton">Show pets</button>
                <button class="btn custom-button mt-3" @click="handleAddSubscriptionButton">Add a subscription</button>
                <button class="btn custom-button mt-3" @click="handleUploadButton">Upload</button>
            </div>
        </div>
        <div class="mb-3 col-md-6">
            <input class="form-control custom-input" type="file" name="file" ref="fileInput" @change="uploadFile($event)">
        </div>
        <div v-for="sub in subscription" :key="sub.id" class="mb-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <p class="card-text"><strong>Nome dell'abbonamento</strong>: {{ sub.name }}</p>
                    <p class="card-text"><strong>Slug dell'abbonamento</strong>: {{ sub.slug }}</p>
                    <p class="card-text"><strong>Durata dell'abbonamento</strong> (mesi): {{ sub.duration }}</p>
                    <p class="card-text"><strong>Data di inizio</strong>: {{ sub.startingDate }}</p>
                    <p class="card-text"><strong>Data fine</strong>: {{ sub.endingDate }}</p>
                    <button @click="handleRemoveSubscription(sub)" class="btn btn-danger">Remove</button>
                </div>
            </div>
        </div>
    </div>
</template>


<style></style>