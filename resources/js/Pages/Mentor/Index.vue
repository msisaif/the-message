<template>
    <Head title="Mentor" />

    <app-layout>
        <template #header> Mentor List </template>

        <div class="py-4">
            <add-new-button :href="route('mentors.create')" />

            <data-table
                :collections="mentors"
                :filters="filters"
                :dateFilter="true"
            >
                <template #head>
                    <th class="py-3 px-2 text-left">ID</th>
                    <th class="py-3 px-2 text-left">Name</th>
                    <th class="py-3 px-2 text-left">Designation</th>
                    <th class="py-3 px-2 text-left">Phone</th>
                    <th class="py-3 px-2 text-center">Action</th>
                </template>
                <template #default="{ item: mentor }">
                    <td class="py-3 px-2 text-left">{{ mentor.id }}</td>
                    <td class="py-3 px-2 text-left">
                        <div class="flex gap-4 items-center">
                            <avatar-photo-view
                                :imageUrl="mentor.imageUrl"
                                :firstLatter="mentor.firstLatter"
                                class="w-10 text-xl bg-brand-black text-white"
                            />
                            <div class="grow shrink">{{ mentor.name }}</div>
                        </div>
                    </td>
                    <td class="py-3 px-2 text-left">
                        {{ mentor.designation }}
                    </td>
                    <td class="py-3 px-2 text-left">{{ mentor.phone }}</td>
                    <td class="py-2.5 px-2">
                        <div
                            class="flex justify-center items-center gap-1 md:gap-2"
                        >
                            <action-button-show
                                :href="route('mentors.show', mentor.id)"
                            />
                            <action-button-edit
                                :href="route('mentors.edit', mentor.id)"
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
import AvatarPhotoView from "@/Components/AvatarPhotoView.vue";

export default {
    components: {
        AppLayout,
        DataTable,
        Head,
        Link,
        ActionButtonShow,
        ActionButtonEdit,
        AddNewButton,
        AvatarPhotoView,
    },
    props: {
        mentors: { type: Object, default: {} },
        filters: { type: Object, default: {} },
    },
};
</script>
