<template>
  <div
    class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]"
  >
    <div class="max-w-full overflow-x-auto custom-scrollbar">
      

      <table class="min-w-full">
        <thead>
          <tr class="border-b border-gray-200 dark:border-gray-700">
            <th class="px-5 py-3 text-left w-3/11 sm:px-6">
              <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Nama Program</p>
            </th>
            <th class="px-5 py-3 text-left w-2/11 sm:px-6">
              <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Lokasi</p>
            </th>
            <th class="px-5 py-3 text-left w-2/11 sm:px-6">
              <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Tarikh Mula</p>
            </th>
            <th class="px-5 py-3 text-left w-2/11 sm:px-6">
              <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Tarikh Tamat</p>
            </th>
            <th class="px-5 py-3 text-left w-2/11 sm:px-6">
              <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                Pegawai Bertanggungjawab
              </p>
            </th>
            <th class="px-5 py-3 text-left w-2/11 sm:px-6">
              <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Status Muat Turun Sijil</p>
            </th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
          <tr
            v-for="(programs, index) in paginatedPrograms"
            :key="index"
            class="border-t border-gray-100 dark:border-gray-800"
          >
            <td class="px-5 py-4 sm:px-6">
              <div class="flex items-center gap-3">
                <div>
                  <span class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                    {{ programs.program_name }}
                  </span>
                </div>
              </div>
            </td>
            <td class="px-5 py-4 sm:px-6">
              <p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ programs.location }}</p>
            </td>
            <td class="px-5 py-4 sm:px-6">
              <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                {{ programs.date_from_display }}
              </p>
            </td>
            <td class="px-5 py-4 sm:px-6">
              <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                {{ programs.date_to_display }}
              </p>
            </td>
            <td class="px-5 py-4 sm:px-6">
              <p class="text-center text-gray-500 text-theme-sm dark:text-gray-400">
                {{ programs.created_by_name }}<br />
                [{{ programs.by_unit_name }}]
              </p>
            </td>
            <td class="px-5 py-4 sm:px-6">
              <div class="flex gap-2">
                <template v-if="String(programs.by_unit) === String(userStore.user.unit_id)">
                  <div class="flex gap-2 items-center">
                    <!-- Toggle switch -->
                    <label class="relative inline-flex items-center cursor-pointer">
                      <input
                        type="checkbox"
                        class="sr-only peer"
                        :checked="programs.isCertificate === 1"
                        @change="toggleCertificate(programs.id)"
                      />
                      <div
                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-500 dark:bg-gray-700 rounded-full peer-checked:bg-green-500"
                      ></div>
                      <div
                        class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition-transform peer-checked:translate-x-5"
                      ></div>
                    </label>

                    <span class="text-sm text-gray-600 ml-2">
                      {{ programs.isCertificate ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                  </div>
                </template>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
      <div class="flex justify-center mt-4 mb-6 gap-2">
        <button
          @click="changePage(currentPage - 1)"
          :disabled="currentPage === 1"
          class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300 disabled:opacity-50"
        >
          Prev
        </button>

        <button
          v-for="page in totalPages"
          :key="page"
          @click="changePage(page)"
          :class="[
            'px-3 py-1 rounded',
            currentPage === page ? 'bg-blue-600 text-white' : 'bg-gray-200 hover:bg-gray-300',
          ]"
        >
          {{ page }}
        </button>

        <button
          @click="changePage(currentPage + 1)"
          :disabled="currentPage === totalPages"
          class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300 disabled:opacity-50"
        >
          Next
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, reactive } from 'vue'
import axios from 'axios'
import { computed } from 'vue'
import Modal from '@/components/profile/Modal.vue'
import { RouterLink } from 'vue-router'
import Swal from 'sweetalert2' // Install with: npm install sweetalert2
import useAuth from '@/composable/useAuth'
import { watch } from 'vue'
import { useUserStore } from '@/stores/user' // Import the store

const { user } = useAuth()
const userStore = useUserStore() // Use the store

//Delete program

const confirmDelete = async (programId) => {
  const confirm = await Swal.fire({
    title: 'Adakah anda pasti?',
    text: 'Program ini akan dipadam.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Ya, padam!',
    cancelButtonText: 'Batal',
  })

  if (confirm.isConfirmed) {
    try {
      await axios.delete(`/api/programs/${programId}`)

      Swal.fire('Berjaya!', 'Program telah dipadam.', 'success')

      // ❗ Instead of pushing route again, just refresh the list:
      fetchPrograms()
    } catch (error) {
      console.error(error)
      Swal.fire('Ralat', 'Gagal memadam program.', 'error')
    }
  }
}

//End delet program

//Pagination
const programs = ref([]) // All users

const currentPage = ref(1)
const perPage = 10

const paginatedPrograms = computed(() => {
  const start = (currentPage.value - 1) * perPage
  return programs.value.slice(start, start + perPage)
})

const totalPages = computed(() => {
  return Math.ceil(programs.value.length / perPage)
})

const changePage = (page) => {
  if (page >= 1 && page <= totalPages.value) {
    currentPage.value = page
  }
}
//end Pagination

//fetch users
const fetchPrograms = async () => {
  try {
    const response = await axios.get('/api/programs')
    programs.value = response.data // filter by unit_id
    programs.value = response.data.map((p) => ({
      ...p,
      isCertificate: Number(p.isCertificate),
    }))
    console.log('Fetched programs:', programs.value) // show in console
    // Loop through programs to check if they have by_unit
    // programs.value.forEach((program) => {
    //   console.log('program.by_unit:', program.by_unit)
    //   console.log('Type of program.by_unit:', typeof program.by_unit)
    // })
    // OR: users.value = response.data if not using resource
  } catch (error) {
    console.error('Failed to fetch programs:', error)
  }
}

//onMounted(fetchPrograms)
onMounted(() => {
  fetchPrograms()
  userStore.fetchUser() // Fetch user data when the component is mounted
  console.log('Fetched programs:', programs.value)

})
//end fetch users

const toggleCertificate = async (programId) => {
  try {
    const response = await axios.put(`/api/programs/${programId}/toggle-certificate`)

    // Cari program yang sepadan dan kemas kini nilai isCertificate
    const updatedStatus = response.data.isCertificate
    const program = programs.value.find((p) => p.id === programId)
    if (program) {
      program.isCertificate = updatedStatus
    }

    // Optional: Tunjuk alert
    // Swal.fire('Berjaya', 'Status sijil dikemaskini.', 'success')
  } catch (error) {
    console.error('Gagal menukar status sijil:', error)
    Swal.fire('Ralat', 'Gagal menukar status sijil.', 'error')
  }
}
</script>

<style scoped>
/* Add any additional styles here if needed */
</style>
