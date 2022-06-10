<template>
    <Head title="JOIN" />

    <div
        class="w-full mx-auto max-w-sm mt-6 px-8 py-6 bg-white shadow-md overflow-hidden"
    >
        <ValidationErrors class="mb-4" />

        <div class="flex justify-center items-center">
            <Link href="/">
                <application-logo class="w-28" />
            </Link>
        </div>

        <hr class="my-4" />

        <div v-if="message">
            <div class="py-3 text-pink-500" v-html="message"></div>
        </div>

        <form @submit.prevent="submit" class="space-y-6 my-4">
            <div v-if="step === 3">
                <Label value="নাম" />
                <Input
                    type="text"
                    class="block w-full"
                    v-model="form.name"
                    required
                />
            </div>

            <div v-if="step === 1">
                <Label value="মোবাইল নাম্বার" />
                <Input
                    type="text"
                    class="block w-full"
                    v-model="form.phone"
                    required
                    placeholder="01XXXXXXXXX"
                />
            </div>

            <div v-if="step === 2 || step === 3" class="mt-4">
                <Label value="পাসওয়ার্ড" />
                <Input
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />
            </div>

            <div class="flex items-center justify-center">
                <Button
                    class="w-full justify-center py-3"
                    :class="{
                        'opacity-25 cursor-not-allowed': checkDisabled(),
                    }"
                    :disabled="checkDisabled()"
                >
                    এগিয়ে যান
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
        message: String,
        phone: String,
        name: String,
        step: Number,
        redirect: String,
    },

    created() {
        if (this.step === 2) {
            this.form.phone = this.phone;
        }

        if (this.step === 3) {
            this.form.phone = this.phone;
            this.form.name = this.name;
        }
    },

    data() {
        return {
            form: this.$inertia.form({
                phone: "",
                password: "",
                name: "",
                remember: true,
                step: "",
            }),
        };
    },

    methods: {
        submit() {
            this.form.step = this.step === 1 ? 1 : 4;
            this.form.post(this.route("join"), {
                onFinish: () => this.form.reset("password"),
            });
        },
        checkDisabled() {
            return (
                this.form.processing ||
                (this.step === 1 &&
                    this.form.phone &&
                    this.form.phone.length !== 11) ||
                (this.step === 2 && !this.form.password) ||
                (this.step === 3 && !(this.form.password && this.form.name))
            );
        },
    },
};
</script>
