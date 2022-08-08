<template>
  <div
    class="w-100 h-screen flex flex-col justify-center items-center bg-gray-50"
  >
    <form
      class="max-w-[400px] min-w-[200px] bg-white shadow-md p-5 relative"
      @submit.prevent="validate"
    >
      <div class="bg-red-600 form__line"></div>

      <InputField
        for="username"
        label="Username"
        type="text"
        placeholder="Enter your Username"
        @input-username="handleData"
      />
      <ErrorMessage msg="Please enter your Username" v-show="errors.username" />

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
        >Go to Login Page</a
      >
    </form>
    <Notification
      title="Successful"
      msg="You should be receiving a password reset link in your email registered to this username
             You will now be redirected back to the login page.
        "
      v-show="successful"
    />
  </div>
</template>


<script>

import InputField from "../components/InputField.vue";
import ErrorMessage from "../components/ErrorMessage.vue";
import Notification1 from "../components/Notifications/Notification1.vue";
import {sleep, yugioh} from "../helpers/helpers";

export default {

  data() {
    return {
      data: {
        username: "",
      },
      successful: false,
      errors: {},
    }
  },
  components: {
    InputField: InputField,
    ErrorMessage: ErrorMessage,
    Notification: Notification1,
  },
  methods: {
    handleData(e) {
      this.data[e.name] = e.value;
    },
    validate() {
      this.errors = {};

      if (this.data.username === "") {
        this.errors.username = "Error";
      }

      if (Object.keys(this.errors).length === 0) {
        this.succssful = true;
        this.handleSubmit();
      }

    },
    handleCookie() {
      this.cookieAcknowledged = !this.cookieAcknowledged;
    },

    async handleSubmit() {
      // Axios logic goes here to submit data to backend
      this.successful = true
      await sleep(3000);
      this.$router.push({ "name": "login" });
    }
  }
}
</script>

<style scoped>
.fa-dragon {
  color: red;
}
</style>