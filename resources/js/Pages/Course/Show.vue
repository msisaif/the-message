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
                    <show-table-row heading="Thumbnail">
                        <image-previe-with-save
                            :imageUrl="course.imageUrl"
                            option="course"
                            :id="course.id"
                        />
                    </show-table-row>
                    <show-table-row heading="Course Title">
                        {{ course.title }}
                    </show-table-row>
                    <show-table-row heading="Amount">
                        {{ course.amount }}
                    </show-table-row>
                    <show-table-row heading="Intro Video Link">
                        {{ course.video }}
                    </show-table-row>
                    <show-table-row heading="Description">
                        <div class="whitespace-pre-wrap">
                            {{ course.description }}
                        </div>
                    </show-table-row>
                    <show-table-row heading="Action">
                        <div
                            class="flex justify-start items-center gap-1 md:gap-2"
                        >
                            <action-button-edit
                                :href="route('courses.edit', course.id)"
                            />
                        </div>
                    </show-table-row>
                </table>
            </div>

            <div class="w-full mt-4 flex">
                <go-to-list :href="route('courses.index')" />
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
        course: {
            type: Object,
            default: {},
        },
    },
};
</script>
