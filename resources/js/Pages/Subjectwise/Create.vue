<template>
    <Head title="Classification" />

    <app-layout>
        <div class="py-4">
            <h3 class="text-brand-primary text-2xl text-center mb-3 font-bold">
                বিষয়ভিত্তিক আয়াত হাদিস
            </h3>

            <form-component
                :data="{ subjectwise, categories }"
                module-action="store"
            />
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
        subjectwise: {
            type: Object,
            default: {},
        },
        categories: {
            type: Object,
            default: {},
        },
    },
};
</script>
