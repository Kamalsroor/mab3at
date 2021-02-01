<template>
  <ul
    class="nav nav-pills nav-sidebar flex-column"
    data-widget="treeview"
    role="menu"
    data-accordion="false"
  >
    <!-- Add icons to the links using the .nav-icon class
    with font-awesome or any other icon font library-->
    <li class="nav-item" @click="closeMenu">
      <router-link to="/home" class="nav-link ">
        <i class="nav-icon fa fa-dashboard"></i>
        <p>الرئيسيه</p>
      </router-link>
    </li>

    
    <li class="nav-item " @click="toggleMenu" >
        <a href="javascript:;" class="nav-link derop-down-menu">
          <i class="nav-icon fas fa-table"></i>
          <p>
            تكويد
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li v-if="hasPermission('access-user')" class="nav-item">
            <router-link to="/user" class="nav-link ">
              <i class="nav-icon fa fa-users"></i>
              <p>{{ trans("user.user") }}</p>
            </router-link>
          </li>
          <li v-if="hasPermission('access-branch')" class="nav-item">
            <router-link to="/branch" class="nav-link ">
              <i class="nav-icon fa fa-users"></i>
              <p>{{ trans("branch.branch") }}</p>
            </router-link>
          </li>
          <li v-if="hasPermission('access-customer')" class="nav-item">
            <router-link to="/customer" class="nav-link ">
              <i class="nav-icon fa fa-users"></i>
              <p>{{ trans("customer.customer") }}</p>
            </router-link>
          </li>
          <li v-if="hasPermission('access-group')" class="nav-item">
            <router-link to="/group" class="nav-link ">
              <i class="nav-icon fa fa-users"></i>
              <p>{{ trans("group.group") }}</p>
            </router-link>
          </li>
          <li v-if="hasPermission('access-category')" class="nav-item">
            <router-link to="/category" class="nav-link ">
              <i class="nav-icon fa fa-users"></i>
              <p>{{ trans("category.category") }}</p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link active" to="/configuration/role" exact>
              <i class="fas fa-users fa-fw"></i>
              <span class="hide-menu">{{trans('role.role')}}</span>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link active" to="/configuration/permission" exact>
              <i class="fas fa-key fa-fw"></i>
              <span class="hide-menu">{{trans('permission.permission')}}</span>
            </router-link>
          </li>
        </ul>
    </li>



  </ul>
</template>





<script>
export default {
  methods: {
    hasPermission(permission) {
      return helper.hasPermission(permission);
    },
    hasRole(role) {
      return helper.hasRole(role);
    },
    getConfig(config) {
      return helper.getConfig(config);
    },
    toggleMenu(e) {
      console.log( $(e.target) , !$(e.target).closest('.nav-treeview').length  );
        if ($(e.target).parents('.derop-down-menu') && !$(e.target).closest('.nav-treeview').length || $(e.target).hasClass('derop-down-menu') && !$(e.target).closest('.nav-treeview').length ) {
          console.log(!$(e.target).parents('.nav-treeview'));
          if (!$(e.target).parents('.menu-is-opening') ) {
            $('.menu-is-opening').removeClass('menu-is-opening');
            $('.menu-open .active').removeClass('active');
            $('.menu-open').removeClass('menu-open');
          }
          $(e.target).parents('.nav-item').toggleClass('menu-is-opening')
          $(e.target).parents('.nav-item').toggleClass('menu-open')
          if ( $(e.target).hasClass('derop-down-menu')) {
            $(e.target).toggleClass('active')
          }else{
            $(e.target).parents('.derop-down-menu').toggleClass('active')
          }
        }
    },
    closeMenu(e) {
      console.log('testss');
          $('.menu-is-opening').removeClass('menu-is-opening');
          $('.menu-open .active').removeClass('active');
          $('.menu-open').removeClass('menu-open');
    },
  },
  mounted() {
    $('.nav-link.router-link-exact-active.router-link-active').parents('.nav-item').addClass('menu-is-opening').addClass('menu-open').children('.nav-link').addClass('active');
  },

};
</script>

<style lang="css">

.nav-link.router-link-exact-active.router-link-active,
.sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active.router-link-active {
    color: #fff !important;
    background-color: #007bff !important;
}
</style>
