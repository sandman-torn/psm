import useAuth from '@/composable/useAuthPentadbir'

export default async function authPentadbir({ next }) {
  const { authenticated, attempt } = useAuth()

  if (!authenticated.value) {
    try {
      await attempt()
    } catch (err) {
      return next('/loginPentadbir')
    }
  }

  return next()
}