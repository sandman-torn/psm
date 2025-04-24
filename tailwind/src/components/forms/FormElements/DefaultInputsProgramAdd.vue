<template>
  <div class="space-y-6">
    <form @submit.prevent="submit">
      <!-- Input with Placeholder -->
      <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
          Nama Program
        </label>
        <input
          type="text"
          v-model="form.program_name"
          placeholder="Kursus Kewangan Akruan"
          class="mb-4 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
        />
        <p v-if="errors.name" class="mt-2 text-sm text-red-600">{{ errors.program_name[0] }}</p>
      </div>
      <div class="space-y-12">
        <!-- Input with Placeholder -->
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
          Keterangan Program
        </label>
        <textarea
          type="text"
          rows="4"
          v-model="form.program_desc"
          placeholder="Kursus ini sesuiai bagi kakitangan kewangan yang baru dilantik"
          class="mb-4 dark:bg-dark-900 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
        />
        <p v-if="errors.program_desc" class="mt-2 text-sm text-red-600">
          {{ errors.program_desc[0] }}
        </p>
      </div>

      <div class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-2">
        <div class="space-y-6">
          <!-- Input: Date To -->
          <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Tarikh Mula
          </label>
          <Datepicker
            v-model="form.date_from"
            format="yyyy-MM-dd"
            class="mb-4 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
          />
          <p v-if="errors.date_from" class="mt-2 text-sm text-red-600">
            {{ errors.date_from[0] }}
          </p>
        </div>
        <div class="space-y-6">
          <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Tarikh Tamat
          </label>
          <Datepicker
            v-model="form.date_to"
            format="yyyy-MM-dd"
            class="mb-4 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
          />
        </div>
      </div>

      <!--<div class="space-y-6">
        Input with Placeholder
         <div>
            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
              Unit
            </label>
            <input
              type="text"
              v-model="form.unit"
              placeholder="Unit Teknologi Maklumat"
              class="mb-4 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
            />
            <p v-if="errors.unit" class="mt-2 text-sm text-red-600">{{ errors.unit[0] }}</p>
          </div> 
      </div>-->

      <div class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-2">
        <div class="space-y-6">
          <!-- Input with Placeholder -->

          <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Lokasi
          </label>
          <input
            type="text"
            v-model="form.location"
            placeholder="Bilik Latihan 1"
            class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
          />
          <p v-if="errors.location" class="mt-2 text-sm text-red-600">{{ errors.location[0] }}</p>
        </div>
        <div class="space-y-6">
          <!-- Input with Placeholder -->
          <div>
            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
              Kuota peserta
            </label>
            <input
              type="text"
              v-model="form.url"
              placeholder="50"
              class="mb-4 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
            />
            <p v-if="errors.url" class="mt-2 text-sm text-red-600">{{ errors.url[0] }}</p>
          </div>
        </div>
      </div>

      <div class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-2">
        <div class="space-y-6">
          <!-- Input with Placeholder -->

          <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Pegawai Bertanggungjawab
          </label>
          <input
            type="text"
            v-model="user.name"
            readonly
            class="bg-gray-100 dark:bg-dark-900 cursor-not-allowed h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 dark:text-white/90"
          />
          <p v-if="errors.created_by" class="mt-2 text-sm text-red-600">
            {{ errors.created_by[0] }}
          </p>
        </div>
        <div class="space-y-6">
          <!-- Input with Placeholder -->
          <div>
            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
              Unit Bertanggungjawab
            </label>
            <input
              type="text"
              v-model="user.unit"
              readonly
              class="bg-gray-100 dark:bg-dark-900 cursor-not-allowed h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 dark:text-white/90"
            />
            <p v-if="errors.by_unit" class="mt-2 text-sm text-red-600">{{ errors.by_unit[0] }}</p>
          </div>
        </div>
      </div>

      <!-- Button -->
      <div class="mt-4 flex justify-between items-center w-full">
        <!-- Save button (left) -->
        <button
          type="submit"
          class="px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-green-600 hover:bg-green-700"
        >
          Simpan
        </button>

        <!-- Back button (right) -->
        <router-link
          to="/senarai-program"
          class="px-4 py-3 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg transition"
        >
          Kembali
        </router-link>
      </div>
    </form>
  </div>
</template>

<script setup lang="ts">
import { ref, reactive, onMounted } from 'vue'
import 'flatpickr/dist/flatpickr.css'
import { useRouter } from 'vue-router'
import axios from 'axios'
import Datepicker from 'vue3-datepicker'
import useAuth from '@/composable/useAuthPenganjur'

const { user, authenticated, logout: logoutAction } = useAuth()

const router = useRouter()

const form = ref({
  created_by: '',
  by_unit: '',
  program_name: '',
  program_desc: '',
  date_from: undefined,
  date_to: undefined,
  location: '',
  url: '',
})

type ValidationErrors = {
  [key: string]: string[]
}

const errors = ref<ValidationErrors>({})

// Submit form
const submit = async () => {
  errors.value = {} // clear previous errors

  // Assign user info to form fields
  form.value.created_by = user.value.name
  form.value.by_unit = user.value.unit_id

  try {
    await axios.get('/sanctum/csrf-cookie')
    const response = await axios.post('/api/programs', form.value)
    const programData = response.data
      console.log('User Data:', programData)
      console.log('Program created:', response.data)
    router.push('/senarai-program')
  } catch (err: any) {
    if (err.response && err.response.status === 422) {
      errors.value = err.response.data.errors
    }
  }
}

const showPassword = ref(false)

const date = ref(null)

const flatpickrConfig = {
  dateFormat: 'Y-m-d',
  altInput: true,
  altFormat: 'F j, Y',
  wrap: true,
}

const flatpickrTimeConfig = {
  enableTime: true,
  noCalendar: true,
  dateFormat: 'H:i',
  time_24hr: false,
  minuteIncrement: 1,
  wrap: false,
}

const time = ref(null)
</script>
