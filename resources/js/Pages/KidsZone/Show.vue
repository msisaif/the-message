<template>
    <app-layout>
        <!-- <splash-banner>
            <img
                class="w-full"
                src="/images/banner-kids-zone.png"
                alt="banner"
            />
        </splash-banner> -->
        <section-card>
            <h1
                class="text-brand-primary my-6 text-lg md:text-3xl text-center font-bold"
            >
                {{ data.playlist.title }}
            </h1>
            <div class="grid md:grid-cols-4 gap-2 md:gap-4 px-2 md:px-0">
                <div
                    v-for="(video, index) in data.videos"
                    :key="index"
                    class="relative"
                    @click="
                        playVideo = video.url.replace(
                            'https://youtu.be/',
                            'https://www.youtube.com/embed/'
                        )
                    "
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
                    <play-icon-with-ping-animation />
                </div>
            </div>
        </section-card>
        <section-card>
            <h1
                class="text-brand-primary my-6 text-lg md:text-3xl text-center font-bold"
            >
                অন্যান্য প্লেলিস্ট
            </h1>
            <div class="grid md:grid-cols-4 gap-2 md:gap-4 px-2 md:px-0">
                <Link
                    v-for="(playlist, index) in data.playlists.data"
                    :key="index"
                    class="relative"
                    :href="route('kids-zone.show', playlist.id)"
                >
                    <div class="relative">
                        <div class="w-full aspect-video overflow-hidden shadow">
                            <img
                                class="w-full h-full object-cover"
                                :src="playlist.imageUrl"
                                @error="$defaultImage"
                            />
                        </div>
                    </div>
                    <h3
                        class="p-4 text-sm md:text-base text-brand-primary font-bold text-center"
                    >
                        {{ playlist.title }}
                    </h3>
                    <playlist-icon />
                </Link>
            </div>
        </section-card>

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
import PlayIconWithPingAnimation from "@/Components/PlayIconWithPingAnimation.vue";
import MenuIconWithPingAnimation from "@/Components/MenuIconWithPingAnimation.vue";
import PlaylistIcon from "@/Components/PlaylistIcon.vue";
export default {
    components: {
        AppLayout,
        SectionCard,
        Link,
        SplashBanner,
        PlayIconWithPingAnimation,
        MenuIconWithPingAnimation,
        PlaylistIcon,
    },
    props: {
        data: {
            type: Object,
            default: {},
        },
    },
    data() {
        return {
            playVideo: "",
        };
    },
    // created() {
    //     this.playVideo = this.data.videos[0].url.replace(
    //         "https://youtu.be/",
    //         "https://www.youtube.com/embed/"
    //     );
    // },
};
</script>
