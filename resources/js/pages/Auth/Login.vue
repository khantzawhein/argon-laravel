<template>
  <div class="row justify-content-center">
    <div class="col-lg-5 col-md-7">
      <div class="card bg-secondary shadow border-0">
        <div class="card-body px-lg-5 py-lg-4">
          <div class="text-center text-muted mb-4">
            <p>Sign in with credentials</p>
          </div>
          <form role="form" @submit.prevent="handleSubmit">
            <base-input class="input-group-alternative mb-3"
                        placeholder="Email"
                        addon-left-icon="ni ni-email-83"
                        :valid="form.errors.email ? false : null"
                        :error="form.errors.email"
                        v-model="form.email">
            </base-input>

            <base-input class="input-group-alternative"
                        placeholder="Password"
                        type="password"
                        autocomplete="current_password"
                        :valid="form.errors.password ? false : null"
                        :error="form.errors.password"
                        addon-left-icon="ni ni-lock-circle-open"
                        v-model="form.password">
            </base-input>

            <base-checkbox class="custom-control-alternative" v-model="form.remember">
              <span class="text-muted">Remember me</span>
            </base-checkbox>
            <div class="d-flex justify-content-center">
              <base-button native-type="submit" type="primary" class="my-4" :processing="form.processing">
                Sign in
              </base-button>
            </div>
          </form>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-6">
          <inertia-link href="#" class="text-light"><small>Forgot password?</small></inertia-link>
        </div>
        <div class="col-6 text-right">
          <inertia-link href="/register" class="text-light"><small>Create new account</small></inertia-link>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import AuthLayout from "../../layout/AuthLayout";
import {BSpinner} from "bootstrap-vue"

export default {
  layout: AuthLayout,
  name: 'login',
  components: {
    BSpinner
  },
  data() {
    return {
      form: this.$inertia.form({
        email: '',
        password: '',
        remember: false
      }),
    }
  },
  methods: {
    handleSubmit() {
      this.form.post(this.$route('admin.auth.login.validate'))
    }
  }
}
</script>
<style>
</style>
