import useAuth from '../composable/useAuth.js';

export default function redirectIfAuthenticated({ next }) {
  const { authenticated } = useAuth();

  //console.log(authenticated.value, user.value);

  if (authenticated.value) {
    return next({
      name: 'dashboard',
    });
  }
  return next();
}
