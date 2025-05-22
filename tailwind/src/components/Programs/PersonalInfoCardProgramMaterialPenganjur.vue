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
            Muat Naik Bahan Program
          </h4>

          <div>
            <h2 class="text-m font-semibold text-gray-800 dark:text-white/90 lg:mb-2">Sila Muat Naik Bahan</h2>
            <form @submit.prevent="uploadMaterial" class="space-y-3">
              <input
                type="text"
                v-model="material_name"
                placeholder="Tajuk Bahan"
                required
                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
              />
              <input type="file" @change="handleFile" required class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
              <button type="submit" class="px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-green-600 hover:bg-green-700">Muat Naik</button>
            </form>

            <div v-if="materials.length" class="mt-6">
              <h2 class="text-m font-semibold text-gray-800 dark:text-white/90 lg:mb-2">Senarai Bahan</h2>
              <div>
                <table class="text-sm text-gray-800 dark:text-white/90 table-auto border border-gray-300 w-full">
                  <thead>
                    <tr>
                      <th class="border px-4 py-2">No</th>
                      <th class="border px-4 py-2">Nama Bahan</th>
                      <th class="border px-4 py-2">Muat Turun</th>
                      <th class="border px-4 py-2">Tindakan</th>
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
                      <td class="border px-4 py-2">
                        <button
                          class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-3 py-1 rounded"
                          @click="deleteMaterial(item.id)"
                        >
                          Padam
                        </button>
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
  </div>
</template>

<script setup>
//import Modal from './Modal.vue'
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { useRoute } from 'vue-router'
import Swal from 'sweetalert2'

const route = useRoute()
const programId = route.params.id // atau route.params.programId bergantung pada route config

const isProfileInfoModal = ref(false)

const props = defineProps({
  programId: Number,
  program: {
    type: Object,
    required: true,
  },
})

const material_name = ref('')
const file = ref(null)
const materials = ref([])

const handleFile = (e) => {
  file.value = e.target.files[0]
}

const uploadMaterial = async () => {
  try {
    // Dapatkan CSRF token dari Sanctum
    await axios.get('/sanctum/csrf-cookie')

    const formData = new FormData()
    formData.append('program_id', programId)
    formData.append('material_name', material_name.value)
    formData.append('file', file.value)

    await axios.post('/api/materials', formData)

    Swal.fire({
      icon: 'success',
      title: 'Berjaya!',
      text: 'Bahan berjaya dimuat naik.',
      timer: 2000,
      showConfirmButton: true,
    })

    // Reset input
    material_name.value = ''
    file.value = null

    fetchMaterials()
  } catch (error) {
    console.error('Upload gagal:', error.response.data)
    Swal.fire({
      icon: 'error',
      title: 'Ralat',
      text: error.response?.data?.message || 'Gagal muat naik bahan.',
    })
  }
}

// contoh fetchMaterials() function untuk populate materials
const fetchMaterials = async () => {
  const res = await axios.get(`/api/materials/${programId}`)
  materials.value = res.data
}

// delete function
const deleteMaterial = async (id) => {
  const confirm = await Swal.fire({
    title: 'Padam Bahan?',
    text: 'Adakah anda pasti ingin memadam bahan ini?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Ya, padam',
    cancelButtonText: 'Batal',
  })

  if (confirm.isConfirmed) {
    try {
      await axios.delete(`/api/materials/${id}`)
      await fetchMaterials()

      Swal.fire({
        icon: 'success',
        title: 'Berjaya!',
        text: 'Bahan berjaya dipadam.',
        //timer: 2000,
        showConfirmButton: true,
      })
    } catch (error) {
      Swal.fire({
        icon: 'error',
        title: 'Ralat',
        text: 'Gagal memadam bahan. Sila cuba lagi.',
      })
    }
  }
}

// panggil fetchMaterials bila component mount
fetchMaterials()

const saveProfile = () => {
  // Implement save profile logic here
  console.log('Profile saved')
  isProfileInfoModal.value = false
}
</script>
