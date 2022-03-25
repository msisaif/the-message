<template>
    <Head title="Video" />

    <app-layout>
        <template #header>
            {{ video.title }}
        </template>

        <div class="mx-auto w-full py-4">
            <add-new-button :href="route('videos.create')" class="mb-4" />

            <div class="overflow-auto bg-white border">
                <table class="table-auto">
                    <show-table-row heading="id">
                        {{ video.id }}
                    </show-table-row>
                    <show-table-row heading="Title">
                        {{ video.title }}
                    </show-table-row>
                    <show-table-row heading="Url">
                        <div class="select-all">
                            {{ video.url }}
                        </div>
                    </show-table-row>
                    <show-table-row heading="Play">
                        <div class="w-full aspect-video rounded shadow">
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
                    </show-table-row>
                    <show-table-row heading="Action">
                        <div
                            class="flex justify-start items-center gap-1 md:gap-2"
                        >
                            <action-button-edit
                                :href="route('videos.edit', video.id)"
                            />
                        </div>
                    </show-table-row>
                </table>
            </div>

            <div class="w-full mt-4 flex">
                <go-to-list :href="route('videos.index')" />
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

export default {
    components: {
        AppLayout,
        Head,
        Link,
        ShowTableRow,
        ActionButtonEdit,
        GoToList,
        AddNewButton,
    },
    props: {
        video: {
            type: Object,
            default: {},
        },
    },
};
</script>
