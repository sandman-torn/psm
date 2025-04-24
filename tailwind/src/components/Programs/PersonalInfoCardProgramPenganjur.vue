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
                {{ program.date_from }}
              </p>
            </div>

            <div>
              <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                Tarikh Tamat
              </p>
              <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                {{ program.date_to }}
              </p>
            </div>
            <div>
              <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                Lokasi
              </p>
              <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                {{ program.location }}
              </p>
            </div>
            

            <div>
              <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">Kuota peserta</p>
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

  </div>
</template>

<script setup>
import { ref } from 'vue'
//import Modal from './Modal.vue'

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
