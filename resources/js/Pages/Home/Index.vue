<template>
    <app-layout>
        <splash-banner
            title="The Message"
            subtitle="Enlighten the society with the light of holy Qur'an &amp; Hadith."
        >
            <!-- <img class="w-full h-auto" src="/images/banner.jpg" /> -->
        </splash-banner>

        <search-section />

        <service-section />

        <section-card class="mt-8" title="Recent Posts">
            <div class="grid md:grid-cols-4 gap-2 md:gap-4 px-2 md:px-0">
                <article-card
                    v-for="(post, index) in posts"
                    :key="index"
                    :src="post.thumbnail"
                    :title="post.title"
                    :summary="post.summary"
                />
            </div>
        </section-card>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/App.vue";
import { Link } from "@inertiajs/inertia-vue3";
import SplashBanner from "@/Components/SplashBanner.vue";
import SectionCard from "./SectionCard.vue";
import SearchSection from "./SearchSection.vue";
import ServiceSection from "./ServiceSection.vue";
import ArticleCard from "./Components/ArticleCard.vue";

export default {
    components: {
        AppLayout,
        Link,
        SplashBanner,
        SectionCard,
        SearchSection,
        ServiceSection,
        ArticleCard,
    },
    props: {
        posts: {
            type: Object,
            default: {
                0: {
                    id: 13,
                    title: "Here will be the post title",
                    thumbnail: "/images/banner.jpg",
                    summary:
                        "Post summary Lorem ipsum dolor sit sed do ut magna. Post summary Lorem ipsum dolor sit sed do ut magna.",
                    body: `
                        <p>
                            Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna.
                        </p>
                        <p>
                            Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna.
                        </p>
                        <p>
                            Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna.
                        </p>`,
                },
                1: {
                    id: 13,
                    title: "Here will be the post title",
                    thumbnail: "/images/banner.jpg",
                    summary:
                        "Post summary Lorem ipsum dolor sit sed do ut magna. Post summary Lorem ipsum dolor sit sed do ut magna.",
                    body: `
                        <p>
                            Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna.
                        </p>
                        <p>
                            Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna.
                        </p>
                        <p>
                            Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna.
                        </p>`,
                },
                2: {
                    id: 13,
                    title: "Here will be the post title",
                    thumbnail: "/images/banner.jpg",
                    summary:
                        "Post summary Lorem ipsum dolor sit sed do ut magna. Post summary Lorem ipsum dolor sit sed do ut magna.",
                    body: `
                        <p>
                            Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna.
                        </p>
                        <p>
                            Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna.
                        </p>
                        <p>
                            Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna.
                        </p>`,
                },
                3: {
                    id: 13,
                    title: "Here will be the post title",
                    thumbnail: "/images/banner.jpg",
                    summary:
                        "Post summary Lorem ipsum dolor sit sed do ut magna. Post summary Lorem ipsum dolor sit sed do ut magna.",
                    body: `
                        <p>
                            Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna.
                        </p>
                        <p>
                            Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna.
                        </p>
                        <p>
                            Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna. Post body Lorem ipsum dolor sit sed do ut magna.
                        </p>`,
                },
            },
        },
    },
};
</script>
