<template>
    <section-card class="mt-8" title="Recent Posts">
        <div class="grid md:grid-cols-3 gap-2 md:gap-4 px-2 md:px-0">
            <Link href="/" class="bg-white shadow">
                <img src="/images/banner.jpg" class="w-full" />
                <div class="flex flex-col gap-2 p-2 md:p-4">
                    <h3 class="text-xl text-brand-black font-bold">
                        Here will be the post title
                    </h3>
                    <p class="text-brand-gray text-justify">
                        Post summary Lorem ipsum dolor sit sed do ut magna. Post
                        summary Lorem ipsum dolor sit sed do ut magna. Post
                        summary Lorem ipsum dolor sit sed do ut magna. Post
                        summary Lorem ipsum dolor sit sed do ut magna.
                        <span class="underline text-brand-primary"
                            >Read more...</span
                        >
                    </p>
                </div>
            </Link>
            <Link href="/" class="bg-white shadow">
                <img src="/images/banner.jpg" class="w-full" />
                <div class="flex flex-col gap-2 p-2 md:p-4">
                    <h3 class="text-xl text-brand-black font-bold">
                        Here will be the post title
                    </h3>
                    <p class="text-brand-gray text-justify">
                        Post summary Lorem ipsum dolor sit sed do ut magna. Post
                        summary Lorem ipsum dolor sit sed do ut magna. Post
                        summary Lorem ipsum dolor sit sed do ut magna. Post
                        summary Lorem ipsum dolor sit sed do ut magna.
                        <span class="underline text-brand-primary"
                            >Read more...</span
                        >
                    </p>
                </div>
            </Link>
            <Link href="/" class="bg-white shadow">
                <img src="/images/banner.jpg" class="w-full" />
                <div class="flex flex-col gap-2 p-2 md:p-4">
                    <h3 class="text-xl text-brand-black font-bold">
                        Here will be the post title
                    </h3>
                    <p class="text-brand-gray text-justify">
                        Post summary Lorem ipsum dolor sit sed do ut magna. Post
                        summary Lorem ipsum dolor sit sed do ut magna. Post
                        summary Lorem ipsum dolor sit sed do ut magna. Post
                        summary Lorem ipsum dolor sit sed do ut magna.
                        <span class="underline text-brand-primary"
                            >Read more...</span
                        >
                    </p>
                </div>
            </Link>
        </div>
    </section-card>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import SectionCard from "./SectionCard.vue";

export default {
    components: {
        Link,
        SectionCard,
    },
};
</script>
