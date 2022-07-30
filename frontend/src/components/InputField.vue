<template>
    <div>
  <label
      class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 text-left px-1"
      :for="for"
    >
      {{ label }}
    </label>
    <input
      class="
        appearance-none
        block
        w-full
        bg-gray-200
        text-gray-700
        border border-gray-200
        rounded
        py-3
        px-4
        leading-tight
        focus:outline-none focus:bg-white focus:border-gray-500
      "
      :type="type"
      :placeholder="placeholder"
      :name="for"
    />
    </div>
</template>


<script>
export default {
    props: ["for","label","type", "placeholder" ],
    emits: ["returnValue"]

}
</script>

<style scoped>
</style>