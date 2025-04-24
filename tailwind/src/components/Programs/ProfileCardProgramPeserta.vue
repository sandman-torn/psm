<template>
  <div v-if="program">
    <div class="p-5 mb-6 border border-gray-200 rounded-2xl dark:border-gray-800 lg:p-6">
      <div class="flex flex-col gap-5 xl:flex-row xl:items-center xl:justify-between">
        <div class="flex flex-col items-center w-full gap-6 xl:flex-row">
          <div class="order-3 xl:order-2">
            <h4
              class="mb-2 text-lg font-semibold text-center text-gray-800 dark:text-white/90 xl:text-left"
            >
              {{ program.program_name }}
            </h4>
            <div
              class="flex flex-col items-center gap-1 text-center xl:flex-row xl:gap-3 xl:text-left"
            >
              <p class="text-sm text-gray-500 dark:text-gray-400">{{ program.program_desc }}</p>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import axios from 'axios'
import Swal from 'sweetalert2'

defineProps({
  program: {
    type: Object,
    required: true,
  },
})

const route = useRoute()
const programId = route.params.id

//import Modal from './Modal.vue'

const isProfileInfoModal = ref(false)

const saveProfile = () => {
  // Implement save profile logic here
  console.log('Profile saved')
  isProfileInfoModal.value = false
}

// Function to copy link to clipboard
const copyToClipboard = async () => {
  const baseUrl = window.location.origin
  const registrationLink = `${baseUrl}/pra-pendaftaran-program/${route.params.id}`

  try {
    // Try the modern Clipboard API first
    await navigator.clipboard.writeText(registrationLink)
    Swal.fire('Berjaya!', 'Link pendaftaran telah disalin.', 'success')
  } catch (err) {
    // Fallback to execCommand for older or insecure environments
    const textarea = document.createElement('textarea')
    textarea.value = registrationLink
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
</script>
