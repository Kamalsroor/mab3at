<template>
  <div>
    <div class="page-titles p-3 border-bottom">
      <h3 class="text-themecolor">
        {{trans('debenture_cashing.debenture_cashing')}}
        <span
          class="card-subtitle"
          v-if="debenture_cashings"
        >{{trans('general.total_result_found',{'count' : debenture_cashings.total})}}</span>
        <span class="card-subtitle" v-else>{{trans('general.no_result_found')}}</span>

        <sort-by
          class="pull-right"
          :order-by-options="orderByOptions"
          :sort-by="filterTodoForm.sort_by"
          :order="filterTodoForm.order"
          @updateSortBy="value => {filterTodoForm.sort_by = value}"
          @updateOrder="value => {filterTodoForm.order = value}"
        ></sort-by>
        <button
          class="btn btn-info btn-sm pull-right m-r-10"
          v-if="!showFilterPanel"
          @click="showFilterPanel = !showFilterPanel"
        >
          <i class="fas fa-filter"></i>
          <span class="d-none d-sm-inline">{{trans('general.filter')}}</span>
        </button>
        <button
          class="btn btn-info btn-sm pull-right m-r-10"
          v-if="debenture_cashings.total && !showCreatePanel"
          @click="showCreatePanel = !showCreatePanel"
        >
          <i class="fas fa-plus"></i>
          <span class="d-none d-sm-inline">{{trans('general.add_new')}}</span>
        </button>
      </h3>
    </div>
    <div class="container-fluid p-0">
      <div class="row">
        <div class="col-12">
          <transition name="fade">
            <div class="card border-bottom" v-if="showCreatePanel">
              <div class="card-body p-4">
                <h4 class="card-title">{{trans('general.add_new')}}</h4>
                <general-form
                  @completed="getCustomers"
                  @cancel="showCreatePanel = !showCreatePanel"
                ></general-form>
              </div>
            </div>
          </transition>

          <transition name="fade">
            <div class="card border-bottom" v-if="showFilterPanel">
              <div class="card-body p-4">
                <h4 class="card-title">{{trans('general.filter')}}</h4>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for>{{trans('todo.keyword')}}</label>
                      <input class="form-control" name="keyword" v-model="filterTodoForm.keyword" />
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <switches v-model="filterTodoForm.status" theme="bootstrap" color="success"></switches>
                      {{trans('todo.show_completed')}}
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <date-range-picker
                        :start-date.sync="filterTodoForm.start_date"
                        :end-date.sync="filterTodoForm.end_date"
                        :label="trans('general.date_between')"
                      ></date-range-picker>
                    </div>
                  </div>
                </div>
                <button
                  class="btn btn-danger btn-sm pull-right"
                  v-if="showFilterPanel"
                  @click="showFilterPanel = !showFilterPanel"
                >{{trans('general.cancel')}}</button>
              </div>
            </div>
          </transition>
          <div class="card">
            <div class="card-body">
              <div class="table-responsive" v-if="debenture_cashings.total">
                <table class="table">
                  <thead>
                    <tr>
                      <th>{{trans('debenture_cashing.username')}}</th>
                      <th>{{trans('debenture_cashing.customer_name')}}</th>
                      <th>{{trans('debenture_cashing.branch_name')}}</th>
                      <th>{{trans('debenture_cashing.amount')}}</th>
                      <th>{{trans('debenture_cashing.date_at')}}</th>
                      <!-- <th>{{trans('category.category')}}</th>
                      <th>{{trans('group.group')}}</th>
                      <th>{{trans('debenture_cashing.max_price')}}</th>
                      <th>{{trans('debenture_cashing.min_price')}}</th>
                      <th>{{trans('debenture_cashing.parcode')}}</th>
                      <th>{{trans('debenture_cashing.status')}}</th>-->
                      <th class="table-option">{{trans('general.action')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(debenture_cashing, index) in debenture_cashings.data" :key="index">
                      <td
                        v-text="debenture_cashing.user.profile.first_name+' '+debenture_cashing.user.profile.last_name"
                      ></td>
                      <td v-text="debenture_cashing.customer.name"></td>
                      <td v-text="debenture_cashing.branch.name"></td>
                      <td v-text="debenture_cashing.amount"></td>
                      <td v-text="debenture_cashing.date_at"></td>
                      <!-- <td v-text="debenture_cashing.name"></td>

                      <td v-text="debenture_cashing.group.name"></td>
                      <td v-text="debenture_cashing.max_price"></td>
                      <td v-text="debenture_cashing.min_price"></td>
                      <td v-text="debenture_cashing.parcode"></td>-->
                      <!-- <td v-text="debenture_cashing.status == 1 ? 'Active' : 'Not Active'"></td> -->
                      <td class="table-option">
                        <div class="btn-debenture_cashing">
                          <button
                            class="btn btn-info btn-sm"
                            v-tooltip="trans('general.edit')"
                            @click.prevent="edit(debenture_cashing)"
                          >
                            <i class="fas fa-edit"></i>
                          </button>
                          <button
                            class="btn btn-danger btn-sm"
                            :key="debenture_cashing.id"
                            v-confirm="{ok: confirmDelete(debenture_cashing)}"
                            v-tooltip="trans('general.delete')"
                          >
                            <i class="fas fa-trash"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <module-info
                v-if="!debenture_cashings.total"
                module="todo"
                title="module_info_title"
                description="module_info_description"
                icon="check-circle"
              >
                <div slot="btn">
                  <button
                    class="btn btn-info btn-md"
                    v-if="!showCreatePanel"
                    @click="showCreatePanel = !showCreatePanel"
                  >
                    <i class="fas fa-plus"></i>
                    {{trans('general.add_new')}}
                  </button>
                </div>
              </module-info>
              <pagination-record
                :page-length.sync="filterTodoForm.page_length"
                :records="debenture_cashings"
                @updateRecords="getCustomers"
              ></pagination-record>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import generalForm from "./form";
import switches from "vue-switches";
import datepicker from "vuejs-datepicker";
import dateRangePicker from "../../components/date-range-picker";
import sortBy from "../../components/sort-by";

export default {
  components: { generalForm, switches, datepicker, dateRangePicker, sortBy },
  data() {
    return {
      debenture_cashings: {
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
    if (!helper.hasPermission("access-todo")) {
      helper.notAccessibleMsg();
      this.$router.push("/home");
    }

    if (!helper.featureAvailable("todo")) {
      helper.featureNotAvailableMsg();
      this.$router.push("/home");
    }

    this.getCustomers();
  },
  methods: {
    hasPermission(permission) {
      return helper.hasPermission(permission);
    },
    getCustomers(page) {
      if (typeof page !== "number") {
        page = 1;
      }
      let url = helper.getFilterURL(this.filterTodoForm);
      axios
        .get("/api/debenture_cashing?page=" + page)
        .then(response => response.data)
        .then(response => (this.debenture_cashings = response))
        .catch(error => {
          helper.showDataErrorMsg(error);
        });
    },
    edit(debenture_cashing) {
      this.$router.push("/debenture_cashing/" + debenture_cashing.id + "/edit");
    },
    confirmDelete(debenture_cashing) {
      return dialog => this.delete(debenture_cashing);
    },
    delete(debenture_cashing) {
      axios
        .delete("/api/debenture_cashing/" + debenture_cashing.id)
        .then(response => response.data)
        .then(response => {
          toastr.success(response.message);
          this.getCustomers();
        })
        .catch(error => {
          helper.showDataErrorMsg(error);
        });
    }
  },
  filters: {
    moment(date) {
      return helper.formatDate(date);
    },
    momentDateTime(date) {
      return helper.formatDateTime(date);
    }
  },
  watch: {
    filterTodoForm: {
      handler(val) {
        setTimeout(() => {
          this.getCustomers();
        }, 500);
      },
      deep: true
    }
  }
};
</script>
