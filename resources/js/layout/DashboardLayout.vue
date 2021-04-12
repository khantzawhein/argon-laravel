<template>
  <div class="wrapper" :class="{ 'nav-open': $sidebar.showSidebar }">
    <notifications></notifications>
    <side-bar
        :background-color="sidebarBackground"
        short-title="Argon"
        title="Argon"
    >
      <template slot="links">
        <sidebar-item :link="{ name: 'Dashboard', icon: 'ni ni-tv-2 text-primary', path: $route('admin.dashboard')}"/>
        <sidebar-item :link="{name: 'Users', icon: 'ni ni-single-02 text-yellow', path: $route('admin.users.index')}"/>
      </template>
    </side-bar>
    <div class="main-content" :data="sidebarBackground">
      <dashboard-navbar></dashboard-navbar>

      <div @click="toggleSidebar">
        <fade-transition :duration="200" origin="center top" mode="out-in">
          <!-- your content here -->
          <slot></slot>
        </fade-transition>
        <content-footer></content-footer>
      </div>
    </div>
  </div>
</template>
<script>
import DashboardNavbar from './DashboardNavbar.vue';
import ContentFooter from './ContentFooter.vue';
import {FadeTransition} from 'vue2-transitions';
import Notifications from "../components/NotificationPlugin/Notifications";

export default {
    components: {
        DashboardNavbar,
        ContentFooter,
        FadeTransition,
        Notifications
    },
    data() {
        return {
            sidebarBackground: 'vue' //vue|blue|orange|green|red|primary
        };
    },
    methods: {
        toggleSidebar() {
            if (this.$sidebar.showSidebar) {
                this.$sidebar.displaySidebar(false);
            }
        },

    }
};
</script>
<style lang="scss">
</style>
