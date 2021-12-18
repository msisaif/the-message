<template>
    <div class="w-ful flex flex-wrap gap-4">
        <dashboard-card
            title="Admins"
            :count="adminCount"
            :href="route('admins.index')"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"
            />
        </dashboard-card>
        <dashboard-card
            title="Users"
            :count="userCount"
            :href="route('users.index')"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"
            />
        </dashboard-card>
    </div>
</template>

<script>
import AppLayout from "@/Layouts/App.vue";
import { Link } from "@inertiajs/inertia-vue3";
import DashboardCard from "@/Components/DashboardCard.vue";

export default {
    layout: AppLayout,
    components: {
        AppLayout,
        Link,
        DashboardCard,
    },
    props: {
        adminCount: {
            type: Number,
            default: 0,
        },
        userCount: {
            type: Number,
            default: 0,
        },
    },
};
</script>
