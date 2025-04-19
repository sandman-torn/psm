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

  const attempt = async () => {
    try {
      let response = await axios.get('/api/user')
      setAuthenticated(true)
      await setUser(response.data)
      setCurrentRole('Pentadbir') // ✅ set role after login
      console.log('Current Role:', currentRole.value)
      return response
    } catch (error) {
      setAuthenticated(false)
      setUser({})
    }
  }

  const login = async (form) => {
    await axios.get('/sanctum/csrf-cookie')

    try {
      const response = await axios.post('/login', form)
      return attempt()
    } catch (error) {
      if ((error.response.status = 422)) {
        errors.value = error.response.data.errors

        return Promise.reject(null)
      }
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
