<template>
  <div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <a class="navbar-brand" href="#">Test auth</a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <router-link to="/" class="nav-link">Home</router-link>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li>
            <b-nav-form v-show="this.$route.name !== 'resultSearch'">
              <b-form-input size="sm" class="mr-sm-2" v-model="navSearch"></b-form-input>
              <router-link
                v-show="state"
                :to="'/search/' + navSearch"
                class="btn-sm btn-danger my-2 my-sm-0"
              >
                <span v-on:click="productSearch">Search</span>
              </router-link>
            </b-nav-form>
          </li>
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              id="navbarDropdown"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >{{ app.user ? app.user.name : "Account" }}</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <div v-if="!app.user">
                <router-link to="/login" class="dropdown-item">Login</router-link>
                <router-link to="/register" class="dropdown-item">Register</router-link>
              </div>
              <a v-else @click="logout" href="javascript:;" class="dropdown-item">logout</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</template>

<script>
export default {
  name: "navbar",
  props: ["app"],
  data() {
    return {
      navSearch: "",
      state: false
    };
  },
  watch: {
    navSearch: function(input) {
      if (input.length > 0) {
        this.state = true;
      } else {
        this.state = false;
      }
    }
  },
  methods: {
    logout() {
      this.app.req.post("auth/logout").then(() => {
        this.app.user = null;
        this.$router.push("/");
      });
    },
    productSearch() {
      setTimeout(() => {
        this.navSearch = "";
      }, 50);
    }
  }
};
</script>

<style></style>
