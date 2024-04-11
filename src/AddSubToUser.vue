<script>
import { client } from './setup';
import config from './config';
export default {
    data() {
        return {
            allSubs: [],
            singleSub: [],
            subscriptionSelect: {
                id: '',
                name: '',
            }
        }
    },

    computed: {
        availableSubscriptions() {
            return this.allSubs.filter(sub => !this.singleSub.find(s => s.id === sub.id));
        }
    },


    methods: {
        getSubscription() {

            client.get(`${config.backendUrl}/subscriptions`)
                .then(response => {
                    this.allSubs = response.data;
                })
                .catch(error => {
                    console.error("Error fetching subscriptions:", error);
                });
        },

        getUsersSubscription() {
            const id = this.$route.params.id;
            client.get(`${config.backendUrl}/users/${id}/subscriptions`)
                .then(response => {
                    this.singleSub = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },

        handleAddSubscriptionButton() {
            const subData = {
                name: this.subscriptionSelect.name,
            };

            const userId = this.$route.params.id;
            const subscriptionId = this.subscriptionSelect.id;
            console.log(subscriptionId);
            const accessToken = localStorage.getItem("token");

            client.post(`${config.backendUrl}/users/${userId}/subscriptions/${subscriptionId}`, subData)
                .then(response => {
                    if (response.status === 200) {
                        this.getUsersSubscription();
                        window.location.reload();
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        }
    },



    mounted() {
        this.getSubscription();
        this.getUsersSubscription();
    }
}
</script>

<template>
    <div class="custom-container">
        <div class="d-flex justify-content-center mt-3">
            <div class="col-md-4">
                <div class="mb-3">
                    <select id="petSpecies" class="form-select" v-model="subscriptionSelect.id">
                        <option value="" disabled selected>Scegli un abbonamento</option>
                        <option v-for="(sub, index) in availableSubscriptions" :key="index" :value="sub.id">{{ sub.name
                            }}
                        </option>
                    </select>
                </div>
                <button @click="handleAddSubscriptionButton" class="btn btn-primary">Add subscription</button>
                <h3>Abbonamenti esistenti:</h3>
                <div v-for="subscription in singleSub">
                    <li>{{ subscription.name }}</li>
                </div>
            </div>
        </div>
    </div>
</template>

<style></style>