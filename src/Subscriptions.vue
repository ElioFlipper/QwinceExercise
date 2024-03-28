<script>
export default {
    data() {
        return {
            subscriptions: []
        }
    },

    methods: {
        getSubscription() {
            fetch("http://127.0.0.1:8000/api/subscriptions")
                .then((response) => response.json())
                .then((data) => {
                    this.subscriptions = data;
                })
                .catch((error) =>
                    console.error("Error fetching subscriptions:", error))
        },

        handleModifyButton(id) {
            this.$router.push({ name: "ModifySubscriptions", params: { id: id } })
        },

        handleRemoveButton(id) {
            fetch(`http://127.0.0.1:8000/api/deleteSubscription/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    this.subscriptions = data
                })
        },

        handleAddButton() {
            this.$router.push({ name: "AddSubscription" })
            console.log("cliccato su add a new");
        }
    },

    mounted() {
        this.getSubscription();
    },

    beforeRouteEnter(to, from, next) {
        fetch("http://127.0.0.1:8000/api/subscriptions")
            .then((response) => response.json())
            .then((data) => {
                next(vm => {
                    vm.users = data;
                });
            })
            .catch((error) => {
                console.error("Error fetching users:", error);
                next();
            })
    },
}

</script>

<template>
    <table class="subscriptionTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Slug</th>
                <th>Duration</th>
                <th>Starting Date</th>
                <th>Ending Date</th>
                <th>Modify</th>
                <th>Remove</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="subscription in subscriptions" :key="subscription.id">
                <td>{{ subscription.name }}</td>
                <td>{{ subscription.slug }}</td>
                <td>{{ subscription.duration }}</td>
                <td>{{ subscription.startingDate }}</td>
                <td>{{ subscription.endingDate }}</td>
                <td><button @click="handleModifyButton(subscription.id)">Modify</button></td>
                <td><button @click="handleRemoveButton(subscription.id)">Remove</button></td>
            </tr>
        </tbody>
    </table>
    <button class="addSubscription" @click="handleAddButton">Add a new subscription</button>
</template>

<style>
.subscriptionTable {
    width: 100%;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.subscriptionTable:nth-child(odd) {
    background-color: rgba(134, 184, 134, 0.273);
}

.subscriptionTable th,
.subscriptionTable td {
    padding: 8px;
    text-align: center;
}

.subscriptionTable th {
    background-color: #f2f2f2;
}

.subscriptionTable tbody tr:nth-child(odd) {
    background-color: rgba(134, 184, 134, 0.273);
}
</style>