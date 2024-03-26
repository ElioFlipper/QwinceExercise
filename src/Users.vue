<template>
    <div class="container">
        <div class="filterSection">
            <span>Search by username</span>
            <input type="text" placeholder="Username" v-model="username">

            <span>Search by name or surname</span>
            <input type="text" placeholder="Name or Surname" v-model="name">

            <span>Search by email</span>
            <input type="text" placeholder="email" v-model="email">

            <span>Search by city</span>
            <input type="text" placeholder="City" v-model="city">

            <select v-model="activationStatus">
                <option :value="true">Active</option>
                <option :value="false">Deactive</option>
            </select>

            <button class="searchButton" @click="handleSearchButton">Search</button>

        </div>
        <ul v-for="user in users" :key="user.id">
            <li>
                <p>{{ user.username }}</p>
                <p>{{ user.email }}</p>
                <p>{{ user.city }}</p>
                <button @click="openProfile(user.id)">Profile</button>
            </li>
        </ul>
        <button class="registerButton" @click="handleRegisterButton">Register a new user</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            users: [],
            username: '',
            name: '',
            surname: '',
            email: '',
            city: '',
            activationStatus: null
        };
    },

    // computed: {
    //     filteredUsers() {
    //         return this.users.filter(user =>
    //             user.username.toLowerCase().includes(this.searchUsername.toLowerCase()) &&
    //             (user.name.toLowerCase().includes(this.searchNameOrSurname.toLowerCase()) ||
    //                 user.surname.toLowerCase().includes(this.searchNameOrSurname.toLowerCase())) &&
    //             user.email.toLowerCase().includes(this.searchByEmail.toLowerCase()) &&
    //             user.city.toLowerCase().includes(this.searchByCity.toLowerCase()) &&
    //             this.activationStatus === null || this.activationStatus === user.activationStatus 
    //         );
    //     }
    // },

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

        // handleSearchInput(e, field) {
        //     const value = e.target.value.toLowerCase();
        //     if (field === 'username') {
        //         this.searchUsername = value;
        //     }
        //     else if (field === 'name') {
        //         this.searchNameOrSurname = value;
        //     }
        //     else if (field === 'email') {
        //         this.searchByEmail = value;
        //     }
        //     else if (field === 'city') {
        //         this.searchByCity = value;
        //     }
        // }

        // handleSearchButton() {
        //     const data = {
        //         username: this.username,
        //         name: this.name,
        //         email: this.email,
        //         city: this.city,
        //         activationStatus: this.activationStatus
        //     };

        //     fetch("http://127.0.0.1:8000/api/filter?" + new URLSearchParams(data))
        //         .then((response) => {
        //             if (!response.ok) {
        //                 throw new Error('Network response was not ok');
        //             }
        //             return response.json();
        //         })
        //         .then((data) => {
        //             this.users = data;
        //         })
        //         .catch((error) => {
        //             console.error("Error fetching users:", error);
        //         });
        //     console.log(this.activationStatus)
        // }

        handleSearchButton() {
            const data = {
                username: this.username,
                name: this.name,
                email: this.email,
                city: this.city,
                activationStatus: this.activationStatus,
            };

            for (const key in data) {
                if (data[key] === '' || data[key] === null) {
                    delete data[key];
                }
            }

            const queryString = new URLSearchParams(data)

            fetch("http://127.0.0.1:8000/api/filter?" + queryString)
                .then((response) => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then((data) => {
                    this.users = data;
                })
                .catch((error) => {
                    console.error("Error fetching users:", error);
                });
        }
    },
}
</script>

<style scoped>
* {
    box-sizing: border-box;
}

.container {
    background-color: whitesmoke;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    display: flex;
    flex-direction: column;
}

.container li {
    max-width: 960px;
    display: flex;
    align-items: center;
    justify-content: space-around;
    margin: 0 auto;
    /* gap: 10rem; */
}

.container ul:nth-of-type(even) {
    background-color: rgba(134, 184, 134, 0.273);
}

.container ul:nth-of-type(odd) {
    background-color: whitesmoke;
}

.filterSection {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background-color: rgba(134, 184, 134, 0.273);
    padding: 1rem;
    gap: .5rem;
}

.filterSection input,
select {
    display: flex;
    margin: 0 auto;
    border: none;
    border-radius: 3px;
    padding: .5rem;
}

.filterSection span {
    display: flex;
    flex-direction: column;
    margin: 0 auto;
}

.container ul {
    margin: 0 0;
}

.registerButton {
    border-radius: 3px;
    padding: .5rem;
    background-color: rgba(134, 184, 134, 0.273);
    margin: 0 auto;
    margin-top: 1rem;
    border: none;
}

.searchButton {
    border-radius: 3px;
    padding: .5rem;
    background-color: rgba(134, 184, 134, 0.273);
    margin: 0 auto;
    margin-top: 1rem;
    border: none;
}

.searchButton:hover {
    transform: scale(110%);
    transition: .5s;
}

.registerButton:hover {
    transform: scale(110%);
    transition: .5s;
}
</style>