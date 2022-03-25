<template>
    <Head title="Video" />

    <app-layout>
        <template #header> Video List </template>

        <div class="py-4">
            <add-new-button
                v-if="Object.keys(videos.data).length < 30"
                :href="route('videos.create')"
            />

            <data-table
                :collections="videos"
                :filters="filters"
                :serial-column="false"
            >
                <template #head>
                    <th class="py-3 px-2 text-left">Preview</th>
                    <th class="py-3 px-2 text-left">Title</th>
                    <th class="py-3 px-2 text-left">url</th>
                    <th class="py-3 px-2 text-center">Action</th>
                </template>
                <template #default="{ item: video }">
                    <td class="py-1 px-2 text-left">
                        <div class="h-36 aspect-video rounded shadow">
                            <iframe
                                class="w-full h-full"
                                :src="
                                    video.url.replace(
                                        'https://youtu.be/',
                                        'https://www.youtube.com/embed/'
                                    )
                                "
                                title="YouTube video player"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                            ></iframe>
                        </div>
                    </td>
                    <td class="py-3 px-2 text-left">{{ video.title }}</td>
                    <td class="py-3 px-2 text-left select-all">
                        {{ video.url }}
                    </td>
                    <td class="py-2.5 px-2">
                        <div
                            class="flex justify-center items-center gap-1 md:gap-2"
                        >
                            <action-button-show
                                :href="route('videos.show', video.id)"
                            />
                            <action-button-edit
                                :href="route('videos.edit', video.id)"
                            />
                        </div>
                    </td>
                </template>
            </data-table>
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
        videos: {
            type: Object,
            default: {},
        },
        filters: {
            type: Object,
            default: {},
        },
    },
};
</script>
