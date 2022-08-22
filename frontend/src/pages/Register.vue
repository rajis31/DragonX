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
        class="shopname"
        for="shopname"
        label="Shopname"
        type="text"
        placeholder="Enter your Shop"
        @input-shopname="handleData"
      />
      <ErrorMessage
        msg="Please enter your Shop Name"
        v-show="errors.shopname"
      />

      <InputField
        for="email"
        label="Email"
        type="email"
        placeholder="Enter Email"
        @input-email="handleData"
      />
      <ErrorMessage msg="Please enter an Email" v-show="errors.email" />
      <ErrorMessage
        msg="Email already exists. Please use another one"
        v-show="errors.email_exists"
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
      <ErrorMessage
        msg="Could not save credentials. Try again"
        v-show="errors.backend"
      />
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
import axios from "axios";


export default {
  mounted() {
    this.apiUri = this.$store.getters.getBackendURI;
    document.querySelectorAll("input")[0].value = this.$route.params?.shop;
    document.querySelectorAll("input")[0].setAttribute("disabled", "disabled");

    if (this.$route.params?.shop) {
      this.handleData({
        "name": "shopname",
        "value": this.$route.params?.shop
      });
    }

  },
  data() {
    return {
      data: {
        shopname: "",
        password: "",
        confirm: "",
        email: "",
        apiUri: ""
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

      axios.post(this.apiUri + "/register", {
        shopname: this.data.shopname + ".myshopify.com",
        password: this.data.password,
        email: this.data.email
      }).then(res => {
        if (res.status === 200) {
          if (res.data.success === true) {
            this.$router.push("/home");
          }
        } else if (res.status !== 200) {
          this.errors.backend = "Error";
        }
      });

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