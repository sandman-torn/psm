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

    <div class="p-5 mb-6 border border-gray-200 rounded-2xl dark:border-gray-800 lg:p-6">
      <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
        <div>
          <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90 lg:mb-6">
            Maklumat Bahan Program
          </h4>

          <div>

            <div v-if="materials.length" class="mt-6">
              <h2 class="text-m font-semibold text-gray-800 dark:text-white/90 lg:mb-2">Senarai Bahan</h2>
              <div>
                <table class="text-sm text-gray-800 dark:text-white/90 table-auto border border-gray-300 w-full">
                  <thead>
                    <tr>
                      <th class="border px-4 py-2">No</th>
                      <th class="border px-4 py-2">Nama Bahan</th>
                      <th class="border px-4 py-2">Muat Turun</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(item, index) in materials" :key="item.id">
                      <td class="border px-4 py-2">{{ index + 1 }}</td>
                      <td class="border px-4 py-2">{{ item.material_name }}</td>
                      <td class="border px-4 py-2">
                        <a
                          :href="`http://psm-b.test/storage/${item.file_url}`"
                          target="_blank"
                          class="text-blue-600 underline"
                          >Muat Turun</a
                        >
                      </td>
                      
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="p-5 mb-6 border border-gray-200 rounded-2xl dark:border-gray-800 lg:p-6">
      <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
        <div>
          <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90 lg:mb-2">
            Sijil Penyertaan
          </h4>

          <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-7 2xl:gap-x-32">
            <!-- 👇 Print Certificate Button -->
            <div class="mt-2">
              <p class="mb-4 text-sm text-gray-600">
                Sijil akan dikeluarkan pada hari terakhir program
              </p>
              <div v-if="program.isCertificate === 1">
                <p v-html="message" class="mb-4 text-sm text-gray-600"></p>

                <button
                  @click="printCertificate"
                  :disabled="!isEligible || isLoading"
                  class="px-4 py-2 rounded bg-blue-600 text-white disabled:opacity-50"
                >
                  Cetak Sijil
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Button -->
    <div class="mt-4 flex justify-end items-center w-full">
      <!-- Back button (right) -->
      <router-link
        to="/senarai-program-peserta"
        class="px-4 py-3 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg transition"
      >
        Kembali
      </router-link>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { useRoute } from 'vue-router'


const isProfileInfoModal = ref(false)

// Props from parent
const isEligible = ref(false)
const isLoading = ref(true)
const message = ref('')
const props = defineProps({
  program: {
    type: Object,
    required: true,
  },
})

const route = useRoute()
const programId = route.params.id // atau route.params.programId bergantung pada route config

const fetchEligibility = async () => {
  try {
    const response = await axios.get(`/api/certificate/eligibility/${props.program.id}`, {
      withCredentials: true,
    })

    isEligible.value = response.data.eligible
    message.value = isEligible.value
      ? 'Anda layak untuk menerima sijil penyertaan. <br> Sila cetak sijil.'
      : `Anda tidak layak untuk menerima sijil penyertaan. <br>
     Kehadiran anda hanya ${response.data.attendedDays} dari ${response.data.totalDays} hari. <br>
     Sila hubungi admin.`
  } catch (err) {
    console.error('Error checking eligibility:', err)
    message.value = 'Gagal menyemak kelayakan.'
  } finally {
    isLoading.value = false
  }
}

const printCertificate = async () => {
  if (!isEligible.value) return

  try {
    const response = await axios.get(`/api/certificate/download/${props.program.id}`, {
      responseType: 'blob',
      withCredentials: true,
    })

    const blob = new Blob([response.data], { type: 'application/pdf' })
    const link = document.createElement('a')
    link.href = URL.createObjectURL(blob)
    link.download = `sijil-peserta-${props.program.id}.pdf`
    link.click()
  } catch (error) {
    console.error('Gagal muat turun sijil:', error)
  }
}

onMounted(fetchEligibility)

const materials = ref([])

// contoh fetchMaterials() function untuk populate materials
const fetchMaterials = async () => {
  const res = await axios.get(`/api/materials/${programId}`)
  materials.value = res.data
}

// panggil fetchMaterials bila component mount
fetchMaterials()

const saveProfile = () => {
  console.log('Profile saved')
  isProfileInfoModal.value = false
}
</script>
