<template>
    <Head title="বিষয়ভিত্তিক আয়াত হাদিস" />
    <app-layout>
        <section-card class="mt-6">
            <div
                class="max-w-3xl mx-auto grid gap-6 py-4 px-2 md:px-6 bg-white"
            >
                <div class="flex justify-center items-center gap-2">
                    <h1
                        class="text-xl md:text-3xl text-brand-primary font-semibold"
                    >
                        {{ data.category.name }}
                    </h1>
                </div>
                <div class="grid gap-2">
                    <div class="flex justify-center items-center gap-2">
                        <span class="text-2xl text-brand-black font-bold">
                            আল-কুরআন
                        </span>
                    </div>
                    <div
                        v-for="ayah in data.ayahList"
                        :key="ayah.id"
                        class="grid gap-3 p-3 border md:rounded"
                    >
                        <div v-if="ayah.title" class="font-bold">
                            {{ ayah.title }}:
                        </div>
                        <div
                            class="text-xl md:text-2xl !leading-loose"
                            dir="rtl"
                        >
                            {{ ayah.arabic }}
                        </div>
                        <div
                            class="text-lg md:text-xl text-left text-brand-black"
                        >
                            {{ ayah.bengali }}
                        </div>
                    </div>
                </div>
                <div class="grid gap-2">
                    <div class="flex justify-center items-center gap-2">
                        <span class="text-2xl text-brand-black font-bold">
                            আল-হাদিস
                        </span>
                    </div>
                    <div
                        v-for="hadith in data.hadithList"
                        :key="hadith.id"
                        class="grid gap-3 p-3 border rounded"
                    >
                        <div v-if="hadith.title" class="font-bold">
                            {{ hadith.title }}:
                        </div>
                        <div
                            class="text-xl md:text-2xl !leading-loose"
                            dir="rtl"
                        >
                            {{ hadith.arabic }}
                        </div>
                        <div
                            class="text-lg md:text-xl text-left text-brand-black"
                        >
                            {{ hadith.bengali }}
                        </div>
                    </div>
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
