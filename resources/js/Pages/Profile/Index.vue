<template>
    <app-layout>
        <div
            class="max-w-sm mx-auto bg-brand-primary text-white shadow mt-6 w-ful grid gap-4 px-4 py-8"
        >
            <div class="flex flex-col items-center gap-4">
                <div class="w-full flex justify-end">
                    <button
                        type="button"
                        class="px-3 py-1 bg-white text-brand-primary font-medium"
                    >
                        Edit
                    </button>
                </div>
                <div class="w-40 h-40 rounded-full ring-8 ring-gray-300">
                    <avatar-photo-view
                        class="w-full h-full object-cover text-5xl bg-brand-primary/50 text-white"
                        :firstLatter="$page.props.auth.user.firstLatter"
                        :imageUrl="$page.props.auth.user.avatar"
                    />
                </div>
                <div class="md:grow md:shrink text-center space-y-2">
                    <h3 class="text-xl md:text-2xl font-semibold">
                        {{ $page.props.auth.user.name }}
                    </h3>
                    <p class="font-bold flex justify-center items-center gap-2">
                        <PhoneIcon
                            class="w-7 h-7 p-1 rounded-full bg-white text-brand-primary"
                        />
                        {{ $page.props.auth.user.phone }}
                    </p>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/App.vue";
import { Link } from "@inertiajs/inertia-vue3";
import AvatarPhotoView from "@/Components/AvatarPhotoView.vue";
import { PhoneIcon } from "@heroicons/vue/solid";
import Button from "@/Components/Button.vue";

export default {
    components: {
        AppLayout,
        Link,
        AvatarPhotoView,
        PhoneIcon,
        Button,
    },
};
</script>
