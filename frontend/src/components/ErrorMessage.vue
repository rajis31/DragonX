<template>
  <p 
  class="
        mt-2 
        text-sm 
        text-red-600 
        dark:text-red-500 
        break-words"
  >
    {{msg}}
  </p>
</template>

<script>
export default {
  props: ["msg"]
}
</script>

<style>
</style>