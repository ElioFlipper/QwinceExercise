<script>
export default {
    data() {
        return {
            singleUser: {}
        }
    },

    mounted() {
        const id = this.$route.params.id;
        this.getSingleUser(id);
    },

    methods: {
        getSingleUser(id) {
            fetch(`http://127.0.0.1:8000/api/users/${id}`)
                .then(response => response.json())
                .then(data => {
                    this.singleUser = data
                })
        },

        handleModifyButton() {
            this.$router.push({ name: 'modify' })
        },

        handleRemoveButton() {
            const id = this.$route.params.id;
            fetch(`http://127.0.0.1:8000/api/delete/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    this.singleUser = data
                })
            this.$router.push({ name: 'home' })
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

    }
}
</script>

<template>
    <div class="userDetailContainer">
        <p> Username: {{ singleUser.username }}</p>
        <p>Name: {{ singleUser.name }}</p>
        <p>Surname: {{ singleUser.surname }}</p>
        <p>Email: {{ singleUser.email }}</p>
        <p>City: {{ singleUser.city }}</p>
        <p>Date of submission: {{ singleUser.date_of_submission }}</p>
        <p>activationStatus: {{ singleUser.activationStatus }}</p>
        <div class="buttonsContainer">
            <button class="modifyButton" @click="handleModifyButton">Modify</button>
            <button class="modifyButton" @click="handleRemoveButton">Remove</button>
            <button class="modifyButton" v-if="singleUser.activationStatus"
                @click="handleDeactiveButton">Deactive</button>
            <button class="modifyButton" v-else @click="handleActiveButton">Active</button>
            <button class="modifyButton" @click="handlePetRegisterButton">Add a pet</button>
            <button class="modifyButton" @click="handlePetDetailButton">Show pets</button>
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
    width: 40%;
}
</style>