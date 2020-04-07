<template>
  <div id="app">
    <b-navbar toggleable="lg" type="dark" variant="info">
      <b-navbar-brand :to="{ path: '/' }">Home</b-navbar-brand>
      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav>
          <b-nav-item :to="{ name: 'train' }" :active="path  == '/train'">Treinamento</b-nav-item>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
    <router-view />
  </div>
</template>

<script>
export default {
  data() {
    return {
      path: this.$route && this.$route.path
    };
  },
  watch: {
    $route(route) {
      this.path = route.path;
    }
  }
};
</script>

<style lang="scss">
  .page {
    padding: 20px;
    margin: 0 auto;
  }
  button, .btn.btn-primary {
    margin-right: 10px !important;
  }
  .button-toolbar {
    margin-bottom: 10px;
  }
</style>
