<template>
    <Head title="Admin" />

    <app-layout>
        <template #header>
            {{ admin.name }}
        </template>

        <add-new-button :href="route('admins.create')" class="mb-2" />

        <div class="overflow-auto">
            <table class="table-auto bg-white border shadow">
                <show-table-row heading="Image">
                    <image-previe-with-save
                        :imageUrl="admin.imageUrl"
                        option="user"
                        :id="admin.id"
                        ratioClass="aspect-square"
                    />
                </show-table-row>
                <show-table-row heading="ID">
                    {{ admin.id }}
                </show-table-row>
                <show-table-row heading="Name">
                    {{ admin.name }}
                </show-table-row>
                <show-table-row heading="Email">
                    {{ admin.email }}
                </show-table-row>
                <show-table-row heading="Phone">
                    {{ admin.phone }}
                </show-table-row>
                <show-table-row heading="Type">
                    {{ admin.typeName }}
                </show-table-row>
                <show-table-row heading="Action">
                    <div class="flex justify-start items-center gap-1 md:gap-2">
                        <action-button-edit
                            :href="route('admins.edit', admin.id)"
                        />
                    </div>
                </show-table-row>
            </table>
        </div>
        <div class="w-full mt-4 flex">
            <go-to-list :href="route('admins.index')" />
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/App.vue";
import { Head } from "@inertiajs/inertia-vue3";
import ShowTableRow from "@/Components/ShowTableRow.vue";
import ActionButtonEdit from "@/Components/ActionButtonEdit.vue";
import GoToList from "@/Components/GoToList.vue";
import AddNewButton from "@/Components/AddNewButton.vue";
import ImagePrevieWithSave from '@/Components/ImagePrevieWithSave.vue';

export default {
    components: {
        AppLayout,
        Head,
        ShowTableRow,
        ActionButtonEdit,
        GoToList,
        AddNewButton,
        ImagePrevieWithSave,
    },
    props: {
        admin: {
            type: Object,
            default: {},
        },
    },
};
</script>
