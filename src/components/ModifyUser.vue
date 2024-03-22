<script>
export default {
    data() {
        return {
            singleUser: {}
        }
    },

    mounted() {
        const id = this.$route.params.id;
        this.getSingleUser(id)
    },

    methods: {
        getSingleUser(id) {
            fetch(`http://127.0.0.1:8000/api/users/${id}`)
                .then(response => response.json())
                .then(data => {
                    this.singleUser = data
                })
        },

        handleSaveButton() {
            const id = this.$route.params.id;
            fetch(`http://127.0.0.1:8000/api/modify/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(this.singleUser)
            })
                .then(response => response.json())
                .then(data => {
                    this.singleUser = data,
                        console.log(data)
                })

            this.$router.push({ name: 'home' })
        },

       
    }
}
</script>

<template>
    <div class="modifyUserContainer">
        <label>Username: </label>
        <input type="text" v-model="singleUser.username">
        <label>Name: </label>
        <input type="text" v-model="singleUser.name">
        <label>Surname: </label>
        <input type="text" v-model="singleUser.surname">
        <label>Email: </label>
        <input type="text" v-model="singleUser.email">
        <label>City: </label>
        <input type="text" v-model="singleUser.city">
        <label>activationStatus: </label>
        <input type="checkbox" v-model="singleUser.activationStatus">
        <button @click="handleSaveButton">Save</button>

    </div>

</template>
<style>
.modifyUserContainer input {
    display: flex;
    flex-direction: column;
}
</style>