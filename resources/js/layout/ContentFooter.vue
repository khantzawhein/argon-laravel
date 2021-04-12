<template>
  <footer class="footer px-4">
    <div class="row align-items-center justify-content-lg-between">
      <div class="col-lg-6">
        <div class="copyright text-center text-lg-left text-muted">
          © {{year}} <inertia-link :href="$page.props.app_url" class="font-weight-bold ml-1" target="_blank">Shwe Zawgyi</inertia-link>
        </div>
      </div>
    </div>
  </footer>
</template>
<script>
import MainLayout from "./MainLayout";

export default {

  layout: MainLayout,
  data() {
    return {
      year: new Date().getFullYear()
    };
  }
};
</script>
<style></style>
