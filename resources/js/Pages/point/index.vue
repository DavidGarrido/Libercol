<template>
    <app-layout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
            points: Array,
            role: Object
        }
    }
</script>
