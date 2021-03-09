<template>
    <app-layout>
        <panel :company="companie" :role="role">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-3xl font-bold text-gray-600">{{point.type}}</p>
                        <p class="mb-5">{{point.comment}}</p>
                    </div>
                    <div class="flex gap-3">
                        <inertia-link :href="route('points.edit',[role,point])">Editar</inertia-link>
                        <button @click="destroy">Eliminar</button>
                    </div>
                </div>
                <p>Teléfono: 
                    <span v-if="contact.tel == null" class="italic text-gray-400">Ninguno</span> 
                    <span v-else>{{contact.tel}}</span> 
                </p>
                <p>Celular 1:
                    <span v-if="contact.cel_one == null" class="italic text-gray-400">Ninguno</span> 
                    <span v-else>{{contact.cel_one}}</span> 
                </p>
                <p>Celular 2: 
                    <span v-if="contact.cel_two == null" class="italic text-gray-400">Ninguno</span> 
                    <span v-else>{{contact.cel_two}}</span> 
                </p>
                <p>Whatsapp: 
                    <span v-if="contact.whatsapp == null" class="italic text-gray-400">Ninguno</span> 
                    <span v-else>{{contact.whatsapp}}</span> 
                </p>
                <p>Telegram: 
                    <span v-if="contact.telegram == null" class="italic text-gray-400">Ninguno</span> 
                    <span v-else>{{contact.telegram}}</span> 
                </p>
                <p>Facebook: 
                    <span v-if="contact.facebook == null" class="italic text-gray-400">Ninguno</span> 
                    <span v-else>{{contact.facebook}}</span> 
                </p>
                <p>Instagram: 
                    <span v-if="contact.instagram == null" class="italic text-gray-400">Ninguno</span> 
                    <span v-else>{{contact.instagram}}</span> 
                </p>
                <p>Twitter: 
                    <span v-if="contact.twitter == null" class="italic text-gray-400">Ninguno</span> 
                    <span v-else>{{contact.twitter}}</span> 
                </p>
                <p>Linked-In: 
                    <span v-if="contact.linkedin == null" class="italic text-gray-400">Ninguno</span> 
                    <span v-else>{{contact.linkedin}}</span> 
                </p>
                <p>E-mail: 
                    <span v-if="contact.email == null" class="italic text-gray-400">Ninguno</span> 
                    <span v-else>{{contact.email}}</span> 
                </p>
                <p>Web: 
                    <span v-if="contact.web == null" class="italic text-gray-400">Ninguno</span> 
                    <span v-else>{{contact.web}}</span> 
                </p>
                <p>Dirección: 
                    <span v-if="contact.address.description_id == null" class="italic text-gray-400">Ninguno</span> 
                    <span v-else>{{contact.address.description_id}}</span> 
                </p>
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
            point: Object,
            role: Object,
            contact: Object,
            companie: Object
        },
        methods :{
            destroy () {
                if (confirm('Vas a eliminar este punto. ¿Deseas continuar?')) {
                    this.$inertia.delete(this.route('points.destroy',[this.role, this.point]))                    
                }
            }
        }
    }
</script>
