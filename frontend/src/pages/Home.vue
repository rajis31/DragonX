<template>
  <div class="flex">
    <SideBar />

    <div class="p-7 text-2xl font-semibold flex-1 h-screen">
      <h1 @click="getHomePage" class="cursor-pointer">Home Page</h1>
    </div>
  </div>
</template>

<script>
import SideBar from "../components/SideBar.vue"
import axios from 'axios';

export default {
  data() {
    return {
      apiUri: "",
    }
  },
  created() {
    this.apiUri = this.$store.getters.getBackendURI;

    axios.post(this.apiUri+"/current_user")
         .then(res => console.log(res))
         .catch(err => console.log(err));
  },
  components: {
    SideBar: SideBar,
  },
  methods: {}
}
</script>

<style scoped>
</style>
