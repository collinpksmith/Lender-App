import { extend, setInteractionMode } from 'vee-validate';
import { required, email } from 'vee-validate/dist/rules';

setInteractionMode('aggressive');

extend('required', {
  ...required,
  message: 'This field is required',
});

extend('email', {
  ...email,
  message: 'This field is email',
});

extend('password', {
  params: ['target'],
  validate(value, { target }) {
    return value === target;
  },
  message: 'Password confirmation does not match',
});
