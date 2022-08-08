<template>
  <div class="flex m-5 max-w-[350px] relative">
    <font-awesome-icon icon="fa-solid fa-xmark" 
        class="
            absolute
            top-2
            right-3
            cursor-pointer
        "
    />
    <div class="m-auto">
      <div class="bg-white rounded-lg border-gray-300 border p-3 shadow-lg">
        <div class="flex flex-row">
          <div class="px-2">
            <font-awesome-icon icon="fa-solid fa-check" />
          </div>
          <div class="ml-2 mr-6">
            <span class="font-semibold">{{ title }}</span>
            <span class="block text-gray-500 text-sm">{{ msg }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["title", "msg"]
}
</script>

<style scoped>
.fa-check {
  color: #44c997;
  width: 24px;
  height: 24px;
}
</style>