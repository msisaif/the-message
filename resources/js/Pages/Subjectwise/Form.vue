<template>
    <div class="w-full max-w-3xl mx-auto p-4 bg-white border shadow">
        <ValidationErrors class="mb-4" />

        <form @submit.prevent="submit" class="">
            <div class="grid md:grid-cols-2 gap-4">
                <div class="">
                    <Label value="Category" />
                    <Select
                        class="mt-1 block w-full"
                        v-model="form.category_id"
                        required
                    >
                        <option value="">- Select -</option>
                        <option
                            v-for="category in data.categories"
                            :key="category.id"
                            :value="category.id"
                        >
                            {{ category.name }}
                        </option>
                    </Select>
                </div>
                <div class="">
                    <Label value="Type" />
                    <Select
                        class="mt-1 block w-full"
                        v-model="form.type"
                        required
                    >
                        <option value="">- Select -</option>
                        <option :value="1">কুরআন</option>
                        <option :value="2">হাদিস</option>
                    </Select>
                </div>
                <div class="col-span-full">
                    <Label value="Sub Heading" />
                    <Input
                        type="text"
                        v-model="form.title"
                        class="block w-full"
                    />
                </div>
                <div class="col-span-full">
                    <Label value="Arabic" />
                    <textarea
                        class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm resize-y"
                        v-model="form.arabic"
                        rows="3"
                        dir="rtl"
                    ></textarea>
                </div>
                <div class="col-span-full">
                    <Label value="অনুবাদ" />
                    <textarea
                        class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm resize-y"
                        v-model="form.bengali"
                        rows="3"
                    ></textarea>
                </div>
            </div>

            <hr class="w-full my-4" />

            <div class="flex items-center justify-between">
                <div class="">
                    <go-to-list :href="route('subjectwises.index')" />
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
            default: "Save",
        },
        data: {
            type: Object,
            default: {},
        },
    },

    data() {
        return {
            form: this.$inertia.form({
                category_id: this.data.subjectwise.category_id,
                type: this.data.subjectwise.type,
                title: this.data.subjectwise.title,
                arabic: this.data.subjectwise.arabic,
                bengali: this.data.subjectwise.bengali,
            }),
        };
    },

    methods: {
        submit() {
            if (this.moduleAction == "store") {
                return this.form.post(this.route("subjectwises.store"), {
                    onSuccess: () => {
                        this.form.reset("arabic");
                        this.form.reset("bengali");
                    },
                });
            }

            if (this.moduleAction == "update") {
                return this.form.put(
                    this.route("subjectwises.update", this.data.subjectwise.id)
                );
            }
        },
    },
};
</script>
