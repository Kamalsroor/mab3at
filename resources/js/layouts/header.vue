<template>
  <!-- <header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
      <div class="navbar-header">
        <router-link class="navbar-brand" to="/">
          <b>
            <img :src="getSidebarLogo" alt class="dark-logo" />
            <img :src="getSidebarLogo" alt class="light-logo" />
          </b>
          <span>
            <img :src="getMainLogo" alt class="dark-logo" />
            <img :src="getMainLogo" class="light-logo" alt />
          </span>
        </router-link>
      </div>
      <div class="navbar-collapse">
        <ul class="navbar-nav mr-auto mt-md-0">
          <li class="nav-item">
            <a
              class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark"
              href="javascript:void(0)"
            >
              <i class="fas fa-bars"></i>
            </a>
          </li>
          <li class="nav-item" v-tooltip.right="trans('general.toggle_sidebar')">
            <a
              class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark"
              href="javascript:void(0)"
            >
              <i class="icon-arrow-left-circle fas"></i>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav my-lg-0">
          <li
            class="nav-item"
            v-tooltip.bottom="trans('todo.todo')"
            v-if="getConfig('todo') && hasPermission('access-todo')"
          >
            <router-link class="nav-link" to="/todo">
              <i class="far fa-check-circle"></i>
            </router-link>
          </li>
          <li
            class="nav-item"
            v-tooltip.bottom="trans('message.message')"
            v-if="getConfig('message') && hasPermission('access-message')"
          >
            <router-link class="nav-link" to="/message">
              <i class="fas fa-envelope"></i>
            </router-link>
          </li>
          <li
            class="nav-item"
            v-tooltip.bottom="trans('configuration.configuration')"
            v-if="hasPermission('access-configuration')"
          >
            <router-link class="nav-link" to="/configuration">
              <i class="fas fa-cogs"></i>
            </router-link>
          </li>
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle text-muted waves-effect waves-dark"
              href
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <img :src="getAuthUser('avatar')" alt="user" class="profile-pic" />
            </a>
            <div
              :class="['dropdown-menu', getConfig('user_direction') != 'rtl' ? 'dropdown-menu-right' : '']"
            >
              <ul class="dropdown-user">
                <li>
                  <div class="dw-user-box text-center">
                    <div class="u-img">
                      <img :src="getAuthUser('avatar')" alt="user" />
                    </div>
                    <div class="u-text">
                      <h4>{{getAuthUser('full_name')}}</h4>
                      <p class="text-muted">{{getAuthUser('email')}}</p>
                      <router-link
                        to="/profile"
                        class="btn btn-rounded btn-danger btn-sm"
                      >{{trans('user.view_profile')}}</router-link>
                    </div>
                  </div>
                </li>
                <li role="separator" class="divider"></li>
                <li>
                  <router-link to="/change-password">
                    <i class="fas fa-key"></i>
                    {{trans('user.change_password')}}
                  </router-link>
                </li>
                <li role="separator" class="divider"></li>
                <li>
                  <a href="#" @click.prevent="logout">
                    <i class="fas fa-power-off"></i>
                    {{trans('auth.logout')}}
                  </a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </header>-->
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#">
          <i class="fa fa-bars"></i>
        </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" @click.prevent="logout">
          <i class="fas fa-power-off"></i>
          تسجيل خروج
        </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">تماس</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input
          class="form-control form-control-navbar"
          type="search"
          placeholder="جستجو"
          aria-label="Search"
        />
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav mr-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-comments-o"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img
                :src="getAuthUser('avatar')"
                alt="User Avatar"
                class="img-size-50 ml-3 img-circle"
              />
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  فسثفي
                  <span class="float-left text-sm text-danger">
                    <i class="fa fa-star"></i>
                  </span>
                </h3>
                <p class="text-sm">با من تماس بگیر لطفا...</p>
                <p class="text-sm text-muted">
                  <i class="fa fa-clock-o mr-1"></i> 4 ساعت قبل
                </p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img
                src="dist/img/user8-128x128.jpg"
                alt="User Avatar"
                class="img-size-50 img-circle ml-3"
              />
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  پیمان احمدی
                  <span class="float-left text-sm text-muted">
                    <i class="fa fa-star"></i>
                  </span>
                </h3>
                <p class="text-sm">من پیامتو دریافت کردم</p>
                <p class="text-sm text-muted">
                  <i class="fa fa-clock-o mr-1"></i> 4 ساعت قبل
                </p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img
                src="dist/img/user3-128x128.jpg"
                alt="User Avatar"
                class="img-size-50 img-circle ml-3"
              />
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  سارا وکیلی
                  <span class="float-left text-sm text-warning">
                    <i class="fa fa-star"></i>
                  </span>
                </h3>
                <p class="text-sm">پروژه اتون عالی بود مرسی واقعا</p>
                <p class="text-sm text-muted">
                  <i class="fa fa-clock-o mr-1"></i>4 ساعت قبل
                </p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">مشاهده همه پیام‌ها</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-bell-o"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
          <span class="dropdown-item dropdown-header">15 نوتیفیکیشن</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-envelope ml-2"></i> 4 پیام جدید
            <span class="float-left text-muted text-sm">3 دقیقه</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-users ml-2"></i> 8 درخواست دوستی
            <span class="float-left text-muted text-sm">12 ساعت</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-file ml-2"></i> 3 گزارش جدید
            <span class="float-left text-muted text-sm">2 روز</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">مشاهده همه نوتیفیکیشن</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fa fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
</template>

<script>
export default {
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
    getConfig(name) {
      return helper.getConfig(name);
    },
    hasPermission(permission) {
      return helper.hasPermission(permission);
    }
  },
  computed: {
    getMainLogo() {
      if (helper.getConfig("main_logo"))
        return "/" + helper.getConfig("main_logo");
      else return "/images/default_main_logo.png";
    },
    getSidebarLogo() {
      if (helper.getConfig("sidebar_logo"))
        return "/" + helper.getConfig("sidebar_logo");
      else return "/images/default_sidebar_logo.png";
    }
  }
};
</script>
