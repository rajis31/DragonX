<template>
  <div
    class="w-100 h-screen flex flex-col justify-center items-center bg-gray-50"
  >
    <form
      class="max-w-[400px] min-w-[200px] bg-white shadow-md p-5"
      @submit.prevent="validate"
    >
      <font-awesome-icon
        icon="fa-solid fa-dragon"
        size="4x"
        class="mx-auto block p-4"
      />
      <InputField
        for="username"
        label="Username"
        type="text"
        placeholder="Enter Username"
        @input-username="handleUsername"
      />
      <ErrorMessage msg="Please enter a Username" v-show="errors.username" />

      <InputField
        for="password"
        label="Password"
        type="password"
        placeholder="Enter Password"
        @input-password="handlePassword"
      />
      <ErrorMessage msg="Please enter a password" v-show="errors.password" />
      <ErrorMessage msg="Username or Password is wrong" v-show="errors.login" />
      <button
        class="
          bg-slate-400
          hover:bg-slate-800
          text-white
          font-bold
          py-2
          px-4
          rounded
          mt-5
        "
        type="Submit"
      >
        Submit
      </button>

      <div class="mt-4">
        <input
          class="
            form-check-input
            appearance-none
            h-4
            w-4
            border border-gray-300
            rounded-sm
            bg-white
            checked:bg-blue-600 checked:border-blue-600
            focus:outline-none
            transition
            duration-200
            mt-1
            align-top
            bg-no-repeat bg-center bg-contain
            float-left
            mr-2
            cursor-pointer
          "
          type="checkbox"
          value="true"
          id="flexCheckDefault"
          @change="handleRememberMe"
        />
        <label
          class="form-check-label inline-block text-gray-800"
          for="flexCheckDefault"
        >
          Remember Me
        </label>
      </div>
      <a 
        href="/register" 
        class="
            text-center 
            w-100 block 
            mt-5 
            hover:underline 
            cursor-pointer 
            font-medium
            text-blue-600	
          "
        >Register Here</a
      >
    </form>

    <div
      class="
        bg-gray-400
        border-l-4 border-gray-900
        text-white
        p-4
        mt-5
        relative
      "
      role="alert"
      v-show="!cookieAcknowledged"
      @click="handleCookie"
    >
      <font-awesome-icon
        icon="fa-solid fa-xmark"
        class="absolute cursor-pointer top-2 right-2"
      />
      <p class="font-bold">Cookie</p>
      <p>This site uses cookies.</p>
    </div>
  </div>
</template>


<script>

import InputField from "../components/InputField.vue";
import ErrorMessage from "../components/ErrorMessage.vue";


export default {
  data() {
    return {
      username: "",
      password: "",
      rememberMe: false,
      errors: {},
      cookieAcknowledged: false,
    }
  },
  components: {
    InputField: InputField,
    ErrorMessage: ErrorMessage,
  },
  methods: {
    handleUsername(e) {
      this.username = e.value;
    },
    handlePassword(e) {
      this.password = e.value;
    },
    handleRememberMe(e) {
      this.rememberMe = e.currentTarget.checked;
    },
    validate() {
      this.errors = {};

      if (this.username === "") {
        this.errors.username = "Error"
      }
      if (this.password === "") {
        this.errors.password = "Error"
      }
      if (Object.keys(this.errors).length === 0) {
        // Here the axios post request will go
        console.log("Logged In Successfully")
      }
    },
    handleCookie() {
      this.cookieAcknowledged = !this.cookieAcknowledged;
    }
  }
}
</script>

<style scoped>
.fa-dragon {
  color: red;
}
</style>