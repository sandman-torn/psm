<template>
  <div v-if="program">
    <div class="p-5 mb-6 border border-gray-200 rounded-2xl dark:border-gray-800 lg:p-6">
      <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
        <div>
          <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90 lg:mb-6">
            Maklumat Terperinci
          </h4>

          <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-7 2xl:gap-x-32">
            <div>
              <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                Tarikh Mula
              </p>
              <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                {{ program.date_from_display }}
              </p>
            </div>

            <div>
              <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                Tarikh Tamat
              </p>
              <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                {{ program.date_to_display }}
              </p>
            </div>
            <div>
              <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">Lokasi</p>
              <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                {{ program.location }}
              </p>
            </div>
            <div>
              <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                Kuota peserta
              </p>
              <p class="text-sm font-medium text-gray-800 dark:text-white/90">{{ program.url }}</p>
            </div>
            <div>
              <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                Pegawai Bertanggungjawab
              </p>
              <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                {{ program.created_by_name }}
              </p>
            </div>

            <div>
              <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                Unit Bertanggungjawab
              </p>
              <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                {{ program.by_unit_name }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Button -->
    <div class="mt-4 flex justify-between items-center w-full">
      <!-- Save button (left) -->
      <button
        @click="registerProgram(program.id)"
        class="px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-green-600 hover:bg-green-700"
      >
        Daftar
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'
import { useRoute, useRouter } from 'vue-router'
import Swal from 'sweetalert2'
//import Modal from './Modal.vue'

//register program
const router = useRouter()
const route = useRoute()

const registerProgram = async (programId) => {
  const selectedDate = route.query.date
  if (!selectedDate) {
    Swal.fire('Ralat', 'Tarikh tidak dijumpai dalam URL.', 'error')
    return
  }

  try {
    await axios.get('/sanctum/csrf-cookie')

    // Get logged-in user
    const userResponse = await axios.get('/api/user', { withCredentials: true })
    const user = userResponse.data
    console.log('USER DATA:', user)

    // Get existing attendance list
    const checkResponse = await axios.get(`/api/attendance/${programId}?date=${selectedDate}`)
    const attendanceList = checkResponse.data
    
    const existingAttendance = attendanceList.find((item) => item.user_id === user.id)
    if (existingAttendance) {
      Swal.fire('Makluman', 'Anda telah mendaftar kehadiran untuk program ini.', 'info')
      return
    }

    // If not registered, then register attendance
    await axios.post(
      '/api/attendance/manual',
      {
        program_id: programId,
        date: selectedDate,
        user_id: user.id,
        is_present: 1,
      },
      { withCredentials: true },
    )

    Swal.fire('Berjaya', 'Kehadiran anda telah direkodkan!', 'success')
    router.push('/dashboard')
  } catch (error) {
    console.error('FULL ERROR:', error)
    Swal.fire('Ralat', 'Gagal merekodkan kehadiran. Sila cuba lagi.', 'error')
  }
}
//end Register Program

const isProfileInfoModal = ref(false)

defineProps({
  program: {
    type: Object,
    required: true,
  },
})

const saveProfile = () => {
  // Implement save profile logic here
  console.log('Profile saved')
  isProfileInfoModal.value = false
}
</script>
