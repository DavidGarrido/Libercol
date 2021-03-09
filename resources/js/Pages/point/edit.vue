<template>
    <app-layout>
        <panel :company="companie" :role="role">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3 flex flex-col gap-3 items-start">
                <form @submit.prevent="update" class="flex flex-col gap-3 items-start w-full">
                    <p>Tipo:</p>
                    <select v-model="form.type">
                        <option value="principal">Principal</option>
                        <option value="bodega" v-if="points.length > 1">Bodega</option>
                        <option value="almacen" v-if="points.length > 1">Almacen</option>
                        <option value="oficina" v-if="points.length > 1">Oficina</option>
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
                    <div class="flex justify-between w-1/2 gap-3">
                        <p class="w-2/12">* Dirección:</p>
                        <input type="text" v-model="form.address" class="flex-1">
                    </div>
                    <select v-model="form.departament" @change="mun">
                        <option v-for="dep in departaments" :value="dep.id">{{dep.name}}</option>
                    </select>
                    <select v-model="form.mun">
                        <option v-for="municipality in municipalities" :value="municipality.id">{{municipality.name}}</option>
                    </select>
                    <p>Comentario <span class="text-gray-500 text-sm italic">* opcional</span></p>
                    <textarea v-model="form.comment" cols="30" rows="10"></textarea>
                    <div class="w-full flex justify-end">
                        <button type="submit" class="bg-gray-500 text-white rounded-lg p-3">Guardar</button>
                    </div>
                </form>
                <button @click.prevent="cancel">Cancelar</button>
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
            role: Object,
            point: Object,
            departaments: Array,
            contact: Object,
            municipal: Object,
            companie: Object,
            points: Array
        },
        data() {
            return {
                form: this.$inertia.form({
                    type: this.point.type,
                    comment: this.point.comment,
                    tel: this.contact.tel,
                    cel_one: this.contact.cel_one,
                    cel_two: this.contact.cel_two,
                    whatsapp: this.contact.whatsapp,
                    telegram: this.contact.telegram,
                    facebook: this.contact.facebook,
                    instagram: this.contact.instagram,
                    twitter: this.contact.twitter,
                    linkedin: this.contact.linkedin,
                    email: this.contact.email,
                    web: this.contact.web,
                    departament: this.municipal.departament.id,
                    mun: this.municipal.id,
                    address: this.contact.address.description_id
                }),
                municipalities: Array
            }
        },
        mounted (){
            this.mun()
        },
        methods: {
            update () {
                this.form.put(this.route('points.update', [this.role, this.point]))
            },
            mun () {
                axios.get(this.route('api.mun', this.form.departament))
                     .then(
                         response => {
                             this.municipalities = response.data
                         }
                     )
                     .catch(err => console.error(err)) 
            },
            cancel() {
                if (
                        this.form.email != this.contact.email ||
                        this.form.type != this.point.type ||
                        this.form.comment != this.point.comment ||
                        this.form.tel != this.contact.tel ||
                        this.form.cel_one != this.contact.cel_one ||
                        this.form.cel_two != this.contact.cel_two ||
                        this.form.whatsapp != this.contact.whatsapp ||
                        this.form.telegram != this.contact.telegram ||
                        this.form.facebook != this.contact.facebook ||
                        this.form.instagram != this.contact.instagram ||
                        this.form.twitter != this.contact.twitter ||
                        this.form.linkedin != this.contact.linkedin ||
                        this.form.email != this.contact.email ||
                        this.form.web != this.contact.web ||
                        this.form.departament != this.municipal.departament.id ||
                        this.form.mun != this.municipal.id ||
                        this.form.address != this.contact.address.description_id
                ) {                    
                    if (confirm('Tienes cambios en el formulario. ¿Deseas cancelar?')) {
                        this.$inertia.visit(this.route('points.show',[this.role,this.point]))
                    }
                }else{
                    this.$inertia.visit(this.route('points.show',[this.role,this.point]))
                }
            }
        }
    }
</script>
