<template>
    <b-modal @ok="create($event)" v-model="showModal" ok-title="Save" :title="(!form.editable) ? 'New Program' : 'Update Program'" centered>
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
                        <label>Others: <span v-if="form.errors.others" v-text="form.errors.others" class="haveerror"></span></label>
                        <input type="text" class="form-control" :class="[(form.errors.others) ? 'is-invalid' : '']" v-model="form.others" style="text-transform: capitalize;">
                    </div>
                </div>  
                <div class="col-md-6 mt-2">
                    <input
                        class="form-check-input theme-choice"
                        type="checkbox"
                        id="customCheck1"
                        v-model="form.is_sub"
                    />  
                    <label class="custom-control-label ms-1" for="customCheck1">Is Sub program?</label>  
                </div>  
                 <div class="col-md-6 mt-2">
                    <input
                        class="form-check-input theme-choice"
                        type="checkbox"
                        id="customCheck2"
                        v-model="form.is_active"
                    />  
                    <label class="custom-control-label ms-1" for="customCheck2">Is active?</label>  
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
                    others: '',
                    is_sub: false,
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
                    this.form.post('/programs',{
                        preserveScroll: true,
                        onSuccess: (response) => {
                            this.hide();
                        }
                    });
                }else{
                    this.form.put('/programs/update',{
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
                this.form.others = data.others;
                this.form.is_sub = (data.is_sub == 1) ? true : false;
                this.form.is_active = (data.is_active == 1) ? true : false;
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