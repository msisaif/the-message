<template>
    <Head title="Classification" />

    <app-layout>
        <template #header>
            {{ classification.suraName }}
        </template>

        <div class="mx-auto w-full py-4">
            <add-new-button
                :href="route('classifications.create')"
                class="mb-4"
            />

            <div class="overflow-auto bg-white border">
                <table class="table-auto">
                    <show-table-row heading="Sura">
                        {{ classification.suraName }}
                    </show-table-row>
                    <show-table-row heading="Ayah">
                        {{ classification.ayah }}
                    </show-table-row>
                    <show-table-row heading="Topic">
                        {{ classification.topic }}
                    </show-table-row>
                    <show-table-row heading="Action">
                        <div
                            class="flex justify-start items-center gap-1 md:gap-2"
                        >
                            <action-button-edit
                                :href="
                                    route(
                                        'classifications.edit',
                                        classification.id
                                    )
                                "
                            />
                        </div>
                    </show-table-row>
                </table>
            </div>

            <div class="w-full mt-4 flex">
                <go-to-list :href="route('classifications.index')" />
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
        classification: {
            type: Object,
            default: {},
        },
    },
};
</script>
