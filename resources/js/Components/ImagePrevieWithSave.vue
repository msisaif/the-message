<template>
    <div
        class="max-w-xs p-3 border border-dashed border-brand-secondary grid gap-3"
    >
        <div v-if="imagePreview" class="border overflow-hidden" :class="ratioClass">
            <img :src="imagePreview" class="w-full h-full object-cover" />
        </div>
        <div v-if="status" class="flex justify-center items-center">
            <div
                v-if="status === 1"
                class="bg-green-500 text-white px-4 py-2 font-bold flex gap-2"
            >
                <span>&check;</span>
                Success
            </div>
            <div
                v-if="status === 2"
                class="bg-indigo-500 text-white px-4 py-2 font-bold flex gap-2"
            >
                <span class="animate-spin font-bold">&#x205B;</span>
                Processing
            </div>
        </div>
        <div v-else class="flex items-center justify-center gap-4">
            <label
                v-if="!edit"
                for="__input__image__file__"
                class="px-4 py-2 border border-brand-primary text-brand-primary hover:text-white hover:bg-brand-primary cursor-pointer"
            >
                {{ imagePreview ? "Change" : "Upload" }}
                Photo
                <input
                    type="file"
                    id="__input__image__file__"
                    class="hidden"
                    accept="image/*"
                    @input="preview"
                />
            </label>
            <button
                v-if="edit"
                type="button"
                @click="cancel"
                class="px-4 py-2 border border-rose-500 text-rose-500 hover:text-white hover:bg-rose-500 cursor-pointer"
            >
                cancel
            </button>
            <button
                v-if="edit"
                type="button"
                @click="save"
                class="px-4 py-2 border border-green-500 text-green-500 hover:text-white hover:bg-green-500 cursor-pointer"
            >
                Save
            </button>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    components: {},
    props: {
        imageUrl: {
            type: String,
            default: null,
        },
        ratioClass: {
            type: String,
            default: 'aspect-video',
        },
        option: {
            type: String,
            default: null,
        },
        id: {
            type: Number,
            default: null,
        },
    },
    created() {
        this.image = this.imageUrl;
        this.imagePreview = this.imageUrl;
    },
    data() {
        return {
            imagePreview: null,
            image: null,
            file: null,
            edit: false,
            status: 0,
        };
    },
    methods: {
        preview(event) {
            const file = event.target.files[0];
            const url = URL.createObjectURL(file);

            this.file = file;
            this.edit = true;
            this.imagePreview = url;
        },
        cancel() {
            this.imagePreview = null;
            this.edit = false;
            this.file = null;

            setTimeout(() => {
                this.imagePreview = this.image;
            }, 400);
        },
        save() {
            this.status = 2;
            const formData = new FormData();
            formData.append("image", this.file);
            formData.append("option", this.option);
            formData.append("id", this.id);

            axios
                .post("/image-upload-get-link", formData)
                .then((response) => {
                    this.edit = false;
                    this.file = null;
                    this.status = 1;

                    setTimeout(() => {
                        this.status = 0;
                    }, 2000);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
