import { api } from "./api";

export const AuthModel = {

    async register(payload) {
        const response = await api.post('/register', payload)
        return response
    },

    async login(payload) {
        const response = await api.post('/login', payload)
        return response
    }, 
}