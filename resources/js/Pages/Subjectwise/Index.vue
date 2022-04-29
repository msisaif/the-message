<template>
    <Head title="বিষয়ভিত্তিক আয়াত হাদিস" />

    <app-layout>
        <template #header> বিষয়ভিত্তিক আয়াত হাদিস </template>

        <div class="py-4">
            <add-new-button :href="route('subjectwises.create')" />

            <data-table
                :collections="subjectwises"
                :filters="filters"
                :serial-column="false"
            >
                <template #head>
                    <th class="py-3 px-2 text-left">Category</th>
                    <th class="py-3 px-2 text-left">Type</th>
                    <th class="py-3 px-2 text-left">Arabic</th>
                    <th class="py-3 px-2 text-left">আনুবাদ</th>
                    <th class="py-3 px-2 text-center">Action</th>
                </template>
                <template #default="{ item: subjectwise }">
                    <td class="py-3 px-2 text-left">
                        {{ subjectwise.categoryName }}
                    </td>
                    <td class="py-3 px-2 text-left max-w-xs">
                        {{ subjectwise.typeText }}
                    </td>
                    <td class="py-3 px-2 text-left max-w-xs" dir="rtl">
                        {{ subjectwise.arabic }}
                    </td>
                    <td class="py-3 px-2 text-left max-w-xs">
                        {{ subjectwise.bengali }}
                    </td>
                    <td class="py-2.5 px-2">
                        <div
                            class="flex justify-center items-center gap-1 md:gap-2"
                        >
                            <action-button-show
                                :href="
                                    route('subjectwises.show', subjectwise.id)
                                "
                            />
                            <action-button-edit
                                :href="
                                    route('subjectwises.edit', subjectwise.id)
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
        subjectwises: {
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
