<template>
    <Head title="Course" />

    <app-layout>
        <template #header>
            {{ course.name }}
        </template>

        <div class="mx-auto w-full py-4">
            <add-new-button :href="route('courses.create')" class="mb-4" />

            <div class="overflow-auto bg-white border">
                <table class="table-auto">
                    <show-table-row heading="Action">
                        <div
                            class="flex flex-wrap justify-start items-center gap-2 md:gap-4"
                        >
                            <Link
                                :href="route('courses.edit', course.id)"
                                class="flex gap-2 justify-center items-center text-white px-2 h-8 bg-brand-primary"
                            >
                                <PencilAltIcon class="w-5 h-5" />
                                <span>Edit</span>
                            </Link>
                            <Link
                                :href="
                                    route('courses.edit', course.id) +
                                    '?step=content'
                                "
                                class="flex gap-2 justify-center items-center text-white px-2 h-8 bg-brand-primary"
                            >
                                <SwitchHorizontalIcon class="w-5 h-5" />
                                <span>Contents</span>
                            </Link>
                            <Link
                                :href="
                                    route('courses.edit', course.id) +
                                    '?step=publish'
                                "
                                class="flex gap-2 justify-center items-center text-white px-2 h-8"
                                :class="{
                                    'bg-green-600': course.publish,
                                    'bg-rose-600': !course.publish,
                                }"
                            >
                                <StatusOnlineIcon
                                    v-if="course.publish"
                                    class="w-5 h-5"
                                />
                                <StatusOfflineIcon v-else class="w-5 h-5" />
                                <span>Publish</span>
                            </Link>
                            <a
                                v-if="course.publish"
                                target="_blank"
                                :href="route('course.show', course.id)"
                                class="flex gap-1 justify-center items-center text-white px-2 h-8 bg-green-500"
                            >
                                <ExternalLinkIcon class="w-5 h-5" />
                            </a>
                        </div>
                    </show-table-row>
                    <show-table-row heading="Course Title">
                        {{ course.title }}
                    </show-table-row>
                    <show-table-row heading="Amount">
                        {{ course.amount }} TK
                    </show-table-row>
                    <show-table-row heading="Thumbnail">
                        <image-previe-with-save
                            :imageUrl="course.imageUrl"
                            option="course"
                            :id="course.id"
                        />
                    </show-table-row>
                    <show-table-row heading="Intro Video Link">
                        <div class="flex items-center gap-2">
                            <PlayIcon
                                @click="playVideo = course.video"
                                class="w-8 h-8 cursor-pointer text-rose-500"
                            />
                            <span class="select-all">{{ course.video }}</span>
                        </div>
                    </show-table-row>
                    <show-table-row heading="কোর্স ইন্সট্রাক্টর (Mentor)">
                        <div
                            class="grid md:grid-cols-2 gap-2 md:gap-4 max-w-3xl"
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
                                        class="w-12 text-3xl bg-brand-primary/40 text-brand-primary"
                                    />
                                </div>
                                <div class="grow shrink">
                                    <h3 class="text-base font-semibold">
                                        {{ mentor.name }}
                                    </h3>
                                    <p class="text-xs">
                                        {{ mentor.designation }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </show-table-row>
                    <show-table-row heading="Description">
                        <div class="whitespace-pre-wrap">
                            {{ course.description }}
                        </div>
                    </show-table-row>
                </table>
            </div>

            <div class="w-full mt-4 flex">
                <go-to-list :href="route('courses.index')" />
            </div>
        </div>

        <div
            v-if="playVideo"
            @click="playVideo = ''"
            class="fixed bg-gray-500/25 inset-0 flex justify-center items-center z-50"
        >
            <div class="aspect-video w-full max-w-3xl">
                <iframe
                    class="w-full aspect-video"
                    :src="
                        playVideo.replace(
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
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/App.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import ShowTableRow from "@/Components/ShowTableRow.vue";
import ActionButtonEdit from "@/Components/ActionButtonEdit.vue";
import GoToList from "@/Components/GoToList.vue";
import AddNewButton from "@/Components/AddNewButton.vue";
import ImagePrevieWithSave from "@/Components/ImagePrevieWithSave.vue";
import AvatarPhotoView from "@/Components/AvatarPhotoView.vue";
import {
    PlayIcon,
    SwitchHorizontalIcon,
    ExternalLinkIcon,
    PencilAltIcon,
    StatusOnlineIcon,
    StatusOfflineIcon,
} from "@heroicons/vue/outline";

export default {
    components: {
        AppLayout,
        Head,
        Link,
        ShowTableRow,
        ActionButtonEdit,
        GoToList,
        AddNewButton,
        ImagePrevieWithSave,
        AvatarPhotoView,
        PlayIcon,
        SwitchHorizontalIcon,
        ExternalLinkIcon,
        PencilAltIcon,
        StatusOnlineIcon,
        StatusOfflineIcon,
    },
    props: {
        course: {
            type: Object,
            default: {},
        },
    },
    data() {
        return {
            playVideo: "",
        };
    },
};
</script>
