<script>
export default {
    data() {
        return {
            singleSubscription: {}
        }
    },

    mounted() {
        const id = this.$route.params.id;
        this.getSingleSubscription(id)
    },

    methods: {
        getSingleSubscription(id) {
            fetch(`http://127.0.0.1:8000/api/subscriptions/${id}`)
                .then(response => response.json())
                .then(data => {
                    this.singleSubscription = data
                })
        },

        handleSaveButton() {
            const id = this.$route.params.id;
            fetch(`http://127.0.0.1:8000/api/modifySubscription/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(this.singleSubscription)
            })
                .then(response => response.json())
                .then(data => {
                    this.singleUser = data,
                        console.log(data)
                })

            this.$router.push({ name: 'subscription' })
        },

       
    }
}
</script>

<template>
    <div class="modifyUserContainer">
        <label>Name: </label>
        <input type="text" v-model="singleSubscription.name">
        <label>Slug: </label>
        <input type="text" v-model="singleSubscription.slug">
        <label>Duration: </label>
        <input type="number" v-model="singleSubscription.duration">
        <label>StartingDate: </label>
        <input type="date" v-model="singleSubscription.startingDate">
        <label>EndingDate: </label>
        <input type="date" v-model="singleSubscription.endingDate">

        <button @click="handleSaveButton" class="saveButton">Save</button>

    </div>

</template>
<style>
.modifyUserContainer input {
    display: flex;
    flex-direction: column;
}
.modifyUserContainer {
    background-color: rgba(134, 184, 134, 0.273);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100vw;
}
</style>