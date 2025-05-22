<template>
  <div class="p-6 max-w-xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Sijil Pengesahan</h1>

    <!-- <div v-if="loading">Menyemak sijil...</div> -->

    <div v-if="error" class="text-red-600">
      {{ error }}
    </div>

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
