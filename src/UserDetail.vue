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
        }

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
        <button class="modifyButton" @click="handleModifyButton">Modify</button>
        <button class="modifyButton" @click="handleRemoveButton">Remove</button>
        <button class="modifyButton" v-if="singleUser.activationStatus" @click="handleDeactiveButton">Deactive</button>
        <button class="modifyButton" v-else @click="handleActiveButton">Active</button>
    </div>
</template>

<style>
.userDetailContainer {
    background-color: whitesmoke;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    display: flex;
    flex-direction: column;
}

.userDetailContainer p:nth-child(even) {
    background-color: rgba(134, 184, 134, 0.273);
    margin: 0;
    padding: 1rem;
    text-align: center;
}

.userDetailContainer p:nth-of-type(odd) {
    background-color: whitesmoke;
    margin: 0;
    padding: 1rem;
    text-align: center;
}

.modifyButton {
    border-radius: 3px;
    padding: .5rem;
    background-color: rgba(134, 184, 134, 0.273);
    margin: 0 auto;
    margin-top: 1rem;
    border: none;
}

.modifyButton:hover {
    transform: scale(110%);
    transition: .5s;
}
</style>