<script>
export default {
    data() {
        return {
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
    <div>
        <h1>Abbonamenti attivi</h1>
        <table class="activeSubscriptionTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Duration</th>
                    <th>Starting Date</th>
                    <th>Ending Date</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="subscriptions">
                    <td>{{ subscriptions.name }}</td>
                    <td>{{ subscriptions.slug }}</td>
                    <td>{{ subscriptions.duration }}</td>
                    <td>{{ subscriptions.startingDate }}</td>
                    <td>{{ subscriptions.endingDate }}</td>
                </tr>
            </tbody>
        </table>

        <h1>Utenti:</h1>
        <table class="userSubscribedTable">
            <thead>
                <tr>
                    <th>Username</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" :key="user.id">
                    <td>{{ user.username }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<style>
.activeSubscriptionTable {
    width: 100%;
}

.activeSubscriptionTable:nth-child(odd) {
    background-color: rgba(134, 184, 134, 0.273);
}

.activeSubscriptionTable th,
.activeSubscriptionTable td {
    padding: 8px;
    text-align: center;
}

.activeSubscriptionTable th {
    background-color: #f2f2f2;
}

.activeSubscriptionTable tbody tr:nth-child(odd) {
    background-color: rgba(134, 184, 134, 0.273);
}



.userSubscribedTable {
    width: 100%;
}

.userSubscribedTable:nth-child(odd) {
    background-color: rgba(134, 184, 134, 0.273);
}

.userSubscribedTable th,
.userSubscribedTable td {
    padding: 8px;
    text-align: center;
}

.userSubscribedTable th {
    background-color: #f2f2f2;
}

.userSubscribedTable tbody tr:nth-child(odd) {
    background-color: rgba(134, 184, 134, 0.273);
}
</style>
