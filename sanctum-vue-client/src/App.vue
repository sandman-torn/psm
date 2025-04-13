<script setup>
import { RouterView } from 'vue-router'
import Navigation from './components/Navigation.vue';

</script>

<template>
  <div>
    <Navigation />
    <div class="py-6 lg:py-2">
      <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <RouterView />
      </div>
    </div>
  </div>
</template>

<style scoped></style>
