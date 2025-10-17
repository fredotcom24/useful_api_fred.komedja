import { api } from "./api";

export const ModuleModel = {

    async getAll() {
        const response = await api.get('/modules')
        return response
    },

    async activate(id) {
        const response = await api.post(`/modules/${id}/activate`)
        return response
    },

    async deactivate(id) {
        const response = await api.post(`/modules/${id}/deactivate`)
        return response
    },
}