<template>
    <Head title="Admin" />

    <app-layout>
        <template #header>
            Create Admin
        </template>
        
        <form-component :data="{ admin }" module-action="store" />
    </app-layout>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';
import AppLayout from "@/Layouts/App.vue";
import FormComponent from "./Form.vue";

export default {
    components: {
        Head,
        AppLayout,
        FormComponent,
    },
    props: {
        admin: {
            type: Object,
            default: {}
        },
    },
};
</script>
