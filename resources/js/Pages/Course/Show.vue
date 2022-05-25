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
                    <show-table-row heading="Course Number">
                        {{ course.courseNumber }}
                    </show-table-row>
                    <show-table-row heading="Total Ayah">
                        {{ course.totalAyah }}
                    </show-table-row>
                    <show-table-row heading="Bismillah">
                        {{ course.bismillahPre ? "Yes" : "No" }}
                    </show-table-row>
                    <show-table-row heading="Revelation Place">
                        {{ course.revelationPlace }}
                    </show-table-row>
                    <show-table-row heading="Revelation Order">
                        {{ course.revelationOrder || "" }}
                    </show-table-row>
                    <show-table-row heading="Arabic" dir="rtl">
                        {{ course.arabic }}
                    </show-table-row>
                    <show-table-row heading="Bengali Pronunciation">
                        {{ course.bengaliPronunciation }}
                    </show-table-row>
                    <show-table-row heading="Bengali Meaning">
                        {{ course.bengaliMeaning }}
                    </show-table-row>
                    <show-table-row heading="English Pronunciation">
                        {{ course.englishPronunciation }}
                    </show-table-row>
                    <show-table-row heading="English Meaning">
                        {{ course.englishMeaning }}
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
        course: {
            type: Object,
            default: {},
        },
    },
};
</script>
