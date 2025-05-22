<template>
  <div v-if="isLoading">Loading program...</div>
  <div v-else>
    <h1>{{ program.program_name }}</h1>

    <label>Pilih Tarikh:</label>
    <select
      v-model="selectedDate"
      class="mb-4 mt-2 ml-4 dark:bg-dark-900 h-11 rounded-lg border border-gray-300 bg-transparent px-2 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
    >
      <option v-for="date in availableDates" :key="date" :value="date">
        {{ date }}
      </option>
    </select>

    <table class="min-w-full">
      <thead>
        <tr class="border-b border-gray-200 dark:border-gray-700">
          <th class="px-5 py-3 text-left w-3/11 sm:px-6">
            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Nama dan Emel</p>
          </th>
          <th class="px-5 py-3 text-left w-2/11 sm:px-6">
            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">myKad</p>
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
          v-for="(participant, index) in paginatedUsers"
          :key="index"
          class="border-t border-gray-100 dark:border-gray-800"
        >
          <td class="px-5 py-4 sm:px-6">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 overflow-hidden rounded-full flex-shrink-0">
                <img src="/images/user/avatar.jpg" :alt="participant.user.name" />
              </div>
              <div>
                <span class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                  {{ participant.user.name }}
                </span>
                <span class="block text-gray-500 text-theme-xs dark:text-gray-400">
                  {{ participant.user.email }}
                </span>
              </div>
            </div>
          </td>
          <td class="px-5 py-4 sm:px-6">
            <p class="text-gray-500 text-theme-sm dark:text-gray-400">
              {{ participant.user.ic_no }}
            </p>
          </td>

          <td class="px-5 py-4 sm:px-6">
            <p class="text-gray-500 text-theme-sm dark:text-gray-400">
              {{ participant.user.position }}
            </p>
          </td>
          <td class="px-5 py-4 sm:px-6">
            <p class="text-gray-500 text-theme-sm dark:text-gray-400">
              {{ participant.user.department }}
            </p>
          </td>
          <td class="px-5 py-4 sm:px-6">
            <select v-model="participant.is_present" @change="updateAttendance(participant)">
              <option :value="true">Hadir</option>
              <option :value="false">Tidak Hadir</option>
            </select>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue'
import axios from 'axios'
import dayjs from 'dayjs'
import { computed } from 'vue'
import isSameOrBefore from 'dayjs/plugin/isSameOrBefore'
import { useRouter, useRoute } from 'vue-router'

const route = useRoute()
const router = useRouter()

dayjs.extend(isSameOrBefore)

const program = ref({})
const availableDates = ref([]) // ← start kosong
const selectedDate = ref(null)
const participants = ref([])

function generateDates(startDate, endDate) {
  const dates = []
  let current = dayjs(startDate)
  const last = dayjs(endDate)
  while (current.isSameOrBefore(last)) {
    dates.push(current.format('YYYY-MM-DD'))
    current = current.add(1, 'day')
  }
  return dates
}

const saveAttendance = async () => {
  try {
    await axios.post('/api/attendance/manual', {
      program_id: program.value.id,
      date: selectedDate.value,
      attendances: participants.value.map((p) => ({
        participant_id: p.id,
        is_present: p.is_present,
      })),
    })
    alert('Kehadiran berjaya disimpan!')
  } catch (error) {
    console.error(error)
    alert('Gagal simpan kehadiran.')
  }
}

const isLoading = ref(true)
const formatDate = (dateString) => {
  return dayjs(dateString, 'DD/MM/YYYY').format('YYYY-MM-DD')
}

//Pagination
const currentPage = ref(1)
const perPage = 10

const paginatedUsers = computed(() => {
  const start = (currentPage.value - 1) * perPage
  return participants.value.slice(start, start + perPage)
})

const totalPages = computed(() => {
  return Math.ceil(participant.value.length / perPage)
})

const changePage = (page) => {
  if (page >= 1 && page <= totalPages.value) {
    currentPage.value = page
  }
}
//end Pagination

onMounted(async () => {
  const programId = route.params.id
  try {
    const response = await axios.get(`/api/programs/${programId}`)
    program.value = response.data
    console.log('programRes:', response)
    console.log('Original date_from:', program.value.date_from)
    console.log('Original date_to:', program.value.date_to)

    const formattedDateFrom = formatDate(program.value.date_from)
    const formattedDateTo = formatDate(program.value.date_to)

    console.log('Formatted date_from:', formattedDateFrom)
    console.log('Formatted date_to:', formattedDateTo)

    availableDates.value = generateDates(formattedDateFrom, formattedDateTo)

    console.log('Available Dates:', availableDates.value)

    isLoading.value = false

    const participantResponse = await axios.get(`/api/programs/${programId}/participants`)
    participants.value = participantResponse.data.filter((p) => p.is_walkin === 0)
    console.log(participants)
  } catch (err) {
    console.error(err)
  }

  const attendanceResponse = await axios.get(
    `/api/attendance/${programId}?date=${selectedDate.value}`,
  )
  const attendanceList = attendanceResponse.data

  participants.value = participantResponse.data.map((p) => {
    const isPresent = attendanceList.some((a) => a.user_id === p.user_id && a.is_present)
    return {
      ...p,
      is_present: isPresent,
    }
  })
})

//kemaskini
const updateAttendance = async (participant) => {
  if (!selectedDate.value) {
    alert('Sila pilih tarikh terlebih dahulu.')
    return
  }

  try {
    if (participant.is_present) {
      // Mark hadir (insert attendance)
      await axios.post('/api/attendance/manual', {
        program_id: program.value.id,
        user_id: participant.user.id,
        date: selectedDate.value,
        attendances: [
          {
            participant_id: participant.id,
            is_present: 1,
          },
        ],
      })
    } else {
      // Mark tidak hadir (delete attendance)
      await axios.post('/api/attendance/manual/delete', {
        program_id: program.value.id,
        date: selectedDate.value,
        user_id: participant.user.id,
      })
    }

    alert('Status kehadiran dikemaskini.')
  } catch (error) {
    console.error(error)
    alert('Gagal mengemaskini kehadiran.')
  }
}
//end kemskini

//add watch on selected date
watch(selectedDate, async (newDate) => {
  if (!newDate) return
  try {
    const programId = route.params.id
    const attendanceResponse = await axios.get(`/api/attendance/${programId}?date=${newDate}`)
    const attendanceList = attendanceResponse.data

    participants.value = participants.value.map((p) => {
      const isPresent = attendanceList.some((a) => a.user_id === p.user_id && Boolean(a.is_present))
      return {
        ...p,
        is_present: isPresent,
      }
    })
  } catch (err) {
    console.error('Failed to reload attendance for new date:', err)
  }
})
</script>
