<template>
    <Link
        :href="href"
        class="flex items-center py-2 px-2 text-base font-medium gap-2"
        :class="classes"
    >
        <slot name="icon">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <slot name="path">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"
                    />
                </slot>
            </svg>
        </slot>
        <slot />
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
                ? "text-white bg-brand-primary focus:outline-none"
                : "text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none";
        },
    },
};
</script>
