<template>
    <b-modal @ok="create($event)" v-model="showModal" ok-title="Save" :title="(!editable) ? 'New Expense' : 'Update Expense'" centered>
        <b-form class="customform">
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Name: <span v-if="form.errors" v-text="form.errors.name" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="expense.name" style="text-transform: capitalize;">
                    </div>
                </div>    
                <div class="col-md-12 mt-2">
                    <div class="form-group">
                        <label>Others: <span v-if="form.errors" v-text="form.errors.code" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="expense.code" style="text-transform: capitalize;">
                    </div>
                </div>  

                <div class="col-md-12 mt-2">
                    <div class="form-group">
                        <label>Term Type: <span v-if="form.errors" v-text="form.errors.expenditure_id" class="haveerror"></span></label>
                        <Multiselect 
                            v-model="expense.expenditure" 
                            :options="expenditures"
                            :allow-empty="false"
                            :show-labels="false"
                            label="name" track-by="id"
                            placeholder="Select Expenditure"/>
                    </div>
                </div>
            </div>
        </b-form>
    </b-modal>
</template>

<script>
import Multiselect from '@suadelabs/vue3-multiselect';
    export default {
        components : { Multiselect },
        props: ['dropdowns'],
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [], 
                editable: false,
                fullPage: true,
                form: {},
                expense: {
                    id: '',
                    name: '',
                    code: '',
                    expenditure: '',
                },
                editable: false,
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

            expenditures : function() {
                return this.dropdowns.filter(x => x.classification === "Expenditure");
            },
        },
        
        methods : {
            show() {
                // this.form.reset().clearErrors();
                this.showModal = true;
            },

            create() {
                this.form = this.$inertia.form({
                    id: this.expense.id,
                    name: this.expense.name,
                    code: this.expense.code,
                    expenditure_id: this.expense.expenditure.id,
                    editable: this.editable
                })

                if(!this.editable){
                    this.form.post('/expenses',{
                        preserveScroll: true,
                        onSuccess: (response) => {
                            this.hide();
                        }
                    });
                }else{
                    this.form.put('/expenses/update',{
                        preserveScroll: true,
                        onSuccess: (response) => {
                            this.hide();
                        }
                    });
                }
            },

            edit(data) {
                this.expense.id = data.id;
                this.expense.name = data.name;
                this.expense.code = data.code;
                this.expense.expenditure = data.expenditure;
                this.editable = true;
                this.showModal = true;
            },

            hide(){
                (this.form.hasOwnProperty('reset') ) ? this.form.reset().clearErrors() : this.expense = {};
                this.showModal = false;
                this.editable = false;
            },
        }
    }
</script>