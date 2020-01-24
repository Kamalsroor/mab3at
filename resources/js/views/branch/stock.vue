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
              <div class="table-responsive" v-if="branches.total">
                <table class="table">
                  <thead>
                    <tr>
                      <th>{{trans('branch.name')}}</th>
                      <th>{{trans('branch.address')}}</th>
                      <th>{{trans('branch.phone')}}</th>
                      <th>{{trans('branch.telephone')}}</th>
                      <th>{{trans('branch.user')}}</th>
                      <th class="table-option">{{trans('general.action')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(branch, index) in branches.data" :key="index">
                      <td v-text="branch.name"></td>
                      <td v-text="branch.address"></td>
                      <td v-text="branch.phone"></td>
                      <td v-text="branch.telephone"></td>
                      <td v-text="branch.user.profile.first_name+' '+branch.user.profile.last_name"></td>
                      <td class="table-option">
                        <div class="btn-group">
                          <button
                            class="btn btn-info btn-sm"
                            v-tooltip="trans('general.edit')"
                            @click.prevent="showStock(branch)"
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
                :records="branches"
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
      branches: {
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
        .get("/api/branch/stock")
        .then(response => response.data)
        .then(response => {
          this.branches.data = response;
          this.branches.total = this.branches.data.length;
        })
        .catch(error => {
          helper.showDataErrorMsg(error);
        });
    },
    showStock(branch) {
      this.$router.push("/branch/" + branch.id + "/stock");
    }
  }
};
</script>
