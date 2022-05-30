<template>
    <Head title="Mentor" />

    <app-layout>
        <template #header>
            {{ mentor.name }}
        </template>

        <add-new-button :href="route('mentors.create')" class="mb-2" />

        <div class="overflow-auto bg-white border">
            <table class="table-auto">
                <show-table-row heading="Image">
                    <image-previe-with-save
                        :imageUrl="mentor.imageUrl"
                        option="mentor"
                        :id="mentor.id"
                        ratioClass="aspect-square rounded-full"
                    />
                </show-table-row>

                <show-table-row heading="ID">
                    {{ mentor.id }}
                </show-table-row>

                <show-table-row heading="Name">
                    {{ mentor.name }}
                </show-table-row>

                <show-table-row heading="Designation">
                    {{ mentor.designation }}
                </show-table-row>

                <show-table-row heading="Phone">
                    {{ mentor.phone }}
                </show-table-row>

                <show-table-row heading="Address">
                    {{ mentor.address }}
                </show-table-row>

                <show-table-row heading="Action">
                    <div class="flex justify-start items-center gap-1 md:gap-2">
                        <action-button-edit
                            :href="route('mentors.edit', mentor.id)"
                        />
                    </div>
                </show-table-row>
            </table>
        </div>

        <div class="w-full mt-4 flex">
            <go-to-list :href="route('mentors.index')" />
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
    },
    props: {
        mentor: { type: Object, default: {} },
    },
};
</script>
