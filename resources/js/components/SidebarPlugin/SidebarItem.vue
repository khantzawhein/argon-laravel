<template>
  <li class="nav-item">
    <inertia-link
        :class="{'active': active(link.path)}"
        @click="linkClick"
        class="nav-link"
        :target="link.target"
        :href="link.path">
      <template>
        <i :class="link.icon"></i>
        <span class="nav-link-text">{{ link.name }}</span>
      </template>
    </inertia-link>
  </li>
</template>
<script>
export default {
  name: 'sidebar-item',
  props: {
    link: {
      type: Object,
      default: () => {
        return {
          name: '',
          path: '',
          children: []
        };
      },
      description:
          'Sidebar link. Can contain name, path, icon and other attributes. See examples for more info'
    }
  },
  inject: {
    autoClose: {
      default: true
    }
  },
  data() {
    return {
      children: [],
      collapsed: true
    };
  },
  methods: {
    linkClick() {
      if (
          this.autoClose &&
          this.$sidebar &&
          this.$sidebar.showSidebar === true
      ) {
        this.$sidebar.displaySidebar(false);
      }
    },
    active(url) {
      return this.$page.props.current_full_url.startsWith(`${url}`)
    }
  }
};
</script>
