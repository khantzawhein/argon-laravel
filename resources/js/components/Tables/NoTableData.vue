<template>
  <base-alert type="secondary" dismissible v-if="count == 0">
    <span class="alert-inner--icon"><i class="ni ni-bulb-61 text-yellow"></i></span>
    <span class="alert-inner--text">
      There is no {{ dataText }} and try to create one.
      <base-button tag="inertia-link" :href="createRoute" type="primary" size="sm">
        Create
      </base-button>
    </span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </base-alert>
</template>

<script>
export default {
  name: "NoTableData",
  props: {
    dataText: '',
    count: '',
    createRoute: ''
  }
}
</script>

<style scoped>

</style>
