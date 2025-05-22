<template>
  <admin-layout>
    <PageBreadcrumb :pageTitle="currentPageTitle" />

    <div
      class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6"
    >
      <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90 lg:mb-7">
        Maklumat Program
      </h3>
      <profile-card v-if="program" :program="program" />
      <personal-info-card v-if="program" :program="program" />
      <personal-info-card-senarai-peserta v-if="program" :program="program" />
      <!-- Button -->
      <div class="mt-4 flex justify-end items-center w-full">
        <!-- Back button (right) -->
        <router-link
          to="/senarai-program-muat-naik-bahan"
          class="px-4 py-3 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg transition"
        >
          Kembali
        </router-link>
      </div>
    </div>
  </admin-layout>
</template>

<script setup>
import AdminLayout from '../../components/layout/AdminLayoutPenganjur.vue'
import PageBreadcrumb from '@/components/common/PageBreadcrumb.vue'
import { ref } from 'vue'
import ProfileCard from '../../components/programs/ProfileCardProgramMaterialPenganjur.vue'
import PersonalInfoCard from '../../components/programs/PersonalInfoCardProgramMaterialPenganjur.vue'
//import PersonalInfoCardSenaraiPeserta from '../../components/programs/PersonalInfoCardProgramMaklumatPesertaPenganjur.vue'
import AddressCard from '../../components/profile/AddressCard.vue'
const currentPageTitle = ref('Program')
import { onMounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import axios from 'axios'

//fetch current user information
const route = useRoute()
const program = ref(null)

onMounted(async () => {
  const programId = route.params.id
  console.log('userId:', programId) // 👈 This will show in your browser's DevTools Console

  try {
    const response = await axios.get(`/api/programs/${programId}`)
    console.log('programRes:', response) // 👈 Shows the full response object in the browser console
    program.value = response.data

    //programRes.value = response.data // Assign API response to programRes
  } catch (err) {
    console.error(err)
  }
})
</script>
