<template>
    <div class="w-full flex">
        <Link
            :href="href"
            class="text-center cursor-pointer border border-brand-primary text-white hover:bg-brand-primary bg-brand-primary px-3 py-1.5"
        >
            + Add New
        </Link>
    </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        Link,
    },
    props: ["href"],
};
</script>
