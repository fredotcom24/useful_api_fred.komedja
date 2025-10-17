<!-- eslint-disable vue/multi-word-component-names -->
<template>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Activate</th>
                    <th>Deactivate</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="module in modules" :key="module.id">
                    <td>{{ module.name || 'N/A' }}</td>
                    <td>{{ module.description || 'N/A' }}</td>
                    <td><button @click="activateModule(module.id)">Activate</button></td>
                    <td><button @click="deactivateModule(module.id)">Deactivate</button></td>
                    <td>{{ status.value }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import {ModuleStore} from '@/stores/moduleStore';
import {ref, onMounted} from 'vue';

const moduleStore = ModuleStore();
const modules = ref([])
const status = ref([])

const loadModules = async () => {
    try {
        await moduleStore.getAllModules()
        modules.value = moduleStore.modules
    } catch(error) {
        console.error('Error login', error);
    }
}

const activateModule = async (id) => {
    await moduleStore.activateModule(id)
    // status.value = JSON.parse(response.data)
}

const deactivateModule = async (id) => {
    await moduleStore.deactivateModule(id)
}

onMounted(()=> {
    loadModules()
})
</script>