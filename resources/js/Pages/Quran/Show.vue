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
                <button
                    @click="show = 'classification'"
                    class="w-40 py-2 flex justify-center items-center"
                    :class="{
                        'bg-brand-secondary text-white':
                            show == 'classification',
                        'bg-white text-brand-secondary':
                            show != 'classification',
                    }"
                >
                    বিষয়বস্তু
                </button>
            </div>
            <div
                v-if="show == 'translations'"
                class="bg-white p-4 md:p-6 space-y-4"
            >
                <div
                    class="text-center text-brand-primary mb-4 text-lg font-bold"
                >
                    ({{ sura.bengaliPronunciation }}) {{ sura.arabic }}
                </div>
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
                            {{ numberToBengaliNumber(ayah.position) }}
                        </span>
                    </div>
                    <div class="p-4 border w-full space-y-2">
                        <div
                            class="text-xl md:text-2xl text-right text-brand-black font-bold !leading-loose"
                        >
                            <div dir="rtl">
                                {{ ayah.text }}
                            </div>
                        </div>
                        <div
                            v-for="translation in ayah.translations"
                            :key="translation.id"
                            class="text-lg md:text-xl text-left text-brand-black"
                        >
                            <div
                                v-if="
                                    resources.includes(translation.resourceId)
                                "
                                class="grid gap-1 pt-2"
                            >
                                <div>{{ translation.text }}</div>
                                <div class="font-semibold text-xs">
                                    - {{ translation.resourceName }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="show == 'read'" class="bg-white p-4 md:p-6 space-y-4">
                <div
                    class="text-center text-brand-primary mb-4 text-lg font-bold"
                >
                    ({{ sura.bengaliPronunciation }}) {{ sura.arabic }}
                </div>
                <div v-if="bismillahPre" class="flex justify-center">
                    <bismillahir-rahmanir-rahim class="h-8" />
                </div>
                <hr />
                <div
                    v-for="(ayah, index) in ayahs"
                    :key="index"
                    class="flex justify-center flex-wrap gap-4 md:gap-8"
                >
                    <div class="inline-flex items-center gap-x-2">
                        <span class="text-xl md:text-3xl relative">
                            {{ numberToArabicNumber(ayah.position) }}
                            <span
                                class="absolute -left-2 top-1.5 text-base md:text-xl"
                                >(</span
                            >
                            <span
                                class="absolute -right-2 top-1.5 text-base md:text-xl"
                                >)</span
                            >
                        </span>
                        <span dir="rtl" class="text-xl md:text-3xl">
                            {{ ayah.text }}
                        </span>
                    </div>
                </div>
            </div>
            <div
                v-if="show == 'classification'"
                class="bg-white p-4 md:p-6 space-y-4"
            >
                <div
                    class="text-center text-brand-primary mb-4 text-lg font-bold"
                >
                    ({{ sura.bengaliPronunciation }}) {{ sura.arabic }}
                </div>
                <table class="w-full table-auto">
                    <thead>
                        <tr
                            class="bg-brand-secondary text-white uppercase leading-normal text-sm md:text-xl"
                        >
                            <th class="py-3 px-2 text-center">আয়াত</th>
                            <th class="py-3 px-2 text-left">বিষয়বস্তু</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light bg-white">
                        <tr
                            v-for="(classification, index) in classifications"
                            :key="index"
                            class="border-b border-gray-200 hover:bg-gray-50"
                        >
                            <td
                                class="py-3 px-2 text-center text-sm md:text-xl"
                            >
                                <Link
                                    class="underline cursor-pointer"
                                    :href="
                                        route('quran.show', [
                                            classification.suraNumber,
                                            classification.ayah,
                                        ])
                                    "
                                >
                                    {{ classification.ayah }}
                                </Link>
                            </td>
                            <td class="py-3 px-2 text-left text-sm md:text-xl">
                                {{ classification.topic }}
                            </td>
                        </tr>
                    </tbody>
                </table>
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
        sura: {
            type: Object,
            default: {},
        },
        ayahs: {
            type: Object,
            default: {},
        },
        classifications: {
            type: Object,
            default: {},
        },
        bismillahPre: {
            type: Boolean,
            default: false,
        },
        resources: {
            type: Array,
            default: [1],
        },
        show: {
            type: String,
            default: "translations",
        },
    },
    methods: {
        numberToArabicNumber(position) {
            let arabic = ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];

            position = new String(position);

            return position.replace(/[0-9]/g, function (w) {
                return arabic[+w];
            });
        },
        numberToBengaliNumber(position) {
            let arabic = ["০", "১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯"];

            position = new String(position);

            return position.replace(/[0-9]/g, function (w) {
                return arabic[+w];
            });
        },
    },
};
</script>
