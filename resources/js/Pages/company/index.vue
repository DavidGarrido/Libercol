<template>
    <app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
                    <inertia-link :href="route('companies.create')">Crear</inertia-link>
                    <div v-for="companie in companies" class="flex p-1 hover:bg-gray-200">
                        <p class="flex-1 p-1">{{companie.name}}</p>
                        <inertia-link :href="route('companies.edit',companie.id)" class="hover:underline flex w-1/12 justify-center items-center">Editar</inertia-link>
                        <inertia-link :href="route('companies.show',companie.id)" class="hover:underline flex w-1/12 justify-center items-center">Ver</inertia-link>
                    </div>                    
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        props: {
            companies: Array
        },
        components: {
            AppLayout,
        },
    }
</script>
