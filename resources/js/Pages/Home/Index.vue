<template>
    <div
        class="
            h-10
            md:h-20
            flex
            justify-center
            items-center
            gap-10
            md:gap-20
            my-5
            md:my-10
        "
    >
        <application-logo class="h-full" />
        <bismillahir-rahmanir-rahim class="h-full" />
    </div>
    <h1 class="text-2xl md:text-5xl text-gray-600 text-center">
        Welcome to Home Page
    </h1>
</template>

<script>
import AppLayout from "@/Layouts/App.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import BismillahirRahmanirRahim from "@/Components/BismillahirRahmanirRahim.vue";

export default {
    layout: AppLayout,
    components: {
        AppLayout,
        ApplicationLogo,
        BismillahirRahmanirRahim,
    },
};
</script>
