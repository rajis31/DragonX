<template>
    <div>
        <InputField 
          label="name"
          placeholder="Name"
          type="text"
          for="name"
        />
    </div>
</template>

<script>
    import InputField from "./components/InputField.vue";
    export default{
      components: {
        InputField: InputField,
      }
    }
</script>

<style scoped>

</style>
