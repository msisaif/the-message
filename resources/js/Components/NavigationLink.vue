<template>
    <div
        class="w-full relative"
        @mouseenter="open = !open"
        @mouseleave="open = !open"
    >
        <Link
            :href="href"
            class="flex justify-center md:justify-between items-center flex-auto sm:flex-1 px-px md:px-3 py-1 border-2 border-brand-primary text-xs md:text-base"
            :class="classes"
        >
            <div class="">
                <slot />
            </div>
            <svg
                v-if="dropdown"
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
        <div v-if="dropdown && open" class="absolute left-0 top-full z-30 pt-2">
            <div class="grid bg-white min-w-max border border-brand-primary">
                <slot name="dropdownContent" />
            </div>
        </div>
    </div>
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
            default: "#",
        },
        active: {
            type: Boolean,
            default: false,
        },
        dropdown: {
            type: Boolean,
            default: false,
        },
    },

    computed: {
        classes() {
            return this.active
                ? "bg-brand-primary text-white"
                : "text-brand-primary bg-white hover:bg-brand-primary hover:text-white";
        },
    },

    data() {
        return {
            open: false,
        };
    },
};
</script>
