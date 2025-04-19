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
            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400"
              >Unit</label
            >
            <select
              v-model="form.unit_id"
              class="mb-4 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
            >
              <option value="" disabled selected>Sila pilih unit</option>
              <option v-for="unit in availableUnits" :key="unit.id" :value="unit.id">
                {{ unit.unit }}
              </option>
            </select>
            <p v-if="errors.unit_id" class="text-red-500 text-sm mt-1">{{ errors.unit_id[0] }}</p>
          </div>
        </div>
      </div>

      <div class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-2">
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
          <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Peranan</label>
          <div class=" space-y-1">
            <label v-for="role in availableRoles" :key="role.id" class="flex items-center">
              <input type="checkbox" :value="role.id" v-model="form.roles" class="mr-2" />
              {{ role.role }}
            </label>
          </div>
          <p v-if="errors.roles" class="mt-2 text-sm text-red-600">
            {{ errors.roles[0] }}
          </p>
        </div>
      </div>

      <div class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-2">
        <div class="space-y-6">
          <!-- Password Input -->
          <div>
            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
              Kata Laluan
            </label>
            <div class="relative">
              <input
                :type="showPassword ? 'text' : 'password'"
                v-model="form.password"
                placeholder="Masukkan Kata Laluan"
                class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pl-4 pr-11 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
              />
              <p v-if="errors.password" class="mt-2 text-sm text-red-600">
                {{ errors.password[0] }}
              </p>

              <span
                @click="showPassword = !showPassword"
                class="absolute z-30 -translate-y-1/2 cursor-pointer right-4 top-1/2"
              >
                <svg
                  v-if="!showPassword"
                  class="fill-gray-500 dark:fill-gray-400"
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M10.0002 13.8619C7.23361 13.8619 4.86803 12.1372 3.92328 9.70241C4.86804 7.26761 7.23361 5.54297 10.0002 5.54297C12.7667 5.54297 15.1323 7.26762 16.0771 9.70243C15.1323 12.1372 12.7667 13.8619 10.0002 13.8619ZM10.0002 4.04297C6.48191 4.04297 3.49489 6.30917 2.4155 9.4593C2.3615 9.61687 2.3615 9.78794 2.41549 9.94552C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C13.5184 15.3619 16.5055 13.0957 17.5849 9.94555C17.6389 9.78797 17.6389 9.6169 17.5849 9.45932C16.5055 6.30919 13.5184 4.04297 10.0002 4.04297ZM9.99151 7.84413C8.96527 7.84413 8.13333 8.67606 8.13333 9.70231C8.13333 10.7286 8.96527 11.5605 9.99151 11.5605H10.0064C11.0326 11.5605 11.8646 10.7286 11.8646 9.70231C11.8646 8.67606 11.0326 7.84413 10.0064 7.84413H9.99151Z"
                  />
                </svg>
                <svg
                  v-else
                  class="fill-gray-500 dark:fill-gray-400"
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M4.63803 3.57709C4.34513 3.2842 3.87026 3.2842 3.57737 3.57709C3.28447 3.86999 3.28447 4.34486 3.57737 4.63775L4.85323 5.91362C3.74609 6.84199 2.89363 8.06395 2.4155 9.45936C2.3615 9.61694 2.3615 9.78801 2.41549 9.94558C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C11.255 15.3619 12.4422 15.0737 13.4994 14.5598L15.3625 16.4229C15.6554 16.7158 16.1302 16.7158 16.4231 16.4229C16.716 16.13 16.716 15.6551 16.4231 15.3622L4.63803 3.57709ZM12.3608 13.4212L10.4475 11.5079C10.3061 11.5423 10.1584 11.5606 10.0064 11.5606H9.99151C8.96527 11.5606 8.13333 10.7286 8.13333 9.70237C8.13333 9.5461 8.15262 9.39434 8.18895 9.24933L5.91885 6.97923C5.03505 7.69015 4.34057 8.62704 3.92328 9.70247C4.86803 12.1373 7.23361 13.8619 10.0002 13.8619C10.8326 13.8619 11.6287 13.7058 12.3608 13.4212ZM16.0771 9.70249C15.7843 10.4569 15.3552 11.1432 14.8199 11.7311L15.8813 12.7925C16.6329 11.9813 17.2187 11.0143 17.5849 9.94561C17.6389 9.78803 17.6389 9.61696 17.5849 9.45938C16.5055 6.30925 13.5184 4.04303 10.0002 4.04303C9.13525 4.04303 8.30244 4.17999 7.52218 4.43338L8.75139 5.66259C9.1556 5.58413 9.57311 5.54303 10.0002 5.54303C12.7667 5.54303 15.1323 7.26768 16.0771 9.70249Z"
                  />
                </svg>
              </span>
            </div>
          </div>
        </div>
        <div class="space-y-6">
          <!-- Input with Placeholder -->
          <!-- Password Input -->
          <div>
            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
              Pengesahan Kata Laluan
            </label>
            <div class="relative">
              <input
                :type="showPassword ? 'text' : 'password'"
                v-model="form.password_confirmation"
                placeholder="Masukkan semula kata laluan yang sama"
                class="mb-4 dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pl-4 pr-11 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
              />
              <p v-if="errors.password_confirmation" class="mt-2 text-sm text-red-600">
                {{ errors.password_confirmation[0] }}
              </p>
              <span
                @click="showPassword = !showPassword"
                class="absolute z-30 -translate-y-1/2 cursor-pointer right-4 top-1/2"
              >
                <svg
                  v-if="!showPassword"
                  class="fill-gray-500 dark:fill-gray-400"
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M10.0002 13.8619C7.23361 13.8619 4.86803 12.1372 3.92328 9.70241C4.86804 7.26761 7.23361 5.54297 10.0002 5.54297C12.7667 5.54297 15.1323 7.26762 16.0771 9.70243C15.1323 12.1372 12.7667 13.8619 10.0002 13.8619ZM10.0002 4.04297C6.48191 4.04297 3.49489 6.30917 2.4155 9.4593C2.3615 9.61687 2.3615 9.78794 2.41549 9.94552C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C13.5184 15.3619 16.5055 13.0957 17.5849 9.94555C17.6389 9.78797 17.6389 9.6169 17.5849 9.45932C16.5055 6.30919 13.5184 4.04297 10.0002 4.04297ZM9.99151 7.84413C8.96527 7.84413 8.13333 8.67606 8.13333 9.70231C8.13333 10.7286 8.96527 11.5605 9.99151 11.5605H10.0064C11.0326 11.5605 11.8646 10.7286 11.8646 9.70231C11.8646 8.67606 11.0326 7.84413 10.0064 7.84413H9.99151Z"
                  />
                </svg>
                <svg
                  v-else
                  class="fill-gray-500 dark:fill-gray-400"
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M4.63803 3.57709C4.34513 3.2842 3.87026 3.2842 3.57737 3.57709C3.28447 3.86999 3.28447 4.34486 3.57737 4.63775L4.85323 5.91362C3.74609 6.84199 2.89363 8.06395 2.4155 9.45936C2.3615 9.61694 2.3615 9.78801 2.41549 9.94558C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C11.255 15.3619 12.4422 15.0737 13.4994 14.5598L15.3625 16.4229C15.6554 16.7158 16.1302 16.7158 16.4231 16.4229C16.716 16.13 16.716 15.6551 16.4231 15.3622L4.63803 3.57709ZM12.3608 13.4212L10.4475 11.5079C10.3061 11.5423 10.1584 11.5606 10.0064 11.5606H9.99151C8.96527 11.5606 8.13333 10.7286 8.13333 9.70237C8.13333 9.5461 8.15262 9.39434 8.18895 9.24933L5.91885 6.97923C5.03505 7.69015 4.34057 8.62704 3.92328 9.70247C4.86803 12.1373 7.23361 13.8619 10.0002 13.8619C10.8326 13.8619 11.6287 13.7058 12.3608 13.4212ZM16.0771 9.70249C15.7843 10.4569 15.3552 11.1432 14.8199 11.7311L15.8813 12.7925C16.6329 11.9813 17.2187 11.0143 17.5849 9.94561C17.6389 9.78803 17.6389 9.61696 17.5849 9.45938C16.5055 6.30925 13.5184 4.04303 10.0002 4.04303C9.13525 4.04303 8.30244 4.17999 7.52218 4.43338L8.75139 5.66259C9.1556 5.58413 9.57311 5.54303 10.0002 5.54303C12.7667 5.54303 15.1323 7.26768 16.0771 9.70249Z"
                  />
                </svg>
              </span>
            </div>
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
import { ref, reactive, onMounted } from 'vue'
import 'flatpickr/dist/flatpickr.css'
import { useRouter } from 'vue-router'
import axios from 'axios'

const router = useRouter()

const form = ref({
  name: '',
  ic_no: '',
  position: '',
  department: '',
  phone_no: '',
  email: '',
  password: '',
  password_confirmation: '',
  unit_id: '',
  roles: [] as number[], // This will store selected role IDs like [1, 2],
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

// Load units from API
type Unit = {
  id: number
  unit: string
}

const availableUnits = ref<Unit[]>([])
onMounted(async () => {
  try {
    const res = await axios.get('/api/units')
    availableUnits.value = res.data
  } catch (err) {
    console.error('Failed to fetch units:', err)
  }
})

// Submit form
const submit = async () => {
  errors.value = {} // clear previous errors

  try {
    await axios.get('/sanctum/csrf-cookie')
    await axios.post('/api/users', form.value)
    // redirect after success
    router.push('/basic-tables')
  } catch (err: any) {
    if (err.response && err.response.status === 422) {
      errors.value = err.response.data.errors
    }
  }
}

// Helper: check if Penganjur is selected
const isPenganjur = () => form.value.roles.includes(2)

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
