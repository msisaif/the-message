<template>
    <Head title="Sura" />

    <app-layout>
        <template #header> Sura List </template>

        <div class="py-4">
            <add-new-button :href="route('classifications.create')" />

            <data-table
                :collections="classifications"
                :filters="filters"
                :serial-column="false"
            >
                <template #head>
                    <th class="py-3 px-2 text-left">Sura</th>
                    <th class="py-3 px-2 text-left">Topic</th>
                    <th class="py-3 px-2 text-center">Ayah</th>
                    <th class="py-3 px-2 text-center">Action</th>
                </template>
                <template #default="{ item: sura }">
                    <td class="py-3 px-2 text-left">
                        {{ sura.suraName }} - {{ sura.suraNumber }}
                    </td>
                    <td class="py-3 px-2 text-left">
                        {{ sura.topic }}
                    </td>
                    <td class="py-3 px-2 text-center">
                        {{ sura.ayah }}
                    </td>
                    <td class="py-2.5 px-2">
                        <div
                            class="flex justify-center items-center gap-1 md:gap-2"
                        >
                            <action-button-show
                                :href="route('classifications.show', sura.id)"
                            />
                            <action-button-edit
                                :href="route('classifications.edit', sura.id)"
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
        classifications: {
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
