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
                <h2
                    class="text-xl md:text-3xl text-brand-primary font-semibold"
                >
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
                    <div class="overflow-hidden w-full aspect-video">
                        <img
                            :src="post.imageUrl || '/images/article.jpg'"
                            class="w-full bg-gray-200 h-full object-cover hover:scale-110 transition-all ease-in-out"
                            @error="$defaultImage"
                        />
                    </div>
                    <div class="flex flex-col gap-1 p-2 md:p-4">
                        <div class="line-clamp-6">
                            <h3
                                class="shrink grow text-base text-brand-primary font-bold"
                            >
                                {{ post.title }}
                            </h3>
                            <hr class="my-1 shrink-0 grow-0" />
                            <div
                                class="shrink-0 grow-0 text-brand-black text-base text-justify"
                            >
                                <div
                                    v-html="post.body"
                                    class="leading-relaxed whitespace-pre-wrap"
                                ></div>
                            </div>
                        </div>
                        <div class="flex justify-center items-center py-2">
                            <span
                                class="text-sm px-4 py-1 text-brand-primary border border-brand-primary hover:bg-brand-primary hover:text-white"
                            >
                                সম্পূর্ন লেখা পড়ুন
                            </span>
                        </div>
                    </div>
                </Link>
            </div>
        </section-card>

        <section-card class="mt-6 md:mt-12">
            <div class="flex justify-between items-center p-4 md:px-0">
                <h2
                    class="text-xl md:text-3xl text-brand-primary font-semibold"
                >
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
                    class="relative"
                >
                    <div class="relative">
                        <div class="w-full aspect-video overflow-hidden shadow">
                            <img
                                class="w-full h-full object-cover"
                                :src="video.imageUrl"
                                @error="$defaultImage"
                            />
                        </div>
                    </div>
                    <h3
                        class="p-4 text-sm md:text-base text-brand-primary font-bold text-center"
                    >
                        {{ video.title }}
                    </h3>
                    <div
                        @click="playVideo = video.id"
                        class="absolute left-0 right-0 top-0 aspect-video bg-brand-primary/10 cursor-pointer flex justify-center items-center"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="absolute h-20 w-20 text-white/50 animate-ping stroke-1"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="absolute h-20 w-20 text-white stroke-1"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>
                    </div>

                    <div
                        v-if="video.id == playVideo"
                        @click="playVideo = ''"
                        class="fixed bg-gray-500/25 inset-0 flex justify-center items-center z-50"
                    >
                        <div class="aspect-video w-full max-w-3xl">
                            <iframe
                                class="w-full aspect-video"
                                :src="
                                    video.url.replace(
                                        'https://youtu.be/',
                                        'https://www.youtube.com/embed/'
                                    )
                                "
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                            ></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section-card>

        <section-card
            class="mt-6 md:mt-12 bg-brand-primary text-white py-4 md:py-8 space-y-4"
        >
            <h2 class="text-white text-2xl md:text-4xl font-bold text-center">
                আজকের আয়াত
            </h2>
            <div class="px-6">
                <p
                    class="text-white text-center text-xl md:text-2xl leading-relaxed"
                    v-html="ayahOfTheDay.text"
                ></p>
            </div>
        </section-card>

        <section-card
            class="mt-6 md:mt-12 bg-brand-secondary text-white py-4 md:py-8 space-y-4"
        >
            <h2 class="text-white text-2xl md:text-4xl font-bold text-center">
                আজকের হাদিস
            </h2>
            <div class="px-6">
                <p
                    class="text-white text-center text-xl md:text-2xl leading-relaxed"
                    v-html="hadithOfTheDay.text"
                ></p>
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
            default: {},
        },
        videos: {
            type: Object,
            default: {},
        },
        ayahOfTheDay: {
            type: Object,
            default: {
                text: `আসমান ও যমীনে যদি আল্লাহ ছাড়া আরো অনেক ইলাহ থাকত তবে (আসমান ও যমীন) উভয়ই ধ্বংস হয়ে যেত। কাজেই আরশের অধিপতি আল্লাহ মহান ও পবিত্র সে সব থেকে যা তারা তাঁর প্রতি আরোপ করে। (সূরা আম্বিয়া, আয়াত: ২২)`,
                reference: "সূরা আম্বিয়া, আয়াত: ২২",
            },
        },
        hadithOfTheDay: {
            type: Object,
            default: {
                text: `বান্দা যখন ভালমন্দ ‍বিচার না করেই কোন কথা বলে, তখন তার কারণে সে নিজেকে জাহান্নামের এতদূর গভীরে নিয়ে যায় যা পূর্ব-পশ্চিমের দূরত্বের সমান। (সহীহ বুখারি - ৬৪৭৭)`,
                reference: "সহীহ বুখারি - ৬৪৭৭",
            },
        },
    },

    data() {
        return {
            playVideo: "",
        };
    },
};
</script>
