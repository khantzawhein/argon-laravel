<template>
  <base-nav class="navbar-top navbar-dark"
            id="navbar-main"
            :show-toggle-button="false"
            expand>
    <ul class="navbar-nav ml-lg-auto align-items-center d-none d-md-flex">
      <li class="nav-item dropdown">
        <base-dropdown class="nav-link pr-0">
          <div class="media align-items-center" slot="title">
            <span class="avatar avatar-sm rounded-circle">
              <v-gravatar :email="$page.props.auth.email"></v-gravatar>
            </span>
            <div class="media-body ml-2 d-none d-lg-block">
              <a href="#" class="mb-0 text-sm text-white font-weight-bold">{{ $page.props.auth.name }}</a>
            </div>
          </div>

          <template>
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <inertia-link href="/profile" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>My profile</span>
            </inertia-link>
            <inertia-link href="/profile" class="dropdown-item">
              <i class="ni ni-settings-gear-65"></i>
              <span>Settings</span>
            </inertia-link>
            <inertia-link href="/profile" class="dropdown-item">
              <i class="ni ni-calendar-grid-58"></i>
              <span>Activity</span>
            </inertia-link>
            <inertia-link href="/profile" class="dropdown-item">
              <i class="ni ni-support-16"></i>
              <span>Support</span>
            </inertia-link>
            <div class="dropdown-divider"></div>
            <a href="#" @click="logout" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Logout</span>
            </a>
          </template>
        </base-dropdown>
      </li>
    </ul>
  </base-nav>
</template>
<script>
export default {
  data() {
    return {
      activeNotifications: false,
      showMenu: false,
      searchQuery: ''
    };
  },
  methods: {
    toggleSidebar() {
      this.$sidebar.displaySidebar(!this.$sidebar.showSidebar);
    },
    hideSidebar() {
      this.$sidebar.displaySidebar(false);
    },
    toggleMenu() {
      this.showMenu = !this.showMenu;
    },
    logout() {
      this.$inertia.post('/logout')
    }
  }
};
</script>
