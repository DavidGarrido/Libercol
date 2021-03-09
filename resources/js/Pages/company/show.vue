<template>
    <app-layout>
        <panel :company="companie" :role="role">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex flex-wrap justify-between items-center p-3">
                <h1 class="p-2 text-3xl font-bold text-gray-500">{{companie.name}}</h1>
                <div class="flex-1 flex justify-end">
                    <inertia-link class="px-6 py-4 flex items-center" :href="route('companies.edit', [role.slug, companie.slug])" tabindex="-1">
                        Editar
                    </inertia-link>
                    <button @click="destroy">Eliminar</button>
                </div>
            </div>
        </panel>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Panel from '@/Layouts/panel'

    export default {
        components: {
            AppLayout,
            Panel
        },
        props: {
            companie: Object,
            role: Object
        },
        methods: {
            destroy(){
                if (confirm('¿seguro desea eliminar?')) {
                    this.$inertia.delete(this.route('companies.destroy',[this.role.slug, this.companie.slug]))
                }
            }
        }
    }
</script>
