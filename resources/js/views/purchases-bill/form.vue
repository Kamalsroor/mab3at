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
          <label for>{{ trans("debenture_cashing.selected_branch") }}</label>
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
          <label for>{{ trans("debenture_cashing.selected_customer") }}</label>
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

      <div class="col-12 col-sm-6">
        <div class="form-group">
          <label for>{{ trans("debenture_cashing.selected_product") }}</label>
          <v-select
            label="name"
            v-model="selected_product"
            name="serialNumber"
            id="serialNumber"
            :options="products"
            :placeholder="trans('debenture_cashing.selected_product')"
            @select="generalForm.errors.clear('serialNumber')"
            @close="getCustomerAccount"
            @remove="generalForm.serialNumber = ''"
          ></v-select>
          <show-error :form-name="generalForm" prop-name="serialNumber"></show-error>
        </div>
      </div>
      <div class="col-12 col-sm-3">
        <div class="form-group">
          <label for>{{ trans("debenture_cashing.price") }}</label>
          <input
            class="form-control"
            type="number"
            value
            @blur="prodactWithPrice"
            v-model="price"
            name="price"
            :placeholder="trans('debenture_cashing.price')"
          />
          <show-error :form-name="generalForm" prop-name="price"></show-error>
        </div>
      </div>

      <div class="col-12 col-sm-3">
        <div class="form-group">
          <label for>{{ trans("debenture_cashing.quantity") }}</label>
          <input
            class="form-control"
            type="number"
            @blur="pushToTable"
            value
            v-model="quantity"
            name="quantity"
            :placeholder="trans('debenture_cashing.quantity')"
          />
          <show-error :form-name="generalForm" prop-name="quantity"></show-error>
        </div>
      </div>

      <table class="table">
        <thead>
          <tr>
            <th>الصنف</th>
            <th>السعر</th>
            <th>الكمية</th>
            <th>المجموع</th>
            <th>السريلات</th>
            <th>حذف</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(product, index) in generalForm.products" :key="index">
            <td>{{ product.name }}</td>
            <td>{{ product.price }}</td>
            <td>{{ product.quantity }}</td>
            <td>{{ product.quantity * product.price }}</td>
            <td>
              <b-button v-b-modal="product.name" variant="success">Serials</b-button>
              <!-- @click="addSerials(index)" -->
              <b-modal :id="product.name" :title="product.name">
                <div class="row">
                  <div class="col-12 col-sm-12">
                    <h5>{{product.serial.length}} عدد السريالات</h5>
                  </div>
                  <div class="col-12 col-sm-12">
                    <h5>{{product.quantity - product.serial.length}} المتبقي</h5>
                  </div>
                  <div
                    v-if="product.quantity - product.serial.length == 0"
                    class="col-12 col-sm-12"
                  >
                    <h5>تم تجميع السريال بنجاح</h5>
                  </div>
                  <div class="col-12 col-sm-8">
                    <div class="form-group">
                      <label for>السريال</label>
                      <input
                        :disabled="product.quantity - product.serial.length == 0 || submitted"
                        class="form-control"
                        type="text"
                        value
                        :id="'serial-'+index"
                        v-model="serial"
                        ref="title"
                        @keyup.enter="addSerials(index, serial)"
                        name="serial"
                        :placeholder="'السريال'"
                      />
                      <show-error :form-name="generalForm" prop-name="name"></show-error>
                    </div>
                  </div>
                  <hr />

                  <table class="table">
                    <thead>
                      <tr>
                        <th>السريال</th>
                        <th>حذف</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(product, product_index) in product.serial" :key="product_index">
                        <td>{{ product }}</td>
                        <td>
                          <b-button
                            @click="removeProductRow(index , product_index)"
                            variant="danger"
                          >حذف</b-button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </b-modal>
            </td>
            <td>
              <b-button @click="removeRow(index)" variant="danger">حذف</b-button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <button type="submit" class="btn btn-info waves-effect waves-light pull-right">
      <span v-if="id">{{ trans("general.update") }}</span>
      <span v-else>{{ trans("general.save") }}</span>
    </button>
    <router-link
      to="/purchases_bill"
      class="btn btn-danger waves-effect waves-light pull-right m-r-10"
      v-show="id"
    >{{ trans("general.cancel") }}</router-link>
    <button
      v-if="!id"
      type="button"
      class="btn btn-danger waves-effect waves-light pull-right m-r-10"
      @click="$emit('cancel')"
    >{{ trans("general.cancel") }}</button>
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
        amount: 0,
        products: []
      }),

      branches: [],
      selected_branch: {
        id: null,
        name: null
      },
      not_id: null,
      customer_account: 0,
      customers: [],
      selected_customer: {
        id: null,
        name: null
      },
      new_customer_account: 0,
      submitted: false,

      serial: null,
      price: 0,
      quantity: null,
      selected_product: {
        id: null,
        name: null
      },
      products: []
    };
  },

  props: ["id"],
  mounted() {
    this.generalForm.date_at = new Date();
    // console.log(Date(Date.now()));
    if (this.id) this.get();
    axios
      .get("/api/purchases_bill/pre-requisite")
      .then(response => response.data)
      .then(response => {
        this.branches = response.branch;
        this.customers = response.customer;
        this.products = response.product;

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
        .post("/api/purchases_bill")
        .then(response => {
          toastr.success(response.message);
          //  new_customer_account: 0
          this.$emit("completed");
          this.customer_account = 0;
          this.new_customer_account = 0;
          this.generalForm.amount = 0;
          this.generalForm.products = [];
          this.generalForm.date_at = new Date();
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

    prodactWithPrice() {
      axios
        .get("/api/product/" + this.selected_product.id + "/" + this.price)
        .then(response => response.data)
        .then(response => {
          if (response == "max_price" || response == "min_price") {
            helper.showDataErrorMsg(response);
          }
          // this.products = response;
        })
        .catch(error => {
          helper.showDataErrorMsg(error);
          helper.showErrorMsg(error);

          this.$router.push("/purchases_bill");
        });
      // console.log("test");
    },
    removeRow(index) {
      console.log("Removing", index);
      this.generalForm.products.splice(index, 1);
    },
    removeProductRow(index, product_index) {
      console.log("Removing", index);
      this.generalForm.products[index].serial.splice(product_index, 1);
    },
    addSerials(index, value) {
      this.submitted = true;

      console.log(
        "add",
        index,
        value,
        this.generalForm.products[index],
        this.generalForm.products[index].serials
      );
      this.serial = null;
      if (
        value != "" &&
        value != null &&
        value != " " &&
        this.generalForm.products[index].quantity -
          this.generalForm.products[index].serials.length !=
          0
      ) {
        axios
          .get("/api/product/" + value + "/sriral/PurchasesBill")
          .then(response => response.data)
          .then(response => {
            this.generalForm.products[index].serial.push(value);
            this.submitted = false;
            this.$nextTick(function() {
              var input = document.getElementById("serial-" + index);
              window.setTimeout(function() {
                input.focus();
              }, 200);
            });
          })
          .catch(error => {
            helper.showDataErrorMsg(error);
            this.submitted = false;
            helper.showErrorMsg(error);
            this.$nextTick(function() {
              var input = document.getElementById("serial-" + index);
              window.setTimeout(function() {
                input.focus();
              }, 200);
            });
            this.$router.push("/purchases_bill");
          });
      }

      // this.$set(this.generalForm.products[index].serials, "serials", value);
    },

    pushToTable() {
      if (parseInt(this.quantity) > 0) {
        axios
          .get("/api/product/" + this.selected_product.id + "/" + this.price)
          .then(response => response.data)
          .then(response => {
            if (response == "max_price" || response == "min_price") {
              helper.showDataErrorMsg(response);
            } else {
              console.log("done");
              let filtered = this.generalForm.products.filter(
                m => m.id === this.selected_product.id
              );
              console.log(filtered.length, "test");
              if (filtered.length < 1) {
                this.generalForm.products.push({
                  id: this.selected_product.id,
                  name: this.selected_product.name,
                  price: this.price,
                  quantity: this.quantity,
                  serials: [],
                  serial: []
                });

                this.price = 0;
                this.quantity = null;
                this.selected_product = {
                  id: null,
                  name: null
                };
              }
            }

            // this.products = response;
          })
          .catch(error => {
            helper.showDataErrorMsg(error);
            helper.showErrorMsg(error);

            this.$router.push("/purchases_bill");
          });
      }
      console.log(parseInt(this.quantity));
      // axios
      //   .get("/api/product/" + this.selected_product.id + "/" + this.price)
      //   .then(response => response.data)
      //   .then(response => {
      //     if (response == "max_price") {
      //       console.log("max_price");
      //       helper.showDataErrorMsg(response);
      //     }
      //     // this.products = response;
      //   })
      //   .catch(error => {
      //     helper.showDataErrorMsg(error);
      //     this.$router.push("/purchases_bill");
      //   });
    },
    getCustomerAccount() {
      this.generalForm.customer_id = this.selected_customer.id;
      if (this.generalForm.amount == null || this.generalForm.amount == "")
        this.generalForm.amount = 0;
      if (this.id) this.not_id = this.id;
      else this.not_id = 0;
      axios
        .get(
          "/api/customer/" +
            this.selected_customer.id +
            "/account/-" +
            this.generalForm.amount +
            "/" +
            this.not_id
        )
        .then(response => response.data)
        .then(response => {
          this.customer_account = response.customerAccount;
        })
        .catch(error => {
          helper.showDataErrorMsg(error);
          this.$router.push("/purchases_bill");
        });
    },
    get() {
      axios
        .get("/api/purchases_bill/" + this.id)
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
          this.$router.push("/purchases_bill");
        });
    },
    update() {
      this.generalForm
        .patch("/api/purchases_bill/" + this.id)
        .then(response => {
          toastr.success(response.message);
          this.$router.push("/purchases_bill");
        })
        .catch(error => {
          helper.showErrorMsg(error);
        });
    }
  }
};
</script>
