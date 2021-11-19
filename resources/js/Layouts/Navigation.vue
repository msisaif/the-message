<template>
    <div>
        <nav-link :href="route('dashboard')" :active="route().current('dashboard')">Dashboard</nav-link>
        <nav-link :href="route('admins.index')" :active="route().current('admins.*')">Admins</nav-link>
        <nav-link :href="route('users.index')" :active="route().current('users.*')">Users</nav-link>
    </div>
</template>

<script>
import NavLink from '@/Components/NavLink.vue';
import NavLinkWrapper from '@/Components/NavLinkWrapper.vue';

export default {
    components: {
        NavLink,
        NavLinkWrapper,
    },
}
</script>