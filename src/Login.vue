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
    <div class="loginContainer">
        <h2>Login</h2>
        <form @submit.prevent="login">
            <label>Email</label>
            <input type="text" name="email" v-model="user.email">
            <label>Password</label>
            <input type="password" name="password" v-model="user.password">
            <button type="submit" class="loginButton">Login</button>
        </form>
        <h3>Are you not registered? <span class="signIn" @click="handlesignIn">Sign in</span></h3>
    </div>

</template>

<style>
.loginContainer {
    display: flex;
    flex-direction: column;
    /* align-items: center; */
    /* justify-content: center; */
    background-color: rgba(134, 184, 134, 0.273);
    padding: 1rem;
    gap: .5rem;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.loginContainer input,
select {
    display: flex;
    margin: 0;
    border: none;
    border-radius: 3px;
    padding: .5rem;
}

.loginButton {
    border-radius: 3px;
    padding: .5rem;
    background-color: rgba(134, 184, 134, 0.273);
    margin: 0 auto;
    margin-top: 1rem;
    border: none;
}

.login {
    cursor: pointer;
    color: red;
}

.loginButton:hover {
    transform: scale(110%);
    transition: .5s;
}
</style>