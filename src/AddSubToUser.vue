<script>
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
            const accessToken = localStorage.getItem("token");

            fetch("http://127.0.0.1:8000/api/subscriptions", {
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + accessToken
                }
            })
                .then((response) => response.json())
                .then((data) => {
                    this.allSubs = data;
                })
                .catch((error) =>
                    console.error("Error fetching subscriptions:", error))
        },

        getUsersSubscription() {
            const id = this.$route.params.id;
            const accessToken = localStorage.getItem("token");
            fetch(`http://127.0.0.1:8000/api/users/${id}/subscriptions`, {
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + accessToken
                }
            })
                .then(response => response.json())
                .then((data) => {
                    this.singleSub = data
                })
                .catch((error) =>
                    console.error("Error fetching subscriptions:", error))
        },

        handleAddSubscriptionButton() {
            const subData = {
                name: this.subscriptionSelect.name,
            };

            const userId = this.$route.params.id;
            const subscriptionId = this.subscriptionSelect.id
            console.log(subscriptionId);
            const accessToken = localStorage.getItem("token");

            fetch(`http://localhost:8000/api/users/${userId}/subscriptions/${subscriptionId}`, {
                'method': 'POST',
                headers: {
                    'content-type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + accessToken
                },
                body: JSON.stringify(subData)
            })
                .then(response => {
                    if (response.ok) {
                        this.getUsersSubscription();
                        window.location.reload()
                    }
                })
        }
    },



    mounted() {
        this.getSubscription();
        this.getUsersSubscription();
    }
}
</script>

<template>
    <div class="addSubToUserContainer">
        <select name="" id="" v-model="subscriptionSelect.id">
            <option value="" disabled selected>Scegli un abbonamento</option>
            <option v-for="(sub, index) in availableSubscriptions" :key="index" :value="sub.id">{{ sub.name }}
            </option>
        </select>
        <button @click="handleAddSubscriptionButton">Add subscription</button>
        <h2>Abbonamenti esistenti:</h2>
        <div v-for="subscription in singleSub">
            <h3>{{ subscription.name }}</h3>
        </div>
    </div>
</template>

<style></style>