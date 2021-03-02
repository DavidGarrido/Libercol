<template>
    <app-layout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <inertia-link class="px-6 py-4 flex items-center" :href="route('companies.edit', companie.id)" tabindex="-1">
                        Editar
                    </inertia-link>
                    <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('companies.index')">Compañias</inertia-link>
                    <h1 class="p-2 text-3xl font-bold text-gray-500">{{companie.name}}</h1>
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
        }
    }
</script>
