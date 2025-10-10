<script setup lang="ts">
import AppLogo from '@/components/AppLogo.vue';
import { logout } from '@/routes';
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <div class="flex items-center space-x-4">
        <Link href="/dashboard">
        <AppLogo />
        </Link>
        <Link href="/settings">Profile</Link>
        <Link :href="logout()">Logout</Link>

    </div>
    <slot />

</template>
