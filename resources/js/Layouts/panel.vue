<template>
    <main>
        <div class="p-3 flex gap-3 rounded-lg">
            <nav class="bg-white rounded-lg w-64 h-full p-5 shadow-lg flex flex-col">
                <h1 class="text-3xl text-gray-500 pb-5">{{company.name}}</h1>
                <inertia-link :class="isUrl('company') ? 'text-blue-500' : 'text-gray-400 group-hover:text-white'" class="py-2 font-bold" :href="route('companies.show',[role,company])">Inicio</inertia-link>
                <inertia-link :class="isUrl('inventary') ? 'text-blue-500' : 'text-gray-400 group-hover:text-white'" class="py-2 font-bold" :href="route('inventaries.index',role)">Inventario</inertia-link>
                <inertia-link :class="isUrl('point') ? 'text-blue-500' : 'text-gray-400 group-hover:text-white'" class="py-2 font-bold" :href="route('points.index',role)">Puntos</inertia-link>
            </nav>
            <div class="flex-1">
                <slot />
            </div>
        </div>
    </main>    
</template>
<script>
export default {
    props : {
        company: {
            type: Object
        },
        role: {
            type: Object
        }
    },
    methods : {
        isUrl(...urls){
            let currentUrl = this.$page.url.substr(1)
            const cadena = currentUrl.split('/')
            if (urls[0] === '') {
                return currentUrl === ''
            }
            return urls.filter(url => cadena[1].startsWith(url)).length
        }
    }
}
</script>
<style scoped>

</style>