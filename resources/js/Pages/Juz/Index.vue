<template>
    <Head title="Juz" />

    <app-layout>
        <template #header> Juz List </template>

        <div class="py-4">
            <add-new-button
                v-if="Object.keys(juzs.data).length < 30"
                :href="route('juzs.create')"
            />

            <data-table
                :collections="juzs"
                :filters="filters"
                :serial-column="false"
            >
                <template #head>
                    <th class="py-3 px-2 text-left">Juz Number</th>
                    <th class="py-3 px-2 text-left">Juz Name</th>
                    <th class="py-3 px-2 text-left">First Ayah</th>
                    <th class="py-3 px-2 text-left">Last Ayah</th>
                    <th class="py-3 px-2 text-left">Total Ayah</th>
                    <th class="py-3 px-2 text-center">Action</th>
                </template>
                <template #default="{ item: juz }">
                    <td class="py-3 px-2 text-left">{{ juz.juzNumber }}</td>
                    <td class="py-3 px-2 text-left">{{ juz.name }}</td>
                    <td class="py-3 px-2 text-left">{{ juz.firstAyah }}</td>
                    <td class="py-3 px-2 text-left">{{ juz.lastAyah }}</td>
                    <td class="py-3 px-2 text-left">{{ juz.totalAyah }}</td>
                    <td class="py-2.5 px-2">
                        <div
                            class="flex justify-center items-center gap-1 md:gap-2"
                        >
                            <action-button-show
                                :href="route('juzs.show', juz.id)"
                            />
                            <action-button-edit
                                :href="route('juzs.edit', juz.id)"
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
        juzs: {
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
