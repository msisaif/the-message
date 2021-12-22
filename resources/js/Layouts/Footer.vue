<template>
    <footer>
        <div class="bg-brand-primary py-6 mt-10">
            <p class="text-center text-xs md:text-sm text-white">
                &copy; 2021 - {{ year }}
                <Link href="/" class="underline">MessageBD.com</Link>
                | All right reserved
            </p>
        </div>
    </footer>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
export default {
    components: {
        Link,
    },
    created() {
        this.year = new Date().getFullYear();
    },
    data() {
        return {
            year: "",
        };
    },
};
</script>
