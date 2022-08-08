<template>
  <div
    class="
      w-100
      h-100
      min-h-screen
      flex flex-col
      justify-center
      items-center
      bg-gray-50
    "
  >
    <form
      class="max-w-[400px] min-w-[200px] bg-white shadow-md p-5 relative"
      @submit.prevent="validate"
    >
      <div class="bg-blue-600 form__line"></div>
      <font-awesome-icon
        icon="fa-solid fa-dragon"
        size="4x"
        class="mx-auto block p-4"
      />
      <InputField
        for="name"
        label="Name"
        type="text"
        placeholder="Enter your Name"
        @input-name="handleData"
      />
      <ErrorMessage msg="Please enter your Name" v-show="errors.name" />

      <InputField
        for="email"
        label="Email"
        type="email"
        placeholder="Enter Email"
        @input-username="handleData"
      />
      <ErrorMessage msg="Please enter an Email" v-show="errors.email" />
      <ErrorMessage
        msg="Email already exists. Please use another one"
        v-show="errors.email_exists"
      />

      <InputField
        for="username"
        label="Username"
        type="text"
        placeholder="Enter Username"
        @input-username="handleData"
      />
      <ErrorMessage msg="Please enter a Username" v-show="errors.username" />
      <ErrorMessage
        msg="User already exists. Please use anotherone"
        v-show="errors.username_exists"
      />

      <InputField
        for="password"
        label="Password"
        type="password"
        placeholder="Enter Password"
        @input-password="handleData"
      />
      <ErrorMessage
        msg="Please enter a password atleast 8 characters long"
        v-show="errors.password"
      />

      <InputField
        for="confirm"
        label="Confirm Password"
        type="password"
        placeholder="Confirm Password"
        @input-confirm="handleData"
      />
      <ErrorMessage msg="Passwords do not match" v-show="errors.confirm" />

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

      <a
        href="/login"
        class="
          text-center
          w-100
          block
          mt-5
          hover:underline
          cursor-pointer
          font-medium
          text-blue-600
        "
        >Login Here</a
      >
    </form>
  </div>
</template>


<script>

import InputField from "../components/InputField.vue";
import ErrorMessage from "../components/ErrorMessage.vue";


export default {
  data() {
    return {
      data: {
        username: "",
        password: "",
        confirm: "",
        name: "",
      },
      errors: {},
    }
  },
  components: {
    InputField: InputField,
    ErrorMessage: ErrorMessage,
  },
  methods: {
    handleData(e) {
      this.data[e.name] = e.value;
    },
    handleRememberMe(e) {
      this.rememberMe = e.currentTarget.checked;
    },
    validate() {
      this.errors = {};

      if (this.data.name === "") {
        this.errors.name = "Error";
      }

      if (this.data.username === "") {
        this.errors.username = "Error";
      }
      if (this.data.password.length < 8) {
        this.errors.password = "Error";
      }

      if (this.data.password !== this.data.confirm) {
        this.errors.confirm = "Error";
      }
      if (Object.keys(this.errors).length === 0) {
        this.handleSubmit();
      }
    },
    handleCookie() {
      this.cookieAcknowledged = !this.cookieAcknowledged;
    },

    handleSubmit() {
      // Axios logic goes here to submit data to backend
    }
  }
}
</script>

<style>
.fa-dragon {
  color: red;
}
.form__line {
  top: 3px;
  left: 0;
  height: 3px;
  z-index: 5000;
  width: 100%;
  position: absolute;
}
</style>