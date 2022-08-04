<template>
  <div>
    <label
      class="
        block
        uppercase
        tracking-wide
        text-gray-700 text-xs
        font-bold
        mb-2
        text-left
        px-1
      "
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
      @input="handleValue"
    />
  </div>
</template>


<script>
export default {
  props: ["for", "label", "type", "placeholder"],
  methods: {
    handleValue(event) {
      this.$emit("input-" + this.$props.for, 
                 {name: this.$props.for, value: event.target.value});
    }
  }

}
</script>

<style scoped>
</style>