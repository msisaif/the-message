<template>
    <app-layout>
        <h1 class="text-brand-primary my-6 text-lg md:text-2xl text-center">
            {{ post.title }}
        </h1>
        <div
            class="text-base md:text-xl border bg-white p-4 md:p-8 whitespace-pre-wrap text-justify"
            v-html="post.body"
        ></div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/App.vue";
import SectionCard from "@/Components/SectionCard.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        AppLayout,
        SectionCard,
        Head,
        Link,
    },
    props: {
        post: {
            type: Object,
            default: {},
        },
    },
};
</script>
