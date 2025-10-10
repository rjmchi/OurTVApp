<script setup lang="ts">
import AppContent from '@/components/AppContent.vue';
import AppHeader from '@/components/AppHeader.vue';
import AppShell from '@/components/AppShell.vue';

</script>

<template>
    AppHeaderLayout
    <AppShell class="flex-col">
        AppShell
        <AppHeader />
        <AppContent>
            <slot />
        </AppContent>
    </AppShell>
</template>
