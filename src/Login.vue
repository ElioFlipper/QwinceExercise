<script>
import config from './config';
import { client } from './setup';
export default {
    data() {
        return {
            user: {
                email: '',
                password: ''
            },
            loginFailed: false
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
                    this.loginFailed = true;
                    setTimeout(() => {
                        this.loginFailed = false;
                    }, 3000);
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
        <h2 class="logIn">Login</h2>
        <div class="d-flex justify-content-center mt-3">
            <form @submit.prevent="login" class="col-md-4">
                <div class="mb-3">
                    <input type="text" name="email" v-model="user.email" class="form-control"
                        placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <input type="password" name="password" v-model="user.password" class="form-control"
                        placeholder="Password">
                </div>
                <div class="alert alert-danger" role="alert" v-if="loginFailed">
                    Email o password errate, riprova!
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
        <div class="registered">
            <h4>Are you not registered? <span class="signIn" @click="handlesignIn">Sign in</span></h4>
        </div>
    </div>

</template>

<style>
.signIn {
    color: red;
    cursor: pointer;
}

.logIn {
    text-align: center;
}

.registered {
    text-align: center;
}
</style>