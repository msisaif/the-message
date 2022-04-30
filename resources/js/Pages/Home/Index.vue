<template>
    <app-layout>
        <splash-banner
            title="The Message"
            subtitle="Enlighten the society with the light of holy Qur'an &amp; Hadith."
        >
            <!-- <img class="w-full h-72 object-cover" src="/images/video.png" /> -->
            <!-- <img class="w-full h-72 object-cover" src="/images/article.jpg" /> -->
        </splash-banner>

        <section-card
            title="Search Anything"
            class="mt-6 md:mt-12 bg-white py-4"
        >
            <div class="flex justify-center items-center px-2">
                <input
                    class="w-full max-w-sm border-2 border-brand-secondary px-2 py-1 focus:outline-none focus:ring-0 placeholder-brand-gray text-brand-primary"
                    placeholder="Search Anything..."
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

        <service-section class="mt-6 md:mt-12" />

        <section-card class="mt-6 md:mt-12">
            <div class="flex justify-between items-center p-4 md:px-0">
                <h2 class="text-xl md:text-3xl text-brand-secondary">
                    প্রাত্যহিক জীবনে ইসলাম
                </h2>
                <Link
                    v-if="Object.keys(posts).length >= 4"
                    :href="route('article.index')"
                    class="text-brand-primary underline font-bold"
                >
                    সব গুলো &#62;
                </Link>
            </div>
            <div class="grid md:grid-cols-4 gap-2 md:gap-4 px-2 md:px-0">
                <Link
                    v-for="(post, index) in posts"
                    :key="index"
                    :href="route('article.show', post.id)"
                    class="border bg-white flex flex-col"
                >
                    <!-- <img
                        :src="post.thumbnail || '/images/article.jpg'"
                        class="w-full h-40 object-cover"
                    /> -->
                    <div class="flex flex-col gap-1 p-2 md:p-4">
                        <h3
                            class="shrink grow text-base text-brand-primary font-bold"
                        >
                            {{ post.title }}
                        </h3>
                        <hr class="my-2 shrink-0 grow-0" />
                        <div
                            class="shrink-0 grow-0 text-brand-black text-base text-justify"
                        >
                            <div
                                v-html="post.body"
                                class="line-clamp-[10] leading-relaxed whitespace-pre-wrap"
                            ></div>
                        </div>
                    </div>
                </Link>
            </div>
        </section-card>

        <section-card class="mt-6 md:mt-12">
            <div class="flex justify-between items-center p-4 md:px-0">
                <h2 class="text-xl md:text-3xl text-brand-secondary">
                    সাম্প্রতিক ভিডিও
                </h2>
                <Link
                    v-if="Object.keys(videos).length >= 4"
                    :href="route('video.index')"
                    class="text-brand-primary underline font-bold"
                >
                    সব গুলো &#62;
                </Link>
            </div>
            <div class="grid md:grid-cols-4 gap-2 md:gap-4 px-2 md:px-0">
                <div
                    v-for="(video, index) in videos"
                    :key="index"
                    class="bg-white shadow"
                >
                    <div class="relative">
                        <div class="w-full aspect-video rounded shadow">
                            <iframe
                                class="w-full h-full"
                                :src="
                                    video.url.replace(
                                        'https://youtu.be/',
                                        'https://www.youtube.com/embed/'
                                    )
                                "
                                title="YouTube video player"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                            ></iframe>
                        </div>
                    </div>
                    <div class="flex items-center p-2 md:p-4">
                        <h3
                            class="text-xs md:text-sm text-brand-black font-bold"
                        >
                            {{ video.title }}
                        </h3>
                    </div>
                </div>
            </div>
        </section-card>

        <section-card class="mt-6 md:mt-12 bg-brand-primary text-white py-4">
            <h2 class="text-brand-secondary text-xl font-bold text-center mb-4">
                Ayat Of The Day
            </h2>
            <div class="space-y-1 px-4">
                <p class="text-white text-center">
                    {{ ayahOfTheDay.text }}
                </p>
                <p class="text-white text-center">
                    {{ ayahOfTheDay.reference }}
                </p>
            </div>
        </section-card>

        <section-card class="mt-6 md:mt-12 bg-brand-secondary text-white py-4">
            <h2 class="text-brand-primary text-xl font-bold text-center mb-4">
                Hadith Of The Day
            </h2>
            <div class="space-y-1 px-4">
                <p class="text-white text-center">
                    {{ hadithOfTheDay.text }}
                </p>
                <p class="text-white text-center">
                    {{ hadithOfTheDay.reference }}
                </p>
            </div>
        </section-card>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/App.vue";
import { Link } from "@inertiajs/inertia-vue3";
import SplashBanner from "@/Components/SplashBanner.vue";
import SectionCard from "@/Components/SectionCard.vue";
import ServiceSection from "./ServiceSection.vue";
import { SearchIcon, PlayIcon } from "@heroicons/vue/solid";

export default {
    components: {
        AppLayout,
        Link,
        SplashBanner,
        SectionCard,
        ServiceSection,
        SearchIcon,
        PlayIcon,
    },
    props: {
        posts: {
            type: Object,
            default: {
                0: {
                    id: 13,
                    title: "Here will be the post title",
                    thumbnail: "/images/article.jpg",
                    description: `Post description Lorem ipsum dolor sit sed do ut magna. Lorem ipsum dolor sit sed do ut magna.`,
                },
                1: {
                    id: 13,
                    title: "Here will be the post title",
                    thumbnail: "/images/article.jpg",
                    description: `Post description Lorem ipsum dolor sit sed do ut magna. Lorem ipsum dolor sit sed do ut magna.`,
                },
                2: {
                    id: 13,
                    title: "Here will be the post title",
                    thumbnail: "/images/article.jpg",
                    description: `Post description Lorem ipsum dolor sit sed do ut magna. Lorem ipsum dolor sit sed do ut magna.`,
                },
                3: {
                    id: 13,
                    title: "Here will be the post title",
                    thumbnail: "/images/article.jpg",
                    description: `Post description Lorem ipsum dolor sit sed do ut magna. Lorem ipsum dolor sit sed do ut magna.`,
                },
            },
        },
        videos: {
            type: Object,
            default: {},
        },
        ayahOfTheDay: {
            type: Object,
            default: {
                text: `" Had there been within the heavens and earth gods besides Allah, they both would have been ruined. So exalted is Allah, Lord of the Throne, (High is He) above what they attribute to Him. "`,
                reference: "Quran 21:22",
            },
        },
        hadithOfTheDay: {
            type: Object,
            default: {
                text: `" And an impious wicked person is like a pine tree which keeps hard and straight till Allah cuts (breaks) it down when He wishes. "`,
                reference: "SAHIH BUKHARI, BOOK 70, Hadith No. 558, Vol. 9",
            },
        },
    },
};
</script>
