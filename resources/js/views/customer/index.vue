<template>
  <div>
    <div class="page-titles p-3 border-bottom">
      <h3 class="text-themecolor">
        {{trans('customer.customer')}}
        <span
          class="card-subtitle"
          v-if="customeres"
        >{{trans('general.total_result_found',{'count' : customeres.total})}}</span>
        <span class="card-subtitle" v-else>{{trans('general.no_result_found')}}</span>

        <sort-by
          class="pull-left"
          :order-by-options="orderByOptions"
          :sort-by="filterTodoForm.sort_by"
          :order="filterTodoForm.order"
          @updateSortBy="value => {filterTodoForm.sort_by = value}"
          @updateOrder="value => {filterTodoForm.order = value}"
        ></sort-by>
        <button
          class="btn btn-info btn-sm pull-left m-r-10"
          v-if="!showFilterPanel"
          @click="showFilterPanel = !showFilterPanel"
        >
          <i class="fas fa-filter"></i>
          <span class="d-none d-sm-inline">{{trans('general.filter')}}</span>
        </button>
        <button
          class="btn btn-info btn-sm pull-left m-r-10"
          v-if="customeres.total && !showCreatePanel && hasPermission('create-customer')"
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
                <general-form @completed="getCustomeres" @cancel="showCreatePanel = !showCreatePanel"></general-form>
              </div>
            </div>
          </transition>


          <transition name="fade">
            <div class="card border-bottom" v-if="showFilterPanel">
              <div class="card-body p-4">
                <h4 class="card-title">{{trans('general.filter')}}</h4>
                <div class="row">
    

                  <div class="col-6 col-sm-3">
                      <div class="form-group">
                          <label for="">{{trans('customer.name')}}</label>
                          <input class="form-control" name="name" v-model="filterTodoForm.name">
                      </div>
                  </div>
                  <div class="col-6 col-sm-3">
                      <div class="form-group">
                          <label for="">{{trans('customer.address')}}</label>
                          <input class="form-control" name="address" v-model="filterTodoForm.address">
                      </div>
                  </div>
                  <!-- <div class="col-6">
                    <div class="form-group">
                      <switches v-model="filterTodoForm.status" theme="bootstrap" color="success"></switches>
                      {{trans('todo.show_completed')}}
                    </div>
                  </div> -->
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
                  v-if="showFilterPanel "
                  @click="showFilterPanel = !showFilterPanel"
                >{{trans('general.cancel')}}</button>
              </div>
            </div>
          </transition>
          <div class="card">
            <div class="card-body">
              <div class="table-responsive" v-if="customeres.total">
                <table class="table">
                  <thead>
                    <tr>
                      <th>{{trans('customer.name')}}</th>
                      <th>{{trans('customer.address')}}</th>
                      <th>{{trans('customer.phone')}}</th>
                      <th>{{trans('customer.telephone')}}</th>
                      <th>{{trans('customer.email')}}</th>
                      <th>{{trans('customer.type')}}</th>
                      <th>{{trans('customer.created_at')}}</th>
                      <th class="table-option">{{trans('general.action')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(customer, index) in customeres.data" :key="index">
                      <td v-text="customer.name"></td>
                      <td v-text="customer.address"></td>
                      <td v-text="customer.phone"></td>
                      <td v-text="customer.telephone"></td>
                      <td v-text="customer.email"></td>
                      <td v-text="customer.type"></td>
                      <td v-text="customer.created_at"></td>
                      <td class="table-option">
                        <div class="btn-group">
                          <button
                            class="btn btn-info btn-sm"
                            v-tooltip="trans('general.edit')"
                            v-if="hasPermission('edit-customer')"
                            @click.prevent="edit(customer)"
                          >
                          
                            <i class="fas fa-edit"></i>
                            <span class="d-none d-sm-inline">{{trans('general.edit')}}</span>
                          </button>
                          <button
                            class="btn btn-danger btn-sm"
                            :key="customer.id"
                            v-if="hasPermission('delete-customer')"
                   
                            @click.prevent="confirmDelete(customer)"

                            v-tooltip="trans('general.delete')"
                          >
                            <span class="d-none d-sm-inline">{{trans('general.delete')}}</span>

                            <i class="fas fa-trash"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <module-info
                v-if="!customeres.total"
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
                :records="customeres"
                @updateRecords="getCustomeres"
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
      customeres: {
        total: 0,
        data: []
      },
      filterTodoForm: {
        name: "",
        address: "",
        // status: false,
        start_date: "",
        end_date: "",
        sort_by: "created_at",
        order: "desc",
        page_length: helper.getConfig("page_length")
      },
      orderByOptions: [
          {
              value: 'name',
              translation: i18n.customer.name
          },
          {
              value: 'address',
              translation: i18n.customer.address
          },
          {
              value: 'phone',
              translation: i18n.customer.phone
          },
          {
              value: 'telephone',
              translation: i18n.customer.telephone
          },
          {
            value: 'type',
              translation: i18n.customer.type
          }
          ,
          {
            value: 'email',
              translation: i18n.customer.email
          }
          ,
          {
              value: 'created_at',
              translation: i18n.customer.created_at
          }

      
      ],
      showCreatePanel: false,
      showFilterPanel: false
    };
  },
  mounted() {
    if (!helper.hasPermission("access-customer")) {
      helper.notAccessibleMsg();
      this.$router.push("/home");
    }
  
    this.getCustomeres();
  },
  methods: {
    hasPermission(permission) {
      console.log(helper.hasPermission(permission));
      return helper.hasPermission(permission);
    },
    getCustomeres(page) {
      if (typeof page !== "number") {
        page = 1;
      }
      let url = helper.getFilterURL(this.filterTodoForm);
      axios
        .get("/api/customer?page=" + page + url)
        .then(response => response.data)
        .then(response => (this.customeres = response))
        .catch(error => {
          helper.showDataErrorMsg(error);
        });
    },
    edit(customer) {
      this.$router.push("/customer/" + customer.id + "/edit");
    },
    confirmDelete(customer) {
        Vue.$confirm({
        auth: true,
        title: 'هل انت متأكد ؟',
        message: 'هل انت متأكد , سوف تقوم بمسح السجل ؟',
        button: {
          yes: 'نعم',
          no: 'لا , اغلاق'
        },
          callback: (confirm, password) => {
              if (confirm && password ) {
                  axios
                  .delete("/api/customer/" + customer.id, {
                    params: {
                        password: password
                    }
                })
                  .then(response => response.data)
                  .then(response => {
                    toastr.success(response.message);
                    this.getCustomeres();
                  })
                  .catch(error => {
                    helper.showDataErrorMsg(error);
                  });
              }
              console.log('tset');
        }
      })

       
    return false;
      // return dialog => this.delete(customer);
    },
    delete(customer) {
      axios
        .delete("/api/customer/" + customer.id)
        .then(response => response.data)
        .then(response => {
          toastr.success(response.message);
          this.getCustomeres();
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
          this.getCustomeres();
        }, 500);
      },
      deep: true
    }
  }
};
</script>
