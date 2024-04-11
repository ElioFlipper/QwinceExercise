<script>
import { client } from './setup';
import config from './config';
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

            client.post(`${config.backendUrl}/createSubscription`, subscriptionData)
                .then(response => {
                    console.log(response.data);
                })
                .catch(error => {
                    console.error(error);
                });

            this.$router.push({ name: 'subscription' })
        }
    }
}
</script>

<template>
    <div class="custom-container">
        <div class="d-flex justify-content-center">
            <form @submit.prevent="saveSubscription" class="col-md-4">
                <label for="">Name</label>
                <input type="text" name="name" v-model="subscription.name" class="form-control custom-input">
                <label for="">Slug</label>
                <input type="text" name="slug" v-model="subscription.slug" class="form-control custom-input">
                <label for="">Duration</label>
                <input type="number" name="duration" v-model="subscription.duration" class="form-control custom-input">
                <label for="">Starting date</label>
                <input type="date" name="startingDate" v-model="subscription.startingDate" class="form-control custom-input">
                <label for="">End date</label>
                <input type="date" name="endingDate" v-model="subscription.endingDate" class="form-control custom-input">
                <button type="submit" class="btn custom-button mt-2">Save</button>
            </form>
        </div>
    </div>
</template>


<style>

</style>