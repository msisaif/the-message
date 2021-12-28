<template>
    <app-layout>
        <banner-section />

        <section-card
            title="Search Anything in Quran"
            class="mt-6 md:mt-12 bg-white py-4"
        >
            <div class="flex justify-center items-center px-2">
                <input
                    class="
                        w-full
                        max-w-sm
                        border-2 border-brand-secondary
                        px-2
                        py-1
                        focus:outline-none focus:ring-0
                        placeholder-brand-gray
                        text-brand-primary
                    "
                    placeholder="Search 'Noah'"
                />
                <button
                    class="
                        px-3
                        py-1
                        flex
                        justify-center
                        items-center
                        gap-2
                        bg-brand-secondary
                        text-white
                    "
                    type="button"
                >
                    <search-icon class="h-6 w-6" />
                    <span class="text-xl font-medium">Search</span>
                </button>
            </div>
        </section-card>

        <section-card class="mt-6 md:mt-12">
            <div class="flex justify-center items-center gap-4">
                <button
                    @click="show = 'sura'"
                    class="w-40 py-2 flex justify-center items-center"
                    :class="{
                        'bg-brand-secondary text-white': show == 'sura',
                        'bg-white text-brand-secondary': show != 'sura',
                    }"
                >
                    Show Surah
                </button>
                <button
                    @click="show = 'juz'"
                    class="w-40 py-2 flex justify-center items-center"
                    :class="{
                        'bg-brand-secondary text-white': show == 'juz',
                        'bg-white text-brand-secondary': show != 'juz',
                    }"
                >
                    Show Juz
                </button>
            </div>

            <div v-if="show == 'sura'" class="grid md:grid-cols-3 gap-4 py-6">
                <Link
                    href="/"
                    v-for="(sura, index) in suras"
                    :key="index"
                    class="
                        p-6
                        flex
                        justify-between
                        items-center
                        gap-4
                        text-brand-gray
                        bg-white
                    "
                >
                    <div class="flex gap-4 items-center">
                        <span
                            class="
                                w-10
                                h-10
                                bg-brand-light
                                rounded-full
                                flex
                                justify-center
                                items-center
                            "
                        >
                            {{ sura.numberOfSura }}
                        </span>
                        <span>{{ sura.nameBengali }}</span>
                    </div>
                    <div>{{ sura.nameArabic }}</div>
                </Link>
            </div>

            <div v-if="show == 'juz'" class="grid md:grid-cols-2 gap-4 py-6">
                <div
                    v-for="(juz, index) in juzs"
                    :key="index"
                    class="p-4 bg-brand-primary"
                >
                    <div class="space-y-4">
                        <div class="text-white font-bold">
                            {{ juz.numberOfJuz }} পাড়া
                        </div>
                        <Link
                            href="/"
                            v-for="(sura, index) in juz.suras"
                            :key="index"
                            class="
                                p-6
                                flex
                                justify-between
                                items-center
                                gap-4
                                text-brand-gray
                                bg-white
                            "
                        >
                            <div class="flex gap-4 items-center">
                                <span
                                    class="
                                        w-10
                                        h-10
                                        bg-brand-light
                                        rounded-full
                                        flex
                                        justify-center
                                        items-center
                                    "
                                >
                                    {{ sura.numberOfSura }}
                                </span>
                                <span>{{ sura.nameBengali }}</span>
                            </div>
                            <div>{{ sura.nameArabic }}</div>
                        </Link>
                    </div>
                </div>
            </div>
        </section-card>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/App.vue";
import { Link } from "@inertiajs/inertia-vue3";
import BannerSection from "./BannerSection.vue";
import SectionCard from "@/Components/SectionCard.vue";
import { SearchIcon } from "@heroicons/vue/solid";

export default {
    components: {
        AppLayout,
        Link,
        BannerSection,
        SectionCard,
        SearchIcon,
    },
    props: {
        suras: {
            type: Object,
            default: {
                0: {
                    numberOfSura: 1,
                    nameBengali: "সূরা আল-ফাতিহা",
                    nameArabic: "سورة الفاتحة",
                },
                1: {
                    numberOfSura: 2,
                    nameBengali: "সূরা আল বাকারা",
                    nameArabic: "سورة البقرة",
                },
                2: {
                    numberOfSura: 1,
                    nameBengali: "সূরা আল-ফাতিহা",
                    nameArabic: "سورة الفاتحة",
                },
                3: {
                    numberOfSura: 2,
                    nameBengali: "সূরা আল বাকারা",
                    nameArabic: "سورة البقرة",
                },
                4: {
                    numberOfSura: 1,
                    nameBengali: "সূরা আল-ফাতিহা",
                    nameArabic: "سورة الفاتحة",
                },
                5: {
                    numberOfSura: 2,
                    nameBengali: "সূরা আল বাকারা",
                    nameArabic: "سورة البقرة",
                },
            },
        },
        juzs: {
            type: Object,
            default: {
                0: {
                    numberOfJuz: 1,
                    suras: {
                        0: {
                            numberOfSura: 1,
                            nameBengali: "সূরা আল-ফাতিহা",
                            nameArabic: "سورة الفاتحة",
                        },
                        1: {
                            numberOfSura: 2,
                            nameBengali: "সূরা আল বাকারা",
                            nameArabic: "سورة البقرة",
                        },
                    },
                },
                2: {
                    numberOfJuz: 1,
                    suras: {
                        0: {
                            numberOfSura: 1,
                            nameBengali: "সূরা আল-ফাতিহা",
                            nameArabic: "سورة الفاتحة",
                        },
                        1: {
                            numberOfSura: 2,
                            nameBengali: "সূরা আল বাকারা",
                            nameArabic: "سورة البقرة",
                        },
                    },
                },
            },
        },
    },
    data() {
        return {
            show: "sura",
        };
    },
};
</script>
