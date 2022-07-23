<template>
    <Head title="Playlist" />

    <app-layout>
        <div class="py-4">
            <h3 class="text-brand-primary text-2xl text-center mb-3 font-bold">
                Playlist
            </h3>

            <video-component v-if="step === 'videos'" :data="data" module-action="update" />
            <form-component v-if="step === ''" :data="data" module-action="update" />

        </div>
    </app-layout>
</template>

<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/App.vue";
import FormComponent from "./Form.vue";
import VideoComponent from "./Video.vue";

export default {
    components: {
        AppLayout,
        Head,
        Link,
        FormComponent,
        VideoComponent,
    },

    data() {
        return {
            data: {
                playlist: this.playlist,
                types: this.types,
                videos: this.videos,
            },
        };
    },

    props: {
        playlist: {
            type: Object,
            default: {},
        },
        types: {
            type: Object,
            default: {},
        },
        step: {
            type: String,
            default: "",
        },
        videos: {
            type: Object,
            default: {},
        },
    },
};
</script>
