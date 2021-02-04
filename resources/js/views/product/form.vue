<template>
    <form @submit.prevent="proceed" @keydown="generalForm.errors.clear($event.target.name)">
        <div class="row">
            <div class="col-12 col-sm-4">
                <div class="form-group">
                    <label for="">{{trans('product.name')}}<span>*</span></label>
                    <input class="form-control" type="text" value="" v-model="generalForm.name" name="name" :placeholder="trans('product.name')">
                    <show-error :form-name="generalForm" prop-name="name"></show-error>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label for>{{ trans("product.status") }}</label>
                    <br />
                    <switches
                        class="m-l-20"
                        v-model="generalForm.status"
                        theme="bulma"
                        color="blue"
                    ></switches>
                    <show-error :form-name="generalForm" prop-name="status"></show-error>
                </div>
            </div>



            <div class="col-12 col-sm-4">
                <div class="form-group">
                    <label for="">{{trans('product.min_price')}}</label>
                    <input class="form-control" type="number" value="" v-on:change="CheckPrice"  v-model="generalForm.min_price" name="min_price"  :placeholder="trans('product.min_price')">
                    <show-error :form-name="generalForm" prop-name="min_price"></show-error>
                </div>
            </div>


            <div class="col-12 col-sm-4">
                <div class="form-group">
                    <label for="">{{trans('product.max_price')}}</label>
                    <input class="form-control" type="number" value=""  v-on:change="CheckPrice" v-model="generalForm.max_price" name="max_price" :placeholder="trans('product.max_price')">
                    <show-error :form-name="generalForm" prop-name="max_price"></show-error>
                </div>
            </div>


            <div class="col-12 col-sm-4">
                <div class="form-group">
                    <label for="">{{trans('product.selected_group')}}</label>
                    <v-select label="name" v-model="selected_group" name="type" id="group_id" :options="groups" :placeholder="trans('product.select_group_id')" @select="generalForm.errors.clear('group_id')" @close="generalForm.group_id = selected_group.id" @remove="generalForm.group_id = ''"></v-select>
                    <show-error :form-name="generalForm" prop-name="group_id"></show-error>
                </div>
            </div>


            <div class="col-12 col-sm-4">
                <div class="form-group">
                    <label for="">{{trans('product.selected_category')}}</label>
                    <v-select label="name" v-model="selected_category" name="type" id="category_id" :options="categorys" :placeholder="trans('product.select_category_id')" @select="generalForm.errors.clear('category_id')" @close="generalForm.category_id = selected_category.id" @remove="generalForm.category_id = ''"></v-select>
                    <show-error :form-name="generalForm" prop-name="category_id"></show-error>
                </div>
            </div>


            <div class="col-12 col-sm-4" >
                <div class="form-group" >
                    <label for="">{{trans('product.parcode')}}<span>*</span></label>
                    <input class="form-control" type="text" value="" v-model="generalForm.parcode" name="parcode" :placeholder="trans('product.parcode')">
                    <show-error :form-name="generalForm" prop-name="parcode"></show-error>
                </div>

            </div>
            
        
        </div>
        <button type="submit" class="btn btn-info waves-effect waves-light pull-right">
            <span v-if="id">{{trans('general.update')}}</span>
            <span v-else>{{trans('general.save')}}</span>
        </button>
        <router-link to="/product" class="btn btn-danger waves-effect waves-light pull-right m-r-10" v-show="id">{{trans('general.cancel')}}</router-link>
        <button v-if="!id" type="button" class="btn btn-danger waves-effect waves-light pull-right m-r-10" @click="$emit('cancel')">{{trans('general.cancel')}}</button>
    </form>
</template>


<script>
    import datepicker from 'vuejs-datepicker'
    import autosizeTextarea from '../../components/autosize-textarea'
    import vSelect from 'vue-multiselect'
    import switches from "vue-switches";

    export default {
        components: {datepicker,autosizeTextarea,vSelect,switches},
        data() {
            return {
                generalForm: new Form({
                    name : null,
                    parcode : null,
                    image : null,
                    group_id : null,
                    category_id : null,
                    min_price : 0,
                    max_price : 0,
                    status: 1,

                }),
                categorys : [],
                selected_category: {
                    id: null,
                    name: null
                },
                groups : [],
                selected_group: {
                    id: null,
                    name: null
                },
            };
        },
        props: ['id'],
        mounted() {
            if(this.id)
                this.get();
                this.$Progress.start()

            axios.get('/api/product/pre-requisite')
                .then(response => response.data)
                .then(response => {
                    console.log(response);
                    this.categorys = response.category;
                    this.groups = response.group;
                    this.$Progress.finish()
                })
                .catch(error => {
                    this.$Progress.fail()
                    helper.showDataErrorMsg(error);
                });
        },
        methods: {
            proceed(){
                if(this.id)
                    this.update();
                else
                    this.store ();
            },
            CheckPrice: function(evt){
                if (this.generalForm.max_price != null && parseInt(this.generalForm.max_price) > 0) {
                    if (parseInt(this.generalForm.min_price) > parseInt(this.generalForm.max_price)) {
                        toastr.error("يجب ان يكون اعلي سعر اكبر من اقل سعر");
                    } 
                    
                console.log(this.generalForm.max_price);
                }
            },
      
        
            
            store(){
                this.$Progress.start()
                this.generalForm.post('/api/product')
                    .then(response => {
                        toastr.success(response.message);
                        this.$emit('completed')
                        this.$Progress.finish()
                        this.generalForm.group_id  = null ;
                        this.selected_category  =   {id: null,name: null} ;
                        this.generalForm.category_id  = null ;
                        this.selected_group  =   {id: null,name: null} ;
                        this.generalForm.status = 1;
                    })
                    .catch(error => {
                        console.log(error);
                        helper.showErrorMsg(error);
                        this.$Progress.fail()
                    });
            },
            get(){
                axios.get('/api/product/'+this.id)
                    .then(response => response.data)
                    .then(response => {
                        this.generalForm.name = response.name;
                        this.generalForm.parcode = response.parcode;
                        this.generalForm.image = response.image;
                        this.generalForm.category_id = response.category_id;
                        this.generalForm.group_id = response.group_id;
                        this.generalForm.min_price = response.min_price;
                        this.generalForm.max_price = response.max_price;
                        this.generalForm.status = response.status;
                        this.selected_category.id = response.category_id;
                        this.selected_category.name = response.category.name;
                        this.selected_group.id = response.group_id;
                        this.selected_group.name = response.group.name;

                    })
                    .catch(error => {
                        helper.showDataErrorMsg(error);
                        this.$router.push('/product');
                    });
            },
            update(){
                this.$Progress.start()
                this.generalForm.patch('/api/product/'+this.id)
                    .then(response => {
                        toastr.success(response.message);
                        this.$Progress.finish()
                        this.$router.push('/product');
                    })
                    .catch(error => {
                        helper.showErrorMsg(error);
                        this.$Progress.fail()
                    });
            }
        }
    }
</script>
