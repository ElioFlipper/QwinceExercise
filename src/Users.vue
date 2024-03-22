<template>
    <div class="container">
        <div class="filterSection">
            <span>Search by username</span>
            <input type="text" @input="handleSearch($event, 'username')" v-model="searchUsername">

            <span>Search by name or surname</span>
            <input type="text" @input="handleSearch($event, 'nameOrSurname')" v-model="searchNameOrSurname">

            <span>Search by email</span>
            <input type="text" @input="handleSearch($event, 'email')" v-model="searchByEmail">

            <span>Search by city</span>
            <input type="text" @input="handleSearch($event, 'city')" v-model="searchByCity">

            <select v-model="activationStatus">
                <option value="">Tutti</option>
                <option value="active">Attivi</option>
                <option value="inactive">Disattivati</option>
            </select>

        </div>
        <ul v-for="user in filteredUsers" :key="user.id">
            <li>
                <p>{{ user.username }}</p>
                <p>{{ user.email }}</p>
                <p>{{ user.city }}</p>
                <button @click="openProfile(user.id)">Profile</button>
            </li>
        </ul>
        <button @click="handleRegisterButton">Register a new user</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            users: [],
            searchUsername: '',
            searchNameOrSurname: '',
            searchByEmail: '',
            searchByCity: '',
            activationStatus: ''
        };
    },

    computed: {
        filteredUsers() {
            return this.users.filter(user =>
                user.username.toLowerCase().includes(this.searchUsername.toLowerCase()) &&
                (user.name.toLowerCase().includes(this.searchNameOrSurname.toLowerCase()) ||
                    user.surname.toLowerCase().includes(this.searchNameOrSurname.toLowerCase())) &&
                user.email.toLowerCase().includes(this.searchByEmail.toLowerCase()) &&
                user.city.toLowerCase().includes(this.searchByCity.toLowerCase())
            );
        }
    },

    beforeRouteEnter(to, from, next) {
        fetch("http://127.0.0.1:8000/api/users")
            .then((response) => response.json())
            .then((data) => {
                next(vm => {
                    vm.users = data;
                });
            })
            .catch((error) => {
                console.error("Error fetching users:", error);
                next();
            })
    },

    mounted() {
        this.getUsers();
    },
    methods: {
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

        openProfile(id) {
            this.$router.push({ name: 'userDetail', params: { id: id } });
        },

        handleRegisterButton() {
            this.$router.push({ name: 'register' }).then(() => {
                this.getUsers();
            })
        },

        handleSearch(e, field) {
            const value = e.target.value.toLowerCase();
            if (field === 'username') {
                this.searchUsername = value;
            }
            else if (field === 'name') {
                this.searchNameOrSurname = value;
            }
            else if (field === 'email') {
                this.searchByEmail = value;
            }
            else if (field === 'city') {
                this.searchByCity = value;
            }
        }
    },
}
</script>

<style scoped>
.container li {
    max-width: 960px;
    display: flex;
    align-items: center;
    justify-content: space-around;
    margin: 0 auto;
}

.container ul:nth-of-type(even) {
    background-color: lightgray;
}

.container ul:nth-of-type(odd) {
    background-color: whitesmoke;
}

.filterSection {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.filterSection input {
    display: flex;
    flex-direction: column;
    margin: 0 auto;
}

.filterSection span {
    display: flex;
    flex-direction: column;
    margin: 0 auto;
}
</style>