import useAuth from '../composable/useAuthPentadbir.js'

export default function redirectIfGuest({ next }) {
  const { authenticated } = useAuth()

  if (!authenticated.value) {
    return next({
      name: 'Signin',
    })
  }
  return next()
}
