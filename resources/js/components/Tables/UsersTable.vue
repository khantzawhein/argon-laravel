<template>
  <div class="card shadow"
       :class="type === 'dark' ? 'bg-default': ''">
    <div class="card-header border-0"
         :class="type === 'dark' ? 'bg-transparent': ''">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0" :class="type === 'dark' ? 'text-white': ''">
            {{ title }}
          </h3>
        </div>
        <div class="col text-right">
          <base-button tag="inertia-link" :href="$route('admin.users.create')" type="primary" size="sm">Create
          </base-button>
        </div>
      </div>
    </div>

    <div class="table-responsive">
      <base-table class="table align-items-center table-flush"
                  :class="type === 'dark' ? 'table-dark': ''"
                  :thead-classes="type === 'dark' ? 'thead-dark': 'thead-light'"
                  tbody-classes="list"
                  :data="users.data">
        <template slot="columns">
          <th>No</th>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Status</th>
          <th>Action</th>
        </template>

        <template v-slot:default="{row, index}">
          <td>{{ index + users.meta.from }}</td>
          <td>{{ row.name }}</td>
          <td>{{ row.email }}</td>
          <td>{{ row.role }}</td>
          <td>
            <badge class="badge-dot mr-4" :type="row.status_class">
              <i :class="`bg-${row.status_class}`"></i>
              <span class="status">{{ row.status }}</span>
            </badge>
          </td>
          <td class="d-flex">
            <base-button tag="inertia-link" :href="$route('admin.users.edit', row.id)" type="primary" size="sm">
              <i class="fas fa-edit mr-1"></i> Edit
            </base-button>
            <div class="text-right">
              <base-dropdown class="dropdown"
                             position="right">
                <template v-slot:title>
                  <a class="btn btn-sm btn-icon-only text-light" role="button" data-toggle="dropdown"
                     aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                  </a>
                </template>

                <template>
                  <button v-if="row.deleted_at" @click="confirmingActivate = row.id" class="dropdown-item">Activate</button>
                  <button v-else @click="confirmingDeactivate = row.id" class="dropdown-item">Deactivate</button>
                </template>
              </base-dropdown>
            </div>
          </td>

        </template>

      </base-table>
    </div>

    <div class="card-footer d-flex justify-content-end"
         :class="type === 'dark' ? 'bg-transparent': ''">
      <base-pagination :per-page="users.meta.per_page" :total="users.meta.total" :value="users.meta.current_page"
                       @input="goToPage"></base-pagination>
    </div>
    <!-- Modals -->
    <modal :show="!!confirmingDeactivate" type="notice">
      <template v-slot:header>
        <h3 class="font-weight-700">Deactivate User</h3>
      </template>
      <p class="text-center">
        Are you sure to deactivate the user?
      </p>
      <template v-slot:footer>
        <base-button type="danger" @click="deactivateUser(confirmingDeactivate)" :processing="deactivating">Yes, Deactivate it</base-button>
        <base-button type="default" @click="confirmingDeactivate = false">No</base-button>
      </template>
    </modal>

    <modal :show="!!confirmingActivate" type="notice">
      <template v-slot:header>
        <h3 class="font-weight-700">Reactivate User</h3>
      </template>
      <p class="text-center">
        Are you sure to reactivate the user?
      </p>
      <template v-slot:footer>
        <base-button type="danger" @click="activateUser(confirmingActivate)" :processing="activating">Yes, Activate it</base-button>
        <base-button type="default" @click="confirmingActivate = false">No</base-button>
      </template>
    </modal >
  </div>
</template>
<script>
import BaseButton from "../BaseButton";
import Modal from "../Modal";
export default {
  name: 'users-table',
  components: {
    BaseButton,
    Modal
  },
  props: {
    type: {
      type: String
    },
    title: String,
    users: Object
  },
  data() {
    return {
      confirmingDeactivate: false,
      deactivating: false,
      confirmingActivate: false,
      activating: false,
    }
  },
  methods: {
    goToPage(pageNo) {
      this.$inertia.get(`${this.users.meta.path}?page=${pageNo}`, {}, {
        preserveScroll: true
      })
    },
    deactivateUser(id) {
      this.deactivating = true;
      this.$inertia.delete(this.$route('admin.users.destroy', id), {
        onSuccess: () => {
          this.confirmingDeactivate = false;
          this.deactivating = false;
        }
      });
    },
    activateUser(id) {
      this.activating = true;
      this.$inertia.post(this.$route('admin.users.restore', {user: id}), {}, {
        onSuccess: () => {
          this.confirmingActivate = false;
          this.activating = false;
        }
      });
    }
  }
}
</script>
<style>
</style>
