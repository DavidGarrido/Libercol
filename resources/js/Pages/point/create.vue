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
                        <div class="flex justify-between w-1/2 gap-3">
                            <p class="w-2/12">Teléfono:</p>
                            <input type="number" v-model="form.tel" class="flex-1">
                        </div>
                        <div class="flex justify-between w-1/2 gap-3">
                            <p class="w-2/12">Celular 1:</p>
                            <input type="number" v-model="form.cel_one" class="flex-1">
                        </div>
                        <div class="flex justify-between w-1/2 gap-3">
                            <p class="w-2/12">Celular 2:</p>
                            <input type="number" v-model="form.cel_two" class="flex-1">
                        </div>
                        <div class="flex justify-between w-1/2 gap-3">
                            <p class="w-2/12">Whatsapp:</p>
                            <input type="number" v-model="form.whatsapp" class="flex-1">
                        </div>
                        <div class="flex justify-between w-1/2 gap-3">
                            <p class="w-2/12">Telegram:</p>
                            <input type="number" v-model="form.telegram" class="flex-1">
                        </div>
                        <div class="flex justify-between w-1/2 gap-3">
                            <p class="w-2/12">Facebook:</p>
                            <input type="text" v-model="form.facebook" class="flex-1">
                        </div>
                        <div class="flex justify-between w-1/2 gap-3">
                            <p class="w-2/12">Instagram:</p>
                            <input type="text" v-model="form.instagram" class="flex-1">
                        </div>
                        <div class="flex justify-between w-1/2 gap-3">
                            <p class="w-2/12">Twitter:</p>
                            <input type="text" v-model="form.twitter" class="flex-1">
                        </div>
                        <div class="flex justify-between w-1/2 gap-3">
                            <p class="w-2/12">Linked-In:</p>
                            <input type="text" v-model="form.linkedin" class="flex-1">
                        </div>
                        <div class="flex justify-between w-1/2 gap-3">
                            <p class="w-2/12">E-mail:</p>
                            <input type="text" v-model="form.email" class="flex-1">
                        </div>
                        <div class="flex justify-between w-1/2 gap-3">
                            <p class="w-2/12">Web:</p>
                            <input type="text" v-model="form.web" class="flex-1">
                        </div>
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
                    comment: null,
                    tel: null,
                    cel_one: null,
                    cel_two: null,
                    whatsapp: null,
                    telegram: null,
                    facebook: null,
                    instagram: null,
                    twitter: null,
                    linkedin: null,
                    email: null,
                    web: null
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
