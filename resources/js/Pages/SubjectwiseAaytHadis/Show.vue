<template>
    <Head title="বিষয়ভিত্তিক আয়াত হাদিস" />
    <app-layout>
        <section-card class="mt-6" :title="data.category.name">
            <div class="max-w-2xl mx-auto grid gap-4">
                <div class="flex justify-center items-center gap-2">
                    <span class="text-lg text-brand-black font-bold">
                        কুরআন
                    </span>
                </div>
                <div
                    v-for="ayah in data.ayahList"
                    :key="ayah.id"
                    class="grid gap-3 p-3 border md:rounded"
                >
                    <div dir="rtl">{{ ayah.arabic }}</div>
                    <div>{{ ayah.bengali }}</div>
                </div>
                <div class="flex justify-center items-center gap-2">
                    <span class="text-lg text-brand-black font-bold">
                        হাদিস
                    </span>
                </div>
                <div
                    v-for="hadith in data.hadithList"
                    :key="hadith.id"
                    class="grid gap-3 p-3 border rounded"
                >
                    <div dir="rtl">{{ hadith.arabic }}</div>
                    <div>{{ hadith.bengali }}</div>
                </div>
            </div>
        </section-card>
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
        data: {
            type: Object,
            default: {},
        },
    },
};
</script>
