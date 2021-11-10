<template>
  <b-col lg="8" class="m-auto">
    <card title="Reset Password">
      <b-col md="10" offset-md="1">
        <b-form @submit.prevent="onReset">
          <alert-success :form="form" :message="status" />

          <vee-text-input
            rules="required|email"
            label="Email"
            label-cols-sm="2"
            name="email"
            type="email"
            v-model="form.email"
            placeholder="Your Email"
          />

          <b-form-group align="center">
            <b-button type="submit" variant="primary">
              Reset Pasword
            </b-button>
          </b-form-group>
        </b-form>
      </b-col>
    </card>
  </b-col>
</template>

<script>
import Form from 'vform'
export default {
  layout: 'centered',

  middleware: 'guest',

  metaInfo () {
    return { title: 'Reset Password' }
  },

  data: () => ({
    status: '',
    form: new Form({
      email: ''
    })
  }),

  methods: {
    async onReset () {
      try {
        const { data } = await this.form.post('/api/password/email')
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