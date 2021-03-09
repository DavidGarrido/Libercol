<template>
    <app-layout>
        <panel :company="companie" :role="role">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex flex-wrap justify-between items-center p-3">
                {{inventaries}}
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
            role: Object,
            companie: Object,
            inventaries: Array
        }
    }
</script>
