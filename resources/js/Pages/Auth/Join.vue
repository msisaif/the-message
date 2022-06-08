<template>
    <Head title="Log in" />

    <div
        class="w-full mx-auto max-w-sm mt-6 px-8 py-6 bg-white shadow-md overflow-hidden"
    >
        <ValidationErrors class="mb-4" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <div class="flex justify-center items-center">
            <Link href="/">
                <application-logo class="w-28" />
            </Link>
        </div>

        <hr class="my-4" />

        <form @submit.prevent="submit" class="space-y-6 my-4">
            <div class="space-y-1">
                <Label
                    value="আপনার মোবাইল নাম্বার
                 দিন"
                />
                <Input
                    type="text"
                    class="block w-full"
                    v-model="form.phone"
                    required
                    autocomplete="off"
                />
            </div>

            <div class="flex items-center justify-center">
                <Button
                    class="w-full justify-center py-3"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Next
                </Button>
            </div>
        </form>
    </div>
</template>

<script>
import Button from "@/Components/Button.vue";
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/App.vue";
import Input from "@/Components/Input.vue";
import Label from "@/Components/Label.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

export default {
    layout: GuestLayout,

    components: {
        Button,
        Checkbox,
        Input,
        Label,
        ValidationErrors,
        Head,
        Link,
        ApplicationLogo,
    },

    props: {
        canResetPassword: Boolean,
        status: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                phone: "",
            }),
        };
    },

    methods: {
        submit() {
            this.form.post(this.route("join"));
        },
    },
};
</script>
