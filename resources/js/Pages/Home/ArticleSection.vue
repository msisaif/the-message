<template>
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
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import SectionCard from "./SectionCard.vue";
import ArticleCard from "./Components/ArticleCard.vue";

export default {
    components: {
        Link,
        SectionCard,
        ArticleCard,
    },
    data() {
        return {
            posts: [
                {
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
                {
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
                {
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
                {
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
            ],
        };
    },
};
</script>
