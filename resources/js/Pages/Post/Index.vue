<template>
    <Head title="Post" />

    <app-layout>
        <template #header> Post List </template>

        <add-new-button :href="route('posts.create')" />

        <data-table :collections="posts" :filters="filters" :dateFilter="true">
            <template #head>
                <th class="py-3 px-2 text-left">ID</th>
                <th class="py-3 px-2 text-left">Author</th>
                <th class="py-3 px-2 text-left">Title</th>
                <th class="py-3 px-2 text-left">Type</th>
                <th class="py-3 px-2 text-center">Action</th>
            </template>
            <template #default="{ item: post }">
                <td class="py-3 px-2 text-left">{{ post.id }}</td>
                <td class="py-3 px-2 text-left">
                    <Link
                        :href="route('users.show', post.userId)"
                        class="text-brand-primary hover:underline"
                    >
                        {{ post.userName }}
                    </Link>
                </td>
                <td class="py-3 px-2 text-left">{{ post.title }}</td>
                <td class="py-3 px-2 text-left">{{ post.valueOfType }}</td>
                <td class="py-2.5 px-2">
                    <div
                        class="flex justify-center items-center gap-1 md:gap-2"
                    >
                        <action-button-show
                            :href="route('posts.show', post.id)"
                        />
                        <action-button-edit
                            :href="route('posts.edit', post.id)"
                        />
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
        posts: { type: Object, default: {} },
        filters: { type: Object, default: {} },
    },
};
</script>
