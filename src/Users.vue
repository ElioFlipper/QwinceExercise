<script>
import axios from 'axios';
import config from './config';
import { client } from './setup';
export default {
    data() {
        return {
            users: [],
            username: '',
            name: '',
            surname: '',
            email: '',
            city: '',
            activationStatus: ''
        };
    },

    // computed: {
    //     filteredUsers() {
    //         return this.users.filter(user =>
    //             user.username.toLowerCase().includes(this.searchUsername.toLowerCase()) &&
    //             (user.name.toLowerCase().includes(this.searchNameOrSurname.toLowerCase()) ||
    //                 user.surname.toLowerCase().includes(this.searchNameOrSurname.toLowerCase())) &&
    //             user.email.toLowerCase().includes(this.searchByEmail.toLowerCase()) &&
    //             user.city.toLowerCase().includes(this.searchByCity.toLowerCase()) &&
    //             this.activationStatus === null || this.activationStatus === user.activationStatus 
    //         );
    //     }
    // },

    beforeRouteEnter(to, from, next) {
        client.get(`${config.backendUrl}/users`)
            .then((response) => {
                next(vm => {
                    vm.users = response.data;
                });
            })
            .catch((error) => {
                console.error("Error fetching users:", error);
                next();
            });
    },


    mounted() {
        this.getUsers();
    },

    methods: {
        getUsers() {

            client.get("http://127.0.0.1:8000/api/users")
                .then(response => {
                    this.users = response.data;
                })
                .catch(error => {
                    console.error("Error fetching users:", error);
                });
        },

        openProfile(id) {
            this.$router.push({ name: 'userDetail', params: { id: id } });
        },

        handleRegisterButton() {
            this.$router.push({ name: 'register' }).then(() => {
                this.getUsers();
            })
        },

        // handleSearchInput(e, field) {
        //     const value = e.target.value.toLowerCase();
        //     if (field === 'username') {
        //         this.searchUsername = value;
        //     }
        //     else if (field === 'name') {
        //         this.searchNameOrSurname = value;
        //     }
        //     else if (field === 'email') {
        //         this.searchByEmail = value;
        //     }
        //     else if (field === 'city') {
        //         this.searchByCity = value;
        //     }
        // }


        handleSearchButton() {
            const data = {
                username: this.username,
                name: this.name,
                email: this.email,
                city: this.city,
                activationStatus: this.activationStatus,
            };

            // for (const key in data) {
            //     if (data[key] === '' || data[key] === null) {
            //         delete data[key];
            //     }
            // }

            const queryString = new URLSearchParams(data);

            client.get("http://127.0.0.1:8000/api/filter?" + queryString)
                .then(response => {
                    this.users = response.data;
                })
                .catch(error => {
                    console.error("Error fetching users:", error);
                });
        }

    },
}
</script>
<template>
    <div class="custom-container ">
        <div class="d-flex justify-content-center mt-3" >
            <form @submit.prevent="handleSearchButton" class="col-md-4">
                <div class="mb-3">
                    <input type="text" placeholder="Username" class="form-control custom-input" v-model="username">
                </div>
                <div class="mb-3">
                    <input type="text" placeholder="Name or surname" class="form-control custom-input" v-model="name">
                </div>
                <div class="mb-3">
                    <input type="text" placeholder="Email" class="form-control custom-input" v-model="email">
                </div>
                <div class="mb-3">
                    <input type="text" placeholder="City" class="form-control custom-input" v-model="city">
                </div>
                <div class="mb-3">
                    <select class="form-select custom-input " aria-label="Default select example" v-model="activationStatus">
                        <option :value="true">Active</option>
                        <option :value="false">Deactive</option>
                    </select>
                </div>
                <button class="btn custom-button" type="submit">Search</button>
            </form>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">City</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" :key="user.id">
                    <td>{{ user.username }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.city }}</td>
                    <td>
                        <button @click="openProfile(user.id)" class="btn btn-dark">Profile</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <button class="btn custom-button" @click="handleRegisterButton">Register a new user</button>
    </div>
</template>

<style scoped></style>