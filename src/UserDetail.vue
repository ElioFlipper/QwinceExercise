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
            fetch(`http://127.0.0.1:8000/users/${id}`)
                .then(response => response.json())
                .then(data => {
                    this.singleUser = data,
                        console.log(data)
                })
        }
    }
}
</script>

<template>
    <div class="container">
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
    </div>
</template>

<style></style>