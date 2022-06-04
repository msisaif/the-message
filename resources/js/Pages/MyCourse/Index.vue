<template>
    <app-layout>
        <div class="mt-6 w-ful grid md:grid-cols-4 gap-4 px-4 md:px-0">
            <Link
                v-for="participant in participants.data"
                :key="participant.id"
                :href="route('course.show', participant.course.id)"
                class="border bg-white"
            >
                <div class="overflow-hidden">
                    <img
                        :src="participant.course.imageUrl"
                        class="w-full aspect-video object-cover hover:scale-110 transition-all ease-in-out"
                    />
                </div>
                <div class="flex flex-col gap-1 p-2 md:p-4">
                    <h3
                        class="shrink grow text-base text-brand-primary font-bold"
                    >
                        {{ participant.course.title }}
                    </h3>
                    <!-- <div class="flex items-center py-2 gap-2">
                        <div class="shrink grow bg-gray-200 rounded-full h-2.5">
                            <div
                                class="bg-green-600 h-2.5 rounded-full w-[0%]"
                            ></div>
                        </div>
                        <div
                            class="shrink-0 grow-0 w-10 flex justify-center items-center"
                        >
                            {{ "0%" }}
                        </div>
                    </div> -->
                    <hr class="my-1 shrink-0 grow-0" />
                    <div
                        class="shrink-0 grow-0 text-brand-black text-base text-justify"
                    >
                        <div class="flex justify-center items-center py-2">
                            <div
                                class="text-sm px-4 py-1 text-brand-primary border border-brand-primary hover:bg-brand-primary hover:text-white"
                            >
                                Continue
                            </div>
                        </div>
                    </div>
                </div>
            </Link>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/App.vue";
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        AppLayout,
        Link,
    },
    props: {
        participants: {
            type: Object,
            default: {},
        },
    },
};
</script>
