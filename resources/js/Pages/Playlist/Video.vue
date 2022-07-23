<template>
    <div class="w-full max-w-2xl mx-auto p-4 bg-white border shadow">
        <ValidationErrors class="mb-4" />

        <form @submit.prevent="submit" class="">
            <div class="grid md:grid-cols-2 gap-4">
                <div class="col-span-full">
                    <Label value="Playlist Videos" />
                    <div class="space-y-4">
                        <div
                            v-for="(video, index) in form.video_ids"
                            :key="index"
                            class="flex items-center gap-4 border border-dashed border-sky-400 p-4"
                        >
                            <div
                                class="w-60 aspect-video overflow-hidden bg-gray-300"
                            >
                                <img
                                    v-if="GetVideoImageUrl(video)"
                                    :src="GetVideoImageUrl(video)"
                                    class="w-full object-cover"
                                />
                            </div>
                            <Select
                                class="block w-full"
                                v-model="form.video_ids[index]"
                                required
                            >
                                <option value="">--Select--</option>
                                <option
                                    v-for="video in data.videos"
                                    :key="video.id"
                                    :value="video.id"
                                    :disabled="
                                        form.video_ids.includes(
                                            Number(video.id)
                                        ) ||
                                        form.video_ids.includes(
                                            String(video.id)
                                        )
                                    "
                                >
                                    {{ video.title }}
                                </option>
                            </Select>
                            <TrashIcon
                                @click="removeVideoSlot(index)"
                                class="w-10 h-10 p-2 text-rose-700 rounded-full bg-rose-700/20 grow-0 shrink-0 cursor-pointer"
                            />
                        </div>
                        <div class="flex justify-center items-center">
                            <div
                                class="flex gap-1 justify-center items-center border px-3 py-1 bg-gray-200 cursor-pointer text-gray-700"
                                @click="AddVideoSlot"
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
                    <go-to-list :href="route('playlists.index')" />
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
import AvatarPhotoView from "@/Components/AvatarPhotoView.vue";
import { PlusCircleIcon, TrashIcon } from "@heroicons/vue/outline";

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
                step: 'videos',
                video_ids: [],
            }),
        };
    },

    methods: {
        submit() {
            if (this.moduleAction == "store") {
                return this.form.post(this.route("playlists.store"));
            }

            if (this.moduleAction == "update") {
                return this.form.put(
                    this.route("playlists.update", this.data.playlist.id)
                );
            }
        },
        AddVideoSlot() {
            this.form.video_ids.push("");
        },
        removeVideoSlot(index) {
            this.form.video_ids.splice(index, 1);
        },
        GetVideoImageUrl(videoId) {
            let selectedVideo = Object.values(this.data.videos).filter(
                (video) => video.id == parseInt(videoId)
            )[0];

            return selectedVideo ? selectedVideo.imageUrl : "";
        },
    },

    created() {
        if (this.data.playlist.videos) {
            Object.values(this.data.playlist.videos).forEach((video) => {
                this.form.video_ids.push(String(video.id));
            });
        }
    },
};
</script>
