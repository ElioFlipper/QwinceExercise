<script>
export default {
    data() {
        return {
            singleUser: {},
            subscription: []
        }
    },

    mounted() {
        const id = this.$route.params.id;
        this.getSingleUser(id);
        this.getUsersSubscription(id);
    },

    methods: {
        getSingleUser(id) {
            fetch(`http://127.0.0.1:8000/api/users/${id}`)
                .then(response => response.json())
                .then(data => {
                    this.singleUser = data
                })
        },

        handleModifyButton() {
            this.$router.push({ name: 'modify' })
        },

        handleRemoveButton() {
            const id = this.$route.params.id;
            fetch(`http://127.0.0.1:8000/api/delete/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    this.singleUser = data
                })
            this.$router.push({ name: 'home' })
        },

        handleDeactiveButton() {
            this.singleUser.activationStatus = !this.singleUser.activationStatus
        },

        handleActiveButton() {
            this.singleUser.activationStatus = !this.singleUser.activationStatus
        },

        handlePetRegisterButton() {
            this.$router.push({ name: 'petsRegister', params: { id: this.singleUser.id } })
        },
        handlePetDetailButton() {
            this.$router.push({ name: 'petsDetails', params: { id: this.singleUser.id } })
        },
        handleAddSubscriptionButton() {
            this.$router.push({ name: 'addSubToUser', params: { id: this.singleUser.id } })
        },
        getUsersSubscription() {
            const id = this.$route.params.id;
            fetch(`http://localhost:8000/api/users/${id}/subscriptions`)
                .then(response => response.json())
                .then(data => {
                    this.subscription = data
                })
        },
        handleRemoveSubscription(sub) {
            const user_id = this.$route.params.id;
            const subscription_id = sub.id;
            console.log(user_id, subscription_id);

                fetch(`http://localhost:8000/api/users/${user_id}/subscriptions/${subscription_id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        this.subscription = data
                    })
                    .then(data =>window.location.reload())
        }
        
    }
}
</script>

<template>
    <div class="userDetailContainer">
        <table class="userDetailTable">
            <tr>
                <th>Username:</th>
                <td>{{ singleUser.username }}</td>
            </tr>
            <tr>
                <th>Name:</th>
                <td>{{ singleUser.name }}</td>
            </tr>
            <tr>
                <th>Surname:</th>
                <td>{{ singleUser.surname }}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>{{ singleUser.email }}</td>
            </tr>
            <tr>
                <th>City:</th>
                <td>{{ singleUser.city }}</td>
            </tr>
            <tr>
                <th>Date of submission:</th>
                <td>{{ singleUser.date_of_submission }}</td>
            </tr>
            <tr>
                <th>Activation Status:</th>
                <td>{{ singleUser.activationStatus }}</td>
            </tr>
        </table>
        <div v-for="sub in subscription" class="subContainer">
            <table class="userDetailTable">
                <tr>
                    <th>Nome dell'abbonamento:</th>
                    <td>{{ sub.name }}</td>
                </tr>
                <tr>
                    <th>Slug dell'abbonamento:</th>
                    <td>{{ sub.slug }}</td>
                </tr>
                <tr>
                    <th>Durata dell'abbonamento (mesi):</th>
                    <td>{{ sub.duration }}</td>
                </tr>
                <tr>
                    <th>Data di inizio:</th>
                    <td>{{ sub.startingDate }}</td>
                </tr>
                <tr>
                    <th>Data fine:</th>
                    <td>{{ sub.endingDate }}</td>
                </tr>
                <tr>
                    <th>Action:</th>
                    <td>
                        <button class="removeButton" @click="handleRemoveSubscription(sub)">Remove</button>
                    </td>
                </tr>
            </table>
        </div>

        <div class="buttonsContainer">
            <button class="modifyButton" @click="handleModifyButton">Modify</button>
            <button class="modifyButton" @click="handleRemoveButton">Remove</button>
            <button class="modifyButton" v-if="singleUser.activationStatus"
                @click="handleDeactiveButton">Deactive</button>
            <button class="modifyButton" v-else @click="handleActiveButton">Active</button>
            <button class="modifyButton" @click="handlePetRegisterButton">Add a pet</button>
            <button class="modifyButton" @click="handlePetDetailButton">Show pets</button>
            <button class="modifyButton" @click="handleAddSubscriptionButton">Add a subscription</button>
        </div>
    </div>
</template>


<style>
.userDetailContainer {
    background-color: whitesmoke;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100vw;
}

.userDetailContainer p:nth-child(even) {
    background-color: rgba(134, 184, 134, 0.273);
    margin: 0;
    padding: 1rem;
    text-align: center;
    width: 100%;
}

.userDetailContainer p:nth-of-type(odd) {
    background-color: whitesmoke;
    margin: 0;
    padding: 1rem;
    text-align: center;
    width: 100%;
}

.modifyButton {
    border-radius: 3px;
    background-color: rgba(134, 184, 134, 0.273);
    margin: 0 auto;
    padding: .5rem;
    border: none;
}

.modifyButton:hover {
    transform: scale(110%);
    transition: .5s;
}

.buttonsContainer {
    display: flex;
    width: 40%;
}

.userDetailTable {
    width: 100%;
}

.userDetailTable:nth-child(odd) {
    background-color: rgba(134, 184, 134, 0.273);
}

.userDetailTable th,
.userDetailTable td {
    padding: 8px;
    text-align: center;
}

.userDetailTable th {
    background-color: #f2f2f2;
}

.userDetailTable tbody tr:nth-child(odd) {
    background-color: rgba(134, 184, 134, 0.273);
}

.subContainer {
    margin-top: 2rem;
    margin-bottom: 2rem
}
</style>