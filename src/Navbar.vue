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
        handleProfileClick() {
            const id = localStorage.getItem("userId");
            this.$router.push({ name: 'userDetail', params: { id: id } });
        }
    }
}

</script>
<template>
       <ul class="nav justify-content-center" style="padding-top: 2rem; align-items: center; background-color: #75c581; padding-bottom: 1rem;">
        <li class="nav-item">
            <p class="nav-item" style="cursor:pointer" @click="handleProfileClick"><i class="bi bi-person-fill"></i></p>
        </li>
        <li class="nav-item">
            <p class="nav-item" style="cursor:pointer" @click="handleUsersClick">Utenti</p>
        </li>
        <li class="nav-item">
            <p class="nav-item" style="cursor:pointer" @click="handlePetClick">Animali</p>
        </li>
        <li class="nav-item">
            <p class="nav-item" style="cursor:pointer" @click="handleSubscriptionClick">Sottoscrizioni</p>
        </li>
        <li class="nav-item">
            <p class="nav-item" style="cursor:pointer" @click="handleLogin">Login</p>
        </li>
        <li class="nav-item">
            <p class="nav-item" style="cursor:pointer" @click="handleLogout">Logout</p>
        </li>
    </ul>
</template>

<style>
.nav-item {
    margin-right: 10px;
    font-weight: bold;
}
</style>