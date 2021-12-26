<template>
    <div class="min-w-max flex items-center">
        <!-- Settings Dropdown -->
        <div v-if="!$page.props.auth.user">
            <Link
                :href="route('login')"
                class="
                    px-3
                    md:px-6
                    py-0.5
                    md:py-1.5
                    border-2 border-brand-primary
                    text-brand-primary
                    hover:bg-brand-primary hover:text-white
                    font-bold
                "
            >
                Join
            </Link>
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
                                text-sm
                                font-medium
                                border border-brand-primary
                                text-brand-primary
                                hover:bg-brand-primary hover:text-white hover:
                                focus:outline-none
                                px-2
                                py-0.5
                                md:py-1.5
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
                                class="w-3.5"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 14.3 8.176"
                            >
                                <path
                                    d="M13.34,16.958l5.407-5.411a1.018,1.018,0,0,1,1.443,0,1.03,1.03,0,0,1,0,1.448l-6.127,6.131a1.02,1.02,0,0,1-1.409.03L6.486,13a1.022,1.022,0,0,1,1.443-1.448Z"
                                    transform="translate(-6.188 -11.246)"
                                    fill="currentColor"
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
</template>

<script>
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        Dropdown,
        DropdownLink,
        Link,
    },
};
</script>
