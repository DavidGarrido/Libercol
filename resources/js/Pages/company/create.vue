<template>
    <app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
                    <inertia-link :href="route('companies.index')">Compañias</inertia-link>
                    <form @submit.prevent="store" class="flex flex-col">
                        <br>
                        <p>Nombre</p>
                        <input type="text" v-model="form.name" class="p-1 rounded-lg border border-gray-200">
                        <br>
                        <p>Color</p>
                        <input type="color" v-model="form.color">
                        <button class="text-white bg-gray-500 rounded-lg p-2">Crear</button>
                    </form>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    // import TextInput from '@/Shared/TextInput'

    export default {
        components: {
            AppLayout,
        },
        data() {
            return {
                form: this.$inertia.form({
                    name: null,
                    color: '#783511'
                })
            }
        },
        methods: {
            store () {
                this.form.post(this.route('companies.store'))
            }
        }
    }
</script>
