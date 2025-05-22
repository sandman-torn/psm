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
              class="w-[500px] flex flex-col items-center gap-1 text-center xl:flex-row xl:gap-3 xl:text-left"
            >
              <div>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                  {{ program.program_desc }}
                </p>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                  Pautan Pra-Pendaftaran:
                </p>
                <p class="mb-2 text-sm font-medium text-gray-800 dark:text-white/90">
                  {{ qrUrl }} &nbsp; &nbsp;
                  <button
                    @click.prevent="copyToClipboard"
                    class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm mt-auto"
                  >
                    Salin
                  </button>
                </p>
                
                <!-- Visible QR Code (size: 100) -->
                <div ref="displayRef">
                  <QrcodeVue :value="qrUrl" :size="100" render-as="canvas" />
                </div>

                <!-- Hidden High-Res QR Code (size: 300) -->
                <div ref="downloadRef" style="display: none">
                  <QrcodeVue :value="qrUrl" :size="600" render-as="canvas" />
                </div>
                <button
                  @click="downloadQR"
                  class="mt-2 px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm"
                >
                  Muat Turun
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, nextTick } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import axios from 'axios'
import Swal from 'sweetalert2'
import QrcodeVue from 'qrcode.vue'

defineProps({
  program: {
    type: Object,
    required: true,
  },
})

const route = useRoute()
const programId = route.params.id
const qrUrl = `http://psm-b.test:5173/program/${route.params.id}`
const displayRef = ref(null)
const downloadRef = ref(null)

const downloadQR = async () => {
  await nextTick()
  const canvas =
    downloadRef.value?.$el?.querySelector('canvas') || downloadRef.value?.querySelector?.('canvas')

  if (canvas) {
    const link = document.createElement('a')
    link.download = 'program-qr.png'
    link.href = canvas.toDataURL('image/png')
    link.click()
  } else {
    alert('QR code not ready yet.')
  }
}

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
