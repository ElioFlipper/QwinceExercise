<script>
import { client } from './setup';
import config from './config';
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
            client.get(`${config.backendUrl}/subscriptions/${id}`)
                .then((response) => {
                    this.subscriptions = response.data;
                })
                .catch((error) => {
                    console.error("Error fetching subscriptions:", error);
                });
        },

        getUsersBySubscription() {
            const id = this.$route.params.id;
            client.get(`${config.backendUrl}/subscriptions/${id}/users`)
                .then((response) => {
                    this.users = response.data;
                })
                .catch((error) => {
                    console.error("Error fetching users:", error);
                });
        }
    },

    mounted() {
        this.getSubscriptionById()
        this.getUsersBySubscription()
    }
}
</script>

<template>
    <div class="custom-container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div v-if="subscriptions">
                            <p><strong>Name:</strong> {{ subscriptions.name }}</p>
                            <p><strong>Slug:</strong> {{ subscriptions.slug }}</p>
                            <p><strong>Duration:</strong> {{ subscriptions.duration }}</p>
                            <p><strong>Starting Date:</strong> {{ subscriptions.startingDate }}</p>
                            <p><strong>Ending Date:</strong> {{ subscriptions.endingDate }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">User Subscribed</h5>
                            <li class="list-group-item" v-for="user in users" :key="user.id">
                                {{ user.username }}
                            </li>
                    </div>
                </div>
            </div>
        </div>

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
