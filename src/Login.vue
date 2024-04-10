<script>
import config from './config';
import { client } from './setup';
export default {
    data() {
        return {
            user: {
                email: '',
                password: ''
            }
        }
    },

    methods: {
        login() {
            const userData = {
                email: this.user.email,
                password: this.user.password
            };

            client.post(`${config.backendUrl}/login`, userData)
                .then(response => {
                    if (response.status !== 200) {
                        throw new Error('Network response was not ok');
                    }
                    return response.data;
                })
                .then(data => {
                    localStorage.setItem('token', data.token);
                    if (data.is_admin) {
                        this.$router.push({ name: 'users' });
                    } else {
                        console.log(data.user_id);
                        this.$router.push({ name: 'userDetail', params: { id: data.user_id } });
                    }
                })
                .catch(error => {
                    console.error('There was a problem with your fetch operation:', error);
                });
        },

        handlesignIn() {
            this.$router.push({ name: 'registerByStep' })
        }
    }
}
</script>

<template>
    <div class="custom-container">
        <h2>Login</h2>
        <form @submit.prevent="login">
            <div class="mb-3 col-md-6" >
                <input type="text" name="email" v-model="user.email" class="form-control" placeholder="name@example.com">
            </div>
            <div class="mb-3 col-md-6" col-md-6>
                <input type="password" name="password" v-model="user.password" class="form-control" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <h4>Are you not registered? <span class="signIn" @click="handlesignIn">Sign in</span></h4>
    </div>
</template>

<style>
.signIn {
    color:red;
    cursor: pointer;
}
</style>