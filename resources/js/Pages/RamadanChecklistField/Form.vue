<template>
    <div class="w-full max-w-md mx-auto p-4 bg-white border shadow">
        <ValidationErrors class="mb-4" />

        <form @submit.prevent="submit" class="">
            <div class="grid md:grid-cols-2 gap-4">
                <div class="col-span-2 col-start-1">
                    <Label value="Field Title" />
                    <Input
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                    />
                </div>
                <div class="col-span-2 col-start-1">
                    <Label value="Input Type" />
                    <Select v-model="form.type" required class="block w-full">
                        <option value="">-- Select --</option>
                        <option value="radio">হ্যাঁ / না</option>
                        <option value="number">সংখ্যা</option>
                    </Select>
                </div>
            </div>

            <hr class="w-full my-4" />

            <div class="flex items-center justify-between">
                <div class="">
                    <go-to-list :href="route('checklist-fields.index')" />
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
                name: this.data.checklistField.name,
                type: this.data.checklistField.type,
            }),
        };
    },

    methods: {
        submit() {
            if (this.moduleAction == "store") {
                return this.form.post(this.route("checklist-fields.store"));
            }

            if (this.moduleAction == "update") {
                return this.form.put(
                    this.route(
                        "checklist-fields.update",
                        this.data.checklistField.id
                    )
                );
            }
        },
    },
};
</script>
