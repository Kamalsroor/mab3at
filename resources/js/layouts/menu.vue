<template>
  <ul
    class="nav nav-pills nav-sidebar flex-column"
    data-widget="treeview"
    role="menu"
    data-accordion="false"
  >
    <!-- Add icons to the links using the .nav-icon class
    with font-awesome or any other icon font library-->
    <li class="nav-item">
      <router-link to="/home" class="nav-link active">
        <i class="nav-icon fa fa-dashboard"></i>
        <p>الرئيسيه</p>
      </router-link>
    </li>

    <template v-if="$route.meta.menu == 'definition'">
      <li v-if="hasPermission('access-user')" class="nav-item">
        <router-link to="/user" class="nav-link active">
          <i class="nav-icon fa fa-users"></i>
          <p>{{ trans("user.user") }}</p>
        </router-link>
      </li>
      <li v-if="hasPermission('access-configuration')" class="nav-item">
        <router-link to="/branch" class="nav-link active">
          <i class="nav-icon fa fa-users"></i>
          <p>{{ trans("branch.branch") }}</p>
        </router-link>
      </li>
      <li v-if="hasPermission('access-configuration')" class="nav-item">
        <router-link to="/customer" class="nav-link active">
          <i class="nav-icon fa fa-users"></i>
          <p>{{ trans("customer.customer") }}</p>
        </router-link>
      </li>
      <li v-if="hasPermission('access-configuration')" class="nav-item">
        <router-link to="/category" class="nav-link active">
          <i class="nav-icon fa fa-users"></i>
          <p>{{ trans("category.category") }}</p>
        </router-link>
      </li>
      <li v-if="hasPermission('access-configuration')" class="nav-item">
        <router-link to="/group" class="nav-link active">
          <i class="nav-icon fa fa-users"></i>
          <p>{{ trans("group.group") }}</p>
        </router-link>
      </li>
      <li v-if="hasPermission('access-configuration')" class="nav-item">
        <router-link to="/product" class="nav-link active">
          <i class="nav-icon fa fa-users"></i>
          <p>{{ trans("product.product") }}</p>
        </router-link>
      </li>
    </template>
    <template v-else-if="$route.meta.menu == 'debenture'">
      <li class="nav-item">
        <router-link to="/debenture_cashing" class="nav-link active">
          <i class="nav-icon fa fa-users"></i>
          <p>{{ trans("debenture_cashing.debenture_cashing") }}</p>
        </router-link>
      </li>
      <li class="nav-item">
        <router-link to="/debenture_deposit" class="nav-link active">
          <i class="nav-icon fa fa-users"></i>
          <p>{{ trans("debenture_cashing.debenture_deposit") }}</p>
        </router-link>
      </li>

      <li class="nav-item">
        <router-link to="/account_adjustment" class="nav-link active">
          <i class="nav-icon fa fa-users"></i>
          <p>{{ trans("debenture_cashing.account_adjustment") }}</p>
        </router-link>
      </li>
    </template>
    <template v-else-if="$route.meta.menu == 'bill'">
      <li class="nav-item">
        <router-link to="/purchases_bill" class="nav-link active">
          <i class="nav-icon fa fa-users"></i>
          <p>{{ trans("debenture_cashing.purchases_bill") }}</p>
        </router-link>
      </li>
      <li class="nav-item">
        <router-link to="/sales_bill" class="nav-link active">
          <i class="nav-icon fa fa-users"></i>
          <p>{{ trans("debenture_cashing.sales_bill") }}</p>
        </router-link>
      </li>
    </template>
    <template v-else-if="$route.meta.menu == 'configuration'">
      <li class="nav-item">
        <router-link class="nav-link active" to="/configuration/basic" exact>
          <i class="fas fa-cog fa-fw"></i>
          <span class="hide-menu">{{trans('configuration.basic_configuration')}}</span>
        </router-link>
      </li>
      <li class="nav-item">
        <router-link class="nav-link active" to="/configuration/logo" exact>
          <i class="fas fa-image fa-fw"></i>
          <span class="hide-menu">{{trans('general.logo')}}</span>
        </router-link>
      </li>
      <li class="nav-item">
        <router-link class="nav-link active" to="/configuration/system" exact>
          <i class="fas fa-cogs fa-fw"></i>
          <span class="hide-menu">{{trans('configuration.system_configuration')}}</span>
        </router-link>
      </li>
      <li class="nav-item">
        <router-link class="nav-link active" to="/configuration/mail" exact>
          <i class="fas fa-envelope fa-fw"></i>
          <span class="hide-menu">{{trans('mail.mail_configuration')}}</span>
        </router-link>
      </li>
      <li v-if="getConfig('multilingual')">
        <router-link class="nav-link active" to="/configuration/locale" exact>
          <i class="fas fa-globe fa-fw"></i>
          <span class="hide-menu">{{trans('locale.locale')}}</span>
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
      <li class="nav-item">
        <router-link class="nav-link active" to="/configuration/menu" exact>
          <i class="fas fa-list fa-fw"></i>
          <span class="hide-menu">{{trans('general.menu')}}</span>
        </router-link>
      </li>
      <!-- <li class="nav-item"><router-link class="nav-link active" to="/configuration/sms" exact><i class="fas fa-comment fa-fw"></i> <span class="hide-menu">{{trans('general.sms')}}</span></router-link></li> -->
      <li class="nav-item">
        <router-link class="nav-link active" to="/configuration/authentication" exact>
          <i class="fas fa-sign-in-alt fa-fw"></i>
          <span class="hide-menu">{{trans('auth.authentication')}}</span>
        </router-link>
      </li>
      <li class="nav-item" v-if="getConfig('ip_filter')">
        <router-link class="nav-link active" to="/configuration/ip-filter" exact>
          <i class="fas fa-ellipsis-v fa-fw"></i>
          <span class="hide-menu">{{trans('ip_filter.ip_filter')}}</span>
        </router-link>
      </li>
      <li class="nav-item">
        <router-link class="nav-link active" to="/configuration/scheduled-job" exact>
          <i class="fas fa-clock fa-fw"></i>
          <span class="hide-menu">{{trans('general.scheduled_job')}}</span>
        </router-link>
      </li>
    </template>
    <template v-else>
      <li class="nav-item">
        <router-link to="/definition" class="nav-link active">
          <i class="nav-icon fa fa-dashboard"></i>
          <p>تكويد</p>
        </router-link>
      </li>
      <li class="nav-item">
        <router-link to="/bill" class="nav-link active">
          <i class="nav-icon fa fa-dashboard"></i>
          <p>فواتير</p>
        </router-link>
      </li>
      <li class="nav-item">
        <router-link to="/debenture" class="nav-link active">
          <i class="nav-icon fa fa-dashboard"></i>
          <p>سندات</p>
        </router-link>
      </li>

      <li class="nav-item">
        <router-link to="/customer/statement" class="nav-link active">
          <i class="nav-icon fa fa-users"></i>
          <p>كشف حساب عملاء</p>
        </router-link>
      </li>
      <li class="nav-item">
        <router-link to="/product/returns" class="nav-link active">
          <i class="nav-icon fa fa-users"></i>
          <p>كشف حالة السريالات</p>
        </router-link>
      </li>
      <li>
        <router-link to="/stock" class="nav-link active">
          <i class="nav-icon fa fa-users"></i>
          <p>المخزون</p>
        </router-link>
      </li>
      <li class="nav-item">
        <router-link class="nav-link active" to="/home" exact>
          <i class="fas fa-home fa-fw"></i>
          <span class="hide-menu">الرئيسيه</span>
        </router-link>
      </li>
      <li class="nav-item" v-if="hasPermission('access-user') && getConfig('show_user_menu')">
        <router-link class="nav-link active" to="/user" exact>
          <i class="fas fa-users fa-fw"></i>
          <span class="hide-menu">{{trans('user.user')}}</span>
        </router-link>
      </li>
      <li class="nav-item" v-if="hasPermission('access-todo') && getConfig('show_todo_menu')">
        <router-link class="nav-link active" to="/todo" exact>
          <i class="far fa-check-circle fa-fw"></i>
          <span class="hide-menu">{{trans('todo.todo')}}</span>
        </router-link>
      </li>
      <li class="nav-item" v-if="hasPermission('access-message') && getConfig('show_message_menu')">
        <router-link class="nav-link active" to="/message" exact>
          <i class="far fa-envelope-open fa-fw"></i>
          <span class="hide-menu">{{trans('message.message')}}</span>
        </router-link>
      </li>
      <li
        class="nav-item"
        v-if="hasPermission('access-configuration') && getConfig('show_configuration_menu')"
      >
        <router-link class="nav-link active" to="/configuration" exact>
          <i class="fas fa-cogs fa-fw"></i>
          <span class="hide-menu">{{trans('configuration.configuration')}}</span>
        </router-link>
      </li>
      <li
        class="nav-item"
        v-if="hasPermission('access-configuration') && getConfig('show_backup_menu')"
      >
        <router-link class="nav-link active" to="/backup" exact>
          <i class="fas fa-database fa-fw"></i>
          <span class="hide-menu">{{trans('backup.backup')}}</span>
        </router-link>
      </li>
      <li
        class="nav-item"
        v-if="hasPermission('access-configuration') && getConfig('show_email_template_menu')"
      >
        <router-link class="nav-link active" to="/email-template" exact>
          <i class="far fa-envelope fa-fw"></i>
          <span class="hide-menu">{{trans('template.email_template')}}</span>
        </router-link>
      </li>
      <li
        class="nav-item"
        v-if="hasPermission('access-configuration') && getConfig('show_email_log_menu')"
      >
        <router-link class="nav-link active" to="/email-log" exact>
          <i class="fas fa-envelope fa-fw"></i>
          <span class="hide-menu">{{trans('mail.email_log')}}</span>
        </router-link>
      </li>
      <li
        class="nav-item"
        v-if="hasPermission('access-configuration') && getConfig('show_activity_log_menu')"
      >
        <router-link class="nav-link active" to="/activity-log" exact>
          <i class="fas fa-bars fa-fw"></i>
          <span class="hide-menu">{{trans('activity.activity_log')}}</span>
        </router-link>
      </li>
    </template>
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
    }
  }
};
</script>
