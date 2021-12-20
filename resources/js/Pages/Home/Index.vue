<template>
    <app-layout>
        <splash-banner
            title="The Message"
            subtitle="Enlighten the society with the light of holy Qur'an &amp; Hadith."
        >
            <!-- <img class="w-full h-auto" src="/images/banner.jpg" /> -->
        </splash-banner>

        <search-section></search-section>

        <service-section></service-section>

        <article-section></article-section>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/App.vue";
import { Link } from "@inertiajs/inertia-vue3";
import SplashBanner from "@/Components/SplashBanner.vue";
import SectionCard from "./SectionCard.vue";
import SearchSection from "./SearchSection.vue";
import ServiceSection from "./ServiceSection.vue";
import ArticleSection from "./ArticleSection.vue";
import { SearchIcon } from "@heroicons/vue/solid";

export default {
    components: {
        AppLayout,
        Link,
        SplashBanner,
        SectionCard,
        SearchSection,
        ServiceSection,
        ArticleSection,
        SearchIcon,
    },
};
</script>
