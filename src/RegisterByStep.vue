<script>
export default {
    data() {
        return {
            currentStep: 1,
            user: {
                username: '',
                name: '',
                surname: '',
                email: '',
                city: '',
                activationStatus: false,
                password: '',
                is_admin: false,
                avatar: '',
            }
        };
    },
    methods: {
        nextStep() {
            this.currentStep++;
        },
        prevStep() {
            this.currentStep--;
        },
        handleFileChange(event) {
            this.userData.avatar = event.target.files[0];
        },
        submitForm() {
            const userData = {
                username: this.user.username,
                name: this.user.name,
                surname: this.user.surname,
                email: this.user.email,
                city: this.user.city,
                activationStatus: this.user.activationStatus,
                is_admin: this.user.is_admin,
                password: this.user.password,
                avatar: this.user.avatar
            };
            client.post(`${config.backendUrl}/register`, userData)
                .then(response => {
                    this.$router.push({ name: 'users' });
                })
                .catch(error => {
                    console.error('There was a problem with your fetch operation:', error);
                });

            console.log('Dati inviati al server:', this.userData);
        }
    }
};
</script>
<template>
    <div>
        <div v-if="currentStep === 1">
            <h2>Step 1: Inserisci nome e cognome</h2>
            <form @submit.prevent="nextStep">
                <input type="text" v-model="user.username" placeholder="Username">
                <input type="text" v-model="user.name" placeholder="Name">
                <input type="text" v-model="user.surname" placeholder="Surname">
                <button type="submit">Avanti</button>
            </form>
        </div>

        <div v-if="currentStep === 2">
            <h2>Step 2: Inserisci email</h2>
            <form @submit.prevent="nextStep">
                <input type="email" v-model="user.email" placeholder="Email">
                <input type="password" v-model="user.password" placeholder="Password">
                <input type="text" v-model="user.city" placeholder="City">
                <button @click.prevent="prevStep">Indietro</button> 
                <button type="submit">Avanti</button>
            </form>
        </div>

        <div v-if="currentStep === 3">
            <h2>Step 3: Carica un'immagine</h2>
            <form @submit.prevent="submitForm">
                <input type="file" @change="handleFileChange">
                <button type="submit">Registrati</button>
                <button @click.prevent="prevStep">Indietro</button> 
            </form>
        </div>
    </div>
</template>