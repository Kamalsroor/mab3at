import Vue from "vue";
import Loading from "vue-loading-overlay";

import "vue-loading-overlay/dist/vue-loading.css";
import VueRouter from "vue-router";
import store from "./store";

let pageLoader;

let routes = [
  {
    path: "/", // all the routes which needs authentication + two factor authentication + lock screen

    component: require("./layouts/default-page").default,
    meta: { validate: ["auth", "two_factor"] },
    children: [
      {
        path: "/",

        component: require("./views/pages/home").default
      },
      {
        path: "/home",

        component: require("./views/pages/home").default
      },
      {
        path: "/profile",

        component: require("./views/pages/profile").default
      },
      {
        path: "/change-password",

        component: require("./views/pages/change-password").default
      },
      {
        path: "/blank",

        component: require("./views/pages/blank").default
      },

      // definition
      {
        path: "/definition",

        component: require("./views/pages/definition").default,
        meta: { menu: "definition" }
      },

      {
        path: "/user",

        component: require("./views/user/index").default,
        meta: { menu: "definition" }
      },
      {
        path: "/user/:id",

        component: require("./views/user/basic").default,
        meta: { menu: "definition" }
      },
      {
        path: "/user/:id/basic",

        component: require("./views/user/basic").default,
        meta: { menu: "definition" }
      },
      {
        path: "/user/:id/contact",

        component: require("./views/user/contact").default,
        meta: { menu: "definition" }
      },
      {
        path: "/user/:id/avatar",

        component: require("./views/user/avatar").default,
        meta: { menu: "definition" }
      },
      {
        path: "/user/:id/social",

        component: require("./views/user/social").default,
        meta: { menu: "definition" }
      },
      {
        path: "/user/:id/password",

        component: require("./views/user/password").default,
        meta: { menu: "definition" }
      },
      {
        path: "/user/:id/email",

        component: require("./views/user/email").default,
        meta: { menu: "definition" }
      },
      {
        path: "/branch",

        component: require("./views/branch/index").default,
        meta: { menu: "definition" }
      },
      {
        path: "/branch/:id/edit",

        component: require("./views/branch/edit").default,
        meta: { menu: "definition" }
      },

     
      {
        path: "/customer",

        component: require("./views/customer/index").default,
        meta: { menu: "definition" }
      },
      {
        path: "/customer/:id/edit",

        component: require("./views/customer/edit").default,
        meta: { menu: "definition" }
      },

      {
        path: "/group",

        component: require("./views/group/index").default,
        meta: { menu: "definition" }
      },
      {
        path: "/group/:id/edit",

        component: require("./views/group/edit").default,
        meta: { menu: "definition" }
      },

      {
        path: "/category",

        component: require("./views/category/index").default,
        meta: { menu: "definition" }
      },
      {
        path: "/category/:id/edit",

        component: require("./views/category/edit").default,
        meta: { menu: "definition" }
      },




      {
        path: "/debenture",

        component: require("./views/pages/debenture").default,
        meta: { menu: "debenture" }
      },

      {
        path: "/configuration",

        component: require("./views/configuration/basic/index").default,
        meta: { menu: "configuration" }
      },
      {
        path: "/configuration/logo",

        component: require("./views/configuration/logo/index").default,
        meta: { menu: "configuration" }
      },
      {
        path: "/configuration/mail",

        component: require("./views/configuration/mail/index").default,
        meta: { menu: "configuration" }
      },
      {
        path: "/backup",

        component: require("./views/backup/index").default
      },
      {
        path: "/configuration/basic",

        component: require("./views/configuration/basic/index").default,
        meta: { menu: "configuration" }
      },
      {
        path: "/configuration/system",

        component: require("./views/configuration/system/index").default,
        meta: { menu: "configuration" }
      },
      {
        path: "/configuration/role",

        component: require("./views/configuration/role/index").default,
        meta: { menu: "configuration" }
      },
      {
        path: "/configuration/menu",

        component: require("./views/configuration/menu/index").default,
        meta: { menu: "configuration" }
      },
      {
        path: "/configuration/authentication",

        component: require("./views/configuration/authentication/index")
          .default,
        meta: { menu: "configuration" }
      },
      // {
      //     path: '/configuration/sms',
      //  //
      // component: require('./views/configuration/sms/index').default,
      //     meta: { menu: 'configuration'}
      // },
      {
        path: "/configuration/scheduled-job",

        component: require("./views/configuration/scheduled-job/index").default,
        meta: { menu: "configuration" }
      },
      {
        path: "/configuration/ip-filter",

        component: require("./views/configuration/ip-filter/index").default,
        meta: { menu: "configuration" }
      },
      {
        path: "/configuration/ip-filter/:id/edit",

        component: require("./views/configuration/ip-filter/edit").default,
        meta: { menu: "configuration" }
      },
      {
        path: "/configuration/permission",

        component: require("./views/configuration/permission/index").default,
        meta: { menu: "configuration" }
      },
      {
        path: "/configuration/permission/assign",

        component: require("./views/configuration/permission/assign").default,
        meta: { menu: "configuration" }
      },
      {
        path: "/configuration/locale",

        component: require("./views/configuration/locale/index").default,
        meta: { menu: "configuration" }
      },
      {
        path: "/configuration/locale/:id/edit",

        component: require("./views/configuration/locale/edit").default,
        meta: { menu: "configuration" }
      },
      {
        path: "/configuration/locale/:locale",

        component: require("./views/configuration/locale/view").default,
        meta: { menu: "configuration" }
      },
      {
        path: "/configuration/locale/:locale/:module",

        component: require("./views/configuration/locale/view").default,
        meta: { menu: "configuration" }
      },
      {
        path: "/email-template",

        component: require("./views/email-template/index").default
      },
      {
        path: "/email-template/:id/edit",

        component: require("./views/email-template/edit").default
      },
      {
        path: "/email-log",

        component: require("./views/email-log/index").default
      },
      {
        path: "/activity-log",

        component: require("./views/activity-log/index").default
      },
     
      {
        path: "/message",

        component: require("./views/message/index").default
      },
      {
        path: "/message/compose",

        component: require("./views/message/index").default
      },
      {
        path: "/message/inbox",

        component: require("./views/message/inbox").default
      },
      {
        path: "/message/sent",

        component: require("./views/message/sent").default
      },
      {
        path: "/message/important",

        component: require("./views/message/important").default
      },
      {
        path: "/message/trash",

        component: require("./views/message/trash").default
      },
      {
        path: "/message/draft",

        component: require("./views/message/draft").default
      },
      {
        path: "/message/:uuid/draft",

        component: require("./views/message/edit-draft").default
      },
      {
        path: "/message/:uuid",

        component: require("./views/message/view").default
      },

    
 
    ]
  },
  {
    path: "/",

    component: require("./layouts/guest-page").default,
    meta: { validate: ["auth"] },
    children: [
      {
        path: "/auth/security",

        component: require("./views/auth/security").default
      },
      {
        path: "/auth/lock",

        component: require("./views/auth/lock").default
      }
    ]
  },
  {
    path: "/", // all the routes which can be access without authentication

    component: require("./layouts/guest-page").default,
    meta: { validate: ["guest"] },
    children: [
      {
        path: "/",

        component: require("./views/auth/login").default
      },
      {
        path: "/login",

        component: require("./views/auth/login").default
      },
      {
        path: "/password",

        component: require("./views/auth/password").default
      },
      {
        path: "/register",

        component: require("./views/auth/register").default
      },
      {
        path: "/auth/:token/activate",

        component: require("./views/auth/activate").default
      },
      {
        path: "/password/reset/:token",

        component: require("./views/auth/reset").default
      },
      {
        path: "/auth/social",

        component: require("./views/auth/social-auth").default
      }
    ]
  },
  {
    path: "/",

    component: require("./layouts/guest-page").default,
    children: [
      {
        path: "/terms-and-conditions",

        component: require("./views/pages/terms-and-conditions").default
      }
    ]
  },
  {
    path: "/",

    component: require("./layouts/error-page").default,
    children: [
      {
        path: "/terms-and-conditions",

        component: require("./views/pages/terms-and-conditions").default
      },
      {
        path: "/ip-restricted",

        component: require("./views/errors/ip-restricted").default
      },
      {
        path: "/maintenance",

        component: require("./views/errors/maintenance").default
      }
    ]
  },
  {
    path: "*",

    component: require("./layouts/error-page").default,
    children: [
      {
        path: "*",

        component: require("./views/errors/page-not-found").default
      }
    ]
  }
];

const router = new VueRouter({
  routes,
  // linkActiveClass: 'active',
  mode: "history",
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition;
    } else {
      return { x: 0, y: 0 };
    }
  }
});

router.beforeEach((to, from, next) => {
  // pageLoader = Vue.$loading.show();
  // For force logout
  // store.dispatch('resetAuthUserDetail');
  helper
    .check()
    .then(response => {
      // Initialize toastr notification
      console.log("all good");
      // pageLoader.hide();

      helper.notification();

      // Check for IP Restriction; If restricted IP found, redirect to "/ip-restricted" route
      // if (
      //   helper.getConfig("ip_filter") &&
      //   localStorage.getItem("ip_restricted") &&
      //   to.fullPath != "/ip-restricted"
      // ) {
      //   pageLoader.hide();
      //   return next({ path: "/ip-restricted" });
      // }

      // Check for Maintenance mode; If maintenance mode is on, redirect to "/maintenance" route
      // if (
      //   helper.isAuth() &&
      //   !helper.hasRole("admin") &&
      //   helper.getConfig("maintenance_mode") &&
      //   to.fullPath != "/maintenance"
      // ) {
      //   pageLoader.hide();
      //   return next({ path: "/maintenance" });

      // }

      if (to.matched.some(m => m.meta.validate)) {
        const m = to.matched.find(m => m.meta.validate);

        // Check for authentication; If no, redirect to "/login" route
        if (m.meta.validate.indexOf("auth") > -1) {
          if (!helper.isAuth()) {
            toastr.error(i18n.auth.auth_required);
            // pageLoader.hide();
            return next({ path: "/login" });
          }
        }

        // Check for two factor security; If enabled, redirect to "/auth/security" route after login
        // if (m.meta.validate.indexOf("two_factor") > -1) {
        //   if (
        //     helper.getConfig("two_factor_security") &&
        //     helper.getTwoFactorCode()
        //   ) {
        //     pageLoader.hide();
        //     return next({ path: "/auth/security" });
        //   }

        // }

        // Check for screen lock; If enabled, redirect to "/auth/lock" route after screen lock timeout
        // if (m.meta.validate.indexOf("lock_screen") > -1) {
        //   if (helper.getConfig("lock_screen") && helper.isScreenLocked()) {
        //     pageLoader.hide();
        //     return next({ path: "/auth/lock" });
        //   }

        // }

        // Check for authentication; If authenticated, redirect to "/home" route
        if (m.meta.validate.indexOf("guest") > -1) {
          if (helper.isAuth()) {
            toastr.error(i18n.auth.guest_required);
            // pageLoader.hide();
            return next({ path: "/home" });
          } else {
            // pageLoader.hide();
          }
        } else {
          // pageLoader.hide();
        }
      }

      // pageLoader.hide();

      return next();
    })
    .catch(error => {
      // Authentication check fail, redirected back to "/login" route
      // console.log("all good");
      // pageLoader.hide();

      store.dispatch("resetAuthUserDetail");
      // pageLoader.hide();

      return next({ path: "/login" });
    });
});

router.afterEach((to, from) => {
  // pageLoader.hide();
});

export default router;
