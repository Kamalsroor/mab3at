<template>
  <div>
    <div class="form-group text-center" v-if="defaultImage">
      <img :src="getImage" class="img-responsive" style="max-width: 200px" />
    </div>
    <div class="form-group text-center m-t-20">
      <div>
        <button
          type="button"
          class="btn btn-sm btn-danger waves-effect waves-light m-t-10 m-b-10"
          v-if="defaultImage"
          v-confirm="{ ok: confirmRemove(imageSource) }"
        >
          {{ trans("general.remove") }}
        </button>
      </div>
      <span id="fileselector" v-show="!source">
        <label class="btn btn-info">
          <input
            type="file"
            @change="previewImage"
            :id="id"
            class="upload-button"
          />
          <i class="fas fa-upload margin-correction"></i>
          {{ trans("general.choose_image") }}
        </label>
      </span>
    </div>
    <div class="form-group text-center" v-if="source">
      <img :src="source" class="img-responsive" style="max-width: 200px" />
    </div>
    <div class="text-center">
      <button
        type="button"
        class="btn btn-danger waves-effect waves-light m-t-10"
        v-if="source"
        @click="cancelUploadImage"
      >
        {{ trans("general.cancel_upload") }}
      </button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    id: {
      default: "",
    },
    uploadPath: {
      required: true,
    },

    imageSource: {
      default: "",
    },
  },
  data() {
    return {
      source: "",
      uploaded: "",
      isRemoved: false,
      image: "",
    };
  },
  methods: {
    previewImage(e) {
      let files = e.target.files || e.dataTransfer.files;
      let allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
      if (!allowedExtensions.exec($("#" + this.id)[0].files[0].name))
        toastr.error(i18n.general.file_not_supported);
      else {
        if (!files.length) return;
        this.createImage(files[0]);
      }
    },
    createImage(file) {
      let reader = new FileReader();
      reader.onload = (e) => {
        this.source = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    cancelUploadImage() {
      this.source = "";
      $("#" + this.id).val("");
    },

    confirmRemove(imageSource) {
      return (dialog) => this.removeImage();
    },

  computed: {
    defaultImage() {
      return (this.imageSource && !this.isRemoved) || this.uploaded
        ? true
        : false;
    },
    getImage() {
      return this.uploaded ? "/" + this.uploaded : "/" + this.imageSource;
    },
  },
};
</script>
