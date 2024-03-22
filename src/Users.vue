<template>
    <div class="container">
        <ul v-for="user in users" :key="user.id">
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
        };
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
</style>