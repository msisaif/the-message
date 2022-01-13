<template>
    <Head title="Sura" />

    <app-layout>
        <template #header>
            {{ sura.name }}
        </template>

        <div class="mx-auto w-full py-4">
            <add-new-button :href="route('suras.create')" class="mb-4" />

            <div class="overflow-auto bg-white border">
                <table class="table-auto">
                    <show-table-row heading="Sura Number">
                        {{ sura.suraNumber }}
                    </show-table-row>
                    <show-table-row heading="Juz Number">
                        {{ sura.juzNumber }}
                    </show-table-row>
                    <show-table-row heading="Total Ayah">
                        {{ sura.totalAyah }}
                    </show-table-row>
                    <show-table-row heading="Bismillah">
                        {{ sura.bismillahPre ? "Yes" : "No" }}
                    </show-table-row>
                    <show-table-row heading="Revelation Place">
                        {{ sura.revelationPlace }}
                    </show-table-row>
                    <show-table-row heading="Revelation Order">
                        {{ sura.revelationOrder || "" }}
                    </show-table-row>
                    <show-table-row heading="Arabic">
                        {{ sura.arabic }}
                    </show-table-row>
                    <show-table-row heading="Pronunciation">
                        {{ sura.latin }}
                    </show-table-row>
                    <show-table-row heading="Bengali Meaning">
                        {{ sura.bengali }}
                    </show-table-row>
                    <show-table-row heading="English Meaning">
                        {{ sura.english }}
                    </show-table-row>
                    <show-table-row heading="Action">
                        <div
                            class="flex justify-start items-center gap-1 md:gap-2"
                        >
                            <action-button-edit
                                :href="route('suras.edit', sura.id)"
                            />
                        </div>
                    </show-table-row>
                </table>
            </div>

            <div class="w-full mt-4 flex">
                <go-to-list :href="route('suras.index')" />
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
        sura: {
            type: Object,
            default: {},
        },
    },
};
</script>
