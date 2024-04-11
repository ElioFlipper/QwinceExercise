<script>
import { client } from './setup';
import config from './config';
export default {
    data() {
        return {
            subscriptions: []
        }
    },

    methods: {
        getSubscription() {

            client.get(`${config.backendUrl}/subscriptions`)
                .then(response => {
                    this.subscriptions = response.data;
                })
                .catch(error => {
                    console.error("Error fetching subscriptions:", error);
                });
        },


        handleModifyButton(id) {
            this.$router.push({ name: "ModifySubscriptions", params: { id: id } })
        },

        handleRemoveButton(id) {

            client.delete(`${config.backendUrl}/deleteSubscription/${id}`)
                .then(response => {
                    this.subscriptions = response.data;
                    window.location.reload();
                })
                .catch(error => {
                    console.error("Error deleting subscription:", error);
                });
        },


        handleAddButton() {
            this.$router.push({ name: "AddSubscription" })
            console.log("cliccato su add a new");
        },

        handleDetailsButton(id) {
            this.$router.push({ name: "subscriptionDetail", params: { id: id } })
        }
    },

    mounted() {
        this.getSubscription();
    },

    beforeRouteEnter(to, from, next) {

        client.get(`${config.backendUrl}/subscriptions`)
            .then(response => {
                next(vm => {
                    vm.subscriptions = response.data;
                });
            })
            .catch(error => {
                console.error("Error fetching subscriptions:", error);
                next();
            });
    }
}

</script>

<template>
    <div class="custom-container">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Slug</th>
                <th scope="col">Duration</th>
                <th scope="col">Starting Date</th>
                <th scope="col">Ending Date</th>
                <th scope="col">Modify</th>
                <th scope="col">Remove</th>
                <th scope="col">Details</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="subscription in subscriptions" :key="subscription.id">
                <td>{{ subscription.name }}</td>
                <td>{{ subscription.slug }}</td>
                <td>{{ subscription.duration }}</td>
                <td>{{ subscription.startingDate }}</td>
                <td>{{ subscription.endingDate }}</td>
                <td>
                    <button @click="handleModifyButton(subscription.id)" class="btn custom-button">Modify</button>
                </td>
                <td>
                    <button @click="handleRemoveButton(subscription.id)" class="btn btn-danger">Remove</button>
                </td>
                <td>
                    <button @click="handleDetailsButton(subscription.id)" class="btn btn-dark">Details</button>
                </td>
            </tr>
        </tbody>
    </table>

    <button class="btn custom-button" @click="handleAddButton">Add a new subscription</button>
</div>
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