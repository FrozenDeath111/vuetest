<template>
  <div>
    <form method="post" @submit.prevent="handleSubmit">
      <input type="text" v-model.trim="formData.name" />
      <input type="text" v-model="formData.roll" />
      <select v-model="formData.workplace">
        <option value="" disabled selected>Please Select</option>
        <option
          v-for="workplace in workplaces"
          :key="workplace.id"
          :value="workplace.name"
        >
          {{ workplace.name }}
        </option>
      </select>
      <select v-model="formData.foods" multiple>
        <option v-for="food in foods" :key="food.id" :value="food.id">
          {{ food.name }}
        </option>
      </select>
      <button>Submit</button>
    </form>
    <div v-if="responseData.status === 'success'">
      <h3>Status Code: {{ responseData.code }}</h3>
      <h4>Message: {{ responseData.message }}</h4>
    </div>
    <h1>Show User</h1>
    <table>
      <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Roll</th>
        <th>Workplace</th>
        <th>Foods</th>
      </thead>
      <tbody v-for="user in userInfo" :key="user.id">
        <tr>
          <td>{{ user.id }}</td>
          <td>{{ user.name }}</td>
          <td>{{ user.roll }}</td>
          <td>{{ user.workplace }}</td>
          <template v-for="likedFood in likedFoods" :key="likedFood.id">
            <td v-if="likedFood.user_id === user.id">
              {{ foods[likedFood.food_id - 1].name }},
            </td>
          </template>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "RealtimeUpdate",
  mounted() {
    this.getChoiceData();
    this.getUserInfo();
  },
  data() {
    return {
      userInfo: [],
      likedFoods: [],
      workplaces: [],
      foods: [],
      formData: {
        name: "",
        roll: "",
        workplace: "",
        foods: [],
      },
      responseData: {
        status: "",
        message: "",
        code: null,
      },
    };
  },
  methods: {
    getChoiceData() {
      axios
        .get("http://127.0.0.1:8000/get-choice-data")
        .then((res) => {
          this.workplaces = res.data.workplaces;
          this.foods = res.data.foods;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getUserInfo() {
      axios
        .get("http://127.0.0.1:8000/user-info")
        .then((res) => {
          this.userInfo = res.data.users;
          this.likedFoods = res.data.foods;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    handleSubmit() {
      axios({
        method: "post",
        url: "http://127.0.0.1:8000/insert-user",
        data: {
          name: this.formData.name,
          roll: this.formData.roll,
          workplace: this.formData.workplace,
          foods: this.formData.foods,
        },
      })
        .then((res) => {
          this.responseData.status = res.data.status;
          this.responseData.message = res.data.message;
          this.responseData.code = res.data.code;

          this.getUserInfo();

          this.formData.name = "";
          this.formData.roll = "";
          this.formData.workplace = "";
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

<style scoped></style>
