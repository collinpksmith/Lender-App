import axios from 'axios';
import store from '~/store';
import router from '~/router';
import Swal from 'sweetalert2';

// Request interceptor
axios.interceptors.request.use((request) => {
  const token = store.getters['auth/token'];
  if (token) {
    request.headers.common.Authorization = `Bearer ${token}`;
  }

  const locale = store.getters['lang/locale'];
  if (locale) {
    request.headers.common['Accept-Language'] = locale;
  }

  return request;
});

// Response interceptor
axios.interceptors.response.use(
  (response) => response,
  (error) => {
    const { status } = error.response;

    if (status >= 500) {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'There was an internal server error.',
        reverseButtons: true,
        confirmButtonText: 'OK',
        cancelButtonText: 'Cancel',
      });
    }

    if (status === 401 && store.getters['auth/check']) {
      Swal.fire({
        icon: 'warning',
        title: 'Token Expired',
        text: 'Your token is expired.',
        reverseButtons: true,
        confirmButtonText: 'OK',
        cancelButtonText: 'Cancel',
      }).then(() => {
        store.commit('auth/LOGOUT');

        router.push({ name: 'login' });
      });
    }

    return Promise.reject(error);
  }
);
