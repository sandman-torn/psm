
<template>
  <FullScreenLayout>
    <div class="relative p-6 bg-white z-1 dark:bg-gray-900 sm:p-0">
      <div
        class="relative flex flex-col justify-center w-full h-screen lg:flex-row dark:bg-gray-900"
      >
        <div class="flex flex-col flex-1 w-full lg:w-1/2">
          <div class="w-full max-w-md pt-10 mx-auto"></div>
          <div class="flex flex-col justify-center flex-1 w-full max-w-md mx-auto">
            <div class="p-6 max-w-xl mx-auto">
              <h1 class="mb-4 font-semibold text-gray-800 text-title-sm dark:text-white/90 sm:text-title-md">
                  Semakkan Sijil Pengesahan
                </h1>
              

              <!-- <div v-if="loading">Menyemak sijil...</div> -->

              <div v-if="error" class="text-red-600 mt-4" v-html="error"></div>

              <div v-else>
                <p class="mb-2">Adalah dimaklumkan bahawa ✅ <strong>Sijil ini sah.</strong></p>
                <p class="mb-2">Peserta dibawah telah mengikuti kursus di Jabatan ini</p>

                <ul class="list-disc list-inside">
                  <li><strong>Nama:</strong> {{ data.name }}</li>
                  <li><strong>No. IC:</strong> {{ data.ic_no }}</li>
                  <li><strong>Program:</strong> {{ data.program_name }}</li>
                  <li><strong>Lokasi:</strong> {{ data.location }}</li>
                  <li>
                    <strong>Tarikh:</strong> {{ formatDate(data.date_from) }} hingga
                    {{ formatDate(data.date_to) }}
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div
          class="relative items-center hidden w-full h-full lg:w-1/2 bg-brand-950 dark:bg-white/5 lg:grid"
        >
          <div class="flex items-center justify-center z-1">
            <common-grid-shape />
            <div class="flex flex-col items-center max-w-xs">
              <router-link to="/" class="block mb-4">
                <img width="150" height="{20}" src="/images/logo/ePNJevent.png" alt="Logo" />
              </router-link>
              <p class="text-center text-gray-400 dark:text-white/60">
                Sistem Pengurusan Program Jabatan
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </FullScreenLayout>
</template>

<script>
import axios from 'axios'

export default {
  name: 'VerifyCertificate',
  data() {
    return {
      data: null,
      error: null,
      loading: true,
    }
  },
  created() {
    const code = this.$route.params.code
    axios
      .get(`http://psm-b.test/api/public-verify-certificate/${code}`)
      .then((res) => {
        this.data = res.data
      })
      .catch((err) => {
        this.error = err.response?.data?.message || 'Ralat berlaku.'
      })
      .finally(() => {
        this.loading = false
      })
  },
  methods: {
    formatDate(dateStr) {
      const options = { day: '2-digit', month: 'short', year: 'numeric' }
      return new Date(dateStr).toLocaleDateString('ms-MY', options)
    },
  },
}
</script>
