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

        <form @submit.prevent="submit" class="space-y-4 my-4">
            <div>
                <Label value="মোবাইল নাম্বার" />
                <div class="relative">
                    <Input
                        type="text"
                        class="block w-full"
                        v-model="form.phone"
                        required
                        placeholder="01XXXXXXXXX"
                    />
                    <div
                        v-if="phone"
                        class="absolute inset-0 z-30 flex justify-end items-center px-2 bg-green-600/10"
                    >
                        <CheckCircleIcon class="w-6 h-6 text-green-600" />
                    </div>
                </div>
            </div>

            <div v-if="step === 2 && !form.sms">
                <Label value="নাম" />
                <div class="relative">
                    <Input
                        type="text"
                        class="block w-full"
                        v-model="form.name"
                        required
                    />
                    <div
                        v-if="name"
                        class="absolute inset-0 z-30 flex justify-end items-center px-2 bg-green-600/10"
                    >
                        <CheckCircleIcon class="w-6 h-6 text-green-600" />
                    </div>
                </div>
            </div>

            <div v-if="step === 2 && !form.sms" class="mt-4">
                <Label value="পাসওয়ার্ড" />
                <div class="relative">
                    <Input
                        :type="inputTypePassword ? 'password' : 'text'"
                        class="mt-1 block w-full"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                    />
                    <EyeIcon
                        v-if="inputTypePassword"
                        @click="inputTypePassword = false"
                        class="cursor-pointer absolute right-3 top-1/2 -translate-y-1/2 w-6 h-6"
                    />
                    <EyeOffIcon
                        v-else
                        @click="inputTypePassword = true"
                        class="cursor-pointer absolute right-3 top-1/2 -translate-y-1/2 w-6 h-6"
                    />
                </div>
            </div>

            <div v-if="!sms" class="flex justify-start">
                <label class="flex items-center justify-start">
                    <Checkbox name="sms" v-model:checked="form.sms" />
                    <span class="ml-2 text-sm text-gray-600">
                        পাসওয়ার্ড মনে নেই
                    </span>
                </label>
            </div>

            <div v-if="!sms && form.sms" class="block">
                <Label value="আপনার মোবাইল নাম্বার দিয়ে এগিয়ে যান" />
            </div>

            <div class="flex items-center justify-center">
                <Button
                    class="w-full justify-center py-3"
                    :class="{
                        'opacity-25 cursor-not-allowed': checkDisabled(),
                    }"
                    :disabled="checkDisabled()"
                >
                    {{ form.sms ? "আমাকে SMS দিন" : "এগিয়ে যান" }}
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
import { CheckCircleIcon, EyeIcon, EyeOffIcon } from "@heroicons/vue/outline";

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
        CheckCircleIcon,
        EyeIcon,
        EyeOffIcon,
    },

    props: {
        message: String,
        phone: String,
        name: String,
        step: Number,
        redirect: String,
        sms: Boolean,
    },

    created() {
        this.checkUpdate();
    },

    updated() {
        this.checkUpdate();
    },

    data() {
        return {
            form: this.$inertia.form({
                phone: "",
                password: "",
                name: "",
                remember: true,
                step: "",
                sms: false,
            }),
            inputTypePassword: true,
        };
    },

    methods: {
        submit() {
            this.form.step = this.form.sms ? 1 : this.step;

            this.checkUpdate();

            this.form.post(this.route("join"), {
                onSuccess: () => {
                    this.form.reset("password");
                    this.form.reset("sms");
                },
            });
        },
        checkDisabled() {
            return (
                this.form.processing ||
                (this.step === 1 && this.form.phone.length !== 11)
            );
        },
        checkUpdate() {
            if (this.step === 2) {
                this.form.phone = this.phone;
                if (this.name) {
                    this.form.name = this.name;
                }
            }
        },
    },
};
</script>
