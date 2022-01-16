<template>
    <Head title="Ayah" />

    <app-layout>
        <template #header> Ayah List </template>

        <div class="py-4">
            <add-new-button :href="route('ayahs.create')" />

            <data-table
                :collections="ayahs"
                :filters="filters"
                :serialColumn="false"
            >
                <template #head>
                    <th class="py-3 px-2 text-center">Key</th>
                    <th class="py-3 px-2 text-center">Action</th>
                    <th class="py-3 px-2 text-right">Arabic</th>
                </template>
                <template #default="{ item: ayah }">
                    <td class="py-3 px-2 text-center">
                        <span class="font-bold">{{ ayah.key }}</span>
                    </td>
                    <td class="py-2.5 px-2">
                        <div
                            class="flex justify-center items-center gap-1 md:gap-2"
                        >
                            <action-button-show
                                :href="route('ayahs.show', ayah.id)"
                            />
                            <action-button-edit
                                :href="route('ayahs.edit', ayah.id)"
                            />
                        </div>
                    </td>
                    <td
                        class="py-3 px-2 text-right max-w-xs whitespace-pre-wrap"
                    >
                        <div dir="rtl">
                            {{ ayah.text }}
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
        ayahs: {
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
