<template>
    <app-layout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex justify-between items-center">
                    <h1 class="p-2 text-3xl font-bold text-gray-500">{{companie.name}}</h1>
                    <inertia-link class="px-6 py-4 flex items-center" :href="route('companies.edit', companie.slug)" tabindex="-1">
                        Editar
                    </inertia-link>
                    <button @click="destroy">Eliminar</button>
                    <!-- <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('companies.index')">Compañias</inertia-link> -->
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
        },
        methods: {
            destroy(){
                if (confirm('¿seguro desea eliminar?')) {
                    this.$inertia.delete(this.route('companies.destroy',this.companie.slug))
                }
            }
        }
    }
</script>
