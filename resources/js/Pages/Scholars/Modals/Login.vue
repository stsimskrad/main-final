<template>
    <b-modal  @ok="create($event)"  v-model="showModal" title="Scholar Login" centered>
        <blockquote class="p-3 border-light border rounded">
            <div class="d-flex">
                <div class="mr-3"><i class="bx bxs-quote-alt-left text-primary font-size-14"></i></div>
                <div>
                    <p class="mb-1 fw-bold text-primary">{{ user.profile.lastname}}, {{ user.profile.firstname}} {{ user.profile.middlename }} <span class="text-muted font-size-11 ml-2">({{user.program.name}})</span> </p>
                </div>
            </div>
        </blockquote>

        <b-form class="customform mb-2">
            <div class="row customerform">
                <div class="col-md-12 mt-2 mb-1">
                    <div class="form-group">
                        <label>Email Address: <span v-if="form.errors" v-text="form.errors.email" class="haveerror"></span></label>
                        <input type="email" class="form-control" v-model="email">
                    </div>
                </div>
            </div>
        </b-form>
        <template v-slot:footer>
            <b-button @click="hide()" variant="secondary" block>Cancel</b-button>
            <b-button @click="create('ok')" variant="primary" :disabled="form.processing" block>Save</b-button>
        </template>
    </b-modal>
</template>
<script>
    export default {
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [],
                form : {},
                user: {
                    program: {},
                    profile: {},
                },
                email: '',
                showModal: false
            }
        },

        methods : {
            set(data){
                this.user = data;
                this.errors = [];
                this.showModal = true;
            },

            create(){
                this.form = this.$inertia.form({
                    id: this.user.profile.id,
                    email: this.email,
                    editable: 'login'
                }),

                this.form.post('/scholars',{
                    preserveScroll: true,
                    onSuccess: (response) => {
                        this.hide();
                    }
                });
            },

            hide(){
                (this.form.hasOwnProperty('reset') ) ? this.form.reset().clearErrors() : this.list = {};
                this.showModal = false;
            },
        }
    }
</script>





