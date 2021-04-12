<template>
  <div>
    <base-header type="gradient-success" class="pb-8 pt-5 pt-lg-8">
      <h1 class="text-white text-xl text-center font-weight-700">Edit User</h1>
    </base-header>
    <div class="container-fluid mt--7">
      <div class="col-xl-12 order-xl-1">
        <card shadow type="secondary">
          <div slot="header" class="bg-white border-0">
            <div class="row align-items-center">
              <div class="col-8">
                <h3 class="mb-0">Edit User Account</h3>
              </div>
              <div class="col-4 text-right">
                <inertia-link :href="$route('admin.users.index')" class="btn btn-sm btn-primary">
                  <i class="fas fa-arrow-left mr-1"></i>Back to Users
                </inertia-link>
              </div>
            </div>
          </div>
          <template>
            <form @submit.prevent="handleSubmit">
              <h6 class="heading-small text-muted mb-4">User information</h6>
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-lg-6">
                    <base-input label="Name"
                                placeholder="Name"
                                required
                                input-classes="form-control-alternative"
                                v-model="form.name"
                                :valid="form.errors.name ? false : null"
                                :error="form.errors.name"
                    />
                  </div>
                  <div class="col-lg-6">
                    <base-input type="email"
                                label="Email"
                                required
                                placeholder="jesse@example.com"
                                input-classes="form-control-alternative"
                                v-model="form.email"
                                :valid="form.errors.email ? false : null"
                                :error="form.errors.email"
                    />
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12 d-flex align-items-center">
                    <label class="form-control-label mr-3">Change Password</label>
                    <base-switch v-model="enable_pw_chg"></base-switch>
                  </div>
                </div>
                <div class="row mt-3" v-if="enable_pw_chg">
                  <div class="col-lg-6">
                    <base-input label="Password"
                                type="password"
                                required
                                placeholder="Password"
                                input-classes="form-control-alternative"
                                :valid="form.errors.password ? false : null"
                                :error="form.errors.password"
                                v-model="form.password"
                    />
                  </div>
                  <div class="col-lg-6">
                    <base-input type="password"
                                required
                                label="Password Confirmation"
                                placeholder="Password Confirmation"
                                input-classes="form-control-alternative"
                                v-model="form.password_confirmation"
                                :valid="form.errors.password_confirmation ? false : null"
                                :error="form.errors.password_confirmation"
                    />
                  </div>
                </div>
              </div>
              <hr class="my-4"/>
              <!-- Address -->
              <h6 class="heading-small text-muted mb-4">Permission information</h6>
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-lg-6">
                    <base-input label="Role"
                                :valid="form.errors.role_id ? false : null"
                                :error="form.errors.role_id"
                                input-classes="form-control-alternative">
                      <select class="form-control form-control-alternative" v-model="form.role_id">
                        <option value="" disabled>
                          Select a Role
                        </option>
                        <option v-for="role in roles" :value="role.id">{{ role.display_name }}</option>
                      </select>
                    </base-input>
                  </div>
                </div>
              </div>
              <hr class="my-4"/>
              <div class="row justify-content-end">
                <div class="mr-4"><base-button type="primary" native-type="submit" :processing="form.processing">Save</base-button></div>
              </div>
            </form>
          </template>
        </card>
      </div>
    </div>
  </div>

</template>

<script>
import DashboardLayout from "../../layout/DashboardLayout";

export default {
  name: "UserEdit",
  props: ['roles', 'user'],
  layout: DashboardLayout,
  components: {},
  computed: {
    superAdminId() {
      return this.roles.find(role => role.name === 'super_admin')?.id
    }
  },
  data() {
    return {
      form: this.$inertia.form(),
      enable_pw_chg: false
    }
  },
  mounted() {
    let data = {...this.user.data, password: '', password_confirmation: null};
    this.form = this.$inertia.form(data);
  },
  methods: {
    handleSubmit() {
      this.form.put(this.$route('admin.users.update', this.user.data.id))
    },
  },
}
</script>

<style scoped>

</style>
