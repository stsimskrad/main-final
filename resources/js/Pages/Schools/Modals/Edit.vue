<template>
    <b-modal @ok="update($event)"  v-model="showModal" size="lg" title="Update School" no-close-on-backdrop centered>
        <b-form class="customform">
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Name: </label>
                        <input type="text" class="form-control" v-model="school.name" readonly>
                    </div>
                </div>
                <div class="col-md-6 mt-2">
                    <div class="form-group">
                        <label>Term type: <span v-if="errors.term_id" v-text="errors.term_id" class="haveerror"></span></label>
                            <multiselect 
                            v-model="school.term" 
                            :options="terms"
                            :allow-empty="false"
                            :show-labels="false"
                            label="name" track-by="id"
                            placeholder="Select Term type">
                        </multiselect>
                    </div>
                </div>
                <div class="col-md-6 mt-2">
                    <div class="form-group">
                        <label>Grading System: <span v-if="errors.grading_id" v-text="errors.grading_id" class="haveerror"></span></label>
                            <multiselect 
                            v-model="school.grading" 
                            :options="gradings"
                            :allow-empty="false"
                            :show-labels="false"
                            label="name" track-by="id"
                            placeholder="Select Grading System">
                        </multiselect>
                    </div>
                </div>  

                <div class="col-md-12 mt-2"><hr></div>
                <div class="col-md-12"> 
                    <button style="margin-top: -55px;" class="btn btn-sm btn-primary pull-right" type="button">Main Campus</button>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Region: <span v-if="errors.region_code" v-text="errors.region_code" class="haveerror"></span></label>
                            <multiselect 
                            @input="onChangeRegion(region.code)"
                            v-model="school.region" 
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
                            v-model="school.province" 
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
                            v-model="school.municipality" 
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
                        <input type="text" class="form-control" v-model="school.address" style="text-transform: capitalize;">
                    </div>
                </div>
                <div class="col-md-4 mt-2">
                    <div class="form-group">
                        <label>Campus Name: <span v-if="errors.campus" v-text="errors.campus" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="school.campus" style="text-transform: capitalize;">
                    </div>
                </div>
                <div class="col-md-4 mt-2">
                    <div class="form-group">
                        <label>Shortcut: <span v-if="errors.shortcut" v-text="errors.shortcut" class="haveerror"></span></label>
                        <input type="text" class="form-control" v-model="school.shortcut">
                    </div>
                </div>
            </div>

            <template v-slot:footer>
                <b-button @click="hide()" variant="secondary" block>Cancel</b-button>
                <b-button @click="create('ok')" variant="primary" :disabled="form.processing" block>Save</b-button>
            </template>
        </b-form>
    </b-modal>
</template>
<script>
import Multiselect from '@suadelabs/vue3-multiselect';
export default {
    components : { Multiselect },
    props: ['gradings','terms','regions'],
    data(){
        return {
            currentUrl: window.location.origin,
            errors: [], 
            school: this.$inertia.form({
                id: '',
                term: '',
                grading: '',
                adress: '',
                shortcut: '',
                campus: ''
            }),
            form: {},
            provinces: [],
            municipalities: [],
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

    methods: {
        show(data){
            this.school = data;
            this.showModal = true;
            this.fetchProvince(data.region.code);
            this.fetchMunicipality(data.province.code);
        },

        update(){
            this.form = this.$inertia.form({
                id: this.school.id,
                term_id: this.school.term.id,
                grading_id: this.school.grading.id,
                region_code: this.school.region.code,
                province_code: this.school.province.code,
                municipality_code: this.school.municipality.code,
                shortcut: this.school.shortcut,
                campus: this.school.campus,
                address: this.school.address,
            })

            this.form.put('/schools/update',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.hide();
                }
            });
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