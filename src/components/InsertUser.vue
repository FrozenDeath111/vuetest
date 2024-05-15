<template>
  <div>
    <form method="post" @submit.prevent="handleSubmit">
      <input type="text" v-model.trim="formData.name" />
      <input type="text" v-model="formData.roll" />
      <button>Submit</button>
    </form>
    <div v-if="responseData.status === 'success'">
      <h3>Status Code: {{ responseData.code }}</h3>
      <h4>Message: {{ responseData.message }}</h4>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "InsertUser",
  data() {
    return {
      formData: {
        name: "",
        roll: "",
      },
      responseData: {
        status: "",
        message: "",
        code: null,
      },
    };
  },
  methods: {
    handleSubmit() {
      axios({
        method: "post",
        url: "http://127.0.0.1:8000/insert-user",
        data: {
          name: this.formData.name,
          roll: this.formData.roll,
        },
      })
        .then((res) => {
          this.responseData.status = res.data.status;
          this.responseData.message = res.data.message;
          this.responseData.code = res.data.code;
        })
        .catch((error) => {
          this.responseData.status = error.data.status;
          this.responseData.message = error.data.message;
          this.responseData.code = error.data.code;
        });
    },
  },
};
</script>

<style lang="scss" scoped></style>
