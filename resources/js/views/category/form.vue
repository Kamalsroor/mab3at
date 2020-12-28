<template>
  <form
    @submit.prevent="proceed"
    @keydown="generalForm.errors.clear($event.target.name)"
  >
    <div class="row">
      <div class="col-12 col-sm-4">
        <div class="form-group">
          <label for>{{ trans("category.name") }}</label>
          <input
            class="form-control"
            type="text"
            value
            v-model="generalForm.name"
            name="name"
            :placeholder="trans('category.name')"
          />
          <show-error :form-name="generalForm" prop-name="name"></show-error>
        </div>
      </div>
      <div class="col-12 col-sm-6">
        <div class="form-group">
          <label for>{{ trans("category.is_serial") }}</label>
          <br />
          <switches
            class="m-l-20"
            v-model="generalForm.is_serial"
            theme="bulma"
            color="blue"
          ></switches>
        </div>
      </div>
    </div>
    <button
      type="submit"
      class="btn btn-info waves-effect waves-light pull-right"
    >
      <span v-if="id">{{ trans("general.update") }}</span>
      <span v-else>{{ trans("general.save") }}</span>
    </button>
    <router-link
      to="/category"
      class="btn btn-danger waves-effect waves-light pull-right m-r-10"
      v-show="id"
      >{{ trans("general.cancel") }}</router-link
    >
    <button
      v-if="!id"
      type="button"
      class="btn btn-danger waves-effect waves-light pull-right m-r-10"
      @click="$emit('cancel')"
    >
      {{ trans("general.cancel") }}
    </button>
  </form>
</template>

<script>
import datepicker from "vuejs-datepicker";
import autosizeTextarea from "../../components/autosize-textarea";
import vSelect from "vue-multiselect";
import switches from "vue-switches";

export default {
  components: { datepicker, autosizeTextarea, vSelect, switches },
  data() {
    return {
      generalForm: new Form({
        name: "",
        is_serial: 0,
      }),
    };
  },
  props: ["id"],
  mounted() {
    if (this.id) this.get();
    axios
      .get("/api/category/pre-requisite")
      .then((response) => response.data)
      .then((response) => {
        this.users = response.user;
        this.types = response.type;
      })
      .catch((error) => {
        helper.showDataErrorMsg(error);
      });
  },
  methods: {
    proceed() {
      if (this.id) this.update();
      else this.store();
    },
    store() {
      this.generalForm
        .post("/api/category")
        .then((response) => {
          toastr.success(response.message);
          this.generalForm.is_serial = 0;
          this.$emit("completed");
        })
        .catch((error) => {
          helper.showErrorMsg(error);
        });
    },
    get() {
      axios
        .get("/api/category/" + this.id)
        .then((response) => response.data)
        .then((response) => {
          this.generalForm.name = response.name;
          this.generalForm.is_serial = response.is_serial;
        })
        .catch((error) => {
          helper.showDataErrorMsg(error);
          this.$router.push("/category");
        });
    },
    update() {
      this.generalForm
        .patch("/api/category/" + this.id)
        .then((response) => {
          toastr.success(response.message);
          this.$router.push("/category");
        })
        .catch((error) => {
          helper.showErrorMsg(error);
        });
    },
  },
};
</script>
