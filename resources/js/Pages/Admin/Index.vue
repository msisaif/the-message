<template>
    <Head title="Admin" />

    <app-layout>
        <template #header>
            Admin List
        </template>

        <add-new-button :href="route('admins.create')" />

        <data-table :collections="admins" :filters="filters" :dateFilter="true">
            <template #head>
                <th class="py-3 px-2 text-left">ID</th>
                <th class="py-3 px-2 text-left">Name</th>
                <th class="py-3 px-2 text-left">Email</th>
                <th class="py-3 px-2 text-left">Phone</th>
                <th class="py-3 px-2 text-center">Action</th>
            </template>
            <template #default="{ item: admin }">
                <td class="py-3 px-2 text-left">{{ admin.id }}</td>
                <td class="py-3 px-2 text-left">{{ admin.name }}</td>
                <td class="py-3 px-2 text-left">{{ admin.email }}</td>
                <td class="py-3 px-2 text-left">{{ admin.phone }}</td>
                <td class="py-2.5 px-2">
                    <div class="flex justify-center items-center gap-1 md:gap-2">
                        <action-button-show :href="route('admins.show', admin.id)" />
                        <action-button-edit :href="route('admins.edit', admin.id)" />
                    </div>
                </td>
            </template>
        </data-table>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/App.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import DataTable from "@/Components/DataTable.vue";
import ActionButtonShow from "@/Components/ActionButtonShow.vue";
import ActionButtonEdit from "@/Components/ActionButtonEdit.vue";
import AddNewButton from '@/Components/AddNewButton.vue';

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
        admins: { type: Object, default: {} },
        filters: { type: Object, default: {} },
    },
};
</script>
