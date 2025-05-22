import useAuth from '../composable/useAuth.js'

export default function redirectIfGuestDaftarKehadiranProgram({ next, from, to }) {
  const { authenticated } = useAuth()

  if (!authenticated.value) {
    const programId = to.params.id
    const selectedDate = to.query.date
    return next({
      path: `/signin-daftar-kehadiran`,
      query: { redirect: `/daftar-kehadiran-program/${programId}?date=${selectedDate}` },
    })
  }

  return next()
}