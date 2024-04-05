<script>
export default {
    methods: {
        handleUsersClick() {
            this.$router.push({ name: 'users' })
        },
        handlePetClick() {
            this.$router.push({ name: 'pets' })
        },
        handleSubscriptionClick() {
            this.$router.push({ name: 'subscription' })
        },
        handleLogin() {
            this.$router.push({ name: 'login' })
        },
        handleLogout() {
            localStorage.removeItem("token");
            window.location.reload();
        },
        checkAdminStatus() {
            const accessToken = localStorage.getItem("token");
            if (accessToken) {
                const data = JSON.parse(accessToken);
                console.log(data)
                this.isAdmin = data.is_admin;
            }
        },
        handleProfile() {
            const accessToken = localStorage.getItem("token");
            const id = this.$route.params.id;
            fetch(`http://127.0.0.1:8000/api/users/${id}`, {
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + accessToken
                }
            })
                .then(response => response.json())
                .then(data => {
                    this.singleUser = data
                })
            this.$router.push({ name: "userDetail", params: ({ id: id }) })
        }
    },

    mounted() {
        this.checkAdminStatus();
    },

    data() {
        return {
            isAdmin:''
        }
    }
}
</script>

<template>
    <div class="navbarContainer">
        <div v-if="isAdmin">
            <p @click="handleUsersClick">Users</p>
            <p @click="handlePetClick">Pet</p>
            <p @click="handleSubscriptionClick">Subscriptions</p>
            <p @click="handleLogin">Login</p>
            <p @click="handleLogout">Logout</p>
        </div>
        <div v-else class="elseContainer">
            <p @click="handleLogin">Login</p>
            <p @click="handleLogout">Logout</p>
            <p @click="handleProfile">Profile</p>
        </div>
    </div>
</template>

<style>
.navbarContainer {
    display: flex;
    background-color: whitesmoke;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: large;
    font-weight: bold;
    justify-content: center;
    gap: 4rem;
    padding: .5rem;
}

.elseContainer {
    display: flex;
    background-color: whitesmoke;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: large;
    font-weight: bold;
    justify-content: center;
    gap: 4rem;
    padding: .5rem;
}

.navbarContainer p {
    cursor: pointer;
}
</style>