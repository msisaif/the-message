<template>
    <Head title="Course" />

    <app-layout>
        <div class="py-4">
            <h3 class="text-brand-primary text-2xl text-center mb-3 font-bold">
                {{ course.title }}
            </h3>

            <content-component
                v-if="step == 'content'"
                :data="{ course, mentors }"
                module-action="update"
            />
            <publish-component
                v-if="step == 'publish'"
                :data="{ course }"
                module-action="update"
            />
            <form-component
                v-if="step == ''"
                :data="{ course, mentors }"
                module-action="update"
            />
        </div>
    </app-layout>
</template>

<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/App.vue";
import FormComponent from "./Form.vue";
import ContentComponent from "./Content.vue";
import PublishComponent from "./Publish.vue";

export default {
    components: {
        AppLayout,
        Head,
        Link,
        FormComponent,
        ContentComponent,
        PublishComponent,
    },

    props: {
        course: {
            type: Object,
            default: {},
        },
        mentors: {
            type: Object,
            default: {},
        },
        step: {
            type: String,
            default: "",
        },
    },
};
</script>
