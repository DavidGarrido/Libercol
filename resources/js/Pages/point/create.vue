<template>
    <app-layout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3 flex flex-col gap-3 items-start">
                    <!-- {{companie}}
                    <p>{{role}}</p>
                    <p>{{points}}</p> -->
                    <form @submit.prevent="store" class="flex flex-col gap-3 items-start w-full">
                        <p>Tipo:</p>
                        <select v-model="form.type">
                            <option value="principal">Principal</option>
                            <option value="bodega">Bodega</option>
                            <option value="almacen">Almacen</option>
                            <option value="oficina">Oficina</option>
                        </select>
                        <p>Comentario <span class="text-gray-500 text-sm italic">* opcional</span></p>
                        <textarea v-model="form.comment" cols="30" rows="10"></textarea>
                        <div class="w-full flex justify-end">
                            <button type="submit" class="bg-gray-500 text-white rounded-lg p-3">Crear</button>
                        </div>
                        <input type="hidden" v-model="form.slug">
                    </form>
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
            role: Object,
            points: Array
        },
        data() {
            return {
                form: this.$inertia.form({
                    type: 'oficina',
                    comment: 'null',
                    slug: 'hola'
                })
            }
        },
        methods: {
            store () {
                this.form.post(this.route('points.store', this.role.slug))
            }
        }
    }
</script>
