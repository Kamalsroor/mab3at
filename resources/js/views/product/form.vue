<template>
  <form
    @submit.prevent="proceed"
    @keydown="generalForm.errors.clear($event.target.name)"
  >
    <div class="row">
      <div class="col-12 col-sm-4">
        <div class="form-group">
          <label for>{{ trans("product.name") }}</label>
          <input
            class="form-control"
            type="text"
            value
            v-model="generalForm.name"
            name="name"
            :placeholder="trans('product.name')"
          />
          <show-error :form-name="generalForm" prop-name="name"></show-error>
        </div>
      </div>
      <div class="col-12 col-sm-4">
        <div class="form-group">
          <label for>{{ trans("product.selected_category") }}</label>
          <v-select
            label="name"
            v-model="selected_category"
            name="category_id"
            id="category_id"
            :options="categorys"
            :placeholder="trans('product.selected_category')"
            @select="generalForm.errors.clear('category_id')"
            @close="generalForm.category_id = selected_category.id"
            @remove="generalForm.category_id = ''"
          ></v-select>
          <show-error
            :form-name="generalForm"
            prop-name="category_id"
          ></show-error>
        </div>
      </div>
      <div class="col-12 col-sm-4">
        <div class="form-group">
          <label for>{{ trans("product.selected_group") }}</label>
          <v-select
            label="name"
            v-model="selected_group"
            name="group_id"
            id="group_id"
            :options="groups"
            :placeholder="trans('product.selected_group')"
            @select="generalForm.errors.clear('group_id')"
            @close="generalForm.group_id = selected_group.id"
            @remove="generalForm.group_id = ''"
          ></v-select>
          <show-error
            :form-name="generalForm"
            prop-name="group_id"
          ></show-error>
        </div>
      </div>
      <div class="col-12 col-sm-4">
        <div class="form-group">
          <label for>{{ trans("product.min_price") }}</label>
          <input
            class="form-control"
            type="number"
            value
            v-model="generalForm.min_price"
            name="min_price"
            :placeholder="trans('product.min_price')"
          />
          <show-error
            :form-name="generalForm"
            prop-name="min_price"
          ></show-error>
        </div>
      </div>
      <div class="col-12 col-sm-4">
        <div class="form-group">
          <label for>{{ trans("product.max_price") }}</label>
          <input
            class="form-control"
            type="number"
            value
            v-model="generalForm.max_price"
            name="max_price"
            :placeholder="trans('product.max_price')"
          />
          <show-error
            :form-name="generalForm"
            prop-name="max_price"
          ></show-error>
        </div>
      </div>

      <div class="col-12 col-sm-4">
        <div class="form-group">
          <label for>{{ trans("product.parcode") }}</label>
          <input
            class="form-control"
            type="text"
            value
            v-model="generalForm.parcode"
            name="parcode"
            :placeholder="trans('product.parcode')"
          />
          <show-error :form-name="generalForm" prop-name="parcode"></show-error>
        </div>
      </div>
      <div class="col-12 col-sm-6">
        <div class="form-group">
          <label for>{{ trans("product.status") }}</label>
          <div>
            <switches
              class
              v-model="generalForm.status"
              theme="bootstrap"
              color="success"
            ></switches>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-12">
        <picture-input
          ref="pictureInput"
          @change="onChange"
          width="1200"
          height="600"
          margin="16"
          accept="image/jpeg,image/png"
          size="10"
          buttonClass="btn"
          :customStrings="{
            upload: '<h1>Bummer!</h1>',
            drag: '😺 حط الصوره هنا ',
          }"
        >
        </picture-input>
      </div>
      <div v-if="generalForm.OldImage" class="col-12 col-sm-12">
        <label class="text-center" for>{{ trans("product.oldimage") }}</label>
        <img :src="generalForm.OldImage" class="img-responsive" />
      </div>
    </div>
    <button
      type="submit"
      class="btn btn-info waves-effect waves-light pull-right"
    >
      <span v-if="id">{{ trans("general.update") }}</span>
      <span v-else>{{ trans("general.save") }}</span>
    </button>
    <router-link
      to="/product"
      class="btn btn-danger waves-effect waves-light pull-right m-r-10"
      v-show="id"
      >{{ trans("general.cancel") }}</router-link
    >
    <button
      v-if="!id"
      type="button"
      class="btn btn-danger waves-effect waves-light pull-right m-r-10"
      @click="$emit('cancel')"
    >
      {{ trans("general.cancel") }}
    </button>
  </form>
</template>

<script>
import datepicker from "vuejs-datepicker";
import autosizeTextarea from "../../components/autosize-textarea";
import vSelect from "vue-multiselect";
import PictureInput from "vue-picture-input";
import switches from "vue-switches";
export default {
  components: { datepicker, autosizeTextarea, vSelect, switches, PictureInput },
  data() {
    return {
      generalForm: new Form({
        name: "",
        category_id: null,
        group_id: null,
        min_price: null,
        max_price: null,
        parcode: null,
        image: null,
        OldImage: null,
        status: true,
      }),
      categorys: [],
      selected_category: {
        id: null,
        name: null,
      },
      groups: [],
      selected_group: {
        id: null,
        name: null,
      },
    };
  },
  props: ["id"],
  mounted() {
    if (this.id) this.get();
    axios
      .get("/api/product/pre-requisite")
      .then((response) => response.data)
      .then((response) => {
        this.categorys = response.category;
        this.groups = response.group;

        // this.types = response.type;
      })
      .catch((error) => {
        helper.showDataErrorMsg(error);
      });
  },
  methods: {
    onChange(image) {
      console.log("New picture selected!");
      if (image) {
        console.log("Picture loaded.");
        this.generalForm.image = image;
      } else {
        console.log("FileReader API not supported: use the <form>, Luke!");
      }
    },

    proceed() {
      if (this.id) this.update();
      else this.store();
    },
    store() {
      this.generalForm.status = this.generalForm.status ? 1 : 0;
      this.generalForm
        .post("/api/product")
        .then((response) => {
          toastr.success(response.message);
          this.selected_category = {
            id: null,
            name: null,
          };
          this.selected_group = {
            id: null,
            name: null,
          };
          this.generalForm.status = ture;
          this.$emit("completed");
        })
        .catch((error) => {
          helper.showErrorMsg(error);
        });
    },
    get() {
      axios
        .get("/api/product/" + this.id)
        .then((response) => response.data)
        .then((response) => {
          this.generalForm.name = response.name;
          this.generalForm.status = response.status;
          this.generalForm.image = response.image;
          this.generalForm.OldImage = response.image;
          this.generalForm.parcode = response.parcode;
          this.generalForm.max_price = response.max_price;
          this.generalForm.min_price = response.min_price;
          this.generalForm.category_id = response.category_id;
          this.generalForm.group_id = response.group_id;
          this.selected_group.id = response.group.id;
          this.selected_group.name = response.group.name;
          this.selected_category.id = response.category.id;
          this.selected_category.name = response.category.name;
        })
        .catch((error) => {
          helper.showDataErrorMsg(error);
          this.$router.push("/product");
        });
    },
    update() {
      this.generalForm
        .patch("/api/product/" + this.id)
        .then((response) => {
          toastr.success(response.message);
          this.$router.push("/product");
        })
        .catch((error) => {
          helper.showErrorMsg(error);
        });
    },
  },
};
</script>
