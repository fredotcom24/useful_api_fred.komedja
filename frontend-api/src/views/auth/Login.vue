<!-- eslint-disable vue/multi-word-component-names -->
<template>
    <div>
        <label>Email</label>
        <input v-model="email" type="email" placeholder="tonton@email.co"> <br>
        <label >Password</label>
        <input v-model="password" type="password" placeholder="********"> <br>
        <button @click="handleLogin" type="button">
            Login
        </button>

        <div>
            <p>I don't have account</p>
            <router-link to="/register">Register here</router-link>
        </div>
    </div>
</template>

<script setup>
import { AuthStore } from '@/stores/authStore';
import { ref } from 'vue';
import router from '@/router';

const authStore = AuthStore();
const email = ref('')
const password = ref('')

const handleLogin = async () => {

    const data = {
        email: email.value,
        password: password.value,
    }

    try {
        await authStore.login(data)
        router.push('/modules')
    } catch (error) {
        console.error('Error login', error);   
    }
}
</script>