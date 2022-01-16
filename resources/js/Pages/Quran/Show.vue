<template>
    <app-layout>
        <section-card class="mt-6">
            <div class="bg-white p-4 md:p-6 space-y-4">
                <div v-if="bismillahPre" class="flex justify-center">
                    <bismillahir-rahmanir-rahim class="h-8" />
                </div>
                <div
                    v-for="(ayah, index) in ayahs"
                    :key="index"
                    class="flex justify-between"
                >
                    <div class="p-2 border flex justify-center items-center">
                        <span
                            class="w-12 h-10 rounded-full bg-brand-light inline-flex justify-center items-center"
                        >
                            {{ ayah.position }}
                        </span>
                    </div>
                    <div class="p-4 border w-full">
                        <div
                            class="text-xl md:text-2xl text-right text-brand-black font-bold"
                        >
                            <div dir="rtl">
                                {{ ayah.text }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section-card>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/App.vue";
import { Link } from "@inertiajs/inertia-vue3";
import SectionCard from "@/Components/SectionCard.vue";
import BismillahirRahmanirRahim from "@/Components/BismillahirRahmanirRahim.vue";

export default {
    components: {
        AppLayout,
        Link,
        SectionCard,
        BismillahirRahmanirRahim,
    },
    props: {
        ayahs: {
            type: Object,
            default: {},
        },
        bismillahPre: {
            type: Boolean,
            default: false,
        },
    },
};
</script>
