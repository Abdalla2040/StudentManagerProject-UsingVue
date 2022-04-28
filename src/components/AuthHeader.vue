<template>
    <div >
        <h3>{{text}}</h3>
        <p v-if="this.auth">{{username}} is authorized</p>
        <p v-else >You are not authorized!</p>
    </div>
</template>

<script>
import store from "@/store/index.js";
export default {
  name: "Auth-Header",
  props: {
    text: {
      type: String,
      default: "Authorization",
      required: false,
    },
  },
  computed: {
    auth: function () {
      return store.state.auth;
    },
    username: function () {
      return store.state.username;
    },
  },
   
}
</script>

<style scoped>

</style>