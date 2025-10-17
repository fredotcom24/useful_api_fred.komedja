import { AuthModel } from "@/services/auth";
import {defineStore} from "pinia";

export const AuthStore = defineStore ('auth', {
    state: () => ({
        user: null,
        token: localStorage.getItem('token') || null,
        isLoggedIn: false,
        loading: false,
        error: '',
    }),

    getters: {
        isAuthenticated: (state) => {
            return state.isLoggedIn && state.token !== null
        }
    },

    actions: {
        async register(payload){
            try{
                const response = await AuthModel.register(payload)
                this.user = response.data
                this.token = response.data.token
                console.log(this.user)

                this.isLoggedIn = true;
                localStorage.setItem('token', this.token)
            }catch (error){
                console.error('Error:', error)
            }
        },

        async login(payload){
            try{
                const response = await AuthModel.login(payload)
                this.user = response.data.user_id
                this.token = response.data.token
                console.log(this.user)

                this.isLoggedIn = true;
                localStorage.setItem('token', this.token)
            }catch (error){
                console.error('Error:', error)
            }
        },
    }
})