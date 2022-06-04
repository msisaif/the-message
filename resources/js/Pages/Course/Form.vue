<template>
    <div class="w-full max-w-3xl mx-auto p-4 bg-white border shadow">
        <ValidationErrors class="mb-4" />

        <form @submit.prevent="submit" class="">
            <div class="grid md:grid-cols-2 gap-4">
                <div class="">
                    <Label value="Course Title *" />
                    <Input
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.title"
                        required
                    />
                </div>
                <div class="">
                    <Label value="Amount *" />
                    <Input
                        type="number"
                        class="mt-1 block w-full"
                        v-model="form.amount"
                        required
                    />
                </div>
                <div class="col-span-full">
                    <Label value="Course Intro Video Link (YouTube)" />
                    <Input
                        type="url"
                        class="mt-1 block w-full"
                        v-model="form.video"
                    />
                </div>
                <div class="col-span-full">
                    <Label value="কোর্স ইন্সট্রাক্টর (Mentor)" />
                    <div class="border border-dashed p-2 space-y-2">
                        <div
                            v-for="(mentor, index) in form.mentor_ids"
                            :key="index"
                            class="flex items-center gap-2 border border-dashed p-2"
                        >
                            <avatar-photo-view
                                :imageUrl="
                                    GetMentorImageUrl(form.mentor_ids[index])
                                "
                                :firstLatter="
                                    GetMentorFirstLatter(form.mentor_ids[index])
                                "
                                class="w-10 h-10 bg-gray-400 text-white"
                            />
                            <Select
                                class="block w-full"
                                v-model="form.mentor_ids[index]"
                                required
                            >
                                <option value="">--Select--</option>
                                <option
                                    v-for="mentor in data.mentors"
                                    :key="mentor.id"
                                    :value="mentor.id"
                                    :disabled="
                                        form.mentor_ids.includes(
                                            Number(mentor.id)
                                        ) ||
                                        form.mentor_ids.includes(
                                            String(mentor.id)
                                        )
                                    "
                                >
                                    {{ mentor.name }}
                                </option>
                            </Select>
                            <TrashIcon
                                @click="removeMentorSlot(index)"
                                class="w-10 h-10 p-2 text-rose-700 rounded-full bg-rose-700/20 grow-0 shrink-0 cursor-pointer"
                            />
                        </div>
                        <div class="flex justify-center items-center">
                            <div
                                class="flex gap-1 justify-center items-center border px-3 py-1 bg-gray-200 cursor-pointer text-gray-700"
                                @click="AddMentorSlot"
                            >
                                <PlusCircleIcon class="w-5 h-5" />
                                <span>Slot</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-full">
                    <Label value="Short Message" />
                    <textarea
                        class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm resize-y"
                        v-model="form.message"
                        rows="3"
                    ></textarea>
                </div>
                <div class="col-span-full">
                    <Label value="Course Description" />
                    <textarea
                        class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm resize-y"
                        v-model="form.description"
                        rows="10"
                    ></textarea>
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
import { PlusCircleIcon, TrashIcon } from "@heroicons/vue/outline";
import AvatarPhotoView from "@/Components/AvatarPhotoView.vue";

export default {
    components: {
        Button,
        Input,
        Label,
        ValidationErrors,
        GoToList,
        Select,
        PlusCircleIcon,
        TrashIcon,
        AvatarPhotoView,
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
                title: this.data.course.title,
                amount: this.data.course.amount,
                video: this.data.course.video,
                message: this.data.course.message,
                description: this.data.course.description,
                mentor_ids: [],
            }),
        };
    },

    methods: {
        submit() {
            if (this.moduleAction == "store") {
                return this.form.post(this.route("courses.store"));
            }

            if (this.moduleAction == "update") {
                return this.form.put(
                    this.route("courses.update", this.data.course.id)
                );
            }
        },
        AddMentorSlot() {
            this.form.mentor_ids.push("");
        },
        removeMentorSlot(index) {
            this.form.mentor_ids.splice(index, 1);
        },
        GetMentorImageUrl(mentorId) {
            let selectedMentor = Object.values(this.data.mentors).filter(
                (mentor) => mentor.id == parseInt(mentorId)
            )[0];

            return selectedMentor ? selectedMentor.imageUrl : "";
        },
        GetMentorFirstLatter(mentorId) {
            let selectedMentor = Object.values(this.data.mentors).filter(
                (mentor) => mentor.id == parseInt(mentorId)
            )[0];

            return selectedMentor ? selectedMentor.firstLatter : "";
        },
    },

    created() {
        if (this.data.course.mentors) {
            Object.values(this.data.course.mentors).forEach((mentor) => {
                this.form.mentor_ids.push(String(mentor.id));
            });
        }
    },
};
</script>
