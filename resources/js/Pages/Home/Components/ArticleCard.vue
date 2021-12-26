<template>
    <Link :href="href" class="bg-white shadow">
        <img :src="src" class="w-full" />
        <div class="flex flex-col gap-2 p-2 md:p-4">
            <h3 class="text-lg text-brand-black font-bold">
                {{ title }}
            </h3>
            <p class="text-brand-gray text-sm text-justify">
                {{ summary }}
                <span class="underline text-brand-primary">Read More</span>
            </p>
        </div>
    </Link>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        Link,
    },
    props: {
        href: {
            type: String,
            default: "",
        },
        src: {
            type: String,
            default: "",
        },
        title: {
            type: String,
            default: "",
        },
        summary: {
            type: String,
            default: "",
        },
    },
};
</script>
