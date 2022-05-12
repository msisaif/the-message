<template>
    <header class="bg-white w-full p-2 z-40">
        <div
            class="w-full max-w-content mx-auto h-12 md:h-20 sm:py-2 flex justify-between items-center"
        >
            <svg
                @click="showingNavigationDropdown = !showingNavigationDropdown"
                class="flex sm:hidden h-5 -mb-2 md:h-8 text-brand-primary cursor-pointer"
                width="42"
                height="26"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 42 26"
            >
                <rect
                    width="42"
                    height="3"
                    transform="translate(0 0)"
                    fill="currentColor"
                />
                <rect
                    width="42"
                    height="3"
                    transform="translate(0 12)"
                    fill="currentColor"
                />
                <rect
                    width="42"
                    height="3"
                    transform="translate(0 23)"
                    fill="currentColor"
                />
            </svg>

            <Link href="/" class="h-full">
                <application-logo class="h-full" />
            </Link>

            <bismillahir-rahmanir-rahim class="h-full sm:block hidden" />

            <account />
        </div>

        <nav
            class="w-full max-w-content mx-auto flex items-center justify-between relative gap-2 py-1"
        >
            <div class="flex items-center">
                <!-- Hamburger -->
                <svg
                    @click="
                        showingNavigationDropdown = !showingNavigationDropdown
                    "
                    class="hidden sm:block h-6 md:h-8 text-brand-primary cursor-pointer"
                    width="42"
                    height="26"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 42 26"
                >
                    <rect
                        width="42"
                        height="3"
                        transform="translate(0 0)"
                        fill="currentColor"
                    />
                    <rect
                        width="42"
                        height="3"
                        transform="translate(0 12)"
                        fill="currentColor"
                    />
                    <rect
                        width="42"
                        height="3"
                        transform="translate(0 23)"
                        fill="currentColor"
                    />
                </svg>

                <div
                    class="absolute top-full ring-0 left-0 w-full md:max-w-max overflow-hidden z-30 py-2"
                >
                    <!-- Navigation Menu -->
                    <div
                        class="overflow-auto bg-white shadow-md border"
                        :class="{
                            block: showingNavigationDropdown,
                            hidden: !showingNavigationDropdown,
                        }"
                    >
                        <navigation />
                    </div>
                </div>
            </div>
            <div
                class="hidden w-full min-w-max sm:flex justify-end items-center gap-px md:gap-2"
            >
                <navigation-link
                    :href="route('home')"
                    :active="route().current('home')"
                    class="hidden md:flex"
                >
                    হোম
                </navigation-link>

                <navigation-link
                    :href="route('quran.index')"
                    :active="route().current('quran.*')"
                >
                    আল-কুরআন
                </navigation-link>

                <navigation-link
                    :href="route('hadith.index')"
                    :active="route().current('hadith.*')"
                >
                    আল-হাদীস
                </navigation-link>

                <navigation-link
                    :href="route('video.index')"
                    :active="route().current('video.*')"
                >
                    ভিডিও
                </navigation-link>

                <navigation-link
                    :href="route('course.index')"
                    :active="route().current('course.*')"
                >
                    কোর্স
                </navigation-link>

                <navigation-link
                    :href="route('kids-zone.index')"
                    :active="route().current('kids-zone.*')"
                >
                    শিশু বিচিত্রা
                </navigation-link>

                <navigation-link
                    :href="route('donate.index')"
                    :active="route().current('donate.*')"
                >
                    দান করুন
                </navigation-link>
            </div>
        </nav>
    </header>
</template>

<script>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Navigation from "./Navigation.vue";
import Account from "./Account.vue";
import BismillahirRahmanirRahim from "@/Components/BismillahirRahmanirRahim.vue";
import NavigationLink from "@/Components/NavigationLink.vue";

export default {
    components: {
        ApplicationLogo,
        Link,
        Navigation,
        Account,
        BismillahirRahmanirRahim,
        NavigationLink,
    },
    data() {
        return {
            showingNavigationDropdown: false,
        };
    },
};
</script>
