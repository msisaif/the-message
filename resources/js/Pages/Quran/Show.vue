<template>
    <app-layout>
        <section-card class="mt-6">
            <div class="bg-white">
                <div
                    v-for="(ayah, index) in ayahs"
                    :key="index"
                    class="flex justify-center items-center p-4"
                >
                    <div class="text-xl text-brand-black">{{ ayah.text }}</div>
                </div>
            </div>
        </section-card>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/App.vue";
import { Link } from "@inertiajs/inertia-vue3";
import SectionCard from "@/Components/SectionCard.vue";

export default {
    components: {
        AppLayout,
        Link,
        SectionCard,
    },
    props: {
        ayahs: {
            type: Object,
            default: {},
        },
    },
};
</script>
