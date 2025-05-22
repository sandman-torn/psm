<template>
  <AdminLayout>
    <PageBreadcrumb :pageTitle="currentPageTitle" />
    <div class="space-y-5 sm:space-y-6">
      <ComponentCard title="Senarai Peserta Program">
        <BasicTableOne />
        <!-- Button -->
        <div class="mt-4 flex justify-end items-center w-full">
          <!-- Back button (right) -->
          <router-link
            :to="`/program-penganjur/${programId}`"
            class="px-4 py-3 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg transition"
          >
            Kembali
          </router-link>
        </div>
      </ComponentCard>
    </div>
  </AdminLayout>
</template>

<script setup>
import { ref } from 'vue'
import PageBreadcrumb from '@/components/common/PageBreadcrumb.vue'
import AdminLayout from '@/components/layout/AdminLayoutPenganjur.vue'
import ComponentCard from '@/components/common/ComponentCard.vue'
import BasicTableOne from '@/components/tables/basic-tables/BasicTableOneKehadiranPesertaProgram.vue'
const currentPageTitle = ref('Senarai Pengguna')

import { useRoute } from 'vue-router'

const route = useRoute()
const programId = route.params.id
</script>
