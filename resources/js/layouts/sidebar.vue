<template>
  <!-- <aside class="left-sidebar">
        <div class="scroll-sidebar">
            <div class="user-profile">
                <div class="profile-img"> <img :src="getAuthUser('avatar')" alt="user" /> </div>
            </div>
            <nav class="sidebar-nav m-t-20">
                <div class="text-center" v-if="getConfig('maintenance_mode')"><span class="badge badge-danger m-b-10">{{trans('configuration.under_maintenance')}}</span></div>
                <div class="text-center" v-if="!getConfig('mode')"><span class="badge badge-danger m-b-10">{{trans('configuration.test_mode')}}</span></div>
                
            </nav>
        </div>
        <div class="sidebar-footer">
            <router-link v-if="hasPermission('access-configuration')" to="/configuration" class="link" v-tooltip="trans('configuration.configuration')"><i class="fas fa-cogs"></i></router-link>
            <router-link to="/profile" class="link" v-tooltip="trans('user.profile')"><i class="fas fa-user"></i></router-link>
            <a href="#" class="link" v-tooltip="trans('auth.logout')" @click.prevent="logout"><i class="fas fa-power-off"></i></a>
        </div>
  </aside>-->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <router-link to="/" class="brand-link">
      <img
        :src="getSidebarLogo"
        alt="AdminLTE Logo"
        class="brand-image img-circle elevation-3"
        style="opacity: .8"
      />
      <span class="brand-text font-weight-light">پنل مدیریت</span>
    </router-link>

    <!-- Sidebar -->
    <div class="sidebar">
      <div>
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img
              src="https://secure.gravatar.com/avatar/5ffa2a1ffeb767c60ab7e1052e385d5c?s=52&d=mm&r=g"
              class="img-circle elevation-2"
              alt="User Image"
            />
          </div>
          <div class="info">
            <a href="#" class="d-block">محمدرضا عطوان</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <main-menu></main-menu>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
    </div>
    <!-- /.sidebar -->
  </aside>
</template>

<script>
import mainMenu from "./menu";

export default {
  components: { mainMenu },
  mounted() {},
  methods: {
    logout() {
      helper.logout().then(() => {
        this.$store.dispatch("resetAuthUserDetail");
        this.$router.push("/login");
      });
    },
    getAuthUser(name) {
      return helper.getAuthUser(name);
    },
    hasPermission(permission) {
      return helper.hasPermission(permission);
    },
    getConfig(config) {
      return helper.getConfig(config);
    }
  },
  computed: {
    getSidebarLogo() {
      if (helper.getConfig("sidebar_logo"))
        return "/" + helper.getConfig("sidebar_logo");
      else return "/images/default_sidebar_logo.png";
    }
  }
};
</script>
