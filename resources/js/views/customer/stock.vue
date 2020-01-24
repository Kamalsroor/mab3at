<template>
  <div>
    <div class="row page-titles">
      <div class="col-sm-6 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">المخزون</h3>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <router-link to="/home">Home</router-link>
          </li>
          <li class="breadcrumb-item active">المخزون</li>
        </ol>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="card-body">
              <div class="table-responsive" v-if="customers.total">
                <table class="table">
                  <thead>
                    <tr>
                      <th>اسم العميل</th>
                      <!-- <th>دائن</th> -->
                      <!-- <th>مدين</th> -->
                      <th>الاجمالي</th>
                      <th class="table-option">{{trans('general.action')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(customer, index) in customers.data" :key="index">
                      <td v-if="customer.debtor - customer.creditor != 0" v-text="customer.name"></td>
                      <!-- <td v-text="customer.creditor"></td> -->
                      <!-- <td v-text="customer.debtor"></td> -->
                      <td
                        v-if="customer.debtor - customer.creditor != 0"
                        v-text="customer.debtor - customer.creditor"
                      ></td>

                      <td v-if="customer.debtor - customer.creditor != 0" class="table-option">
                        <div class="btn-group">
                          <button
                            class="btn btn-info btn-sm"
                            v-tooltip="trans('general.edit')"
                            @click.prevent="showStatement(customer)"
                          >
                            <i class="fas fa-eye"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <pagination-record
                :page-length.sync="filterTodoForm.page_length"
                :records="customers"
                @updateRecords="getBranches"
              ></pagination-record>
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
        .get("/api/customers/statement")
        .then(response => response.data)
        .then(response => {
          this.customers.data = response;
          this.customers.total = this.customers.data.length;
        })
        .catch(error => {
          helper.showDataErrorMsg(error);
        });
    },
    showStatement(customer) {
      this.$router.push("/customer/" + customer.id + "/statement");
    }
  }
};
</script>
