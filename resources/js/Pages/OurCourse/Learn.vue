<template>
    <app-layout>
        <div class="max-w-7xl md:mx-auto px-2">
            <h1 class="text-brand-primary my-4 text-lg md:text-2xl font-bold">
                {{ course.title }}
            </h1>
            <div class="flex flex-col md:flex-row gap-4 justify-between">
                <div class="shrink grow">
                    <div class="w-full aspect-video border relative">
                        <div
                            class="absolute inset-0 bg-gray-300 -z-10 flex justify-center items-center text-gray-400 text-3xl"
                        >
                            Not Available
                        </div>
                        <iframe
                            v-if="currentContent.type === 1"
                            class="w-full aspect-video border"
                            :src="
                                currentContent.link.replace(
                                    'https://youtu.be/',
                                    'https://www.youtube.com/embed/'
                                )
                            "
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                        ></iframe>
                        <iframe
                            v-if="!currentContent.id"
                            class="w-full aspect-video"
                            :src="
                                course.video.replace(
                                    'https://youtu.be/',
                                    'https://www.youtube.com/embed/'
                                )
                            "
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                        ></iframe>
                    </div>
                </div>
                <div class="w-full shrink-0 grow-0 max-w-sm">
                    <div v-if="Object.keys(course.topics).length" class="mb-6">
                        <div
                            class="border border-gray-300 divide-gray-300 divide-y px-3"
                        >
                            <div
                                v-for="topic in course.topics"
                                :key="topic.id"
                                class="py-4"
                            >
                                <div class="font-semibold">
                                    {{ topic.title }}
                                </div>
                                <div
                                    v-if="Object.keys(topic.contents).length"
                                    class="space-y-4 pt-2 px-1"
                                >
                                    <div
                                        v-for="content in topic.contents"
                                        :key="content.id"
                                        class="hover:bg-gray-200"
                                        :class="{
                                            'bg-gray-200':
                                                content.id == currentContent.id,
                                        }"
                                    >
                                        <Link
                                            v-if="content.type === 1"
                                            :href="
                                                route('course.learn', [
                                                    course.id,
                                                    content.id,
                                                ])
                                            "
                                            class="flex items-center gap-2"
                                        >
                                            <PlayIcon
                                                class="w-6 text-rose-500"
                                            />
                                            <div class="grow shrink">
                                                {{ content.title }}
                                            </div>
                                            <CheckCircleIcon
                                                v-if="content.link"
                                                class="w-6 text-gray-500"
                                            />
                                        </Link>
                                        <div
                                            v-if="content.type === 2"
                                            class="flex items-center gap-2"
                                        >
                                            <DocumentTextIcon
                                                class="w-6 text-blue-600"
                                            />
                                            <div class="grow shrink">
                                                {{ content.title }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/App.vue";
import SectionCard from "@/Components/SectionCard.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import AvatarPhotoView from "@/Components/AvatarPhotoView.vue";
import {
    PlayIcon,
    DocumentTextIcon,
    CheckCircleIcon,
} from "@heroicons/vue/outline";

export default {
    components: {
        AppLayout,
        SectionCard,
        Head,
        Link,
        AvatarPhotoView,
        PlayIcon,
        DocumentTextIcon,
        CheckCircleIcon,
    },
    props: {
        course: {
            type: Object,
            default: {},
        },
        currentContent: {
            type: Object,
            default: {},
        },
    },
    data() {
        return {
            playVideo: false,
        };
    },
};
</script>
