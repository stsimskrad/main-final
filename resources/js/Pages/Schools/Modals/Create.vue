<template>
    <b-modal @ok="create($event)"  v-model="showModal" size="lg" title="New School" no-close-on-backdrop centered>
        <b-form class="customform">
            <div class="row mt-2" v-if="!showNow">
                <div class="col-md-12">
                    <multiselect v-model="school" id="ajax" label="name" track-by="id"
                        placeholder="Search School" open-direction="bottom" :options="schools"
                        :searchable="true" 
                        :allow-empty="false"
                        :show-labels="false"
                        @search-change="asyncSchool">
                    </multiselect>
                </div>
            </div>
            <div class="row" v-if="is_empty">
                <div class="col-md-12 mt-2">
                    <div class="row g-0">
                        <button @click="addNew()" class="btn btn-primary" type="button" block="true">Add new</button>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-8" v-if="showNow">
                    <div class="form-group">
                        <label>Name: <span v-if="errors.name" v-text="errors.name" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="name">
                    </div>
                </div>
                <div class="col-md-4" v-if="showNow">
                    <div class="form-group">
                        <label>Deped Id: </label>
                        <input type="text" class="form-control" v-model="deped_id">
                    </div>
                </div>      
                <div class="col-md-4 mt-2" v-if="showNow">
                    <div class="form-group">
                        <label>Class: <span v-if="errors.class_id" v-text="errors.class_id" class="haveerror"></span></label>
                            <multiselect 
                            v-model="klas" 
                            :options="classes"
                            :allow-empty="false"
                            :show-labels="false"
                            label="name" track-by="id"
                            placeholder="Select Class">
                        </multiselect>
                    </div>
                </div>
                <div v-if="school != '' || showNow == true" :class="(showNow) ? 'col-md-4 mt-2' : 'col-md-6 mt-2'">
                    <div class="form-group">
                        <label>Term type: <span v-if="errors.term_id" v-text="errors.term_id" class="haveerror"></span></label>
                            <multiselect 
                            v-model="term" 
                            :options="terms"
                            :allow-empty="false"
                            :show-labels="false"
                            label="name" track-by="id"
                            placeholder="Select Term type">
                        </multiselect>
                    </div>
                </div>
                <div v-if="school != '' || showNow == true" :class="(showNow) ? 'col-md-4 mt-2' : 'col-md-6 mt-2'">
                    <div class="form-group">
                        <label>Grading System: <span v-if="errors.grading_id" v-text="errors.grading_id" class="haveerror"></span></label>
                            <multiselect 
                            v-model="grading" 
                            :options="gradings"
                            :allow-empty="false"
                            :show-labels="false"
                            label="name" track-by="id"
                            placeholder="Select Grading System">
                        </multiselect>
                    </div>
                </div>  
            </div>
            <div class="row" v-if="school != '' || showNow == true">
                <div class="col-md-12 mt-2"><hr></div>
                <div class="col-md-12"> 
                    <button style="margin-top: -55px;" class="btn btn-sm btn-primary pull-right" type="button">Main Campus</button>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Region: <span v-if="errors.region_code" v-text="errors.region_code" class="haveerror"></span></label>
                            <multiselect 
                            @input="onChangeRegion(region.code)"
                            v-model="region" 
                            :options="regions"
                            :allow-empty="false"
                            :show-labels="false"
                            label="region" track-by="code"
                            placeholder="Select Region">
                        </multiselect>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Province: <span v-if="errors.province_code" v-text="errors.province_code" class="haveerror"></span></label>
                            <multiselect 
                            @input="onChangeProvince(province.code)"
                            v-model="province" 
                            :options="provinces"
                            :allow-empty="false"
                            :show-labels="false"
                            label="name" track-by="code"
                            placeholder="Select Province">
                        </multiselect>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Municipality: <span v-if="errors.municipality_code" v-text="errors.municipality_code" class="haveerror"></span></label>
                            <multiselect 
                            v-model="municipality" 
                            :options="municipalities"
                            :allow-empty="false"
                            :show-labels="false"
                            label="name" track-by="code"
                            placeholder="Select Municipality">
                        </multiselect>
                    </div>
                </div>
                <div class="col-md-4 mt-2">
                    <div class="form-group">
                        <label>Address: <span v-if="errors.address" v-text="errors.address" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="address" style="text-transform: capitalize;">
                    </div>
                </div>
                <div class="col-md-4 mt-2">
                    <div class="form-group">
                        <label>Campus Name: <span v-if="errors.campus" v-text="errors.campus" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="campus" style="text-transform: capitalize;">
                    </div>
                </div>
                <div class="col-md-4 mt-2">
                    <div class="form-group">
                        <label>Shortcut: <span v-if="errors.shortcut" v-text="errors.shortcut" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="shortcut">
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
        props: ['classes','terms','gradings','regions'],
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [], 
                editable: false,
                isLoading: false,
                fullPage: true,
                showModal: false,
                schools: [],
                school: '',
                region: '',
                provinces: [],
                province: '',
                municipalities: [],
                municipality: '',
                address: '',
                campus: '',
                shortcut: '',
                name: '',
                deped_id: '',
                term: '',
                klas: '',
                grading: '',
                is_empty: false,
                showNow: false,
                form: {},
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
            region(){
                this.province = '';
                this.municipality = '';
                this.barangay = '';
                this.fetchProvince(this.region.code);
            },
            province(){
                this.barangay = '';
                this.municipality = '';
                this.fetchMunicipality(this.province.code);
            }
        },

        computed: {
            datares() {
                return this.$page.props.flash.datares;
            },
        },
        
        methods : {
            show() {
                // this.form.reset().clearErrors();
                this.showModal = true;
                this.showNow = false;
                this.is_empty = false;
                this.school = '';
                this.name = '';
                this.errors = [];
            },

            create() {
                let data = new FormData();
                (!this.showNow) ? data.append('id', (this.school.id != undefined) ? this.school.id : '') : '';
                (this.showNow) ? data.append('name', (this.name != undefined) ? this.name : '') : '';
                (this.showNow) ? data.append('class_id', (this.klas.id != undefined) ? this.klas.id : '') : '';
                data.append('term_id', (this.term.id != undefined) ? this.term.id : '');
                data.append('grading_id', (this.grading.id != undefined) ? this.grading.id : '');
                data.append('region_code', (this.region.code != undefined) ? this.region.code : '');
                data.append('province_code', (this.province.code != undefined) ? this.province.code : '');
                data.append('municipality_code', (this.municipality.code != undefined) ? this.municipality.code : '');
                (this.shortcut != '') ? data.append('shortcut', (this.shortcut != undefined) ? this.shortcut : '') : '';
                (this.campus != '') ? data.append('campus', (this.campus != undefined) ? this.campus : '') : '';
                (this.address != '') ? data.append('address', (this.address != undefined) ? this.address : '') : '';
                data.append('new', (this.showNow) ? true : false);
                data.append('is_main', (this.showNow) ? 1 : 0);
               
                this.$inertia.post('/schools', data, {
                    preserveScroll: true,
                    forceFormData: true,
                    onSuccess: (response) => {
                       this.hide();
                    },
                    onError: () => {
                        this.errors = this.$page.props.errors;
                    }
                });
            },

            hide(){
                this.errors = [];
                this.showModal = false;
            },

            asyncSchool(value) {
                if(value.length > 5){
                    this.name = value;
                    axios.post(this.currentUrl + '/lists/search/schools', {
                        word: value,
                    })
                    .then(response => {
                        this.schools = response.data.data;
                        if(this.schools == '') {
                            this.is_empty = true 
                        }else{
                            this.is_empty = false; 
                        } 
                        
                    })
                    .catch(err => console.log(err));
                }
            },

            addNew(){
                this.is_empty = false;
                this.showNow = true;
            },

            fetchProvince($id){
                axios.get(this.currentUrl + '/lists/provinces/'+$id)
                .then(response => {
                    this.provinces = response.data.data;
                })
                .catch(err => console.log(err));
            },

            fetchMunicipality($id){
                axios.get(this.currentUrl + '/lists/municipalities/'+$id)
                .then(response => {
                    this.municipalities = response.data.data;
                })
                .catch(err => console.log(err));
            },
        }
    }
</script>