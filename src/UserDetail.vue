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
        <ul>
            <li>
                <p> Username: {{ singleUser.username }}</p>
                <p>Name: {{ singleUser.name }}</p>
                <p>Surname: {{ singleUser.surname }}</p>
                <p>Email: {{ singleUser.email }}</p>
                <p>City: {{ singleUser.city }}</p>
                <p>Date of submission: {{ singleUser.date_of_submission }}</p>
                <p>activationStatus: {{ singleUser.activationStatus }}</p>
            </li>
        </ul>
        <button @click="handleModifyButton">Modify</button>
        <button @click="handleRemoveButton">Remove</button>
        <button v-if="singleUser.activationStatus" @click="handleDeactiveButton">Deactive</button>
        <button v-else @click="handleActiveButton">Active</button>
    </div>
</template>

<style></style>