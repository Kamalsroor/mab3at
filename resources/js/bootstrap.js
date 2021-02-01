import Vue from "vue";
import VueRouter from "vue-router";
import axios from "axios";
import VueProgressBar from 'vue-progressbar'


import Form from "./services/form";
import helper from "./services/helper";
import VTooltip from "v-tooltip";
import VuejsDialog from "vuejs-dialog";
import VuejsDialogMixin from "vuejs-dialog/dist/vuejs-dialog-mixin.min.js";
import "vuejs-dialog/dist/vuejs-dialog.min.css";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
import showTip from "./components/show-tip";
import paginationRecord from "./components/pagination-record";
import showError from "./components/show-error";
import moduleInfo from "./components/module-info";
import VuePageTransition from 'vue-page-transition'
import VueConfirmDialog from "vue-confirm-dialog";




window._get = require("lodash/get");
window._eachRight = require("lodash/eachRight");
window._replace = require("lodash/replace");
window._has = require("lodash/has");
window._size = require("lodash/size");
const options = {
  color: '#27ae60',
  failedColor: '#c0392b',
  thickness: '10px',
  transition: {
    speed: '3s',
    opacity: '1s',
    termination: 900
  },
  autoRevert: true,
  inverse: false
}

window.Vue = Vue;
Vue.use(VueProgressBar, options)
Vue.use(VuePageTransition)
Vue.use(VueConfirmDialog);

Vue.use(VueRouter);
window.axios = axios;
window.Form = Form;
window.helper = helper;
Vue.prototype.trans = (string, args) => {
  let value = _get(window.i18n, string);

  _eachRight(args, (paramVal, paramKey) => {
    value = _replace(value, `:${paramKey}`, paramVal);
  });
  return value;
};
Vue.prototype.$last = function(item, list) {
  return item == list[list.length - 1];
};

Vue.use(VTooltip);


let VuejsDialogOption = {
  loader: false, // set to true if you want the dailog to show a loader after click on "proceed"
  reverse: false, // switch the button positions (left to right, and vise versa)
  okText: 'اكمل',
  cancelText: 'اغلاق',
  animation: 'bounce',
  // animation: 'zoom', // Available: "zoom", "bounce", "fade"
  type: 'basic', // coming soon: 'soft', 'hard'
  verification: 'continue', // for hard confirm, user will be prompted to type this to enable the proceed button
  verificationHelp: 'Type "[+:verification]" below to confirm', // Verification help text. [+:verification] will be matched with 'options.verification' (i.e 'Type "continue" below to confirm')
  clicksCount: 3, // for soft confirm, user will be asked to click on "proceed" btn 3 times before actually proceeding
  backdropClose: true, // set to true to close the dialog when clicking outside of the dialog window, i.e. click landing on the mask
  customClass: '' // Custom class to be injected into the parent node for the current dialog instance
};

Vue.use(VuejsDialog,VuejsDialogOption);
Vue.use(Loading);
Vue.component("show-tip", showTip);
Vue.component("pagination-record", paginationRecord);
Vue.component("show-error", showError);
Vue.component("module-info", moduleInfo);

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
window.axios.defaults.headers.common["Authorization"] =
  "Bearer " + localStorage.getItem("auth_token");

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
  window.axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
} else {
  console.error(
    "CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token"
  );
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });
