<template>
    <Head title="Ayah" />

    <app-layout>
        <template #header>
            {{ ayah.name }}
        </template>

        <div class="mx-auto w-full py-4">
            <add-new-button :href="route('ayahs.create')" class="mb-4" />

            <div class="overflow-auto bg-white border">
                <table class="table-auto">
                    <show-table-row heading="Ayah Number">
                        {{ ayah.ayahNumber }}
                    </show-table-row>
                    <show-table-row heading="Key">
                        {{ ayah.key }}
                    </show-table-row>
                    <show-table-row heading="Text">
                        <div dir="rtl">{{ ayah.text }}</div>
                    </show-table-row>
                    <show-table-row heading="Action">
                        <div
                            class="flex justify-start items-center gap-1 md:gap-2"
                        >
                            <action-button-edit
                                :href="route('ayahs.edit', ayah.id)"
                            />
                        </div>
                    </show-table-row>
                </table>
            </div>

            <div class="w-full mt-4 flex">
                <go-to-list :href="route('ayahs.index')" />
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
        ayah: {
            type: Object,
            default: {},
        },
    },
};
</script>
