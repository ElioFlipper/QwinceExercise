<script>
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

            fetch("http://127.0.0.1:8000/api/login", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(userData)
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Gestisci la risposta dal server
                    console.log(data);
                    this.$router.push({ name: 'users' })
                })
                .catch(error => {
                    // Gestisci gli errori di rete o di risposta dal server
                    console.error('There was a problem with your fetch operation:', error);
                });
        },

        handlesignIn() {
            this.$router.push({ name: 'register' })
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
            <button type="submit">Login</button>
        </form>
        <h3>Are you not registered? <span class="signIn" @click="handlesignIn">Sign in</span></h3>
    </div>

</template>