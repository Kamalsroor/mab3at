<template>
  <div>
    <div class="row page-titles">
      <div class="col-sm-6 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">المخزون</h3>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <router-link to="/home">Home</router-link>
          </li>
          <li class="breadcrumb-item active" v-text="customers.data[0].name"></li>
        </ol>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="card-body">
              <h2 v-if="dataSort.length">كشف حساب</h2>
              <h3 v-if="dataSort.length">العميل : {{customers.data[0].name}}</h3>
              <div class="row">
                <div class="col-12 col-md-5">
                  <div class="form-group">
                    <label for>من تاريخ</label>
                    <datepicker v-model="date.from" :bootstrapStyling="true" name="from"></datepicker>
                  </div>
                </div>
                <div class="col-12 col-md-5">
                  <div class="form-group">
                    <label for>الي تاريخ</label>
                    <datepicker v-model="date.to" :bootstrapStyling="true" name="to"></datepicker>
                  </div>
                </div>
                <div class="col-12 col-md-2">
                  <div class="form-group">
                    <button
                      type="button"
                      @click="getBranches()"
                      class="btn btn-info waves-effect waves-light pull-right"
                    >Chick</button>
                  </div>
                </div>
              </div>

              <div class="table-responsive" v-if="dataSort.length">
                <table class="table table-hover table-bordered">
                  <thead>
                    <tr>
                      <th>{{trans('debenture_cashing.username')}}</th>
                      <th>{{trans('debenture_cashing.branch_name')}}</th>
                      <th>ما قبله</th>
                      <th>مدين</th>
                      <th>داين</th>
                      <th>رصيد باقي</th>
                      <th>بيان</th>
                      <th>{{trans('debenture_cashing.date_at')}}</th>
                      <th>رقم البيان</th>
                    </tr>
                  </thead>
                  <tbody>
                    <template v-for="(dataSortSingle, index) in dataSort">
                      <tr>
                        <td
                          v-text="dataSortSingle.user.profile.first_name+' '+dataSortSingle.user.profile.last_name"
                        ></td>
                        <td
                          v-if="dataSortSingle.type != 'AccountAdjustment'"
                          v-text="dataSortSingle.branch.name"
                        ></td>
                        <td v-else>----</td>
                        <!-- <td v-if="index == 0">{{last = 0}}</td>
                        <td v-else v-text="last"></td>-->
                        <template v-if="dataSortSingle.type == 'DebentureCashings'">
                          <td
                            v-text="parseInt(dataSortSingle.last) + parseInt(dataSortSingle.amount)"
                          ></td>
                          <td></td>
                          <td v-text="dataSortSingle.amount"></td>
                          <!-- <td>{{last = parseInt(last) - parseInt(dataSortSingle.amount) }}</td> -->
                        </template>
                        <template v-else-if="dataSortSingle.type == 'DebentureDeposits'">
                          <td
                            v-text="parseInt(dataSortSingle.last) - parseInt(dataSortSingle.amount)"
                          ></td>
                          <td v-text="-dataSortSingle.amount"></td>
                          <td></td>
                          <!-- <td>{{last = parseInt(last) + parseInt(dataSortSingle.amount) }}</td> -->
                        </template>
                        <template v-else-if="dataSortSingle.type == 'PurchasesBill'">
                          <td
                            v-text="parseInt(dataSortSingle.last) - parseInt(dataSortSingle.amount)"
                          ></td>
                          <td v-text="dataSortSingle.amount"></td>
                          <td></td>
                          <!-- <td>{{last = parseInt(last) + parseInt(dataSortSingle.amount) }}</td> -->
                        </template>
                        <template v-else-if="dataSortSingle.type == 'SalesBill'">
                          <td
                            v-text="parseInt(dataSortSingle.last) + parseInt(dataSortSingle.amount)"
                          ></td>
                          <td></td>
                          <td v-text="-dataSortSingle.amount"></td>
                          <!-- <td>{{last = parseInt(last) - parseInt(dataSortSingle.amount) }}</td> -->
                        </template>
                        <template v-else-if="dataSortSingle.type == 'AccountAdjustment'">
                          <td
                            v-text="parseInt(dataSortSingle.last) + parseInt(dataSortSingle.amount)"
                          ></td>
                          <td v-if="dataSortSingle.amount > 0" v-text="dataSortSingle.amount"></td>
                          <td></td>
                          <td v-if="dataSortSingle.amount < 0" v-text="dataSortSingle.amount"></td>
                          <!-- <td>{{last = parseInt(last) + parseInt(dataSortSingle.amount) }}</td> -->
                        </template>
                        <td v-text="dataSortSingle.last"></td>

                        <td v-if="dataSortSingle.type == 'AccountAdjustment'">تسويه حساب</td>
                        <td v-else-if="dataSortSingle.type == 'DebentureCashings'">سند صرف</td>
                        <td v-else-if="dataSortSingle.type == 'DebentureDeposits'">سند ايداع</td>
                        <td v-else-if="dataSortSingle.type == 'PurchasesBill'">فاتوره مشتريات</td>
                        <td v-else-if="dataSortSingle.type == 'SalesBill'">فاتورة مبيعات</td>
                        <td v-text="dataSortSingle.created_at"></td>
                        <td v-text="dataSortSingle.id"></td>
                      </tr>
                      <template v-if="dataSortSingle.type == 'PurchasesBill'">
                        <tr class="table-primary">
                          <th colspan="3">الصنف</th>
                          <th colspan="2">السعر</th>
                          <th colspan="2">العدد</th>
                          <th colspan="2">الاجمالي</th>
                        </tr>
                      </template>
                      <template v-if="dataSortSingle.type == 'PurchasesBill'">
                        <tr
                          class="table-secondary"
                          v-for="(purchases_bill_details, index) in dataSortSingle.purchases_bill_details"
                          :key="index"
                        >
                          <td colspan="3" v-text="purchases_bill_details.product.name"></td>
                          <td colspan="2" v-text="purchases_bill_details.amount"></td>
                          <td
                            colspan="2"
                            v-text="purchases_bill_details.purchases_bill_detail_srials.length"
                          ></td>
                          <td
                            colspan="2"
                            v-text="purchases_bill_details.amount * purchases_bill_details.purchases_bill_detail_srials.length"
                          ></td>
                        </tr>
                      </template>
                      <template v-if="dataSortSingle.type == 'PurchasesBill'">
                        <tr class="table-info">
                          <th colspan="7">الاجمالي</th>
                          <th colspan="2">{{parseInt(dataSortSingle.amount)}}</th>
                        </tr>
                      </template>

                      <template v-if="dataSortSingle.type == 'SalesBill'">
                        <tr class="table-primary">
                          <th colspan="3">الصنف</th>
                          <th colspan="2">السعر</th>
                          <th colspan="2">العدد</th>
                          <th colspan="2">الاجمالي</th>
                        </tr>
                      </template>
                      <template v-if="dataSortSingle.type == 'SalesBill'">
                        <tr
                          class="table-secondary"
                          v-for="(sales_bill_details, index) in dataSortSingle.sales_bill_details"
                          :key="index"
                        >
                          <td colspan="3" v-text="sales_bill_details.product.name"></td>
                          <td colspan="2" v-text="sales_bill_details.amount"></td>
                          <td
                            colspan="2"
                            v-text="sales_bill_details.sales_bill_detail_srials.length"
                          ></td>
                          <td
                            colspan="2"
                            v-text="sales_bill_details.amount * sales_bill_details.sales_bill_detail_srials.length"
                          ></td>
                        </tr>
                      </template>
                      <template v-if="dataSortSingle.type == 'SalesBill'">
                        <tr class="table-info">
                          <th colspan="7">الاجمالي</th>
                          <th colspan="2">{{parseInt(dataSortSingle.amount)}}</th>
                        </tr>
                      </template>
                    </template>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import datepicker from "vuejs-datepicker";
export default {
  components: { datepicker },
  methods: {},
  data() {
    return {
      id: this.$route.params.id,

      customers: {
        total: 0,
        data: []
      },
      dataSort: [],
      last: 0,
      date: { from: null, to: null },
      filterTodoForm: {
        keyword: "",
        status: false,
        start_date: "",
        end_date: "",
        sort_by: "created_at",
        order: "desc",
        page_length: helper.getConfig("page_length")
      },
      orderByOptions: [],
      showCreatePanel: false,
      showFilterPanel: false
    };
  },
  mounted() {
    this.getBranches();
  },

  methods: {
    getBranches(page) {
      if (typeof page !== "number") {
        page = 1;
      }
      this.date.from = moment(this.date.from).format("YYYY-MM-DD");
      this.date.to = moment(this.date.to).format("YYYY-MM-DD");
      let url = helper.getFilterURL(this.date);
      console.log(url);
      axios
        .get("/api/customers/statement/" + this.id + "?page=0" + url)
        .then(response => response.data)
        .then(response => {
          this.customers.data = response;
          this.dataSort = [];
          var list = [];
          console.log(response);
          console.log(response[0].DebentureCashings.length);
          console.log(response[0].DebentureDeposits.length);

          if (response[0].DebentureCashings.length > 0) {
            response[0].DebentureCashings.map(function(value, key) {
              list.push(value);
            });
          }
          if (response[0].DebentureDeposits.length > 0) {
            response[0].DebentureDeposits.map(function(value, key) {
              list.push(value);
            });
          }
          if (response[0].PurchasesBill.length > 0) {
            response[0].PurchasesBill.map(function(value, key) {
              list.push(value);
            });
          }
          if (response[0].SalesBill.length > 0) {
            response[0].SalesBill.map(function(value, key) {
              list.push(value);
            });
          }
          if (response[0].AccountAdjustment.length > 0) {
            response[0].AccountAdjustment.map(function(value, key) {
              list.push(value);
            });
          }

          this.dataSort = list;
          let dataSort = this.dataSort;
          dataSort = this.dataSort.sort(
            (prev, curr) =>
              Date.parse(prev.created_at) - Date.parse(curr.created_at)
          );
          this.dataSort = dataSort;
          var last = 0;

          let testdsg = [];
          $.each(this.dataSort, function(key, value) {
            if (
              value.type == "DebentureCashings" ||
              value.type == "SalesBill"
            ) {
              value.last = last - parseInt(value.amount);
              console.log(parseInt(value.amount), last);
              last = last - parseInt(value.amount);
            } else if (
              value.type == "DebentureDeposits" ||
              value.type == "PurchasesBill" ||
              value.type == "AccountAdjustment"
            ) {
              value.last = last + parseInt(value.amount);
              console.log(parseInt(value.amount), last);
              last = last + parseInt(value.amount);
            }
            testdsg.push(value);
          });
          console.log(testdsg);
        })
        .catch(error => {
          helper.showDataErrorMsg(error);
        });
    },
    showStatement(branch) {
      this.$router.push("/customer/" + branch.id + "/statement");
    }
  }
};
</script>
