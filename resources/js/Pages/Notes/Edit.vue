<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout.vue';
import {useForm} from "@inertiajs/inertia-vue3";

const props = defineProps({
    note: Object,
});

const form = useForm({
    excerpt:props.note.excerpt,
    content:props.note.content
});
const submit = () => {
    form.put(route('notes.update',props.note.id), form);
};
const destroy = () => {
    if(confirm('Desea Eliminar?')){
        form.delete(route('notes.destroy',props.note.id),form);
    }
};
</script>
<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Módulo de Notas
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px0">
                            <h3 class="text-lg text-gray-900">Editar una nota</h3>
                            <p class="text-sm text-gray-600">Si editas no podrás volver al estado anterior</p>
                        </div>
                    </div>
                    <div class="md:col-span-2 mt-5 md:mt-0">
                        <div class="shadow bg-white md:rounded-md p-4">
                            <form @submit.prevent="submit">
                                <label class="block font-medium text-sm text-gray-700">
                                    Resumen
                                </label>
                                <textarea
                                    class="form-input w-full rounded-md shadow-sm"
                                    v-model="form.excerpt"
                                ></textarea>
                                <label class="block font-medium text-sm text-gray-700">
                                    Contenido
                                </label>
                                <textarea
                                    class="form-input w-full rounded-md shadow-sm"
                                    v-model="form.content"
                                    rows="8"
                                ></textarea>
                                <button
                                    class="px-3 py-2 mr-2 rounded text-white text-sm font-bold whitespace-no-wrap bg-green-500 hover:bg-green-800"
                                >Editar</button>
                            </form>
                            <hr class="my-6">
                            <inertia-link :href="route('notes.index')" class="px-3 py-2 mr-2 rounded text-white text-sm font-bold whitespace-no-wrap bg-gray-500 hover:bg-gray-800">
                                Volver
                            </inertia-link>
                            <a href="#" @click.prevent="destroy" style="margin-left: 10px" class="px-3 py-2 mr-2 rounded text-white text-sm font-bold whitespace-no-wrap bg-red-500 hover:bg-red-800">
                                Eliminar Nota
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>
