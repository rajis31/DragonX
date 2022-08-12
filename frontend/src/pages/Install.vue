<template>
  <p>{{ location }}</p>
</template>

<script>
export default {
  mounted() {

    this.location = window.location.href;
    let params    = window.location.search;
    params        = params.replace("?", " ").split(" ");
    console.log(params);
  },
  data() {
    return {
      location: "",
      hmac: "",
      host:"",
      shop:"",
      timestamp:"",
    }
  }
}
</script>

<style scoped>
</style>
