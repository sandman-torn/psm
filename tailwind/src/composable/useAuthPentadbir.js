import { reactive } from 'vue'
import { computed, toRef } from 'vue'
import axios from 'axios'
import { ref } from 'vue'
import Swal from 'sweetalert2'

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


  const attempt = async () => {

    try {
      const response = await axios.get('/api/user')
      const userData = response.data
      console.log('User Data:', userData)

      // ✅ Ensure roles is an array and check if it contains "Pentadbir Sistem"
      const hasPentadbirRole =
        Array.isArray(userData.roles) && userData.roles.includes('Pentadbir Sistem')

      if (!hasPentadbirRole) {
        await axios.post('/logout') // Laravel Fortify logout
        setAuthenticated(false)
        setUser({})
        setCurrentRole(null)
        

        await Swal.fire({
          icon: 'error',
          title: 'Akses Ditolak',
          text: 'Anda bukan pengguna Pentadbir',
        })

        return Promise.reject('Not Pentadbir')
      }

      // ✅ Valid Pentadbir user
      setAuthenticated(true)
      setUser(userData)
      setCurrentRole('Pentadbir Sistem')
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

      localStorage.setItem('authRole', 'Pentadbir') // Save role

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
