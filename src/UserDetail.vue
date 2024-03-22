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
                    this.singleUser = data,
                        console.log(data)
                })
        },
        handleModifyButton() {
            this.$router.push({ name: 'modify' })
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
        <button>Remove</button>
        <button>Active</button>
        <button>Deactive</button>
    </div>
</template>

<style></style>