<template>
    <app-layout>
        <div class="max-w-6xl md:mx-auto">
            <div class="w-full sm:max-w-xl float-left px-8 pt-5 sm:pt-8">
                <div
                    class="bg-gray-300 flex-initial flex-col justify-center items-center"
                >
                    <img
                        :src="post.imageUrl || '/images/article.jpg'"
                        class="w-full aspect-video border border-gray-300"
                    />
                    <h1
                        class="text-brand-primary py-3 text-lg md:text-2xl text-center font-bold"
                    >
                        {{ post.title }}
                    </h1>
                </div>
            </div>
            <div
                v-html="post.body"
                class="text-base md:text-xl border bg-white p-4 md:p-8 mt-6 whitespace-pre-wrap text-justify leading-relaxed"
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
