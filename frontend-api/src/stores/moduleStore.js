import { ModuleModel } from "@/services/module";
import {defineStore} from "pinia";

export const ModuleStore = defineStore ('modules', {
    state: () => ({
        modules: [],
        loading: false,
        error: '',
    }),

    getters: {

    },

    actions: {
        async getAllModules(){
            try{
                const response = await ModuleModel.getAll()
                this.modules = response.data
                console.log(this.modules)
                return this.modules
            }catch (error){
                console.error('Error:', error)
            }
        },

        async activateModule(id){
            try{
                const response = await ModuleModel.activate(id)
                console.log(response.data)
            }catch (error){
                console.error('Error:', error)
            }
        },

        async deactivateModule(id){
            try{
                const response = await ModuleModel.deactivate(id)
                console.log(response.data)
            }catch (error){
                console.error('Error:', error)
            }
        },
    },

    persist: true
})