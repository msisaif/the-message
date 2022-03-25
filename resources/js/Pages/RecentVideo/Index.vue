<template>
    <app-layout>
        <section-card class="mt-6" title="Recent Videos">
            <div class="grid md:grid-cols-3 gap-2 md:gap-4 px-2 md:px-0">
                <div
                    v-for="(video, index) in videos.data"
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
                    <div class="flex flex-col gap-2 p-2 md:p-4">
                        <h3 class="text-lg text-brand-black font-bold">
                            {{ video.title }}
                        </h3>
                    </div>
                    <slot></slot>
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
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/App.vue";
import SectionCard from "@/Components/SectionCard.vue";
import { Link } from "@inertiajs/inertia-vue3";
export default {
    components: {
        AppLayout,
        SectionCard,
        Link,
    },
    props: {
        videos: {
            type: Object,
            default: {},
        },
    },
};
</script>
