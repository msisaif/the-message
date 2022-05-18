<template>
    <Head title="Checklist Field" />

    <app-layout>
        <template #header> Checklist Field List </template>

        <div class="py-4">
            <add-new-button :href="route('checklist-fields.create')" />
            <data-table
                :collections="checklistFields"
                :filters="filters"
                :serial-column="false"
            >
                <template #head>
                    <th class="py-3 px-2 text-left">Field Title</th>
                    <th class="py-3 px-2 text-center">Input Type</th>
                    <th class="py-3 px-2 text-center">Action</th>
                </template>
                <template #default="{ item: checklistField }">
                    <td class="py-3 px-2 text-left">
                        {{ checklistField.name }}
                    </td>
                    <td class="py-3 px-2 text-center">
                        <span v-if="checklistField.type == 'radio'">
                            হ্যাঁ/না
                        </span>
                        <span v-if="checklistField.type == 'number'">
                            সংখ্যা
                        </span>
                    </td>
                    <td class="py-2.5 px-2">
                        <div
                            class="flex justify-center items-center gap-1 md:gap-2"
                        >
                            <action-button-show
                                :href="
                                    route(
                                        'checklist-fields.show',
                                        checklistField.id
                                    )
                                "
                            />
                            <action-button-edit
                                :href="
                                    route(
                                        'checklist-fields.edit',
                                        checklistField.id
                                    )
                                "
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
        checklistFields: {
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
