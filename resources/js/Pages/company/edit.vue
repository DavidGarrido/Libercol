<template>
    <app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
                    <form @submit.prevent="update" class="flex flex-col items-start gap-2">
                        <p>Nombre</p>
                        <input type="text" v-model="form.name" class="p-1 rounded-lg border border-gray-200">
                        <p>Color</p>
                        <input type="color" v-model="form.color">
                        <div class="flex justify-end items-center gap-3 w-full">
                            <inertia-link :href="route('companie')" class="text-gray-400 underline text-sm">Cancelar</inertia-link>
                            <button type="submit" class="bg-gray-200 text-gray-500 p-3 rounded-lg">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        components: {
            AppLayout,
        },
        props: {
            companie: Object,
            role: Object
        },
        remember: 'form',
        data () {
            return {
                form: this.$inertia.form({
                    name: this.companie.name,
                    color: this.companie.color
                })
            }
        },
        methods: {
            update(){
                this.form.put(this.route('companies.update', [this.role.slug, this.companie.slug]))
            }
        }
    }
</script>
