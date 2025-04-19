import useAuth from '../composable/useAuth.js';

export default function redirectIfGuest({ next }) {
  const { authenticated } = useAuth();

  if (!authenticated.value) {
    return next({
      name: 'login',
    });
  }
  return next();
}
