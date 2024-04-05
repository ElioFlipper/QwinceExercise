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
        }
    }
}
</script>

<template>
    <div class="navbarContainer">
        <p @click="handleUsersClick">Users</p>
        <p @click="handlePetClick">Pet</p>
        <p @click="handleSubscriptionClick">Subscriptions</p>
        <p @click="handleLogin">Login</p>
        <p @click="handleLogout">Logout</p>
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

.navbarContainer p {
    cursor: pointer;
}
</style>