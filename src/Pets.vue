<script>
export default {
    data() {
        return {
            pets: [],
            users: []
        }
    },

    methods: {
        getPets() {
            fetch("http://127.0.0.1:8000/api/pets")
                .then(response => response.json())
                .then((data) => this.pets = data)
                .catch((error) => console.log(error))
        },

        getUsers() {
            fetch("http://127.0.0.1:8000/api/users")
                .then((response) => response.json())
                .then((data) => {
                    this.users = data;
                })
                .catch((error) => {
                    console.error("Error fetching users:", error);
                });
        },

        getOwnersName(userId) {
            const user = this.users.find(user => user.id === userId);
            if (user) {
                return `${user.name} ${user.surname}`
            } else {
                return "owner not found"
            }
        },

        handleOwnerButton(userId) {
            this.$router.push({ name: 'userDetail', params: { id: userId } })
            console.log(userId)
        }
    },
    mounted() {
        this.getPets();
        this.getUsers();
    }
}
</script>

<template>
    <div class="petsContainer">
        <table class="petsTable">
            <thead>
                <tr>
                    <th>Pet name</th>
                    <th>Pet species</th>
                    <th>Pet owner</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="pet in pets" :key="pet.id">
                    <td>{{ pet.name }}</td>
                    <td>{{ pet.species }}</td>
                    <td>{{ getOwnersName(pet.user_id) }}</td>
                    <td><button class="ownerButton" @click="handleOwnerButton(pet.user_id)">Owner Profile</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<style>
.petsContainer {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.petsTable {
    width: 100%;
}

.petsTable:nth-child(odd) {
    background-color: rgba(134, 184, 134, 0.273);
}

.petsTable th,
.petsTable td {
    padding: 1rem;
    text-align: center;

}

.petsTable th {
    background-color: #f2f2f2;
}

.petsTable tbody tr:nth-child(odd) {
    background-color: rgba(134, 184, 134, 0.273);
}

.ownerButton {
    border-radius: 3px;
    background-color:whitesmoke;
    margin: 0 auto;
    padding: .5rem;
    border: none;
}

.ownerButton:hover {
    transform: scale(110%);
    transition: .5s;
}
</style>