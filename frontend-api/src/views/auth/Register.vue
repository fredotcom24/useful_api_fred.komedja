<!-- eslint-disable vue/multi-word-component-names -->
<template>
    <div>
        <label>Name</label>
        <input v-model="name" type="text" placeholder="Enter your name"> <br>
        <label>Email</label>
        <input v-model="email" type="email" placeholder="tonton@email.co"> <br>
        <label>Password</label>
        <input v-model="password" type="password" placeholder="********"> <br>
        <label>Confirm Password</label>
        <input v-model="rpt_password" type="password" placeholder="********"> <br>
        <button @click="handleRegister" type="button">
            Register
        </button>

        <div>
            <p>I have an account</p>
            <router-link to="/">Login here</router-link>
        </div>
    </div>
</template>

<script setup>
import { AuthStore } from '@/stores/authStore';
import { ref } from 'vue';

const authStore = AuthStore();
const name = ref('')
const email = ref('')
const password = ref('')
const rpt_password = ref('')

const handleRegister = async () => {

    const data = {
        name: name.value,
        email: email.value,
        password: password.value,
        password_confirmation: rpt_password.value
    }

    try {
        await authStore.register(data)
    } catch (error) {
        console.error('Error login', error);   
    }
}
</script>