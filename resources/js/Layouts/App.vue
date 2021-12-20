<template>
    <div class="min-h-screen bg-gray-100">
        <header class="bg-white w-full p-2 z-40">
            <div
                class="
                    w-full
                    max-w-6xl
                    mx-auto
                    h-12
                    md:h-16
                    py-2
                    flex
                    justify-between
                    items-center
                "
            >
                <Link href="/" class="h-full">
                    <application-logo class="h-full" />
                </Link>
                <bismillahir-rahmanir-rahim class="h-full" />
                <div class="min-w-max flex items-center">
                    <!-- Settings Dropdown -->
                    <div v-if="!$page.props.auth.user">
                        <Link
                            :href="route('login')"
                            class="
                                px-6
                                py-1.5
                                border border-green-600
                                text-green-600
                                hover:bg-green-600 hover:text-white
                            "
                            >Login</Link
                        >
                    </div>
                    <div v-else class="relative">
                        <dropdown align="right" width="48">
                            <template #trigger>
                                <span class="inline-flex rounded-md">
                                    <button
                                        type="button"
                                        class="
                                            inline-flex
                                            items-center
                                            gap-1
                                            border border-transparent
                                            text-sm
                                            leading-4
                                            font-medium
                                            rounded-md
                                            text-gray-500
                                            bg-white
                                            hover:text-gray-700
                                            focus:outline-none
                                            transition
                                            ease-in-out
                                            duration-150
                                        "
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                        <span
                                            class="hidden sm:block"
                                            v-if="$page.props.auth.user"
                                        >
                                            {{ $page.props.auth.user.name }}
                                        </span>
                                        <svg
                                            class="h-4 w-4"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </button>
                                </span>
                            </template>

                            <template #content>
                                <dropdown-link
                                    :href="route('logout')"
                                    method="post"
                                    as="button"
                                >
                                    Log Out
                                </dropdown-link>
                            </template>
                        </dropdown>
                    </div>
                </div>
            </div>

            <nav
                class="
                    w-full
                    max-w-6xl
                    mx-auto
                    flex
                    items-center
                    justify-between
                    relative
                    gap-2
                "
            >
                <div class="flex items-center">
                    <!-- Hamburger -->
                    <button
                        @click="
                            showingNavigationDropdown =
                                !showingNavigationDropdown
                        "
                        class="
                            inline-flex
                            items-center
                            justify-center
                            text-gray-600
                            hover:text-gray-700
                            focus:outline-none
                        "
                    >
                        <svg
                            class="w-6 h-6 md:w-8 md:h-8"
                            stroke="currentColor"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <path
                                :class="{
                                    hidden: showingNavigationDropdown,
                                    'inline-flex': !showingNavigationDropdown,
                                }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                            <path
                                :class="{
                                    hidden: !showingNavigationDropdown,
                                    'inline-flex': showingNavigationDropdown,
                                }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>

                    <div
                        class="
                            absolute
                            top-full
                            ring-0
                            left-0
                            w-full
                            md:max-w-max
                            overflow-hidden
                            z-30
                            py-2
                        "
                    >
                        <!-- Navigation Menu -->
                        <div
                            class="overflow-auto bg-white shadow"
                            :class="{
                                block: showingNavigationDropdown,
                                hidden: !showingNavigationDropdown,
                            }"
                        >
                            <navigation />
                        </div>
                    </div>
                </div>
                <div class="w-full flex items-center gap-1 md:gap-2">
                    <Link
                        href="/"
                        class="
                            hidden
                            md:flex
                            justify-center
                            md:justify-between
                            items-center
                            w-full
                            px-1
                            md:px-4
                            py-1
                            border
                            rounded
                            text-xs
                            md:text-base
                        "
                    >
                        <span>Home</span>
                        <svg
                            class="h-4 w-4 md:h-6 md:w-6 hidden md:block"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </Link>
                    <Link
                        :href="route('quran.index')"
                        class="
                            flex
                            justify-center
                            md:justify-between
                            items-center
                            w-full
                            px-1
                            md:px-4
                            py-1
                            border
                            rounded
                            text-xs
                            md:text-base
                        "
                    >
                        <span>Al-Quran</span>
                        <svg
                            class="h-4 w-4 md:h-6 md:w-6 hidden md:block"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </Link>
                    <Link
                        :href="route('hadith.index')"
                        class="
                            flex
                            justify-center
                            md:justify-between
                            items-center
                            w-full
                            px-1
                            md:px-4
                            py-1
                            border
                            rounded
                            text-xs
                            md:text-base
                        "
                    >
                        <span>Hadith</span>
                        <svg
                            class="h-4 w-4 md:h-6 md:w-6 hidden md:block"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </Link>
                    <Link
                        :href="route('article.index')"
                        class="
                            flex
                            justify-center
                            md:justify-between
                            items-center
                            w-full
                            px-1
                            md:px-4
                            py-1
                            border
                            rounded
                            text-xs
                            md:text-base
                        "
                    >
                        <span>Article</span>
                        <svg
                            class="h-4 w-4 md:h-6 md:w-6 hidden md:block"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </Link>
                    <Link
                        :href="route('kids-zone.index')"
                        class="
                            flex
                            justify-center
                            md:justify-between
                            items-center
                            w-full
                            px-1
                            md:px-4
                            py-1
                            border
                            rounded
                            text-xs
                            md:text-base
                        "
                    >
                        <span>Kids Zone</span>
                        <svg
                            class="h-4 w-4 md:h-6 md:w-6 hidden md:block"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </Link>
                </div>
            </nav>
        </header>

        <main class="w-full mx-auto max-w-6xl overflow-hidden">
            <!-- Page Content -->
            <slot />
        </main>

        <footer>
            <div class="bg-brand-dark text-white py-8 mt-10">
                <p class="text-center">&copy; 2021 - 2022</p>
            </div>
        </footer>
    </div>
</template>

<script>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Navigation from "./Navigation.vue";
import BismillahirRahmanirRahim from "@/Components/BismillahirRahmanirRahim.vue";

export default {
    components: {
        ApplicationLogo,
        Dropdown,
        DropdownLink,
        NavLink,
        Link,
        Navigation,
        BismillahirRahmanirRahim,
    },

    data() {
        return {
            showingNavigationDropdown: false,
        };
    },
};
</script>
