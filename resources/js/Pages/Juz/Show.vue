<template>
    <Head title="Juz" />

    <app-layout>
        <template #header>
            {{ juz.name }}
        </template>

        <div class="mx-auto w-full py-4">
            <add-new-button :href="route('juzs.create')" class="mb-4" />

            <div class="overflow-auto bg-white border">
                <table class="table-auto">
                    <show-table-row heading="Juz Number">
                        {{ juz.juzNumber }}
                    </show-table-row>
                    <show-table-row heading="Juz Name">
                        {{ juz.name }}
                    </show-table-row>
                    <show-table-row heading="First Ayah">
                        {{ juz.firstAyah }}
                    </show-table-row>
                    <show-table-row heading="Last Ayah">
                        {{ juz.lastAyah }}
                    </show-table-row>
                    <show-table-row heading="Total Ayah">
                        {{ juz.totalAyah }}
                    </show-table-row>
                    <show-table-row heading="Action">
                        <div
                            class="flex justify-start items-center gap-1 md:gap-2"
                        >
                            <action-button-edit
                                :href="route('juzs.edit', juz.id)"
                            />
                        </div>
                    </show-table-row>
                </table>
            </div>

            <div class="w-full mt-4 flex">
                <go-to-list :href="route('juzs.index')" />
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
        juz: {
            type: Object,
            default: {},
        },
    },
};
</script>
