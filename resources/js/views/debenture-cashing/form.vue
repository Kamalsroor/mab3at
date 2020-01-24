<template>
  <!-- branch_id
  user_id
  customer_id
  note
  img
  type
  amount
  date_at-->
  <form @submit.prevent="proceed" @keydown="generalForm.errors.clear($event.target.name)">
    <div class="row">
      <div class="col-12 col-sm-6">
        <div class="form-group">
          <label for>{{trans('debenture_cashing.selected_branch')}}</label>
          <v-select
            label="name"
            v-model="selected_branch"
            name="branch_id"
            id="branch_id"
            :options="branches"
            :placeholder="trans('debenture_cashing.selected_branch')"
            @select="generalForm.errors.clear('branch_id')"
            @close="generalForm.branch_id = selected_branch.id"
            @remove="generalForm.branch_id = ''"
          ></v-select>
          <show-error :form-name="generalForm" prop-name="branch_id"></show-error>
        </div>
      </div>
      <div class="col-12 col-sm-6">
        <div class="form-group">
          <label for>{{trans('debenture_cashing.selected_customer')}}</label>
          <v-select
            label="name"
            v-model="selected_customer"
            name="customer_id"
            id="customer_id"
            :options="customers"
            :placeholder="trans('debenture_cashing.selected_customer')"
            @select="generalForm.errors.clear('customer_id')"
            @close="getCustomerAccount"
            @remove="generalForm.customer_id = ''"
          ></v-select>
          <show-error :form-name="generalForm" prop-name="customer_id"></show-error>
        </div>
      </div>
      <div class="col-12 col-sm-4">
        <div class="form-group">
          <label for>{{trans('debenture_cashing.amount')}}</label>
          <input
            class="form-control"
            type="number"
            v-model="generalForm.amount"
            :keyup="new_customer_account = parseInt(customer_account) +  parseInt(generalForm.amount)"
            name="amount"
            :placeholder="trans('product.amount')"
          />
          <show-error :form-name="generalForm" prop-name="amount"></show-error>
        </div>
      </div>
      <div class="col-12 col-sm-4">
        <div class="form-group">
          <label for>{{trans('debenture_cashing.customer_account')}}</label>
          <input
            class="form-control"
            type="number"
            disabled
            v-model="customer_account"
            name="customer_account"
            :placeholder="trans('product.customer_account')"
          />
          <show-error :form-name="generalForm" prop-name="customer_account"></show-error>
        </div>
      </div>
      <div class="col-12 col-sm-4">
        <div class="form-group">
          <label for>{{trans('debenture_cashing.new_customer_account')}}</label>
          <input
            class="form-control"
            type="number"
            disabled
            v-model="new_customer_account"
            name="new_customer_account"
            :placeholder="trans('product.new_customer_account')"
          />
          <show-error :form-name="generalForm" prop-name="new_customer_account"></show-error>
        </div>
      </div>
      <div class="col-12 col-sm-6">
        <div class="form-group">
          <label for>{{trans('debenture_cashing.date_at')}}</label>
          <datepicker
            v-model="generalForm.date_at"
            :bootstrapStyling="true"
            name="date_at"
            @selected="generalForm.errors.clear('date_at')"
          ></datepicker>
          <show-error :form-name="generalForm" prop-name="date_at"></show-error>
        </div>
      </div>
      <div class="col-12 col-sm-12">
        <div class="form-group">
          <label for>{{trans('debenture_cashing.note')}}</label>
          <autosize-textarea
            row="1"
            class="form-control"
            v-model="generalForm.note"
            :placeholder="trans('configuration.maintenance_mode_message')"
            rows="3"
            name="maintenance_mode_message"
          ></autosize-textarea>

          <show-error :form-name="generalForm" prop-name="note"></show-error>
        </div>
      </div>
    </div>
    <button type="submit" class="btn btn-info waves-effect waves-light pull-right">
      <span v-if="id">{{trans('general.update')}}</span>
      <span v-else>{{trans('general.save')}}</span>
    </button>
    <router-link
      to="/debenture_cashing"
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
import switches from "vue-switches";
export default {
  components: { datepicker, autosizeTextarea, vSelect, switches },
  data() {
    return {
      generalForm: new Form({
        branch_id: null,
        customer_id: null,
        date_at: null,
        note: null,
        amount: 0
      }),

      branches: [],
      selected_branch: {
        id: null,
        name: null
      },

      customer_account: 0,
      customers: [],
      selected_customer: {
        id: null,
        name: null
      },
      new_customer_account: 0
    };
  },

  props: ["id"],
  mounted() {
    this.generalForm.date_at = new Date();
    // console.log(Date(Date.now()));
    if (this.id) this.get();
    axios
      .get("/api/debenture_cashing/pre-requisite")
      .then(response => response.data)
      .then(response => {
        this.branches = response.branch;

        this.customers = response.customer;

        // this.types = response.type;
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
      this.generalForm.date_at = moment(this.generalForm.date_at).format(
        "YYYY-MM-DD"
      );
      this.generalForm
        .post("/api/debenture_cashing")
        .then(response => {
          toastr.success(response.message);
          this.customer_account = 0;
          this.new_customer_account = 0;
          //  new_customer_account: 0
          this.generalForm.date_at = new Date();

          this.$emit("completed");

          this.selected_branch = {
            id: null,
            name: null
          };
          this.selected_customer = {
            id: null,
            name: null
          };
        })
        .catch(error => {
          helper.showErrorMsg(error);
        });
    },

    getCustomerAccount() {
      this.generalForm.customer_id = this.selected_customer.id;
      axios
        .get(
          "/api/customer/" +
            this.selected_customer.id +
            "/account/" +
            this.generalForm.amount
        )
        .then(response => response.data)
        .then(response => {
          // this.customer_account = response.customerAccount;
          this.customer_account =
            response.customerAccount > 0
              ? -response.customerAccount
              : +response.customerAccount;
        })
        .catch(error => {
          helper.showDataErrorMsg(error);
          this.$router.push("/debenture_cashing");
        });
    },
    get() {
      axios
        .get("/api/debenture_cashing/" + this.id)
        .then(response => response.data)
        .then(response => {
          this.generalForm.branch_id = response.branch_id;
          this.generalForm.customer_id = response.customer_id;
          this.generalForm.date_at = response.date_at;
          this.generalForm.note = response.note;
          this.generalForm.amount = response.amount;
          this.generalForm.customer_id = response.customer_id;
          this.generalForm.branch_id = response.branch_id;
          this.selected_branch.id = response.branch.id;
          this.selected_branch.name = response.branch.name;
          this.selected_customer.id = response.customer.id;
          this.selected_customer.name = response.customer.name;
          this.getCustomerAccount();
        })
        .catch(error => {
          helper.showDataErrorMsg(error);
          this.$router.push("/debenture_cashing");
        });
    },
    update() {
      this.generalForm
        .patch("/api/debenture_cashing/" + this.id)
        .then(response => {
          toastr.success(response.message);
          this.$router.push("/debenture_cashing");
        })
        .catch(error => {
          helper.showErrorMsg(error);
        });
    }
  }
};
</script>
