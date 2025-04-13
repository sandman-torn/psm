<script setup>
//
</script>

<template>
  <main>
    <form action="" method="post" @submit.prevent="login">
      <input v-model="form.email" type="text" name="email:" id="email" placeholder="Email"
        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-400" />
      <p v-if="errors.email">{{ errors.email[0] }}</p>
      <input v-model="form.password" type="password" name="password:" id="password" placeholder="Password"
        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-400" />
      <p v-if="errors.password">{{ errors.password[0] }}</p>

      <button type="submit">Login</button>
    </form>
  </main>
</template>
