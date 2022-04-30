<template>
    <div class="w-full max-w-md mx-auto p-4 bg-white border shadow">
        <ValidationErrors class="mb-4" />

        <form @submit.prevent="submit" class="">
            <div class="mb-4">
                <Label value="Title" />
                <Input
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.title"
                    required
                    autofocus
                />
            </div>

            <!-- <div class="mb-4">
                <Label value="Description" />
                <textarea
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm resize-y"
                    v-model="form.description"
                    rows="3"
                    required
                ></textarea>
            </div> -->

            <div class="mb-4">
                <Label for="body" value="Body" />
                <textarea
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm resize-y"
                    v-model="form.body"
                    rows="10"
                    required
                ></textarea>
            </div>

            <hr class="w-full my-4" />

            <div class="flex items-center justify-between">
                <div class="">
                    <go-to-list :href="route('posts.index')" />
                </div>
                <Button
                    class=""
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    {{ buttonValue }}
                </Button>
            </div>
        </form>
    </div>
</template>

<script>
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";
import Label from "@/Components/Label.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import GoToList from "@/Components/GoToList.vue";
import Select from "@/Components/Select.vue";

export default {
    components: {
        Button,
        Input,
        Label,
        ValidationErrors,
        GoToList,
        Select,
    },

    props: {
        moduleAction: String,
        buttonValue: {
            type: String,
            default: "Submit",
        },
        data: {
            type: Object,
            default: {},
        },
    },

    data() {
        return {
            form: this.$inertia.form({
                title: this.data.post.title,
                description: this.data.post.description,
                body: this.data.post.body,
            }),
        };
    },

    methods: {
        submit() {
            if (this.moduleAction == "store") {
                return this.form.post(this.route("posts.store"));
            }

            if (this.moduleAction == "update") {
                return this.form.put(
                    this.route("posts.update", this.data.post.id)
                );
            }
        },
    },
};
</script>
