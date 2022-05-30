<template>
    <div class="w-full max-w-md mx-auto p-4 bg-white border shadow m-4">
        <ValidationErrors class="mb-4" />

        <form @submit.prevent="submit" class="">
            <div class="mb-4">
                <Label value="Name" />
                <Input
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                />
            </div>

            <div class="mb-4">
                <Label value="Designation" />
                <Input
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.designation"
                />
            </div>

            <div class="mb-4">
                <Label value="Phone" />
                <Input
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.phone"
                />
            </div>

            <div class="mb-4">
                <Label value="Address" />
                <Input
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.address"
                />
            </div>

            <hr class="w-full my-4" />

            <div class="flex items-center justify-between">
                <div class="">
                    <go-to-list :href="route('mentors.index')" />
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
        mentor: { 
            type: Object,
            default: {} 
        },
        moduleAction: String,
        buttonValue: { type: String, default: "Submit" },
    },

    data() {
        return {
            form: this.$inertia.form({
                name: this.mentor.name,
                email: this.mentor.email,
                address: this.mentor.address,
                designation: this.mentor.designation,
            }),
        };
    },

    methods: {
        submit() {
            if (this.moduleAction == "store") {
                return this.form.post(this.route("mentors.store"));
            }

            if (this.moduleAction == "update") {
                return this.form.put(this.route("mentors.update", this.mentor.id));
            }
        },
    },
};
</script>
