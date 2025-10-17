import axios from 'axios';
// Récupération des variables d'environnement
const API_URL = import.meta.env.VITE_WP_API_URL;

// Debug : vérifier si les variables sont bien chargées
console.log('API_URL:', API_URL);

export const api = axios.create({
    baseURL: API_URL,
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    }
});

api.interceptors.request.use((config) => {
    const token = localStorage.getItem("token");
    if(token){
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
});