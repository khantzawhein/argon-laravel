<template>
  <div>
    <base-header type="gradient-success" class="pb-4 pt-4 pt-md-7">
      <h1 class="text-white text-xl text-center font-weight-700">Users List</h1>
    </base-header>
    <div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <users-table title="Users Table" :users="users"></users-table>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import DashboardLayout from "../../layout/DashboardLayout";
import UsersTable from "../../components/Tables/UsersTable";

export default {
name: "UserIndex",
  layout: DashboardLayout,
  props: ['users'],
  components: {
    UsersTable
  }
}
</script>

<style scoped>

</style>