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
          <input
            v-model="form.date_from"
            type="date"
            class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pl-4 pr-11 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
          />
          <p v-if="errors.date_from" class="mt-2 text-sm text-red-600">
            {{ errors.date_from[0] }}
          </p>
        </div>
        <div class="space-y-6">
          <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Tarikh Tamat
          </label>
          <input
            v-model="form.date_to"
            type="date"
            class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pl-4 pr-11 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
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
          <!-- Input: Masa -->
          <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Masa Mula
          </label>
          <input
            v-model="form.time_from"
            type="time"
            class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pl-4 pr-11 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
          />
          <p v-if="errors.time_from" class="mt-2 text-sm text-red-600">
            {{ errors.time_from[0] }}
          </p>
        </div>
        <div class="space-y-6">
          <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Masa Tamat
          </label>
          <input
            v-model="form.time_to"
            type="time"
            class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pl-4 pr-11 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
          />
          <p v-if="errors.time_to" class="mt-2 text-sm text-red-600">
            {{ errors.time_to[0] }}
          </p>
        </div>
      </div>

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
          <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Pegawai Bertanggungjawab
          </label>
          <input
            type="text"
            :value="programRes ? programRes.created_by_name : ''"
            readonly
            class="bg-gray-100 dark:bg-dark-900 cursor-not-allowed h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 dark:text-white/90"
          />
          <input type="hidden" v-model="form.created_by" />
          <!-- 👈 hidden input to store ID -->
          <p v-if="errors.created_by" class="mt-2 text-sm text-red-600">
            {{ errors.created_by[0] }}
          </p>
        </div>

        <!-- Display by_unit_name, but bind the ID to form.by_unit -->
        <div class="space-y-6">
          <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Unit Bertanggungjawab
          </label>
          <input
            type="text"
            :value="programRes ? programRes.by_unit_name : ''"
            readonly
            class="bg-gray-100 dark:bg-dark-900 cursor-not-allowed h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 dark:text-white/90"
          />
          <input type="hidden" v-model="form.by_unit" />
          <!-- 👈 hidden input to store ID -->
          <p v-if="errors.by_unit" class="mt-2 text-sm text-red-600">
            {{ errors.by_unit[0] }}
          </p>
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
import { useRouter, useRoute } from 'vue-router'
import axios from 'axios'
import Datepicker from 'vue3-datepicker'
import useAuth from '@/composable/useAuthPenganjur'

const { user, authenticated, logout: logoutAction } = useAuth()

const route = useRoute()
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
  time_from: '',
  time_to: '',
})

//fetch current user information
const programRes = ref<any>(null) // to access names in template

onMounted(async () => {
  const programId = route.params.id
  console.log('userId:', programId) // 👈 This will show in your browser's DevTools Console

  try {
    const response = await axios.get(`/api/programs/${programId}`)
    console.log('programRes:', response) // 👈 Shows the full response object in the browser console
    programRes.value = response.data // Assign API response to programRes
    form.value.program_name = response.data.program_name
    form.value.program_desc = response.data.program_desc
    form.value.date_from = response.data.date_from
    form.value.date_to = response.data.date_to
    form.value.location = response.data.location
    form.value.url = response.data.url
    form.value.created_by = response.data.created_by
    form.value.by_unit = response.data.by_unit
    form.value.time_from = response.data.time_from
    form.value.time_to = response.data.time_to
  } catch (err) {
    console.error(err)
  }
})



type ValidationErrors = {
  [key: string]: string[]
}

const errors = ref<ValidationErrors>({})

// Submit form
const submit = async () => {
  errors.value = {} // clear errors

  const payload = {
  ...form.value,
  time_from: form.value.time_from.length === 5 ? form.value.time_from + ':00' : form.value.time_from,
  time_to: form.value.time_to.length === 5 ? form.value.time_to + ':00' : form.value.time_to,
}

  try {
    await axios.get('/sanctum/csrf-cookie')


    const response = await axios.put(`/api/programs/${route.params.id}`, payload)
    console.log('hantar apa:', response)
    router.push('/senarai-program')
  } catch (err: any) {
    if (err.response?.status === 422) {
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
