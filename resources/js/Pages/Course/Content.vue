<template>
    <div class="w-full max-w-3xl mx-auto px-4 py-6 bg-white border shadow">
        <ValidationErrors class="mb-4" />

        <form @submit.prevent="submit" class="">
            <div class="space-y-8">
                <div
                    v-for="(topic, index) in form.topics"
                    :key="index"
                    class="grid gap-x-2 gap-y-6 border border-dashed border-brand-primary px-4 py-6"
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
                    <hr class="border-dashed border-gray-400" />
                    <div
                        v-for="(content, contentIndex) in topic.contents"
                        :key="contentIndex"
                    >
                        <div
                            v-if="content.type === 1"
                            class="flex items-start md:items-center gap-2 border px-2 py-3 bg-purple-700/20"
                        >
                            <PlayIcon
                                class="w-10 h-10 text-purple-700 grow-0 shrink-0"
                            />
                            <div
                                class="flex flex-col md:flex-row gap-2 shrink grow"
                            >
                                <Input
                                    class="block w-full"
                                    type="text"
                                    v-model="content.title"
                                    required
                                    placeholder="Lecture Title"
                                />
                                <Input
                                    class="block w-full"
                                    type="text"
                                    v-model="content.link"
                                    required
                                    placeholder="Video Link"
                                />
                            </div>
                            <TrashIcon
                                @click="removeContentSlot(index, contentIndex)"
                                class="w-10 h-10 p-1.5 text-rose-700 rounded-full bg-white grow-0 shrink-0 cursor-pointer"
                            />
                        </div>
                        <div
                            v-if="content.type === 2"
                            class="flex items-start md:items-center gap-2 border px-2 py-3 bg-indigo-700/20"
                        >
                            <DocumentAddIcon
                                class="w-10 h-10 text-indigo-700 grow-0 shrink-0"
                            />
                            <div
                                class="flex flex-col md:flex-row gap-2 shrink grow"
                            >
                                <Input
                                    class="block w-full"
                                    type="text"
                                    v-model="content.title"
                                    required
                                    placeholder="Document Title"
                                />
                                <Input
                                    class="block w-full"
                                    type="text"
                                    v-model="content.link"
                                    required
                                    placeholder="Google Drive Link"
                                />
                            </div>
                            <TrashIcon
                                @click="removeContentSlot(index, contentIndex)"
                                class="w-10 h-10 p-1.5 text-rose-700 rounded-full bg-white grow-0 shrink-0 cursor-pointer"
                            />
                        </div>
                    </div>
                    <hr class="border-dashed border-gray-400" />
                    <div class="flex justify-center items-center gap-4">
                        <button
                            class="flex justify-center gap-1 items-center px-1.5 py-1 bg-purple-700 text-white"
                            type="button"
                            @click="AddContentSlot(index, 1)"
                        >
                            <PlayIcon class="w-6 h-6" />
                            Video
                        </button>
                        <button
                            class="flex justify-center gap-1 items-center px-1.5 py-1 bg-indigo-700 text-white"
                            type="button"
                            @click="AddContentSlot(index, 2)"
                        >
                            <DocumentAddIcon class="w-6 h-6" />
                            File
                        </button>
                    </div>
                </div>
                <div
                    class="flex gap-1 justify-center items-center border border-dashed border-gray-400 py-4 text-gray-400 cursor-pointer text-xl md:text-3xl"
                    @click="AddTopicSlot"
                >
                    <PlusCircleIcon class="w-6 md:w-10 md:h-10 h-6" />
                    <span>Add Topic</span>
                </div>
            </div>

            <hr class="w-full my-4" />

            <div class="flex items-center justify-between">
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
        removeTopicSlot(topicIndex) {
            this.form.topics.splice(topicIndex, 1);
        },
        AddContentSlot(topicIndex, type) {
            this.form.topics[topicIndex].contents.push({
                title: "",
                type: parseInt(type),
                link: "",
            });
        },
        removeContentSlot(topicIndex, contentIndex) {
            this.form.topics[topicIndex].contents.splice(contentIndex, 1);
        },
    },

    created() {
        if (this.data.course.topics) {
            Object.values(this.data.course.topics).forEach((topic) => {

                const array = [];

                Object.values(topic.contents).forEach((content) => {
                    array.push({
                        title: content.title,
                        type: parseInt(content.type),
                        link: content.link,
                    });
                });

                this.form.topics.push({
                    title: topic.title,
                    contents: array,
                });
            });
        }
    },
};
</script>
