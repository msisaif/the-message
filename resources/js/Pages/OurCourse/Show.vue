<template>
    <app-layout>
        <div class="max-w-7xl md:mx-auto px-2 md:px-0">
            <h1 class="text-brand-primary my-4 text-lg md:text-2xl font-bold">
                {{ course.title }}
            </h1>
            <div
                class="flex flex-col-reverse md:flex-row gap-4 justify-between"
            >
                <div class="shrink grow">
                    <div v-if="course.description" class="mb-6">
                        <h3 class="font-semibold text-lg py-2">
                            কোর্স সম্পর্কে
                        </h3>
                        <div class="border border-gray-300 p-4">
                            <div
                                v-html="course.description"
                                class="leading-loose text-justify"
                            ></div>
                            <!-- <div class="flex justify-center items-center -mb-8">
                                <span
                                    class="px-4 py-1 border bg-gray-300 font-medium text-sm cursor-pointer"
                                >
                                    আরো পড়ুন
                                </span>
                            </div> -->
                        </div>
                    </div>
                    <div v-if="Object.keys(course.topics).length" class="mb-6">
                        <h3 class="font-semibold text-lg py-2">
                            কোর্স সিলেবাস
                        </h3>
                        <div
                            class="border border-gray-300 divide-gray-300 divide-y px-4"
                        >
                            <div
                                v-for="topic in course.topics"
                                :key="topic.id"
                                class="py-4"
                            >
                                <div class="font-semibold">
                                    {{ topic.title }}
                                </div>
                                <div class="space-y-2 pt-2">
                                    <div
                                        v-for="content in topic.contents"
                                        :key="content.id"
                                        class="space-y-2"
                                    >
                                        <div
                                            v-if="content.type === 1"
                                            class="flex items-center gap-2"
                                        >
                                            <PlayIcon
                                                class="w-6 text-rose-500"
                                            />
                                            <div class="grow shrink">
                                                {{ content.title }}
                                            </div>
                                        </div>
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
                <div class="w-full shrink-0 grow-0 max-w-sm">
                    <div class="grid border mb-6">
                        <div class="relative">
                            <div class="relative">
                                <div
                                    class="w-full aspect-video overflow-hidden shadow"
                                >
                                    <img
                                        class="w-full h-full object-cover"
                                        :src="course.imageUrl"
                                        @error="$defaultImage"
                                    />
                                </div>
                            </div>

                            <div
                                @click="playVideo = !playVideo"
                                class="absolute left-0 right-0 top-0 aspect-video bg-brand-primary/10 cursor-pointer flex justify-center items-center"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="absolute h-20 w-20 text-white/50 animate-ping stroke-1"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="absolute h-20 w-20 text-white stroke-1"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>
                            </div>

                            <div
                                v-if="playVideo"
                                @click="playVideo = !playVideo"
                                class="fixed bg-gray-500/25 inset-0 flex justify-center items-center z-50"
                            >
                                <div class="aspect-video w-full max-w-3xl">
                                    <iframe
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
                        </div>
                        <div
                            class="flex justify-between items-center p-2 md:p-4"
                        >
                            <div
                                class="px-3 py-1 text-brand-primary bg-brand-primary/10 font-semibold flex justify-center items-center gap-2"
                            >
                                <span>৳</span>
                                <span>
                                    {{ course.amount ? course.amount : "ফ্রি" }}
                                </span>
                            </div>
                            <Link
                                :href="route('course.enroll', course.id)"
                                class="text-sm px-4 py-1 text-brand-primary border border-brand-primary hover:bg-brand-primary hover:text-white"
                            >
                                {{
                                    course.amount
                                        ? "কোর্সটি কিনুন"
                                        : "শুরু করুন"
                                }}
                            </Link>
                        </div>
                    </div>
                    <div v-if="Object.keys(course.mentors).length" class="mb-6">
                        <h3 class="font-semibold text-lg py-2">
                            কোর্স ইন্সট্রাক্টর
                        </h3>
                        <div
                            class="grid gap-4 border border-gray-300 p-2 md:p-4 md:py-8"
                        >
                            <div
                                v-for="mentor in course.mentors"
                                :key="mentor.id"
                                class="flex gap-2 md:gap-4"
                            >
                                <div class="grow-0 shrink-0">
                                    <avatar-photo-view
                                        :imageUrl="mentor.imageUrl"
                                        :firstLatter="mentor.firstLatter"
                                        class="w-12 text-3xl bg-brand-dark text-white"
                                    />
                                </div>
                                <div class="grow shrink">
                                    <h5
                                        class="text-base md:text-lg font-semibold text-brand-black"
                                    >
                                        {{ mentor.name }}
                                    </h5>
                                    <p
                                        class="text-xs md:text-sm text-brand-dark"
                                    >
                                        {{ mentor.designation }}
                                    </p>
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
import { PlayIcon, DocumentTextIcon } from "@heroicons/vue/outline";
import AvatarPhotoView from "@/Components/AvatarPhotoView.vue";

export default {
    components: {
        AppLayout,
        SectionCard,
        Head,
        Link,
        AvatarPhotoView,
        PlayIcon,
        DocumentTextIcon,
    },
    props: {
        course: {
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
