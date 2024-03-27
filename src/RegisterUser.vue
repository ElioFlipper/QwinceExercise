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
        sendEmail() {

            const userData = {
                username: this.user.username,
                name: this.user.name,
                surname: this.user.surname,
                email: this.user.email,
                city: this.user.city,
                activationStatus: this.user.activationStatus
            };

            const queryString = new URLSearchParams(userData)


            fetch("http://127.0.0.1:8000/api/testroute?" + queryString)
                .then((response) => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then((data) => {
                    this.users = data;
                })
                .catch((error) => {
                    console.error("Error fetching users:", error);
                });
        },

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
            this.sendEmail()
        },



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
            <button class="saveButton" type="submit">Save</button>
        </form>
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

.saveButton:hover {
    transform: scale(110%);
    transition: .5s;
}
</style>