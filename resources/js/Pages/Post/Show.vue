<template>
    <Head title="Post" />

    <app-layout>
        <template #header>
            {{ post.name }}
        </template>

        <div class="py-4">
            <add-new-button :href="route('posts.create')" class="mb-2" />

            <div class="overflow-auto bg-white border">
                <table class="table-auto">
                    <show-table-row heading="Photo">
                        <image-previe-with-save
                            :imageUrl="post.imageUrl"
                            model="post"
                            :id="post.id"
                        />
                    </show-table-row>

                    <show-table-row heading="ID">{{ post.id }}</show-table-row>

                    <show-table-row heading="Author">
                        <Link
                            :href="route('users.show', post.userId)"
                            class="text-brand-primary hover:underline"
                        >
                            {{ post.userName }}
                        </Link>
                    </show-table-row>

                    <show-table-row heading="Title">
                        {{ post.title }}
                    </show-table-row>

                    <show-table-row heading="Description">
                        {{ post.description }}
                    </show-table-row>

                    <show-table-row heading="Body">
                        <div class="whitespace-pre-wrap">
                            {{ post.body }}
                        </div>
                    </show-table-row>

                    <show-table-row heading="Action">
                        <div
                            class="flex justify-start items-center gap-1 md:gap-2"
                        >
                            <action-button-edit
                                :href="route('posts.edit', post.id)"
                            />
                        </div>
                    </show-table-row>
                </table>
            </div>

            <div class="w-full mt-4 flex">
                <go-to-list :href="route('posts.index')" />
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
import ImagePrevieWithSave from "@/Components/ImagePrevieWithSave.vue";

export default {
    components: {
        AppLayout,
        Head,
        Link,
        ShowTableRow,
        ActionButtonEdit,
        GoToList,
        AddNewButton,
        ImagePrevieWithSave,
    },
    props: {
        post: { type: Object, default: {} },
    },
};
</script>
