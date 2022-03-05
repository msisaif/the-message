<template>
    <app-layout>
        <banner-section />

        <section-card
            title="Search Anything in Quran"
            class="mt-6 md:mt-12 bg-white py-4"
        >
            <div class="flex justify-center items-center px-2">
                <input
                    class="w-full max-w-sm border-2 border-brand-secondary px-2 py-1 focus:outline-none focus:ring-0 placeholder-brand-gray text-brand-primary"
                    placeholder="Search 'Noah'"
                />
                <button
                    class="px-3 py-1 flex justify-center items-center gap-2 bg-brand-secondary text-white"
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
                    Show Sura
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

            <div v-if="show == 'sura'" class="grid md:grid-cols-3 gap-4 py-6">
                <sura-card
                    class="bg-white"
                    v-for="(sura, index) in suras"
                    :key="index"
                    :href="route('quran.show', sura.id)"
                    :sura="sura"
                />
                <Link
                    v-if="
                        $page.props.auth.user &&
                        $page.props.auth.user.type === 1 &&
                        suras.length < 114
                    "
                    :href="route('suras.create')"
                    class="p-6 flex justify-center items-center text-2xl text-brand-primary border border-dashed border-brand-primary"
                >
                    (+) Add Sura
                </Link>
            </div>

            <div v-if="show == 'juz'" class="flex flex-col flex-wrap my-6">
                <div v-for="(juz, index) in juzs" :key="index" class="w-full">
                    <div class="p-2">
                        <div class="space-y-2 p-4 bg-brand-primary">
                            <div class="text-white font-bold">
                                {{ juz.juzNumber }} পাড়া
                            </div>
                            <div
                                class="grid md:grid-cols-2 lg:grid-cols-3 gap-4"
                            >
                                <sura-card
                                    class="bg-white"
                                    v-for="(sura, index) in juz.suras"
                                    :key="index"
                                    :href="route('quran.show', sura.id)"
                                    :sura="sura"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div
                v-if="show == 'classification'"
                class="grid md:grid-cols-3 gap-4 py-6"
            >
                <sura-card
                    class="bg-gray-200"
                    v-for="(sura, index) in suras"
                    :key="index"
                    :href="
                        route('quran.show', sura.id) + '?option=classification'
                    "
                    :sura="sura"
                />
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
import SuraCard from "./SuraCard.vue";

export default {
    components: {
        AppLayout,
        Link,
        BannerSection,
        SectionCard,
        SearchIcon,
        SuraCard,
    },
    props: {
        suras: {
            type: Object,
            default: {},
        },
        juzs: {
            type: Object,
            default: {},
        },
    },
    data() {
        return {
            show: "sura",
        };
    },
};
</script>
