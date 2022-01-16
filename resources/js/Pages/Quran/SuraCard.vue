<template>
    <Link
        :href="href"
        class="p-6 flex justify-between items-center gap-4 text-brand-gray bg-white"
    >
        <div class="flex gap-4 items-center">
            <span
                class="w-10 h-10 bg-brand-light rounded-full flex justify-center items-center"
            >
                {{ sura.suraNumber }}
            </span>
            <div>
                <div class="text-brand-black">
                    {{ sura.bengaliPronunciation }}
                </div>
                <div class="text-xs text-brand-gray">
                    {{ sura.bengaliMeaning }}
                </div>
            </div>
        </div>
        <div class="text-right">
            <div class="text-brand-black text-lg">
                {{ sura.arabic }}
            </div>
            <div class="text-xs text-brand-gray">
                {{ sura.totalAyah }} Ayahs
            </div>
        </div>
    </Link>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
export default {
    components: {
        Link,
    },
    props: ["href", "sura"],
};
</script>
