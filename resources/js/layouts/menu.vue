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
          <li v-if="hasPermission('access-product')" class="nav-item">
            <router-link to="/product" class="nav-link ">
              <i class="nav-icon fa fa-users"></i>
              <p>{{ trans("product.product") }}</p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link active" to="/configuration/role" exact>
              <i class="fas fa-users fa-fw"></i>
              <span >{{trans('role.role')}}</span>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link active" to="/configuration/permission" exact>
              <i class="fas fa-key fa-fw"></i>
              <span >{{trans('permission.permission')}}</span>
            </router-link>
          </li>
        </ul>
    </li>
    
    <li class="nav-item " @click="toggleMenu" >
        <a href="javascript:;" class="nav-link derop-down-menu">
          <i class="nav-icon fas fa-table"></i>
          <p>
            الاعدادات
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <router-link class="nav-link active" to="/configuration/basic" exact>
              <i class="fas fa-cog fa-fw"></i>
              <span >{{trans('configuration.basic_configuration')}}</span>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link active" to="/configuration/logo" exact>
              <i class="fas fa-image fa-fw"></i>
              <span >{{trans('general.logo')}}</span>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link active" to="/configuration/system" exact>
              <i class="fas fa-cogs fa-fw"></i>
              <span >{{trans('configuration.system_configuration')}}</span>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link active" to="/configuration/mail" exact>
              <i class="fas fa-envelope fa-fw"></i>
              <span >{{trans('mail.mail_configuration')}}</span>
            </router-link>
          </li>
          <li v-if="getConfig('multilingual')">
            <router-link class="nav-link active" to="/configuration/locale" exact>
              <i class="fas fa-globe fa-fw"></i>
              <span >{{trans('locale.locale')}}</span>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link active" to="/configuration/role" exact>
              <i class="fas fa-users fa-fw"></i>
              <span >{{trans('role.role')}}</span>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link active" to="/configuration/permission" exact>
              <i class="fas fa-key fa-fw"></i>
              <span >{{trans('permission.permission')}}</span>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link active" to="/configuration/menu" exact>
              <i class="fas fa-list fa-fw"></i>
              <span >{{trans('general.menu')}}</span>
            </router-link>
          </li>
          <!-- <li class="nav-item"><router-link class="nav-link active" to="/configuration/sms" exact><i class="fas fa-comment fa-fw"></i> <span >{{trans('general.sms')}}</span></router-link></li> -->
          <li class="nav-item">
            <router-link class="nav-link active" to="/configuration/authentication" exact>
              <i class="fas fa-sign-in-alt fa-fw"></i>
              <span >{{trans('auth.authentication')}}</span>
            </router-link>
          </li>
          <li class="nav-item" v-if="getConfig('ip_filter')">
            <router-link class="nav-link active" to="/configuration/ip-filter" exact>
              <i class="fas fa-ellipsis-v fa-fw"></i>
              <span >{{trans('ip_filter.ip_filter')}}</span>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link active" to="/configuration/scheduled-job" exact>
              <i class="fas fa-clock fa-fw"></i>
              <span >{{trans('general.scheduled_job')}}</span>
            </router-link>
          </li>
           <li class="nav-item" v-if="hasPermission('access-message') && getConfig('show_message_menu')">
              <router-link class="nav-link active" to="/message" exact>
                <i class="far fa-envelope-open fa-fw"></i>
                <span >{{trans('message.message')}}</span>
              </router-link>
            </li>
            <li
              class="nav-item"
              v-if="hasPermission('access-configuration') && getConfig('show_configuration_menu')"
            >
              <router-link class="nav-link active" to="/configuration" exact>
                <i class="fas fa-cogs fa-fw"></i>
                <span >{{trans('configuration.configuration')}}</span>
              </router-link>
            </li>
            <li
              class="nav-item"
              v-if="hasPermission('access-configuration') && getConfig('show_backup_menu')"
            >
              <router-link class="nav-link active" to="/backup" exact>
                <i class="fas fa-database fa-fw"></i>
                <span >{{trans('backup.backup')}}</span>
              </router-link>
            </li>
            <li
              class="nav-item"
              v-if="hasPermission('access-configuration') && getConfig('show_email_template_menu')"
            >
              <router-link class="nav-link active" to="/email-template" exact>
                <i class="far fa-envelope fa-fw"></i>
                <span >{{trans('template.email_template')}}</span>
              </router-link>
            </li>
            <li
              class="nav-item"
              v-if="hasPermission('access-configuration') && getConfig('show_email_log_menu')"
            >
              <router-link class="nav-link active" to="/email-log" exact>
                <i class="fas fa-envelope fa-fw"></i>
                <span >{{trans('mail.email_log')}}</span>
              </router-link>
            </li>
            <li
              class="nav-item"
              v-if="hasPermission('access-configuration') && getConfig('show_activity_log_menu')"
            >
              <router-link class="nav-link active" to="/activity-log" exact>
                <i class="fas fa-bars fa-fw"></i>
                <span >{{trans('activity.activity_log')}}</span>
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
