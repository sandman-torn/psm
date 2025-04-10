<script setup>
import { reactive } from 'vue';
import useAuth from '@/composable/useAuth';
import Navigation from '@/components/Navigation.vue';

const { login: loginAction, errors } = useAuth();


const form = reactive({
  email: 'admin@admin.com',
  password: 'password'
});

const login = async () => {
  loginAction(form)
}
</script>

<template>
  <main>
    <navigation />
    <form action="" method="post" @submit.prevent="login">
      <input v-model="form.email" type="text" name="email:" id="email" placeholder="Email" />
      <p v-if="errors.email">{{ errors.email[0] }}</p>
      <input v-model="form.password" type="password" name="password:" id="password" placeholder="Password" />
      <p v-if="errors.password">{{ errors.password[0] }}</p>

      <button type="submit">Login</button>
    </form>
  </main>
</template>
