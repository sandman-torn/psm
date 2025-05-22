<template>
  <div v-if="program">
    <div class="p-5 mb-6 border border-gray-200 rounded-2xl dark:border-gray-800 lg:p-6">
      <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
        <div>
          <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90 lg:mb-6">
            Maklumat Pendaftaran Peserta
          </h4>

          <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-7 2xl:gap-x-32">
            <div>
              <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                Jumlah Peserta Berdaftar : {{ program.registered_participants_count }}
              </p>
            </div>
          </div>
        </div>
        <RouterLink
          :to="`/senarai-peserta-program/${program.id}`"
          class="edit-button flex items-center gap-2"
        >
          <svg
            class="fill-current"
            width="18"
            height="18"
            viewBox="0 0 18 18"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M15.0911 2.78206C14.2125 1.90338 12.7878 1.90338 11.9092 2.78206L4.57524 10.116C4.26682 10.4244 4.0547 10.8158 3.96468 11.2426L3.31231 14.3352C3.25997 14.5833 3.33653 14.841 3.51583 15.0203C3.69512 15.1996 3.95286 15.2761 4.20096 15.2238L7.29355 14.5714C7.72031 14.4814 8.11172 14.2693 8.42013 13.9609L15.7541 6.62695C16.6327 5.74827 16.6327 4.32365 15.7541 3.44497L15.0911 2.78206ZM12.9698 3.84272C13.2627 3.54982 13.7376 3.54982 14.0305 3.84272L14.6934 4.50563C14.9863 4.79852 14.9863 5.2734 14.6934 5.56629L14.044 6.21573L12.3204 4.49215L12.9698 3.84272ZM11.2597 5.55281L5.6359 11.1766C5.53309 11.2794 5.46238 11.4099 5.43238 11.5522L5.01758 13.5185L6.98394 13.1037C7.1262 13.0737 7.25666 13.003 7.35947 12.9002L12.9833 7.27639L11.2597 5.55281Z"
            />
          </svg>
          Senarai Peserta
        </RouterLink>
      </div>
    </div>
    <div class="p-5 mb-6 border border-gray-200 rounded-2xl dark:border-gray-800 lg:p-6">
      <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-4">
        Maklumat Kehadiran Peserta
      </h4>

      <div
        v-for="(date, index) in attendanceDates"
        :key="index"
        class="flex justify-between items-center border p-3 rounded-lg mb-2"
      >
        <div>
          <p class="mb-2 text-sm leading-normal text-gray-800 dark:text-white">
            Kehadiran Peserta pada <strong>{{ formatDate(date) }}</strong>
          </p>

          <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
            Jumlah Peserta Hadir: {{ attendanceStats[date]?.hadir || 0 }}
          </p>
          <p class="text-xs text-gray-500 dark:text-gray-400">
            Jumlah Peserta Tidak Hadir: {{ attendanceStats[date]?.tidak_hadir || 0 }}
          </p>
          <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">
            Jumlah Peserta Walk-in: {{ attendanceStats[date]?.walkin || 0 }}
          </p>
          <p class="text-xs text-gray-500 dark:text-gray-400">Pautan Pendaftaran Kehadiran</p>
          <p class="text-xs text-gray-500 text-gray-800 dark:text-white/90">
            {{ baseLink + program.id + '?date=' + date }}
          </p>
        </div>
        <button
          @click.prevent="copyLink(program.id, date)"
          class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm mt-auto"
        >
          Salin
        </button>
        <!-- Visible QR Code (size: 100) -->
        <div ref="displayRef">
          <QrcodeVue :value="qrUrl + program.id + '?date=' + date" :size="100" render-as="canvas" />
        </div>

        <!-- For each QR download area -->
        <div :ref="(el) => setDownloadRef(el, index)" style="display: none">
          <QrcodeVue :value="qrUrl + program.id + '?date=' + date" :size="600" render-as="canvas" />
        </div>
        <button @click="downloadQR(index)" class="mt-auto px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">Muat Turun</button>

        <div class="flex justify-between items-center p-3 rounded-lg mb-2">
          <RouterLink
            :to="`/kehadiran-peserta-program/${program.id}?date=${date}`"
            class="edit-button flex items-center gap-2"
          >
            <svg
              class="fill-current"
              width="18"
              height="18"
              viewBox="0 0 18 18"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M15.0911 2.78206C14.2125 1.90338 12.7878 1.90338 11.9092 2.78206L4.57524 10.116C4.26682 10.4244 4.0547 10.8158 3.96468 11.2426L3.31231 14.3352C3.25997 14.5833 3.33653 14.841 3.51583 15.0203C3.69512 15.1996 3.95286 15.2761 4.20096 15.2238L7.29355 14.5714C7.72031 14.4814 8.11172 14.2693 8.42013 13.9609L15.7541 6.62695C16.6327 5.74827 16.6327 4.32365 15.7541 3.44497L15.0911 2.78206ZM12.9698 3.84272C13.2627 3.54982 13.7376 3.54982 14.0305 3.84272L14.6934 4.50563C14.9863 4.79852 14.9863 5.2734 14.6934 5.56629L14.044 6.21573L12.3204 4.49215L12.9698 3.84272ZM11.2597 5.55281L5.6359 11.1766C5.53309 11.2794 5.46238 11.4099 5.43238 11.5522L5.01758 13.5185L6.98394 13.1037C7.1262 13.0737 7.25666 13.003 7.35947 12.9002L12.9833 7.27639L11.2597 5.55281Z"
              />
            </svg>
            Senarai Kehadiran
          </RouterLink>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, nextTick } from 'vue'
import Swal from 'sweetalert2'
import axios from 'axios'
import QrcodeVue from 'qrcode.vue'
import { useRouter, useRoute } from 'vue-router'

const route = useRoute()
const programId = route.params.id
const qrUrl = `http://psm-b.test:5173/daftar-kehadiran-program/`
const displayRef = ref(null)
const downloadRefs = ref([])

const setDownloadRef = (el, index) => {
  if (el) {
    downloadRefs.value[index] = el
  }
}

const downloadQR = async (index) => {
  await nextTick()

  const el = downloadRefs.value[index]
  const canvas = el?.$el?.querySelector('canvas') || el?.querySelector?.('canvas')

  if (canvas) {
    const link = document.createElement('a')
    link.download = `program-qr-${index}.png`
    link.href = canvas.toDataURL('image/png')
    link.click()
  } else {
    alert('QR code not ready yet.')
  }
}

//import Modal from './Modal.vue'

const isProfileInfoModal = ref(false)

const props = defineProps({
  program: {
    type: Object,
    required: true,
  },
})

const baseLink = 'http://psm-b.test:5173/daftar-kehadiran-program/' // adjust this to your actual frontend route

const attendanceDates = computed(() => getDateRange(props.program.date_from, props.program.date_to))

const getDateRange = (start, end) => {
  const startDate = new Date(start)
  const endDate = new Date(end)
  const dates = []

  while (startDate <= endDate) {
    dates.push(new Date(startDate).toISOString().split('T')[0])
    startDate.setDate(startDate.getDate() + 1)
  }

  return dates
}

//get summary
const attendanceStats = ref({})

const fetchAttendanceSummary = async () => {
  for (const date of attendanceDates.value) {
    try {
      const response = await axios.get(`/api/programs/${props.program.id}/attendance-summary`, {
        params: { date },
      })

      console.log(`Attendance summary for ${date}`, response.data)

      attendanceStats.value[date] = response.data
    } catch (error) {
      console.error(`Error fetching summary for ${date}`, error)
    }
  }
}

onMounted(() => {
  fetchAttendanceSummary()
})
//end get summary

const copyLink = async (programId, date) => {
  const link = `${baseLink}${programId}?date=${date}`
  try {
    await navigator.clipboard.writeText(link)
    alert('Pautan disalin!')
  } catch (err) {
    // Fallback to execCommand for older or insecure environments
    const textarea = document.createElement('textarea')
    textarea.value = link
    textarea.style.position = 'fixed'
    textarea.style.left = '-9999px'
    document.body.appendChild(textarea)
    textarea.select()

    try {
      const successful = document.execCommand('copy')
      if (successful) {
        Swal.fire('Berjaya!', 'Link pendaftaran telah disalin.', 'success')
      } else {
        throw new Error('execCommand failed')
      }
    } catch (fallbackErr) {
      Swal.fire('Ralat', 'Gagal menyalin link.', 'error')
      console.error('Clipboard copy failed:', fallbackErr)
    } finally {
      document.body.removeChild(textarea)
    }
  }
}

const formatDate = (date) => {
  const options = { day: '2-digit', month: 'short', year: 'numeric' }
  return new Date(date).toLocaleDateString('ms-MY', options)
}

const saveProfile = () => {
  // Implement save profile logic here
  console.log('Profile saved')
  isProfileInfoModal.value = false
}
</script>
