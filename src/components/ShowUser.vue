<template>
  <div>
    <h1>Show User</h1>
    <table>
      <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Roll</th>
      </thead>
      <tbody v-for="user in userInfo" :key="user.id">
        <tr>
          <td>{{ user.id }}</td>
          <td>{{ user.name }}</td>
          <td>{{ user.roll }}</td>
        </tr>
      </tbody>
    </table>
    <button @click="getUserInfo">Update Table</button>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "ShowUser",
  mounted() {
    this.getUserInfo();
  },
  data() {
    return {
      userInfo: [],
    };
  },
  methods: {
    getUserInfo() {
      axios
        .get("http://127.0.0.1:8000/user-info")
        .then((res) => {
          this.userInfo = res.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>

<style scoped></style>
