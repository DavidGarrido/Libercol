<template>
    <app-layout>
        <panel :company="companie" :role="role">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3 divide-y divide-gray-400">
                <div class="flex justify-end py-2">
                    <inertia-link :href="route('points.create',role.slug)" class="p-3 rounded-lg bg-gray-400 text-white">Crear</inertia-link>
                </div>
                <div class="flex flex-col">
                    <div v-for="point in points" class="py-3 flex">
                        <p class="w-2/12">{{point.type}}</p>
                        <div class="flex-1 flex justify-end">
                            <inertia-link :href="route('points.show', [role, point])">Ver</inertia-link>
                        </div>
                    </div>
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
            points: Array,
            role: Object,
            companie: Object
        }
    }
</script>
