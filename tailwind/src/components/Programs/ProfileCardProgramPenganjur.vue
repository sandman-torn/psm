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
          <div class="flex items-center order-2 gap-2 grow xl:order-3 xl:justify-end">
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Pautan Pra-Pendaftaran:</p>
            <p class="text-sm font-medium text-gray-800 dark:text-white/90"> http://psm-b.test:5173/program/{{ route.params.id }}
            </p>  
          </div>
        </div>
        <button @click.prevent="copyToClipboard" class="edit-button">
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
              fill=""
            />
          </svg>
          Salin
        </button>
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
