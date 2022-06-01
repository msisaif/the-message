<template>
    <div class="w-full max-w-3xl mx-auto p-4 bg-white border shadow">
        <ValidationErrors class="mb-4" />

        <form @submit.prevent="submit" class="">
            <div class="grid md:grid-cols-2 gap-4">
                <div class="col-span-full">
                    <Label value="Course Content" />
                    <div class="border border-dashed px-2 py-4 space-y-4">
                        <div
                            v-for="(topic, index) in form.topics"
                            :key="index"
                            class="grid gap-2 border border-dashed border-brand-primary p-2"
                        >
                            <div class="flex items-center gap-2">
                                <Input
                                    class="block w-full"
                                    type="text"
                                    v-model="topic.title"
                                    required
                                    placeholder="Topic Title"
                                />
                                <TrashIcon
                                    @click="removeTopicSlot(index)"
                                    class="w-10 h-10 p-2 text-rose-700 rounded-full bg-rose-700/20 grow-0 shrink-0 cursor-pointer"
                                />
                            </div>
                            <div class="flex justify-center items-center gap-4">
                                <button
                                    class="flex justify-center gap-1 items-center px-2 py-1.5 bg-rose-600/40 text-rose-600"
                                    type="button"
                                >
                                    <PlayIcon class="w-5 h-5" />
                                    Lecture
                                </button>
                                <button
                                    class="flex justify-center gap-1 items-center px-2 py-1.5 bg-indigo-600/40 text-indigo-600"
                                    type="button"
                                >
                                    <DocumentAddIcon class="w-5 h-5" />
                                    Document
                                </button>
                            </div>
                        </div>
                        <div class="flex justify-center items-center">
                            <div
                                class="flex gap-1 justify-center items-center border px-3 py-1 bg-gray-200 cursor-pointer text-gray-700"
                                @click="AddTopicSlot"
                            >
                                <PlusCircleIcon class="w-5 h-5" />
                                <span>Slot</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="w-full my-4" />

            <div class="flex items-center justify-between">
                <div class="">
                    <go-to-list :href="route('courses.index')" />
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
import {
    PlusCircleIcon,
    TrashIcon,
    PlayIcon,
    DocumentAddIcon,
} from "@heroicons/vue/outline";
import AvatarPhotoView from "@/Components/AvatarPhotoView.vue";

export default {
    components: {
        Button,
        Input,
        Label,
        ValidationErrors,
        GoToList,
        Select,
        AvatarPhotoView,
        PlusCircleIcon,
        TrashIcon,
        PlayIcon,
        DocumentAddIcon,
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
                step: "content",
                topics: [],
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
        AddTopicSlot() {
            this.form.topics.push({
                title: "",
                contents: [],
            });
        },
        removeTopicSlot(index) {
            this.form.topics.splice(index, 1);
        },
    },

    created() {
        // if (this.data.course.mentors) {
        //     Object.values(this.data.course.mentors).forEach((mentor) => {
        //         this.form.mentor_ids.push(String(mentor.id));
        //     });
        // }
    },
};
</script>
