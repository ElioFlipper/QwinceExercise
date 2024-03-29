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
    methods: {
        getSubscription() {
            fetch("http://127.0.0.1:8000/api/subscriptions")
                .then((response) => response.json())
                .then((data) => {
                    this.allSubs = data;
                })
                .catch((error) =>
                    console.error("Error fetching subscriptions:", error))
        },

        getUsersSubscription() {
            const id = this.$route.params.id;
            fetch(`http://localhost:8000/api/users/${id}/subscriptions`)
                .then(response => response.json())
                .then(data => {
                    this.singleSub = data
                })
        },

        handleAddSubscriptionButton() {
            const subData = {
                name: this.subscriptionSelect.name,
            };

            const userId = this.$route.params.id;
            const subscriptionId = this.subscriptionSelect.id
            console.log(subscriptionId);

            fetch(`http://localhost:8000/api/users/${userId}/subscriptions/${subscriptionId}`, {
                'method': 'POST',
                headers: { 'content-type': 'application/json' },
                body: JSON.stringify(subData)
            })
                .then(response => {
                    if (response.ok) {
                        this.getUsersSubscription();
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
            <option v-for="(sub, index) in allSubs" :key="index" :value="sub.id">{{ sub.name }}
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