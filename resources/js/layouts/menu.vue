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
        <p>{{ trans("general.home") }}</p>
      </router-link>
      <!-- <ul class="nav nav-treeview">
        <li class="nav-item">
          <router-link to="#" class="nav-link active">
            <i class="fa fa-circle-o nav-icon"></i>
            <p>صفحه فعال</p>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link to="/user" class="nav-link">
            <i class="fa fa-circle-o nav-icon"></i>
            <p>صفحه غیر فعال</p>
          </router-link>
        </li>
      </ul>-->
    </li>
    <li class="nav-item">
      <router-link to="/user" class="nav-link active">
        <i class="nav-icon fa fa-users"></i>
        <p>{{ trans("user.user") }}</p>
      </router-link>
    </li>
    <li class="nav-item">
      <router-link to="/branch" class="nav-link active">
        <i class="nav-icon fa fa-users"></i>
        <p>{{ trans("branch.branch") }}</p>
      </router-link>
    </li>
    <li class="nav-item">
      <router-link to="/customer" class="nav-link active">
        <i class="nav-icon fa fa-users"></i>
        <p>{{ trans("customer.customer") }}</p>
      </router-link>
    </li>
    <li class="nav-item">
      <router-link to="/category" class="nav-link active">
        <i class="nav-icon fa fa-users"></i>
        <p>{{ trans("category.category") }}</p>
      </router-link>
    </li>
    <li class="nav-item">
      <router-link to="/group" class="nav-link active">
        <i class="nav-icon fa fa-users"></i>
        <p>{{ trans("group.group") }}</p>
      </router-link>
    </li>
    <li class="nav-item">
      <router-link to="/product" class="nav-link active">
        <i class="nav-icon fa fa-users"></i>
        <p>{{ trans("product.product") }}</p>
      </router-link>
    </li>
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
    <li class="nav-item">
      <router-link to="/account_adjustment" class="nav-link active">
        <i class="nav-icon fa fa-users"></i>
        <p>{{ trans("debenture_cashing.account_adjustment") }}</p>
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
    <li class="nav-item">
      <router-link to="/stock" class="nav-link active">
        <i class="nav-icon fa fa-users"></i>
        <p>المخزون</p>
      </router-link>
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
    }
  }
};
</script>
