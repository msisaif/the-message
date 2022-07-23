<template>
    <Head title="Playlist" />

    <app-layout>
        <template #header>
            {{ playlist.title }}
        </template>

        <div class="mx-auto w-full py-4">
            <add-new-button :href="route('playlists.create')" class="mb-4" />

            <div class="overflow-auto bg-white border">
                <table class="table-auto">
                    <show-table-row heading="Playlist Video">
                        <div class="flex justify-start items-center">
                            <Link
                                :href="
                                    route('playlists.edit', playlist.id) +
                                    '?step=videos'
                                "
                                class="flex gap-2 justify-center items-center text-white px-2 h-8 bg-brand-primary"
                            >
                                <SwitchHorizontalIcon class="w-5 h-5" />
                                <span>Playlist Video</span>
                            </Link>
                        </div>
                    </show-table-row>
                    <show-table-row heading="Thumbnail">
                        <image-previe-with-save
                            :imageUrl="playlist.imageUrl"
                            option="playlist"
                            :id="playlist.id"
                        />
                    </show-table-row>
                    <show-table-row heading="id">
                        {{ playlist.id }}
                    </show-table-row>
                    <show-table-row heading="Title">
                        {{ playlist.title }}
                    </show-table-row>
                    <show-table-row heading="Type">
                        <div class="select-all">
                            {{ playlist.typeText }}
                        </div>
                    </show-table-row>
                    <show-table-row heading="Action">
                        <div
                            class="flex justify-start items-center gap-1 md:gap-2"
                        >
                            <action-button-edit
                                :href="route('playlists.edit', playlist.id)"
                            />
                        </div>
                    </show-table-row>
                </table>
            </div>

            <div class="w-full mt-4 flex">
                <go-to-list :href="route('playlists.index')" />
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
import { SwitchHorizontalIcon } from "@heroicons/vue/outline";

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
        SwitchHorizontalIcon,
    },
    props: {
        playlist: {
            type: Object,
            default: {},
        },
    },
};
</script>
