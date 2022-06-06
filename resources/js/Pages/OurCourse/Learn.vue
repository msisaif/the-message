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
                            class="absolute inset-0 bg-gray-300 -z-10 flex justify-center items-center text-gray-700 text-3xl text-center"
                        >
                            {{ course.message }}
                        </div>
                        <YouTube
                            v-if="currentContent.type === 1"
                            :src="currentContent.link"
                            :vars="parameters"
                            @ready="onReady"
                            @stateChange="onStateChange"
                            @playbackQualityChange="onPlaybackQualityChange"
                            @playbackRateChange="onPlaybackRateChange"
                            @error="onError"
                            @apiChange="onApiChange"
                            width="100%"
                            height="100%"
                            class="w-full aspect-video"
                        ></YouTube>
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
import YouTube from "vue3-youtube";

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
        YouTube,
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
            parameters: {
                autoplay: 1,
                enablejsapi: 1,
            },
            countDown: 0,
            duration: 0,
        };
    },
    methods: {
        countDownTimer(time = null) {
            if (time) {
                this.countDown = time;
            }

            if (this.countDown > 0) {
                setTimeout(() => {
                    this.countDown -= 1;
                    this.countDownTimer();
                }, 1000);
            }
        },
        onReady(event) {
            console.log("\o/ we are watching!!!");
            const player = event.target;
            player.playVideo();
            this.duration = player.getDuration();
            this.countDownTimer(
                Math.floor(player.getDuration() - player.getCurrentTime())
            );
        },
        onStateChange(event) {
            console.log("onStateChange", event.target);
            const player = event.target;
            this.countDown = Math.floor(
                player.getDuration() - player.getCurrentTime()
            );
        },
        onPlaybackQualityChange(event) {
            console.log("onPlaybackQualityChange", event.target);
        },
        onPlaybackRateChange(event) {
            console.log("onPlaybackRateChange", event.target);
        },
        onError(event) {
            console.log("onError", event.target);
        },
        onApiChange(event) {
            console.log("onApiChange", event.target);
        },
        secondToMinute(second) {
            let minute = Math.floor(second / 60);

            second = `${second % 60}`;

            return `${minute}:${second.padStart(2, "0")}`;
        },
    },
};
</script>
