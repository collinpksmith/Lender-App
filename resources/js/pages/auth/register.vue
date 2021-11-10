<template>
  <b-col lg="8" class="m-auto">
    <card title="Register">
      <b-col md="10" offset-md="1">
        <validation-observer
          ref="observer"
          v-slot="{ invalid, handleSubmit }"
        >
          <b-form @submit.prevent="handleSubmit(onRegister)">
            <vee-text-input
              rules="required"
              label="Name"
              label-cols-sm="3"
              name="name"
              v-model="form.name"
              placeholder="Enter your name"
            />

            <vee-text-input
              rules="required|email"
              label="Email"
              label-cols-sm="3"
              name="email"
              v-model="form.email"
              placeholder="Enter your email"
            />

            <vee-text-input
              rules="required|password:@confirm"
              label="Password"
              label-cols-sm="3"
              name="password"
              type="password"
              v-model="form.password"
              placeholder="Enter your password"
            />

            <vee-text-input
              rules="required"
              label="Confirm"
              label-cols-sm="3"
              name="confirm"
              type="password"
              v-model="form.password_confirmation"
              placeholder="Confirm your password"
            />

            <b-form-group align="center">
              <b-button
                type="submit"
                variant="primary"
                :disabled="invalid"
              >
                Register
              </b-button>
            </b-form-group>
          </b-form>
        </validation-observer>
      </b-col>
    </card>
  </b-col>
</template>

<script>
import Form from 'vform';
import { mapActions } from 'vuex';

export default {
  layout: 'centered',

  middleware: 'guest',

  metaInfo() {
    return { title: 'Register' };
  },

  data: () => ({
    form: new Form({
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
    }),
  }),

  methods: {
    ...mapActions('auth', ['saveToken', 'updateUser']),

    async onRegister() {
      try {
        // Register the user.
        const { data: user } = await this.form.post('/api/register');

        // Log in the user.
        const { data: { token } } = await this.form.post('/api/login');

        // Save the token and update user.
        this.saveToken({ token });
        this.updateUser({ user });

        // Redirect home.
        this.$router.push({ name: 'Teams' });
      } catch(error) {
        this.$swal({
          icon: 'error',
          title: 'Error',
          text: error.message,
          confirmButtonText: 'OK',
        });
      }
    },
  },
};
</script>
