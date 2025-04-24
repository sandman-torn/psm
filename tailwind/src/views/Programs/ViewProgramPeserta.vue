<template>
  <admin-layout>
    <PageBreadcrumb :pageTitle="currentPageTitle" />

    <div
      class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6"
    >
      <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90 lg:mb-7">Maklumat Program</h3>
      <profile-card v-if="program" :program="program"  />
      <personal-info-card v-if="program" :program="program" />
    </div>
  </admin-layout>
</template>

<script setup>
import AdminLayout from '../../components/layout/AdminLayout.vue'
import PageBreadcrumb from '@/components/common/PageBreadcrumb.vue'
import { ref } from 'vue'
import ProfileCard from '../../components/programs/ProfileCardProgramPeserta.vue'
import PersonalInfoCard from '../../components/programs/PersonalInfoCardProgramPeserta.vue'
import AddressCard from '../../components/profile/AddressCard.vue'
const currentPageTitle = ref('Program')
import {  onMounted } from 'vue'
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
