<template>
    <app-layout>
        <h1
            class="text-brand-primary my-6 text-lg md:text-3xl text-center font-bold"
        >
            প্রাত্যহিক জীবনে ইসলাম
        </h1>
        <section-card class="">
            <div class="grid md:grid-cols-4 gap-2 md:gap-4 px-2 md:px-0">
                <Link
                    v-for="(post, index) in posts.data"
                    :key="index"
                    :href="route('article.show', post.id)"
                    class="border bg-white"
                >
                    <div class="overflow-hidden w-full aspect-video">
                        <img
                            :src="post.imageUrl || '/images/article.jpg'"
                            class="w-full h-full object-cover hover:scale-110 transition-all ease-in-out"
                            @error="$defaultImage"
                        />
                    </div>
                    <div class="flex flex-col gap-1 p-2 md:p-4">
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
                                class="line-clamp-4 leading-relaxed whitespace-pre-wrap"
                            ></div>
                            <div class="flex justify-center items-center py-2">
                                <span
                                    class="text-sm px-4 py-1 text-brand-primary border border-brand-primary hover:bg-brand-primary hover:text-white"
                                >
                                    সম্পূর্ন লেখা পড়ুন
                                </span>
                            </div>
                        </div>
                    </div>
                </Link>
            </div>
        </section-card>
        <div
            v-if="posts.next_page_url || posts.prev_page_url"
            class="mt-6 w-full flex justify-center gap-4 items-center"
        >
            <Link
                v-if="posts.prev_page_url"
                :href="posts.prev_page_url"
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
                v-if="posts.next_page_url"
                :href="posts.next_page_url"
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
import { Head, Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        AppLayout,
        SectionCard,
        Head,
        Link,
    },
    props: {
        posts: {
            type: Object,
            default: {},
        },
    },
};
</script>
