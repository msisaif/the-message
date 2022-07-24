<template>
    <div
        class="absolute left-0 right-0 top-0 bottom-0 aspect-video cursor-pointer"
    >
        <div
            class="absolute left-2/3 right-0 top-0 bottom-0 bg-gray-900/70 cursor-pointer flex flex-col justify-center items-center"
        >
            <div v-if="total" class="text-4xl text-white">{{ total }}</div>
            <svg
                viewBox="0 0 24 24"
                fill="currentColor"
                preserveAspectRatio="xMidYMid meet"
                focusable="false"
                class="h-16 w-16 text-white stroke-1"
            >
                <path
                    d="M22,7H2v1h20V7z M13,12H2v-1h11V12z M13,16H2v-1h11V16z M15,19v-8l7,4L15,19z"
                ></path>
            </svg>
        </div>

        <div
            class="absolute inset-0 bg-brand-primary/95 flex gap-1 justify-center items-center z-50 opacity-0 hover:opacity-100"
        >
            <PlayIcon class="h-8 w-8 text-white" />
            <span class="text-white text-lg">Play All</span>
        </div>
    </div>
</template>

<script>
import { PlayIcon } from "@heroicons/vue/outline";
export default {
    components: {
        PlayIcon,
    },
    props: {
        total: {
            type: Number,
            default: 0,
        },
    },
};
</script>
