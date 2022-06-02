<template>
    <div class="w-full max-w-3xl mx-auto px-4 py-6 bg-white border shadow">
        <ValidationErrors class="mb-4" />

        <form @submit.prevent="submit" class="">
            <div>
                <ul
                    class="marker:text-rose-600 marker:text-2xl list-disc px-10 md:px-20 md:gap-x-20 gap-y-3 py-3 text-slate-500 grid md:grid-cols-2"
                >
                    <li :class="{ 'marker:text-green-600': data.course.title }">
                        Course Title
                    </li>
                    <li
                        :class="{
                            'marker:text-green-600': data.course.imageUrl,
                        }"
                    >
                        Course Thumbnail
                    </li>
                    <li :class="{ 'marker:text-green-600': data.course.video }">
                        Intro Video
                    </li>
                    <li
                        :class="{
                            'marker:text-green-600': data.course.description,
                        }"
                    >
                        Course Description
                    </li>
                    <li
                        :class="{
                            'marker:text-green-600': Object.keys(
                                data.course.mentors
                            ).length,
                        }"
                    >
                        Course Instructor
                    </li>
                    <li
                        :class="{
                            'marker:text-green-600': Object.keys(
                                data.course.topics
                            ).length,
                        }"
                    >
                        Course Topic
                    </li>
                </ul>
            </div>

            <div
                class="flex justify-center items-center p-4 relative border-t border-b mt-4"
            >
                <div
                    v-if="!editable"
                    class="absolute inset-0 bg-gray-700/30 z-20"
                ></div>
                <div class="flex bg-gray-200 z-0">
                    <div
                        class="py-2 w-32 text-center shadow cursor-pointer"
                        :class="{ 'bg-sky-600 text-white': form.publish }"
                        @click="form.publish = editable ? 1 : form.publish"
                    >
                        Publish
                    </div>
                    <div
                        class="py-2 w-32 text-center shadow cursor-pointer"
                        :class="{ 'bg-sky-600 text-white': !form.publish }"
                        @click="form.publish = editable ? 0 : form.publish"
                    >
                        Unpublish
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between mt-6">
                <div class="">
                    <go-to-list
                        :href="route('courses.show', data.course.id)"
                        value="Back"
                        :history="false"
                    />
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
import { StatusOfflineIcon, StatusOnlineIcon } from "@heroicons/vue/outline";

export default {
    components: {
        Button,
        Input,
        Label,
        ValidationErrors,
        GoToList,
        Select,
        StatusOfflineIcon,
        StatusOnlineIcon,
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
            editable: true,
            form: this.$inertia.form({
                step: "publish",
                publish: this.data.course.publish,
            }),
        };
    },

    methods: {
        submit() {
            if (this.moduleAction == "update") {
                return this.form.put(
                    this.route("courses.update", this.data.course.id)
                );
            }
        },
    },

    created() {
        const course = this.data.course;
        this.editable =
            course.title &&
            course.imageUrl &&
            course.video &&
            course.description &&
            Object.keys(course.mentors).length &&
            Object.keys(course.topics).length;
    },
};
</script>
