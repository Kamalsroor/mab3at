<template>
  <section id="wrapper">
    <div class="login-register" style="background-image:url(/images/background.jpg);">
      <div class="login-box card">
        <div class="card-body p-4">
          <form
            class="form-horizontal form-material"
            id="loginform"
            @submit.prevent="submit"
            @keydown="loginForm.errors.clear($event.target.name)"
          >
            <h3 class="box-title m-b-20">{{trans('auth.login')}}</h3>
            <div class="form-group">
              <input
                type="text"
                name="email"
                class="form-control"
                :placeholder="trans('auth.email')"
                v-model="loginForm.email"
              />
              <show-error :form-name="loginForm" prop-name="email"></show-error>
            </div>
            <div class="form-group">
              <input
                type="password"
                name="password"
                class="form-control"
                :placeholder="trans('auth.password')"
                v-model="loginForm.password"
              />
              <show-error :form-name="loginForm" prop-name="password"></show-error>
            </div>
            <div
              class="g-recaptcha"
              v-if="getConfig('recaptcha') && getConfig('login_recaptcha')"
              :data-sitekey="getConfig('recaptcha_key')"
            ></div>
            <div class="form-group text-center m-t-20">
              <button
                class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light"
                :disabled="submit_disabled"
                type="submit"
              >{{trans('auth.sign_in')}}</button>
            </div>
            <div class="form-group m-b-0">
              <div class="col-sm-12 text-center">
                <p v-if="getConfig('reset_password')">
                  {{trans('auth.forgot_your_password?')}}
                  <router-link to="/password" class="text-info m-l-5">
                    <b>{{trans('auth.reset_here!')}}</b>
                  </router-link>
                </p>
                <p v-if="getConfig('registration')">
                  {{trans('auth.create_account?')}}
                  <router-link to="/register" class="text-info m-l-5">
                    <b>{{trans('auth.sign_up')}}</b>
                  </router-link>
                </p>
              </div>
            </div>

            <div class="col-6 text-center">
              <button
                type="button"
                class="btn bt-block btn-info"
                @click="loginAsAdmin"
              >Login as Admin</button>
            </div>
            <div class="col-6 text-center">
              <button
                type="button"
                class="btn bt-block btn-success"
                @click="loginAsUser"
              >Login as User</button>
            </div>
            <div class="row m-t-10" v-if="!getConfig('mode')"></div>
          </form>
        </div>
        <guest-footer></guest-footer>
      </div>
    </div>
  </section>
</template>

<script>
import guestFooter from "../../layouts/guest-footer.vue";

export default {
  data() {
    return {
      loginForm: new Form({
        email: "",
        password: ""
      }),
      social_login_providers: [],
      submit_disabled: false
    };
  },
  components: {
    guestFooter
  },
  mounted() {
    if (helper.getConfig("social_login"))
      axios
        .get("/api/configuration/variable?type=social_login")
        .then(response => response.data)
        .then(response => {
          this.social_login_providers = response.social_login_providers;
        })
        .catch(error => {
          helper.showDataErrorMsg(error);
        });
  },
  methods: {
    submit() {
      this.submit_disabled = true;
      this.loginForm
        .post("/api/auth/login")
        .then(response => {
          localStorage.setItem("auth_token", response.token);
          axios.defaults.headers.common["Authorization"] =
            "Bearer " + localStorage.getItem("auth_token");
          this.$store.dispatch("setAuthStatus");
          this.$store.dispatch("setLastActivity");
          toastr.success(response.message);
          this.submit_disabled = false;

          if (
            helper.getConfig("two_factor_security") &&
            response.two_factor_code
          ) {
            this.$store.dispatch("setTwoFactorCode", response.two_factor_code);
            this.$router.push("/auth/security");
          } else {
            var redirect_path = response.reload ? "/home?reload=1" : "/home";
            this.$store.dispatch("resetTwoFactorCode");
            this.$router.push(redirect_path);
          }
        })
        .catch(error => {
          this.submit_disabled = false;

          helper.showErrorMsg(error);
        });
    },
    loginAsAdmin() {
      this.loginForm.email = "john.doe@example.com";
      this.loginForm.password = "password";
      this.submit();
    },
    loginAsUser() {
      this.loginForm.email = "marry.jen@example.com";
      this.loginForm.password = "password";
      this.submit();
    },
    getConfig(config) {
      return helper.getConfig(config);
    }
  }
};
</script>
