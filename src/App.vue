<template>
  <div>
    <!-- <InsertUser></InsertUser>
    <ShowUser></ShowUser> -->
    <RealtimeUpdate></RealtimeUpdate>
  </div>
</template>

<script>
// import ShowUser from "./components/ShowUser.vue";
// import InsertUser from "./components/InsertUser.vue";
import RealtimeUpdate from "./components/RealtimeUpdate.vue";

export default {
  name: "App",
  components: {
    // ShowUser,
    // InsertUser,
    RealtimeUpdate,
  },
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
