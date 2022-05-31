<template>
    <Head title="Course" />

    <app-layout>
        <template #header> Course List </template>

        <div class="py-4">
            <add-new-button :href="route('courses.create')" />
            <data-table
                :collections="courses"
                :filters="filters"
                :serial-column="false"
            >
                <template #head>
                    <th class="py-3 px-2 text-left">id</th>
                    <th class="py-3 px-2 text-left"></th>
                    <th class="py-3 px-2 text-left">title</th>
                    <th class="py-3 px-2 text-right">amount</th>
                    <th class="py-3 px-2 text-center">Action</th>
                </template>
                <template #default="{ item: course }">
                    <td class="py-3 px-2 text-left">
                        {{ course.id }}
                    </td>
                    <td class="py-3 px-2 text-left">
                        <div
                            class="w-32 aspect-video cursor-pointer relative"
                            @click="playVideo = course.video"
                        >
                            <img
                                :src="course.imageUrl"
                                class="w-full h-full object-cover"
                            />
                            <div
                                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 h-10 w-10"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="absolute w-full text-white/50 animate-ping stroke-1"
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
                                    class="absolute w-full text-white stroke-1"
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
                        </div>
                    </td>
                    <td class="py-3 px-2 text-left">
                        {{ course.title }}
                    </td>
                    <td class="py-3 px-2 text-right">
                        {{ course.amount }}
                    </td>
                    <td class="py-2.5 px-2">
                        <div
                            class="flex justify-center items-center gap-1 md:gap-2"
                        >
                            <action-button-show
                                :href="route('courses.show', course.id)"
                            />
                            <action-button-edit
                                :href="route('courses.edit', course.id)"
                            />
                        </div>
                    </td>
                </template>
            </data-table>
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
import DataTable from "@/Components/DataTable.vue";
import ActionButtonShow from "@/Components/ActionButtonShow.vue";
import ActionButtonEdit from "@/Components/ActionButtonEdit.vue";
import AddNewButton from "@/Components/AddNewButton.vue";

export default {
    components: {
        AppLayout,
        DataTable,
        Head,
        Link,
        ActionButtonShow,
        ActionButtonEdit,
        AddNewButton,
    },
    props: {
        courses: {
            type: Object,
            default: {},
        },
        filters: {
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
