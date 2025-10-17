import { api } from "./api";

export const ModuleModel = {

    async getAll() {
        const response = await api.get('/modules')
        return response
    },
}