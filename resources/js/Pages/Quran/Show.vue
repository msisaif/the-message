<template>
    <app-layout>
        <section-card class="mt-4 space-y-4">
            <div class="flex justify-center items-center gap-4">
                <button
                    @click="show = 'translations'"
                    class="w-40 py-2 flex justify-center items-center"
                    :class="{
                        'bg-brand-secondary text-white': show == 'translations',
                        'bg-white text-brand-secondary': show != 'translations',
                    }"
                >
                    Translations
                </button>
                <button
                    @click="show = 'read'"
                    class="w-40 py-2 flex justify-center items-center"
                    :class="{
                        'bg-brand-secondary text-white': show == 'read',
                        'bg-white text-brand-secondary': show != 'read',
                    }"
                >
                    Read
                </button>
            </div>
            <div
                v-if="show == 'translations'"
                class="bg-white p-4 md:p-6 space-y-4"
            >
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
                            class="w-12 h-10 rounded-full text-gray-500 bg-brand-light inline-flex justify-center items-center text-xl md:text-3xl"
                        >
                            {{ numberToArabicNumber(ayah.position) }}
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
            <div v-if="show == 'read'" class="bg-white p-4 md:p-6 space-y-4">
                <div v-if="bismillahPre" class="flex justify-center">
                    <bismillahir-rahmanir-rahim class="h-8" />
                </div>
                <div
                    v-for="(ayah, index) in ayahs"
                    :key="index"
                    class="flex justify-center flex-wrap gap-4 md:gap-8"
                >
                    <div class="inline-flex items-center gap-x-2">
                        <span class="text-xl md:text-3xl relative">
                            {{ numberToArabicNumber(ayah.position) }}
                            <span
                                class="absolute -left-3 top-1.5 text-base md:text-xl"
                                >(</span
                            >
                            <span
                                class="absolute -left-3 top-1.5 text-base md:text-xl"
                                >)</span
                            >
                        </span>
                        <span
                            dir="rtl"
                            class="text-xl md:text-3xl"
                            style="word-spacing: 12px"
                        >
                            {{ ayah.text }}
                        </span>
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
    data() {
        return {
            show: "translations",
        };
    },
    methods: {
        numberToArabicNumber(position) {
            let arabic = ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];

            position = new String(position);

            return position.replace(/[0-9]/g, function (w) {
                return arabic[+w];
            });
        },
    },
};
</script>
