<template>
    <Head title="Sura" />

    <app-layout>
        <div class="py-4">
            <h3 class="text-brand-primary text-2xl text-center mb-3 font-bold">
                Add New Sura
            </h3>

            <form-component :data="data" module-action="store" />
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

    data() {
        return {
            data: {
                sura: this.sura,
                suraTypes: this.suraTypes,
            },
        };
    },

    props: {
        sura: {
            type: Object,
            default: {},
        },
        suraTypes: {
            type: Object,
            default: {},
        },
    },
};
</script>
