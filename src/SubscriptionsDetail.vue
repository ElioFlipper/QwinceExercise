<script>
export default {
    data() {
        return{
            subscriptions: {},
            users: []
        }
    },

    methods: {
        getSubscriptionById() {
            const id = this.$route.params.id;
            fetch(`http://127.0.0.1:8000/api/subscriptions/${id}`)
                .then((response) => response.json())
                .then((data) => {
                    this.subscriptions = data;
                })
                .catch((error) =>
                    console.error("Error fetching subscriptions:", error))
        },

        getUsersBySubscription() {
            const id = this.$route.params.id;
            fetch(`http://127.0.0.1:8000/api/subscriptions/${id}/users`)
                .then((response) => response.json())
                .then((data) => {
                    this.users = data;
                })
                .catch((error) =>
                    console.error("Error fetching users:", error))
        }
    },

    mounted() {
        this.getSubscriptionById()
        this.getUsersBySubscription()
    }
}
</script>

<template>
    <h1>Subscribe</h1>
    <p>{{ subscriptions.name }}</p>
    <p>{{ subscriptions.slug }}</p>
    <p>{{ subscriptions.duration }}</p>
    <p>{{ subscriptions.startingDate }}</p>
    <p>{{ subscriptions.endingDate }}</p>

    <h1>Utenti:</h1>
    <ul v-for="user in users">
        <li>
            {{ user.username }}
        </li>
    </ul>
    
</template>