<template>
    <Head title="Course" />

    <app-layout>
        <div class="py-4">
            <h3 class="text-brand-primary text-2xl text-center mb-3 font-bold">
                Edit Course
            </h3>

            <form-component :data="data" module-action="update" />
        </div>
    </app-layout>
</template>

<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/App.vue";
import FormComponent from "./Form.vue";

export default {
    components: {
        AppLayout,
        Head,
        Link,
        FormComponent,
    },

    props: {
        data: {
            type: Object,
            default: {},
        },
    },
};
</script>
