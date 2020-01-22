<template>
  <form @submit.prevent="proceed" @keydown="generalForm.errors.clear($event.target.name)">
    <div class="row">
      <div class="col-12 col-sm-4">
        <div class="form-group">
          <label for>{{trans('group.name')}}</label>
          <input
            class="form-control"
            type="text"
            value
            v-model="generalForm.name"
            name="name"
            :placeholder="trans('group.name')"
          />
          <show-error :form-name="generalForm" prop-name="name"></show-error>
        </div>
      </div>
    </div>
    <button type="submit" class="btn btn-info waves-effect waves-light pull-right">
      <span v-if="id">{{trans('general.update')}}</span>
      <span v-else>{{trans('general.save')}}</span>
    </button>
    <router-link
      to="/group"
      class="btn btn-danger waves-effect waves-light pull-right m-r-10"
      v-show="id"
    >{{trans('general.cancel')}}</router-link>
    <button
      v-if="!id"
      type="button"
      class="btn btn-danger waves-effect waves-light pull-right m-r-10"
      @click="$emit('cancel')"
    >{{trans('general.cancel')}}</button>
  </form>
</template>


<script>
import datepicker from "vuejs-datepicker";
import autosizeTextarea from "../../components/autosize-textarea";
import vSelect from "vue-multiselect";

export default {
  components: { datepicker, autosizeTextarea, vSelect },
  data() {
    return {
      generalForm: new Form({
        name: ""
      })
    };
  },
  props: ["id"],
  mounted() {
    if (this.id) this.get();
    axios
      .get("/api/group/pre-requisite")
      .then(response => response.data)
      .then(response => {
        this.users = response.user;
        this.types = response.type;
      })
      .catch(error => {
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
        .post("/api/group")
        .then(response => {
          toastr.success(response.message);
          this.$emit("completed");
        })
        .catch(error => {
          helper.showErrorMsg(error);
        });
    },
    get() {
      axios
        .get("/api/group/" + this.id)
        .then(response => response.data)
        .then(response => {
          this.generalForm.name = response.name;
        })
        .catch(error => {
          helper.showDataErrorMsg(error);
          this.$router.push("/group");
        });
    },
    update() {
      this.generalForm
        .patch("/api/group/" + this.id)
        .then(response => {
          toastr.success(response.message);
          this.$router.push("/group");
        })
        .catch(error => {
          helper.showErrorMsg(error);
        });
    }
  }
};
</script>
