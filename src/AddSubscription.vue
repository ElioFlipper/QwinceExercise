<script>
export default {
    data() {
        return {
            subscription: {
                name: '',
                slug: '',
                duration: '',
                startingDate: '',
                endingDate: '',
            }
        }
    },

    methods: {
        saveSubscription(event) {
            event.preventDefault()

            const subscriptionData = {
                name: this.subscription.name,
                slug: this.subscription.slug,
                duration: this.subscription.duration,
                startingDate: this.subscription.startingDate,
                endingDate: this.subscription.endingDate,
            };

            fetch("http://127.0.0.1:8000/api/createSubscription", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(subscriptionData)
            })

            this.$router.push({ name: 'subscription' })
        }
    }
}
</script>

<template>
    <div class="newSubscriptionContainer">
        <form @submit.prevent="saveSubscription">
            <label for="">Name</label>
            <input type="text" name="name" v-model="subscription.name">
            <label for="">Slug</label>
            <input type="text" name="slug" v-model="subscription.slug">
            <label for="">Duration</label>
            <input type="number" name="duration" v-model="subscription.duration">
            <label for="">Starting date</label>
            <input type="date" name="startingDate" v-model="subscription.startingDate">
            <label for="">End date</label>
            <input type="date" name="endingDate" v-model="subscription.endingDate">
            <button type="submit" class="saveButton">Save</button>
        </form>
    </div>
</template>

<style>
.newSubscriptionContainer {
    display: flex;
    flex-direction: column;
    /* align-items: center; */
    /* justify-content: center; */
    background-color: rgba(134, 184, 134, 0.273);
    padding: 1rem;
    gap: .5rem;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.newSubscriptionContainer input,
select {
    display: flex;
    margin: 0;
    border: none;
    border-radius: 3px;
    padding: .5rem;
}

.saveButton {
    border-radius: 3px;
    padding: .5rem;
    background-color: rgba(134, 184, 134, 0.273);
    margin: 0 auto;
    margin-top: 1rem;
    border: none;
}

.saveButton:hover {
    transform: scale(110%);
    transition: .5s;
}
</style>