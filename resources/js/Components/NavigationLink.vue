<template>
    <Link
        :href="href"
        class="
            flex
            justify-center
            md:justify-between
            items-center
            flex-auto
            sm:flex-1
            md:px-3
            py-1
            border border-brand-secondary
            text-xs
            md:text-base
        "
        :class="classes"
    >
        <div class="">
            <slot />
        </div>
        <svg
            class="w-3.5 hidden md:block"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 14.3 8.176"
        >
            <path
                d="M13.34,16.958l5.407-5.411a1.018,1.018,0,0,1,1.443,0,1.03,1.03,0,0,1,0,1.448l-6.127,6.131a1.02,1.02,0,0,1-1.409.03L6.486,13a1.022,1.022,0,0,1,1.443-1.448Z"
                transform="translate(-6.188 -11.246)"
                fill="currentColor"
            />
        </svg>
    </Link>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        Link,
    },

    props: ["href", "active"],

    computed: {
        classes() {
            return this.active
                ? "bg-brand-secondary text-white"
                : "text-brand-secondary bg-white hover:bg-brand-secondary hover:text-white";
        },
    },
};
</script>
