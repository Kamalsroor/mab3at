<template>
    <form @submit.prevent="proceed" @keydown="generalForm.errors.clear($event.target.name)">
        <div class="row">
            <div class="col-12 col-sm-4">
                <div class="form-group">
                    <label for="">{{trans('customer.name')}}</label>
                    <input class="form-control" type="text" value="" v-model="generalForm.name" name="name" :placeholder="trans('customer.name')">
                    <show-error :form-name="generalForm" prop-name="name"></show-error>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="form-group">
                    <label for="">{{trans('customer.address')}}</label>
                    <input class="form-control" type="text" value="" v-model="generalForm.address" name="address" :placeholder="trans('customer.address')">
                    <show-error :form-name="generalForm" prop-name="address"></show-error>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="form-group">
                    <label for="">{{trans('customer.phone')}}</label>
                    <input class="form-control" type="text" value="" v-model="generalForm.phone" name="phone" :placeholder="trans('customer.phone')">
                    <show-error :form-name="generalForm" prop-name="phone"></show-error>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="form-group">
                    <label for="">{{trans('customer.telephone')}}</label>
                    <input class="form-control" type="text" value="" v-model="generalForm.telephone" name="telephone" :placeholder="trans('customer.telephone')">
                    <show-error :form-name="generalForm" prop-name="telephone"></show-error>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="form-group">
                    <label for="">{{trans('customer.email')}}</label>
                    <input class="form-control" type="email" value="" v-model="generalForm.email" name="email" :placeholder="trans('customer.email')">
                    <show-error :form-name="generalForm" prop-name="email"></show-error>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="form-group">
                    <label for="">{{trans('customer.user')}}</label>
                    <v-select label="name" v-model="selected_user" name="user_id" id="user_id" :options="users" :placeholder="trans('customer.select_user')" @select="generalForm.errors.clear('user_id')" @close="generalForm.user_id = selected_user.id" @remove="generalForm.user_id = ''"></v-select>
                    <show-error :form-name="generalForm" prop-name="user_id"></show-error>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="form-group">
                    <label for="">{{trans('customer.type')}}</label>
                    <v-select label="name" v-model="selected_type" name="type" id="type" :options="types" :placeholder="trans('customer.select_type')" @select="generalForm.errors.clear('type')" @close="generalForm.type = selected_type.id" @remove="generalForm.type = ''"></v-select>
                    <show-error :form-name="generalForm" prop-name="type"></show-error>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-info waves-effect waves-light pull-right">
            <span v-if="id">{{trans('general.update')}}</span>
            <span v-else>{{trans('general.save')}}</span>
        </button>
        <router-link to="/customer" class="btn btn-danger waves-effect waves-light pull-right m-r-10" v-show="id">{{trans('general.cancel')}}</router-link>
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
                    user_id: null,
                    type : null,
                    email : '',
                    telephone : '',
                }),
                users : [],
                types : [],
                selected_user: {
                    id: null,
                    name: null
                },
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
            axios.get('/api/customer/pre-requisite')
                .then(response => response.data)
                .then(response => {
                    this.users = response.user;
                    this.types = response.type;
                })
                .catch(error => {
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
                this.generalForm.post('/api/customer')
                    .then(response => {
                        toastr.success(response.message);
                        this.$emit('completed')
                    })
                    .catch(error => {
                        helper.showErrorMsg(error);
                    });
            },
            get(){
                axios.get('/api/customer/'+this.id)
                    .then(response => response.data)
                    .then(response => {
                        this.generalForm.name = response.name;
                        this.generalForm.address = response.address;
                        this.generalForm.phone = response.phone;
                        this.selected_user.id = response.user_id;
                        this.selected_user.name = response.user.profile.first_name+' '+response.user.profile.last_name;
                        this.generalForm.user_id = response.user_id;
                        this.generalForm.type = response.type;
                        this.selected_type.id = response.type;
                        this.selected_type.name = response.typeName;
                        this.generalForm.telephone = response.telephone;
                        this.generalForm.email = response.email;
                    })
                    .catch(error => {
                        helper.showDataErrorMsg(error);
                        this.$router.push('/customer');
                    });
            },
            update(){
                this.generalForm.patch('/api/customer/'+this.id)
                    .then(response => {
                        toastr.success(response.message);
                        this.$router.push('/customer');
                    })
                    .catch(error => {
                        helper.showErrorMsg(error);
                    });
            }
        }
    }
</script>
