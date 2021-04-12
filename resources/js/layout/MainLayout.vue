<template>
  <div>
    <Notifications></Notifications>
    <slot></slot>
  </div>
</template>

<script>
import Notifications from "../components/NotificationPlugin/Notifications";

export default {
  name: "MainLayout",
  components: {
    Notifications
  }
}
</script>

<style scoped>

</style>
