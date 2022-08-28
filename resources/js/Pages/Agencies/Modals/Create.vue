<template>
    <b-modal @ok="create($event)" v-model="showModal" ok-title="Save" :title="(!form.editable) ? 'New Agency' : 'Update Agency'" centered>
        <b-form class="customform">
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Name:  <span v-if="form.errors.name" v-text="form.errors.name" class="haveerror"></span></label>
                        <input type="text" class="form-control" :class="[(form.errors.name) ? 'is-invalid' : '']" v-model="form.name" style="text-transform: capitalize;">
                    </div>
                </div>    
                <div class="col-md-6 mt-2">
                    <div class="form-group">
                        <label>Acronym:  <span v-if="form.errors.acronym" v-text="form.errors.acronym" class="haveerror"></span></label>
                        <input type="text" class="form-control" :class="[(form.errors.acronym) ? 'is-invalid' : '']" v-model="form.acronym" style="text-transform: uppercase;">
                    </div>
                </div>  
                <div class="col-md-6 mt-2">
                    <div class="form-group">
                        <label>Code:  <span v-if="form.errors.code" v-text="form.errors.code" class="haveerror"></span></label>
                        <input type="text" class="form-control" :class="[(form.errors.code) ? 'is-invalid' : '']" v-model="form.code" style="text-transform: uppercase;">
                    </div>
                </div>  
                <div class="col-md-12 mt-2">
                    <div class="form-group">
                        <label>Website:  <span v-if="form.errors.website" v-text="form.errors.website" class="haveerror"></span></label>
                        <input type="text" class="form-control" :class="[(form.errors.website) ? 'is-invalid' : '']" v-model="form.website" style="text-transform: lowercase;">
                    </div>
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
                    code: '',
                    acronym: '',
                    website: '',
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
                    this.form.post('/agencies',{
                        preserveScroll: true,
                        onSuccess: (response) => {
                            this.hide();
                        }
                    });
                }else{
                    this.form.put('/agencies/update',{
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
                this.form.code = data.code;
                this.form.acronym = data.acronym;
                this.form.website = data.website;
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