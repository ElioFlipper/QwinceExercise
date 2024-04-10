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
    <img :src="avatarURL" width="200" height="200">
    <div class="userDetailContainer">
        <table class="userDetailTable">
            <tr>
                <th>Username:</th>
                <td>{{ singleUser.username }}</td>
            </tr>
            <tr>
                <th>Name:</th>
                <td>{{ singleUser.name }}</td>
            </tr>
            <tr>
                <th>Surname:</th>
                <td>{{ singleUser.surname }}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>{{ singleUser.email }}</td>
            </tr>
            <tr>
                <th>City:</th>
                <td>{{ singleUser.city }}</td>
            </tr>
            <tr>
                <th>Date of submission:</th>
                <td>{{ singleUser.date_of_submission }}</td>
            </tr>
            <tr>
                <th>Activation Status:</th>
                <td>{{ singleUser.activationStatus }}</td>
            </tr>
        </table>
        <div v-for="sub in subscription" class="subContainer">
            <table class="userDetailTable">
                <tr>
                    <th>Nome dell'abbonamento:</th>
                    <td>{{ sub.name }}</td>
                </tr>
                <tr>
                    <th>Slug dell'abbonamento:</th>
                    <td>{{ sub.slug }}</td>
                </tr>
                <tr>
                    <th>Durata dell'abbonamento (mesi):</th>
                    <td>{{ sub.duration }}</td>
                </tr>
                <tr>
                    <th>Data di inizio:</th>
                    <td>{{ sub.startingDate }}</td>
                </tr>
                <tr>
                    <th>Data fine:</th>
                    <td>{{ sub.endingDate }}</td>
                </tr>
                <tr>
                    <th>Action:</th>
                    <td>
                        <button class="removeButton" @click="handleRemoveSubscription(sub)">Remove</button>
                    </td>
                </tr>
            </table>
        </div>

        <div class="buttonsContainer">
            <button class="modifyButton" @click="handleModifyButton">Modify</button>
            <button class="modifyButton" @click="handleRemoveButton">Remove</button>
            <button class="modifyButton" v-if="singleUser.activationStatus"
                @click="handleDeactiveButton">Deactive</button>
            <button class="modifyButton" v-else @click="handleActiveButton">Active</button>
            <button class="modifyButton" @click="handlePetRegisterButton">Add a pet</button>
            <button class="modifyButton" @click="handlePetDetailButton">Show pets</button>
            <button class="modifyButton" @click="handleAddSubscriptionButton">Add a subscription</button>
            <button class="modifyButton" @click="handleUploadButton">Upload</button>
            <input class="modifyButton" type="file" name="file" ref="fileInput" @change="uploadFile($event)">
        </div>
    </div>
</template>


<style>
.userDetailContainer {
    background-color: whitesmoke;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100vw;
}

.userDetailContainer p:nth-child(even) {
    background-color: rgba(134, 184, 134, 0.273);
    margin: 0;
    padding: 1rem;
    text-align: center;
    width: 100%;
}

.userDetailContainer p:nth-of-type(odd) {
    background-color: whitesmoke;
    margin: 0;
    padding: 1rem;
    text-align: center;
    width: 100%;
}

.modifyButton {
    border-radius: 3px;
    background-color: rgba(134, 184, 134, 0.273);
    margin: 0 auto;
    padding: .5rem;
    border: none;
}

.modifyButton:hover {
    transform: scale(110%);
    transition: .5s;
}

.buttonsContainer {
    display: flex;
    width: 90%;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
}

.userDetailTable {
    width: 100%;
}

.userDetailTable:nth-child(odd) {
    background-color: rgba(134, 184, 134, 0.273);
}

.userDetailTable th,
.userDetailTable td {
    padding: 8px;
    text-align: center;
}

.userDetailTable th {
    background-color: #f2f2f2;
}

.userDetailTable tbody tr:nth-child(odd) {
    background-color: rgba(134, 184, 134, 0.273);
}

.subContainer {
    margin-top: 2rem;
    margin-bottom: 2rem
}
</style>