import useAuth from '../composable/useAuth.js'

export default function redirectIfGuest({ next, to }) {
  const { authenticated } = useAuth()

  if (!authenticated.value) {
    const programId = to.params.id
    return next({
      path: `/signin-pre-register`,
      query: { redirect: `/pra-pendaftaran-program/${programId}` },
    })
  }

  return next()
}