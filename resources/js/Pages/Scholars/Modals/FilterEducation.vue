<template>
    <b-modal v-model="showModal" hide-footer title="Filter Education" centered>
        <form @submit.prevent="submit" class="customform">
            <div class="row customerform" style="margin-right: 5px; margin-left: 5px;">
                <div class="col-md-12 mt-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>School: <span v-if="errors.school_id" class="haveerror">({{( errors.school_id[0] )}})</span></label>
                                <multiselect 
                                    v-model="school" 
                                    :options="schools"
                                    :allow-empty="false"
                                    :show-labels="false"
                                    @search-change="asyncSchool"
                                    label="name" track-by="id"
                                    placeholder="Select School">
                                </multiselect>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="form-group">
                                <label>Course: <span v-if="errors.course_id" class="haveerror">({{( errors.course_id[0] )}})</span></label>
                                 <multiselect 
                                    v-model="course" 
                                    :options="courses"
                                    :allow-empty="false"
                                    @search-change="asyncCourse"
                                    :show-labels="false"
                                    label="name" track-by="id"
                                    placeholder="Select Course">
                                </multiselect>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <button type="submit" class="float-end btn btn-info btn-block waves-effect waves-light mb-4 ms-1">FILTER</button>
                    <button type="button" @click="clear" class="float-end btn btn-light btn-block waves-effect waves-light mb-4">RESET</button>
                </div>
            </div>
        </form>
    </b-modal>
</template>
<script>
    import Multiselect from '@suadelabs/vue3-multiselect';
    export default {
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [],
                schools: [],
                courses: [],
                school: '',
                course: '',
                fil :[],
                showModal: false
            }
        },

        methods : {
            set(){
                this.showModal = true;
            },  

            submit(){
                this.fil = {
                    'school' : (this.school != null) ? this.school.id : '',
                    'course' : (this.course != null) ? this.course.id : '',
                };
                this.$emit('status', this.fil);
                this.showModal = false;
            },

            asyncSchool(value) {
                if(value.length > 5){
                    axios.post(this.currentUrl + '/lists/search/schools', {
                        word: value,
                    })
                    .then(response => {
                        this.schools = response.data.data;
                    })
                    .catch(err => console.log(err));
                }
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

            clear(){
                this.school = '';
                this.course = '';
                this.fil = {};
                this.$emit('status', this.fil);
                this.showModal = false;
            }
            
        }, components : { Multiselect }
    }
</script>





