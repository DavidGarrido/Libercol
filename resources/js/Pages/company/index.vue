<template>
    <app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3 divide-y divide-gray-300">
                    <div class="p-2 flex items-center justify-end">
                        <inertia-link :href="route('companies.create')" class="p-2 bg-gray-400 rounded-lg text-white">Crear</inertia-link>
                    </div>
                    <div class="p-2 flex gap-3 font-bold">
                        <p class="w-2/12">Cargo</p>
                        <p class="w-2/12">Empresa</p>
                    </div>
                    <div v-for="role in roles" class="p-2 flex gap-3">
                        <p class="w-2/12">{{role.name}}</p>
                        <p class="w-2/12">{{role.companies[0].name}}</p>
                        <div class="flex-1 flex justify-end">
                            <inertia-link :href="route('companies.show', [role.slug, role.companies[0].slug])">Ver</inertia-link>
                        </div>
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
            roles: Array
        },
        components: {
            AppLayout,
        }
    }
</script>
