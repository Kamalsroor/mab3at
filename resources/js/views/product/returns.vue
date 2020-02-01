<template>
  <div>
    <div class="row page-titles">
      <div class="col-sm-6 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Blank</h3>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <router-link to="/home">Home</router-link>
          </li>
          <li class="breadcrumb-item active">Blank</li>
        </ol>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h2>مرتجاعات مشتريات</h2>
            <div class="col-12 col-sm-8">
              <div class="form-group">
                <label for>السريال</label>
                <input
                  class="form-control"
                  type="text"
                  value
                  :id="'serial'"
                  v-model="serial"
                  ref="title"
                  @change="supertrim(serial)"
                  @keyup.enter="addSerials(serial)"
                  name="serial"
                  :placeholder="'السريال'"
                />
              </div>

              <table class="table">
                <thead>
                  <tr>
                    <th>السريال</th>
                    <th>حذف</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(serial, index) in generalForm.serials" :key="index">
                    <td>{{ serial }}</td>
                    <td>
                      <b-button @click="removeSerial(index)" variant="danger">حذف</b-button>
                    </td>
                  </tr>
                </tbody>
              </table>

              <button
                type="button"
                @click="sendSerials()"
                class="btn btn-info waves-effect waves-light pull-right"
              >Chick</button>

              <div class="table-responsive" v-if="data">
                <table class="table">
                  <thead>
                    <tr>
                      <th>السريال</th>
                      <th>الحالة</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(data, index) in data" :key="index">
                      <td v-if="data.status == 'NotFound'" v-text="data.srial"></td>
                      <td v-if="data.status == 'NotFound'">هذا السريال غير موجود بالمخازن</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="table-responsive" v-if="data">
                <table class="table">
                  <thead>
                    <tr>
                      <th>السريال</th>
                      <th>الحالة</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(data, index) in data" :key="index">
                      <td v-if="data.status == 'FoundFalse'" v-text="data.srial"></td>
                      <td v-if="data.status == 'FoundFalse'">هذا السريال تم عمل مبيعات عليه</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="table-responsive" v-if="data">
                <table class="table">
                  <thead>
                    <tr>
                      <th>السريال</th>
                      <th>النوع</th>
                      <th>العميل</th>
                      <th>الفرع</th>
                      <th>سعر الشراء</th>
                      <th>الحالة</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(data, index) in data" :key="index">
                      <td v-if="data.status == 'FoundTrue'" v-text="data.srial"></td>
                      <td v-if="data.status == 'FoundTrue'" v-text="data.Product.name"></td>
                      <td v-if="data.status == 'FoundTrue'" v-text="data.customer.name"></td>
                      <td v-if="data.status == 'FoundTrue'" v-text="data.branch.name"></td>
                      <td v-if="data.status == 'FoundTrue'" v-text="data.amount"></td>
                      <td v-if="data.status == 'FoundTrue'">يمكن عمل مرتجع به</td>
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
  data() {
    return {
      generalForm: new Form({
        autoReset: false,
        serials: []
      }),
      data: [],
      serial: null
    };
  },
  methods: {
    addSerials(value) {
      this.serial = null;
      let filtered = this.generalForm.serials.filter(m => m === value);
      if (filtered.length > 0) {
        helper.ErrorMsgVue("لا يمكن الاضافة مرتين");
      } else {
        if (
          value != null &&
          value != "" &&
          value != " " &&
          value != "  " &&
          value != "   " &&
          value != "    " &&
          value != "     " &&
          value != "      " &&
          value != "       "
        ) {
          this.generalForm.serials.push(value);
        }
      }
    },
    removeSerial(index) {
      this.generalForm.serials.splice(index, 1);
    },
    supertrim(value) {
      this.$el.value = value.replace(/\s/g, "");
    },
    sendSerials() {
      this.generalForm
        .post("/api/product/CheckSrirals")
        .then(response => {
          // this.branches = response.branch;
          this.data = response;
          toastr.success(response.message);
        })
        .catch(error => {
          helper.showErrorMsg(error);
        });
    }
  }
};
</script>
