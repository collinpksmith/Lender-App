<template>
  <b-col lg="8" class="m-auto">
    <card title="Login">
      <b-col md="10" offset-md="1">
        <validation-observer
          ref="observer"
          v-slot="{ invalid, handleSubmit }"
        >
          <b-form @submit.prevent="handleSubmit(onLogin)">
            <vee-text-input
              rules="required|email"
              label="Email"
              label-cols-sm="3"
              name="email"
              type="email"
              v-model="form.email"
              placeholder="Enter your email"
            />

            <vee-text-input
              rules="required"
              label="Password"
              label-cols-sm="3"
              name="password"
              type="password"
              v-model="form.password"
              placeholder="Enter your password"
            />

            <b-row>
              <b-col xs="6">
                <b-form-checkbox
                  v-model="remember"
                  name="remember"
                >
                  Remember Me
                </b-form-checkbox>
              </b-col>

              <b-col xs="6" class="text-right">
                <router-link
                  class="small ml-auto my-auto"
                  :to="{ name: 'password.request' }"
                >
                  Forgot Password
                </router-link>
              </b-col>
            </b-row>

            <b-form-group align="center">
              <b-button
                type="submit"
                variant="primary"
                :disabled="invalid"
              >
                Login
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
import Cookies from 'js-cookie';

export default {
  layout: 'centered',

  middleware: 'guest',

  metaInfo() {
    return { title: 'Login' };
  },

  data: () => ({
    form: new Form({
      email: '',
      password: '',
    }),
    remember: false,
  }),

  methods: {
    ...mapActions('auth', ['saveToken', 'fetchUser']),

    async onLogin() {
      try {
        // Submit the form.
        const { data } = await this.form.post('/api/login');
  
        // Save the token.
        this.saveToken({
          token: data.token,
          remember: this.remember
        })
  
        // fetch the user
        this.fetchUser();
        this.redirect();
      } catch (error) {
        this.$swal({
          icon: 'error',
          title: 'Error',
          text: error.message,
          confirmButtonText: 'OK',
        });
      }
    },

    // if there is a saved intended url, redirect to there, otherwise to /home
    redirect() {
      const intendedUrl = Cookies.get('intended_url');

      if (intendedUrl) {
        Cookies.remove('intended_url');
        this.$router.push({ path: intendedUrl });
      } else {
        this.$router.push({ name: 'Teams' });
      }
    },
  },
};
</script>