<template>
    <Head>
        <title>{{ post.title }}</title>
        <meta name="title" :content="post.title" />
        <meta name="description" :content="post.description" />

        <!-- Facebook -->
        <meta property="og:url" :content="route('article.show', post.id)" />
        <meta property="og:type" content="article" />
        <meta property="og:title" :content="post.title" />
        <meta property="og:description" :content="post.description" />
        <meta
            property="og:image"
            :content="
                'https://messagebd.net' +
                (post.imageUrl || '/images/article.jpg')
            "
        />
    </Head>
    <app-layout>
        <div class="max-w-6xl md:mx-auto">
            <div class="w-full sm:max-w-xl float-left p-4 pb-2 sm:p-8 sm:pb-2">
                <div
                    class="bg-gray-300 flex-initial flex-col justify-center items-center"
                >
                    <img
                        :src="post.imageUrl || '/images/article.jpg'"
                        class="w-full aspect-video border border-gray-300"
                    />
                    <h1
                        class="text-brand-primary py-3 text-lg sm:text-2xl text-center font-bold"
                    >
                        {{ post.title }}
                    </h1>
                </div>
            </div>
            <div
                v-html="post.body"
                class="text-base md:text-xl border bg-white p-4 md:p-8 mt-6 whitespace-pre-wrap text-justify !leading-relaxed"
            ></div>
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
        post: {
            type: Object,
            default: {},
        },
    },
};
</script>
