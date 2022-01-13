<template>
    <Head title="Sura" />

    <app-layout>
        <template #header> Sura List </template>

        <div class="py-4">
            <add-new-button :href="route('suras.create')" />

            <data-table
                :collections="suras"
                :filters="filters"
                :serial-column="false"
            >
                <template #head>
                    <th class="py-3 px-2 text-left">Sura</th>
                    <th class="py-3 px-2 text-left">Juz</th>
                    <th class="py-3 px-2 text-left">Arabic</th>
                    <th class="py-3 px-2 text-left">Pronunciation</th>
                    <th class="py-3 px-2 text-left">English Meaning</th>
                    <th class="py-3 px-2 text-left">Bengali Meaning</th>
                    <th class="py-3 px-2 text-center">Action</th>
                </template>
                <template #default="{ item: sura }">
                    <td class="py-3 px-2 text-left">{{ sura.suraNumber }}</td>
                    <td class="py-3 px-2 text-left">{{ sura.juzNumber }}</td>
                    <td class="py-3 px-2 text-left">{{ sura.arabic }}</td>
                    <td class="py-3 px-2 text-left">{{ sura.latin }}</td>
                    <td class="py-3 px-2 text-left">{{ sura.english }}</td>
                    <td class="py-3 px-2 text-left">{{ sura.bengali }}</td>
                    <td class="py-2.5 px-2">
                        <div
                            class="flex justify-center items-center gap-1 md:gap-2"
                        >
                            <action-button-show
                                :href="route('suras.show', sura.id)"
                            />
                            <action-button-edit
                                :href="route('suras.edit', sura.id)"
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
        suras: {
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
