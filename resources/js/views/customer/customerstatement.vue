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
              <h2 v-if="customers.data[0].DebentureCashings.length">سند صرف نقدية</h2>
              <div class="table-responsive" v-if="customers.data[0].DebentureCashings.length">
                <table class="table">
                  <thead>
                    <tr>
                      <th>{{trans('debenture_cashing.username')}}</th>
                      <th>{{trans('debenture_cashing.branch_name')}}</th>
                      <th>{{trans('debenture_cashing.amount')}}</th>
                      <th>{{trans('debenture_cashing.date_at')}}</th>

                      <th>ملاحظات</th>
                      <th>اضافة في</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="(debenture_cashing, index) in customers.data[0].DebentureCashings"
                      :key="index"
                    >
                      <td
                        v-text="debenture_cashing.user.profile.first_name+' '+debenture_cashing.user.profile.last_name"
                      ></td>
                      <td v-text="debenture_cashing.branch.name"></td>
                      <td v-text="debenture_cashing.amount"></td>
                      <td v-text="debenture_cashing.date_at"></td>
                      <td v-text="debenture_cashing.note"></td>

                      <td v-text="debenture_cashing.created_at"></td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <h2 v-if="customers.data[0].DebentureDeposits.length">سند ايداع نقدية</h2>
              <div class="table-responsive" v-if="customers.data[0].DebentureDeposits.length">
                <table class="table">
                  <thead>
                    <tr>
                      <th>{{trans('debenture_cashing.username')}}</th>
                      <th>{{trans('debenture_cashing.branch_name')}}</th>
                      <th>{{trans('debenture_cashing.amount')}}</th>
                      <th>{{trans('debenture_cashing.date_at')}}</th>
                      <th>ملاحظات</th>
                      <th>اضافة في</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="(debenture_cashing, index) in customers.data[0].DebentureDeposits"
                      :key="index"
                    >
                      <td
                        v-text="debenture_cashing.user.profile.first_name+' '+debenture_cashing.user.profile.last_name"
                      ></td>
                      <td v-text="debenture_cashing.branch.name"></td>
                      <td v-text="debenture_cashing.amount"></td>
                      <td v-text="debenture_cashing.date_at"></td>
                      <td v-text="debenture_cashing.note"></td>

                      <td v-text="debenture_cashing.created_at"></td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <hr />
              <h2 v-if="customers.data[0].PurchasesBill.length">فواتير مشتريات</h2>

              <div class="table-responsive" v-if="customers.data[0].PurchasesBill.length">
                <table class="table">
                  <thead>
                    <tr>
                      <th>{{trans('debenture_cashing.username')}}</th>
                      <th>{{trans('debenture_cashing.branch_name')}}</th>
                      <th>{{trans('debenture_cashing.amount')}}</th>
                      <th>{{trans('debenture_cashing.date_at')}}</th>
                      <th>اضافة في</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="(purchases_bill, index) in customers.data[0].PurchasesBill"
                      :key="index"
                    >
                      <td
                        v-text="purchases_bill.user.profile.first_name+' '+purchases_bill.user.profile.last_name"
                      ></td>
                      <td v-text="purchases_bill.branch.name"></td>
                      <td v-text="purchases_bill.amount"></td>
                      <td v-text="purchases_bill.date_at"></td>
                      <td v-text="purchases_bill.created_at"></td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <h2 v-if="customers.data[0].SalesBill.length">فواتير مبيعات</h2>

              <div class="table-responsive" v-if="customers.data[0].SalesBill.length">
                <table class="table">
                  <thead>
                    <tr>
                      <th>{{trans('debenture_cashing.username')}}</th>
                      <th>{{trans('debenture_cashing.branch_name')}}</th>
                      <th>{{trans('debenture_cashing.amount')}}</th>
                      <th>{{trans('debenture_cashing.date_at')}}</th>
                      <th>اضافة في</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(sales_bill, index) in customers.data[0].SalesBill" :key="index">
                      <td
                        v-text="sales_bill.user.profile.first_name+' '+sales_bill.user.profile.last_name"
                      ></td>
                      <td v-text="sales_bill.branch.name"></td>
                      <td v-text="sales_bill.amount"></td>
                      <td v-text="sales_bill.date_at"></td>
                      <td v-text="sales_bill.created_at"></td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <h2 v-if="customers.data[0].AccountAdjustment.length">تسويه</h2>

              <div class="table-responsive" v-if="customers.data[0].AccountAdjustment.length">
                <table class="table">
                  <thead>
                    <tr>
                      <th>{{trans('debenture_cashing.username')}}</th>
                      <th>{{trans('debenture_cashing.amount')}}</th>
                      <th>{{trans('debenture_cashing.date_at')}}</th>
                      <th>ملاحظات</th>
                      <th>اضافة في</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="(account_adjustment, index) in customers.data[0].AccountAdjustment"
                      :key="index"
                    >
                      <td
                        v-text="account_adjustment.user.profile.first_name+' '+account_adjustment.user.profile.last_name"
                      ></td>
                      <td v-text="account_adjustment.amount"></td>
                      <td v-text="account_adjustment.date_at"></td>
                      <td v-text="account_adjustment.note"></td>
                      <td v-text="account_adjustment.created_at"></td>
                    </tr>
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
export default {
  methods: {},
  data() {
    return {
      id: this.$route.params.id,

      customers: {
        total: 0,
        data: []
      },
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
      let url = helper.getFilterURL(this.filterTodoForm);
      axios
        .get("/api/customers/statement/" + this.id)
        .then(response => response.data)
        .then(response => {
          this.customers.data = response;
          this.customers.total = this.customers.data.length;
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
