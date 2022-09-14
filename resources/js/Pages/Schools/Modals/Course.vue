<template>
    <b-modal @ok="create($event)" v-model="showModal" size="lg" title="Add Course" no-close-on-backdrop centered>
        <b-form class="customform mb-2">
            <div class="row">
                <div class="col-md-12 mb-1">
                    <label>Course: <span v-if="form.errors" v-text="form.errors.course_id" class="haveerror"></span></label>
                    <multiselect v-model="list.course" id="ajax" label="name" track-by="id"
                        placeholder="Search Course" open-direction="bottom" :options="courses"
                        :searchable="true" 
                        :allow-empty="false"
                        :show-labels="false"
                        @search-change="asyncCourse">
                    </multiselect> 
                </div>
                <div class="col-md-6 mt-2">
                    <div class="form-group">
                        <label>Sub-course: <span v-if="form.errors" v-text="form.errors.type" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="list.type" style="text-transform: capitalize;">
                    </div>
                </div>
                <div class="col-md-6 mt-2">
                    <div class="form-group">
                        <label>Years: <span v-if="form.errors" v-text="form.errors.years" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="list.years" style="text-transform: capitalize;">
                    </div>
                </div>
                <div class="col-md-6 mt-2">
                    <div class="form-group">
                        <label>Validity: <span v-if="form.errors" v-text="form.errors.validity" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="list.validity">
                    </div>
                </div>
                <div class="col-md-6 mt-2">
                    <div class="form-group">
                        <label>Certification: <span v-if="form.errors" v-text="form.errors.certification" class="haveerror"></span></label>
                        <multiselect id="ajax" v-model="list.certification" 
                        placeholder="Search Course"
                         open-direction="bottom" :options="certifications"
                        :searchable="true" 
                        :allow-empty="false"
                        :show-labels="false">
                    </multiselect> 
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
import Multiselect from '@suadelabs/vue3-multiselect';
export default {
    components : { Multiselect },
    data(){
        return {
            currentUrl: window.location.origin,
            showModal : false,
            list: {
                id: '',
                course: '',
                type: '',
                years:'',
                validity: '',
                certification: ''
            },
            school: '',
            form: {},
            courses: [],
            certifications: ['COE','COD','FAAP I', 'FAAP II', 'FAAP III', 'FAAP IV'],
            editable: false
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

    methods: {
        show(data){
            this.school = data;
            this.showModal = true;
        },

        asyncCourse(value) {
            if(value.length > 5){
                axios.post(this.currentUrl + '/lists/search/courses', {
                    word: value,
                })
                .then(response => {
                    this.courses = response.data.data;
                })
                .catch(err => console.log(err));
            }
        },

        create(){
            this.form = this.$inertia.form({
                id: this.list.id,
                school_id: this.school.data.id,
                course_id: (this.list.course.id != undefined) ? this.list.course.id : '',
                type:  (this.list.type == '') ? 'n/a'  : this.list.type,
                years: this.list.years,
                validity: this.list.validity,
                certification: this.list.certification,
                editable: this.editable,
                option: 'course'
            })

            this.form.post('/schools',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.hide();
                }
            });
        },

        edit(school,data){
            this.school = school;
            this.list = data;
            this.showModal = true;
            this.editable = true;
        },

        hide(){
            (this.form.hasOwnProperty('reset') ) ? this.form.reset().clearErrors() : this.list = {};
            this.showModal = false;
        }
    }
}
</script>