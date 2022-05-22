<template>
    <Head title="Checklist Field" />

    <app-layout>
        <template #header>
            {{ checklistField.title }}
        </template>

        <div class="mx-auto w-full py-4">
            <add-new-button
                :href="route('checklist-fields.create')"
                class="mb-4"
            />

            <div class="overflow-auto bg-white border">
                <table class="table-auto">
                    <show-table-row heading="id">
                        {{ checklistField.id }}
                    </show-table-row>
                    <show-table-row heading="Field Title">
                        {{ checklistField.name }}
                    </show-table-row>
                    <show-table-row heading="Input Type">
                        <span v-if="checklistField.type == 'radio'">
                            হ্যাঁ/না
                        </span>
                        <span v-if="checklistField.type == 'number'">
                            সংখ্যা
                        </span>
                    </show-table-row>
                    <show-table-row heading="Action">
                        <div
                            class="flex justify-start items-center gap-1 md:gap-2"
                        >
                            <action-button-edit
                                :href="
                                    route(
                                        'checklist-fields.edit',
                                        checklistField.id
                                    )
                                "
                            />
                            <action-button-delete
                                :href="
                                    route(
                                        'checklist-fields.destroy',
                                        checklistField.id
                                    )
                                "
                            />
                        </div>
                    </show-table-row>
                </table>
            </div>

            <div class="w-full mt-4 flex">
                <go-to-list :href="route('checklist-fields.index')" />
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
import ActionButtonDelete from "@/Components/ActionButtonDelete.vue";

export default {
    components: {
        AppLayout,
        Head,
        Link,
        ShowTableRow,
        ActionButtonEdit,
        GoToList,
        AddNewButton,
        ActionButtonDelete,
    },
    props: {
        checklistField: {
            type: Object,
            default: {},
        },
    },
};
</script>
