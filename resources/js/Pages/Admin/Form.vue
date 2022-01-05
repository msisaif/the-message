<template>
    <div class="w-full max-w-md mx-auto p-4 bg-white border shadow m-4">
        <validation-errors class="mb-4" />

        <form @submit.prevent="submit" class="">
            <div class="mb-4">
                <Label for="name" value="Name" />
                <Input
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                />
            </div>

            <div class="mb-4">
                <Label for="email" value="Email" />
                <Input
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                />
            </div>

            <div class="mb-4">
                <Label for="phone" value="Phone" />
                <Input
                    id="phone"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.phone"
                />
            </div>

            <hr class="w-full my-4" />

            <div class="flex items-center justify-between">
                <div class="">
                    <go-to-list :href="route('admins.index')" />
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

export default {
    components: {
        Label,
        Input,
        Button,
        ValidationErrors,
        GoToList,
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
                name: this.data.admin.name,
                email: this.data.admin.email,
                phone: this.data.admin.phone,
                type: this.data.admin.type,
            }),
        };
    },
    methods: {
        submit() {
            if (this.moduleAction == "store") {
                return this.form.post(this.route("admins.store"));
            }
            if (this.moduleAction == "update") {
                return this.form.put(
                    this.route("admins.update", this.data.admin.id)
                );
            }
        },
    },
};
</script>
