<template>
    <app-layout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
                    <div class="flex justify-end">
                        <inertia-link :href="route('points.create',role.slug)">Crear</inertia-link>
                    </div>
                    {{points}}
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
