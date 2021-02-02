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
            <div class="col-12 col-sm-4">
                <div class="form-group">
                    <label for="">{{trans('product.address')}}</label>
                    <input class="form-control" type="text" value="" v-model="generalForm.address" name="address" :placeholder="trans('product.address')">
                    <show-error :form-name="generalForm" prop-name="address"></show-error>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="form-group">
                    <label for="">{{trans('product.phone')}}<span>*</span></label>
                    <input class="form-control" type="text" value="" v-model="generalForm.phone" name="phone" :placeholder="trans('product.phone')">
                    <show-error :form-name="generalForm" prop-name="phone"></show-error>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="form-group">
                    <label for="">{{trans('product.email')}}</label>
                    <input class="form-control" type="email" value="" v-model="generalForm.email" name="email" :placeholder="trans('product.email')">
                    <show-error :form-name="generalForm" prop-name="email"></show-error>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="form-group">
                    <label for="">{{trans('product.telephone')}}</label>
                    <input class="form-control" type="text" value="" v-model="generalForm.telephone" name="telephone" :placeholder="trans('product.telephone')">
                    <show-error :form-name="generalForm" prop-name="telephone"></show-error>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="form-group">
                    <label for="">{{trans('product.type')}}</label>
                    <v-select label="name" v-model="selected_type" name="type" id="type" :options="types" :placeholder="trans('product.select_type')" @select="generalForm.errors.clear('type')" @close="generalForm.type = selected_type.id" @remove="generalForm.type = ''"></v-select>
                    <show-error :form-name="generalForm" prop-name="type"></show-error>
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

    export default {
        components: {datepicker,autosizeTextarea,vSelect},
        data() {
            return {
                generalForm: new Form({
                    name : '',
                    address : '',
                    phone : '',
                    type : null,
                    email : '',
                    telephone : '',
                }),
                types : [],
                selected_type: {
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
                    this.types = response.type;
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
            store(){
                this.$Progress.start()
                this.generalForm.post('/api/product')
                    .then(response => {
                        toastr.success(response.message);
                        this.$emit('completed')
                        this.$Progress.finish()
                        this.generalForm.user_id  = null ;
                        this.selected_type  =   {id: null,name: null} ;
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
                        this.generalForm.address = response.address;
                        this.generalForm.phone = response.phone;
                        this.generalForm.email = response.email;
                        this.generalForm.type = response.type;
                        this.selected_type.id = response.type;
                        this.selected_type.name = response.type_name;
                        // this.selected_type.name = response.user.profile.first_name+' '+response.user.profile.last_name;
                        // this.generalForm.user_id = response.user_id;
                        this.generalForm.telephone = response.telephone;
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
