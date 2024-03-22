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
                activationStatus: false
            }
        }
    },

    methods: {
        saveUser(event) {
            event.preventDefault();

            const userData = {
                username: this.user.username,
                name: this.user.name,
                surname: this.user.surname,
                email: this.user.email,
                city: this.user.city,
                activationStatus: this.user.activationStatus
            };


            fetch("http://127.0.0.1:8000/api/register", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                
                body: JSON.stringify(userData)
            })

            this.$router.push({ name: 'home' })
        }

    }
}
</script>

<template>
    <div class="formContainer">
        <form @submit.prevent="saveUser">
            <label for="">Username:</label>
            <input type="text" name="username" v-model="user.username">
            <label for="">Name:</label>
            <input type="text" name="name" v-model="user.name">
            <label for="">Surname:</label>
            <input type="text" name="surname" v-model="user.surname">
            <label for="">Email:</label>
            <input type="text" name="email" v-model="user.email">
            <label for="">City:</label>
            <input type="text" name="city" v-model="user.city">
            <label for="">Activation Status:</label>
            <input type="checkbox" name="activationStatus" v-model="user.activationStatus">
            <button type="submit">Save</button>
        </form>
    </div>
</template>

<style>
.formContainer input {
    display: flex;
    flex-direction: column;
}
</style>