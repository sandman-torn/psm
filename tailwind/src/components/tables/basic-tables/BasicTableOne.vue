<template>
  <div
    class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]"
  >
    <div class="max-w-full overflow-x-auto custom-scrollbar">
      <div class="flex justify-end mt-6 mb-4 mr-4">
        <RouterLink
          :to="{ name: 'Borang Pendaftaran Pengguna' }"
          class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded"
        >
          Tambah Pengguna
        </RouterLink>
      </div>

      <table class="min-w-full">
        <thead>
          <tr class="border-b border-gray-200 dark:border-gray-700">
            <th class="px-5 py-3 text-left w-3/11 sm:px-6">
              <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                Nama dan Emel
              </p>
            </th>
            <th class="px-5 py-3 text-left w-2/11 sm:px-6">
              <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">myKad</p>
            </th>
            <th class="px-5 py-3 text-left w-2/11 sm:px-6">
              <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Peranan</p>
            </th>
            <th class="px-5 py-3 text-left w-2/11 sm:px-6">
              <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Jawatan</p>
            </th>
            <th class="px-5 py-3 text-left w-2/11 sm:px-6">
              <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Jabatan</p>
            </th>
            <th class="px-5 py-3 text-left w-2/11 sm:px-6">
              <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Tindakan</p>
            </th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
          <tr
            v-for="(user, index) in paginatedUsers"
            :key="index"
            class="border-t border-gray-100 dark:border-gray-800"
          >
            <td class="px-5 py-4 sm:px-6">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 overflow-hidden rounded-full">
                  <img src="/images/user/avatar.jpg" :alt="user.name" />
                </div>
                <div>
                  <span class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                    {{ user.name }}
                  </span>
                  <span class="block text-gray-500 text-theme-xs dark:text-gray-400">
                    {{ user.email }}
                  </span>
                </div>
              </div>
            </td>
            <td class="px-5 py-4 sm:px-6">
              <p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ user.ic_no }}</p>
            </td>
            <td class="px-5 py-4 sm:px-6">
              <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                {{ user.roles.join(', ') }}
              </p>
            </td>
            <td class="px-5 py-4 sm:px-6">
              <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                {{ user.position }}
              </p>
            </td>
            <td class="px-5 py-4 sm:px-6">
              <p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ user.department }}</p>
            </td>
            <td class="px-5 py-4 sm:px-6">
              <div class="flex gap-2">
                <RouterLink :to="{ name: 'Borang Kemaskini Pengguna.edit', params: { id: user.id } }"
                  class="inline-flex items-center justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                >
                Ubah
                </RouterLink>
                
                <button
                  @click="confirmDelete(user.id)"
                  class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-3 py-1 rounded"
                >
                  Padam
                </button>
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


//Delete User

const confirmDelete = async (userId) => {
  const confirm = await Swal.fire({
    title: 'Adakah anda pasti?',
    text: 'Pengguna ini akan dipadam.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Ya, padam!',
    cancelButtonText: 'Batal'
  })

  if (confirm.isConfirmed) {
    try {
      await axios.delete(`/api/users/${userId}`)

      Swal.fire('Berjaya!', 'Pengguna telah dipadam.', 'success')

      // ❗ Instead of pushing route again, just refresh the list:
      fetchUsers()
    } catch (error) {
      console.error(error)
      Swal.fire('Ralat', 'Gagal memadam pengguna.', 'error')
    }
  }
}


//End delet User

//Pagination
const users = ref([]) // All users
const currentPage = ref(1)
const perPage = 10

const paginatedUsers = computed(() => {
  const start = (currentPage.value - 1) * perPage
  return users.value.slice(start, start + perPage)
})

const totalPages = computed(() => {
  return Math.ceil(users.value.length / perPage)
})

const changePage = (page) => {
  if (page >= 1 && page <= totalPages.value) {
    currentPage.value = page
  }
}
//end Pagination

//fetch users
const fetchUsers = async () => {
  try {
    const response = await axios.get('/api/users')
    users.value = response.data // if using resource
    // OR: users.value = response.data if not using resource
  } catch (error) {
    console.error('Failed to fetch users:', error)
  }
}

onMounted(fetchUsers)
//end fetch users
</script>

<style scoped>
/* Add any additional styles here if needed */
</style>
