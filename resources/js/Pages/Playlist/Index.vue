<template>
    <Head title="Playlist" />

    <app-layout>
        <template #header> Playlist List </template>

        <div class="py-4">
            <add-new-button :href="route('playlists.create')" />

            <data-table
                :collections="playlists"
                :filters="filters"
                :serial-column="false"
            >
                <template #head>
                    <th class="py-3 px-2 text-left">Thumbnail</th>
                    <th class="py-3 px-2 text-left">Title</th>
                    <th class="py-3 px-2 text-left">Type</th>
                    <th class="py-3 px-2 text-center">Action</th>
                </template>
                <template #default="{ item: playlist }">
                    <td class="py-3 px-2 text-left">
                        <div class="h-20 aspect-video border w-auto overflow-hidden">
                            <img
                                :src="playlist.imageUrl"
                                class="w-full h-full object-cover"
                            />
                        </div>
                    </td>
                    <td class="py-3 px-2 text-left">{{ playlist.title }}</td>
                    <td class="py-3 px-2 text-left select-all">
                        {{ playlist.typeText }}
                    </td>
                    <td class="py-2.5 px-2">
                        <div
                            class="flex justify-center items-center gap-1 md:gap-2"
                        >
                            <action-button-show
                                :href="route('playlists.show', playlist.id)"
                            />
                            <action-button-edit
                                :href="route('playlists.edit', playlist.id)"
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
        playlists: {
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
