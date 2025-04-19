<template>
  <div class="space-y-6">
    <form @submit.prevent="submit">
      <!-- Input with Placeholder -->
      <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
          Nama
        </label>
        <input
          type="text"
          v-model="form.name"
          placeholder="Ali bin Abdullah"
          class="mb-4 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
        />
        <p v-if="errors.name" class="mt-2 text-sm text-red-600">{{ errors.name[0] }}</p>
      </div>
      <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
        <div class="space-y-6">
          <!-- Input with Placeholder -->
          <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            My Kad
          </label>
          <input
            type="text"
            v-model="form.ic_no"
            placeholder="841112015403"
            class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
          />
          <p v-if="errors.ic_no" class="mt-2 text-sm text-red-600">{{ errors.ic_no[0] }}</p>
        </div>
        <div class="space-y-6">
          <!-- Input with Placeholder -->
          <div>
            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
              Jawatan
            </label>
            <input
              type="text"
              v-model="form.position"
              placeholder="Penolong Akauntan W5"
              class="mb-4 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
            />
            <p v-if="errors.position" class="mt-2 text-sm text-red-600">{{ errors.position[0] }}</p>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
        <div class="space-y-6">
          <!-- Input with Placeholder -->

          <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Jabatan
          </label>
          <input
            type="text"
            v-model="form.department"
            placeholder="Perbendaharaan Negeri Johor"
            class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
          />
          <p v-if="errors.department" class="mt-2 text-sm text-red-600">
            {{ errors.department[0] }}
          </p>
        </div>
        <div class="space-y-6">
          <!-- Input with Placeholder -->
          <!-- <div>
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
          </div> -->
          <div v-if="form.roles.includes(2)">
            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Unit</label>
            <select v-model="form.unit_id" class="mb-4 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
              <option value="">Pilih Unit</option>
              <option v-for="unit in availableUnits" :key="unit.id" :value="unit.id">
                {{ unit.unit }}
              </option>
            </select>
            <p v-if="errors.unit_id" class="text-sm text-red-600">{{ errors.unit_id[0] }}</p>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
        <div class="space-y-6">
          <!-- Input with Placeholder -->

          <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            No Telefon
          </label>
          <input
            type="text"
            v-model="form.phone_no"
            placeholder="019-7551234"
            class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
          />
          <p v-if="errors.phone_no" class="mt-2 text-sm text-red-600">{{ errors.phone_no[0] }}</p>
        </div>

        <div class="space-y-6">
          <!-- Input with Placeholder -->
          <div>
            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
              Emel
            </label>
            <input
              type="text"
              v-model="form.email"
              placeholder="ali@johor.gov.my"
              class="mb-4 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
            />
            <p v-if="errors.email" class="mt-2 text-sm text-red-600">{{ errors.email[0] }}</p>
          </div>
        </div>
      </div>

      <div class="space-y-6">
        <div class="flex flex-col gap-2">
          <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Peranan
          </label>
          <label v-for="role in availableRoles" :key="role.id" class="flex items-center">
            <input type="checkbox" :value="role.id" v-model="form.roles" class="mr-2" />
            {{ role.role }}
          </label>
          <p v-if="errors.roles" class="mt-2 text-sm text-red-600">
            {{ errors.roles[0] }}
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
          to="/basic-tables"
          class="px-4 py-3 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg transition"
        >
          Kembali
        </router-link>
      </div>
    </form>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import 'flatpickr/dist/flatpickr.css'
import { useRouter, useRoute } from 'vue-router'
import axios from 'axios'

const route = useRoute()
const router = useRouter()

const form = ref({
  name: '',
  ic_no: '',
  position: '',
  department: '',
  unit: '',
  phone_no: '',
  email: '',
  password: '',
  password_confirmation: '',
  roles: [] as number[], // This will store selected role IDs like [1, 2],
  unit_id: '',
})

type ValidationErrors = {
  [key: string]: string[]
}

const errors = ref<ValidationErrors>({})

interface Role {
  id: number
  role: string
}

// Hardcoded available roles
const availableRoles = [
  { id: 1, role: 'Peserta' },
  { id: 2, role: 'Penganjur' },
  { id: 3, role: 'Pentadbir Sistem' },
]

//fetch current user information
onMounted(async () => {
  const userId = route.params.id
  console.log('userId:', userId) // 👈 This will show in your browser's DevTools Console

  try {
    const userRes = await axios.get(`/api/users/${userId}`)
    console.log('userRes:', userRes) // 👈 Shows the full response object in the browser console
    form.value.name = userRes.data.name
    form.value.ic_no = userRes.data.ic_no
    form.value.position = userRes.data.position
    form.value.department = userRes.data.department
    form.value.unit = userRes.data.unit
    form.value.phone_no = userRes.data.phone_no
    form.value.email = userRes.data.email
    form.value.unit_id = userRes.data.unit_id

    // Extract role IDs from user.roles
    form.value.roles = userRes.data.roles.map((r: Role) => r.id)
  } catch (err) {
    console.error(err)
  }
})

const submit = async () => {
  errors.value = {} // clear previous errors

  try {
    await axios.get('/sanctum/csrf-cookie')
    await axios.put(`/api/users/${route.params.id}`, form.value)
    // redirect after success
    router.push('/basic-tables')
  } catch (err: any) {
    if (err.response && err.response.status === 422) {
      errors.value = err.response.data.errors
    }
  }
}

//show unit if pengajur
interface Unit {
  id: number
  unit: string
}

const availableUnits = ref<Unit[]>([])

onMounted(async () => {
  const unitRes = await axios.get('/api/units')
  availableUnits.value = unitRes.data

  // If editing user:
  const userId = route.params.id
  if (userId) {
    const userRes = await axios.get(`/api/users/${userId}`)
    form.value.unit_id = userRes.data.unit_id
    form.value.roles = userRes.data.roles.map((r: Role) => r.id)
  }
})
//end

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
