<template>
    <b-modal @ok="create($event)" v-model="showModal" ok-title="Save" :title="(!form.editable) ? 'New Privilege' : 'Update Privilege'" centered>
        <b-form class="customform">
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Name: <span v-if="form.errors.name" v-text="form.errors.name" class="haveerror"></span></label>
                        <input type="text" class="form-control" :class="[(form.errors.name) ? 'is-invalid' : '']" v-model="form.name" style="text-transform: capitalize;">
                    </div>
                </div>    
                <div class="col-md-12 mt-2">
                    <div class="form-group">
                        <label>Type: <span v-if="form.errors.type" v-text="form.errors.type" class="haveerror"></span></label>
                        <input type="text" class="form-control" :class="[(form.errors.type) ? 'is-invalid' : '']" v-model="form.type">
                    </div>
                </div>  
                <div class="col-md-6 mt-2">
                    <div class="form-group">
                        <label>Regular Amount: <span v-if="form.errors.regular_amount" v-text="form.errors.regular_amount" class="haveerror"></span></label>
                        <input type="text" class="form-control" :class="[(form.errors.regular_amount) ? 'is-invalid' : '']" v-model="form.regular_amount">
                    </div>
                </div>
                <div class="col-md-6 mt-2">
                    <div class="form-group">
                        <label>Summer Amount: <span v-if="form.errors.summer_amount" v-text="form.errors.summer_amount" class="haveerror"></span></label>
                        <input type="text" class="form-control" :class="[(form.errors.summer_amount) ? 'is-invalid' : '']" v-model="form.summer_amount">
                    </div>
                </div>
                <div class="col-md-4 mt-2">
                    <input
                        class="form-check-input theme-choice"
                        type="checkbox"
                        id="customCheck1"
                        v-model="form.is_fixed"
                    />  
                    <label class="custom-control-label ms-1" for="customCheck1">Is Fixed?</label>  
                </div>  
                <div class="col-md-4 mt-2">
                    <input
                        class="form-check-input theme-choice"
                        type="checkbox"
                        id="customCheck2"
                        v-model="form.is_active"
                    />  
                    <label class="custom-control-label ms-1" for="customCheck2">Is active?</label>  
                </div>  
                <div class="col-md-4 mt-2">
                    <input
                        class="form-check-input theme-choice"
                        type="checkbox"
                        id="customCheck2"
                        v-model="form.is_reimburseable"
                    />  
                    <label class="custom-control-label ms-1" for="customCheck2">Is reimburseable?</label>  
                </div>  
            </div>
        </b-form>
    </b-modal>
</template>

<script>
    export default {
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [], 
                editable: false,
                isLoading: false,
                fullPage: true,
                form: this.$inertia.form({
                    id: '',
                    name: '',
                    type: '',
                    regular_amount: '',
                    summer_amount: '',
                    is_fixed: false,
                    is_active:  false,
                    editable: false
                }),
                showModal: false
            }
        },

        watch: {
            datares: {
                deep: true,
                handler(val = null) {
                    if(val != null && val !== ''){
                        this.$emit('info', val.data);
                    }
                },
            },
        },
        computed: {
            datares() {
                return this.$page.props.flash.datares;
            },
        },
        
        methods : {
            show() {
                this.form.reset().clearErrors();
                this.showModal = true;
            },

            create() {
                if(!this.form.editable){
                    this.form.post('/privileges',{
                        preserveScroll: true,
                        onSuccess: (response) => {
                            this.hide();
                        }
                    });
                }else{
                    this.form.put('/privileges/update',{
                        preserveScroll: true,
                        onSuccess: (response) => {
                            this.hide();
                        }
                    });
                }
            },

            edit(data) {
                this.form.id = data.id;
                this.form.name = data.name;
                this.form.type = data.type;
                this.form.regular_amount = data.regular_amount;
                this.form.summer_amount = data.summer_amount;
                this.form.is_fixed = (data.is_fixed == 1) ? true : false;
                this.form.is_active = (data.is_active == 1) ? true : false;
                this.form.is_reimburseable = (data.is_reimburseable == 1) ? true : false;
                this.form.editable = true;
                this.showModal = true;
            },

            hide(){
                this.form.reset().clearErrors();
                this.showModal = false;
            },
        }
    }
</script>