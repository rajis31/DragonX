<template>
  <div class="flex">
    <SideBar />
    
    <div class="p-7 text-2xl font-semibold flex-1 h-screen">
      <h1>Home Page</h1>
    </div>
  </div>
</template>

<script>
import SideBar from "../components/SideBar.vue"

export default {
  components: {
    SideBar: SideBar,
  }
}
</script>

<style scoped>
</style>
