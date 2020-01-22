<template>
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">Anything you want</div>
    <!-- Default to the left -->
    <strong>{{getConfig('footer_credit')}}</strong>
  </footer>
</template>

<script>
export default {
  methods: {
    getConfig(config) {
      return helper.getConfig(config);
    }
  }
};
</script>