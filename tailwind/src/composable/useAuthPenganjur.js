import { reactive } from 'vue'
import { computed, toRef } from 'vue'
import axios from 'axios'
import { ref } from 'vue'

const state = reactive({
  authenticated: false,
  user: {},
  currentRole: null,
})

export default function useAuth() {
  const authenticated = computed(() => state.authenticated)

  const user = computed(() => state.user)
  //const user = toRef(state, 'user')

  const _currentRole = ref(null) // private mutable role ref

  const errors = ref({})

  const setAuthenticated = (authenticated) => {
    state.authenticated = authenticated
  }

  const setUser = (user) => {
    state.user = user
  }

  const currentRole = computed(() => _currentRole.value) // public readonly-like

  const setCurrentRole = (role) => {
    _currentRole.value = role
  }

  let attemptedOnce = false

  const attempt = async () => {
    if (attemptedOnce) return
    attemptedOnce = true
  
    try {
      const response = await axios.get('/api/user')
      const userData = response.data
      console.log('User Data:', userData)
  
      // ✅ Ensure roles is an array and check if it contains "Pentadbir Sistem"
      const hasPenganjurRole = Array.isArray(userData.roles) && userData.roles.includes('Penganjur')
  
      if (!hasPenganjurRole) {
        await axios.post('/logout') // Laravel Fortify logout
        setAuthenticated(false)
        setUser({})
        setCurrentRole(null)
  
        await Swal.fire({
          icon: 'error',
          title: 'Akses Ditolak',
          text: 'Anda bukan pengguna Penganjur',
        })
  
        return Promise.reject('Not Penganjur')
      }
  
      // ✅ Valid Pentadbir user
      setAuthenticated(true)
      setUser(userData)
      setCurrentRole('Penganjur')
      console.log('Current Role:', currentRole.value)
  
      return response
  
    } catch (error) {
      if ((error.response.status = 422)) {
        errors.value = error.response.data.errors;

        return Promise.reject(null);
      }
    }
  };
  
  const login = async (form) => {
    try {
      await axios.get('/sanctum/csrf-cookie')
      await axios.post('/login', form)

      localStorage.setItem('authRole', 'Penganjur') // Save role
  
      return attempt()
    } catch (error) {
      if (error.response && error.response.status === 422) {
        errors.value = error.response.data.errors
      } else {
        await Swal.fire({
          icon: 'error',
          title: 'Ralat Log Masuk',
          text: 'Maklumat log masuk tidak sah.',
        })
      }
  
      return Promise.reject(error)
    }
  }

  const logout = async () => {
    try {
      await axios.post('/logout')
      setAuthenticated(false)
      setUser({})
    } catch (error) {
      return Promise.reject(null)
    }
  }

  return {
    authenticated,
    user,
    setAuthenticated,
    login,
    setUser,
    attempt,
    errors,
    logout,
    currentRole,
  }
}
