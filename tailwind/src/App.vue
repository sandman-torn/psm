<template>
  <ThemeProvider>
    <SidebarProvider>
      <RouterView />
    </SidebarProvider>
  </ThemeProvider>
</template>

<script setup lang="ts">
import ThemeProvider from './components/layout/ThemeProvider.vue'
import SidebarProvider from './components/layout/SidebarProvider.vue'
import { useUserStore } from '@/stores/user'
import { onMounted } from 'vue'

const userStore = useUserStore()

onMounted(async () => {
  const hasSession = localStorage.getItem('token') || document.cookie.includes('XSRF-TOKEN')
  if (hasSession) {
    await userStore.fetchUser()
  } else {
    console.log('No login session, skip fetchUser')
  }
})
</script>
