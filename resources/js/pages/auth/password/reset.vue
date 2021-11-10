<template>
  <b-col lg="8" class="m-auto">
    <card title="Reset Password">
      <b-col md="10" offset-md="1">
        <b-form @submit.prevent="onReset">
          <alert-success :form="form" :message="status" />

          <validation-observer>
            <vee-text-input
              rules="required|email"
              label="Email"
              label-cols-sm="3"
              name="email"
              type="email"
              v-model="form.email"
              readonly
              placeholder="Your Email"
            />

            <vee-text-input
              rules="required|password:@confirm"
              label="Password"
              label-cols-sm="3"
              name="password"
              type="password"
              v-model="form.password"
              placeholder="Your Password"
            />

            <vee-text-input
              rules="required"
              label="Confirm"
              label-cols-sm="3"
              name="confirm"
              type="password"
              v-model="form.password_confirmation"
              placeholder="Your Password"
            />

            <b-form-group align="center">
              <b-button type="submit" variant="primary">Register</b-button>
            </b-form-group>
          </validation-observer>
        </b-form>
      </b-col>
    </card>
  </b-col>
</template>

<script>
import Form from 'vform';

export default {
  layout: 'centered',

  middleware: 'guest',
  
  metaInfo () {
    return { title: 'Reset Password' }
  },
  
  data: () => ({
    status: '',
    form: new Form({
      token: '',
      email: '',
      password: '',
      password_confirmation: ''
    })
  }),

  created () {
    this.form.email = this.$route.query.email
    this.form.token = this.$route.params.token
  },

  methods: {
    async onReset () {
      try {
        const { data } = await this.form.post('/api/password/reset')
        this.status = data.status
      } catch(error) {
        this.$swal({
          icon: 'error',
          title: 'Error',
          text: error.message,
          confirmButtonText: 'OK',
        });
      }
    }
  }
}
</script>