<script>
export default {

    data() {
        return {
            user: {
                username: '',
                name: '',
                surname: '',
                email: '',
                city: '',
                activationStatus: '',
                password: '',
                is_admin: ''
            }
        }
    },

    methods: {
        // sendEmail() {

        //     const userData = {
        //         username: this.user.username,
        //         name: this.user.name,
        //         surname: this.user.surname,
        //         email: this.user.email,
        //         city: this.user.city,
        //         activationStatus: this.user.activationStatus
        //     };

        //     const queryString = new URLSearchParams(userData)


        //     fetch("http://127.0.0.1:8000/api/sendEmail?" + queryString)
        //         .then((response) => {
        //             if (!response.ok) {
        //                 throw new Error('Network response was not ok');
        //             }
        //             return response.json();
        //         })
        //         .then((data) => {
        //             this.users = data;
        //         })
        //         .catch((error) => {
        //             console.error("Error fetching users:", error);
        //         });
        // },

        saveUser(event) {
            event.preventDefault();
            const accessToken = localStorage.getItem("token");

            const userData = {
                username: this.user.username,
                name: this.user.name,
                surname: this.user.surname,
                email: this.user.email,
                city: this.user.city,
                activationStatus: this.user.activationStatus,
                is_admin: this.user.is_admin,
                password: this.user.password
            };


            fetch("http://127.0.0.1:8000/api/register", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + accessToken
                },

                body: JSON.stringify(userData)
            })
            // .then(data =>
            //     this.sendEmail())

            this.$router.push({ name: 'users' })

        },

        handleLogin() {
            this.$router.push({ name: 'login' })
        }
    }
}
</script>

<template>
    <div class="formContainer">
        <form @submit.prevent="saveUser">
            <h1>Register</h1>
            <label for="">Username:</label>
            <input type="text" name="username" v-model="user.username">
            <label for="">Name:</label>
            <input type="text" name="name" v-model="user.name">
            <label for="">Surname:</label>
            <input type="text" name="surname" v-model="user.surname">
            <label for="">Password:</label>
            <input type="password" name="password" v-model="user.password">
            <label for="">Email:</label>
            <input type="text" name="email" v-model="user.email">
            <label for="">City:</label>
            <input type="text" name="city" v-model="user.city">
            <label for="">Activation Status:</label>
            <input type="checkbox" name="activationStatus" v-model="user.activationStatus">
            <label for="">Admin:</label>
            <input type="checkbox" name="is_admin" v-model="user.is_admin">
            <button class="saveButton" type="submit">Save</button>
        </form>
        <h3>Are you already registered? <span class="login" @click="handleLogin">Login!</span></h3>
    </div>
</template>

<style>
.formContainer {
    display: flex;
    flex-direction: column;
    /* align-items: center; */
    /* justify-content: center; */
    background-color: rgba(134, 184, 134, 0.273);
    padding: 1rem;
    gap: .5rem;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.formContainer input,
select {
    display: flex;
    margin: 0;
    border: none;
    border-radius: 3px;
    padding: .5rem;
}

.saveButton {
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

.saveButton:hover {
    transform: scale(110%);
    transition: .5s;
}
</style>