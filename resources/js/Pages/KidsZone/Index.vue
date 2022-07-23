<template>
    <app-layout>
        <splash-banner>
            <img
                class="w-full"
                src="/images/banner-kids-zone.png"
                alt="banner"
            />
        </splash-banner>
        <section-card>
            <h1
                class="text-brand-primary my-6 text-lg md:text-3xl text-center font-bold"
            >
                শিশু বিচিত্রা
            </h1>
            <div class="grid md:grid-cols-4 gap-2 md:gap-4 px-2 md:px-0">
                <div
                    v-for="(video, index) in videos.data"
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
                        @click="
                            playVideo = video.url.replace(
                                'https://youtu.be/',
                                'https://www.youtube.com/embed/'
                            )
                        "
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
                </div>
            </div>
        </section-card>
        <div
            v-if="videos.next_page_url || videos.prev_page_url"
            class="mt-6 w-full flex justify-center gap-4 items-center"
        >
            <Link
                v-if="videos.prev_page_url"
                :href="videos.prev_page_url"
                class="w-24 flex justify-center items-center py-2 border text-brand-primary border-brand-primary rounded hover:bg-brand-primary hover:text-white"
            >
                Previous
            </Link>
            <div
                v-else
                class="w-24 flex justify-center items-center py-2 rounded bg-brand-gray text-white cursor-not-allowed"
            >
                Previous
            </div>
            <Link
                v-if="videos.next_page_url"
                :href="videos.next_page_url"
                class="w-24 flex justify-center items-center py-2 border text-brand-primary border-brand-primary rounded hover:bg-brand-primary hover:text-white"
            >
                Next
            </Link>
            <div
                v-else
                class="w-24 flex justify-center items-center py-2 rounded bg-brand-gray text-white cursor-not-allowed"
            >
                Next
            </div>
        </div>

        <div
            v-if="playVideo"
            @click="playVideo = ''"
            class="fixed bg-gray-700/50 inset-0 flex justify-center items-center z-50"
        >
            <div class="aspect-video w-full max-w-3xl bg-gray-700">
                <iframe
                    class="w-full aspect-video"
                    :src="playVideo"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                ></iframe>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/App.vue";
import SectionCard from "@/Components/SectionCard.vue";
import SplashBanner from "@/Components/SplashBanner.vue";
import { Link } from "@inertiajs/inertia-vue3";
export default {
    components: {
        AppLayout,
        SectionCard,
        Link,
        SplashBanner,
    },
    props: {
        videos: {
            type: Object,
            default: {},
        },
        playlists: {
            type: Object,
            default: {},
        },
    },
    data() {
        return {
            playVideo: "",
        };
    },
};
</script>
