<template>
    <b-modal v-model="showModal" size="lg" hide-footer title="Filter Location" centered>
        <form @submit.prevent="submit" class="customform">
            <div class="row customerform" style="margin-right: 5px; margin-left: 5px;">
                <div class="col-md-12">
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Region: <span v-if="errors.region_code" class="haveerror">({{( errors.region_code[0] )}})</span></label>
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Province: <span v-if="errors.province_code" class="haveerror">({{( errors.province_code[0] )}})</span></label>
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
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label>Municipality: <span v-if="errors.municipality_code" class="haveerror">({{( errors.municipality_code[0] )}})</span></label>
                                    <multiselect 
                                    v-model="municipality" 
                                    @input="onChangeMunicipality(municipality.code)"
                                    :options="municipalities"
                                    :allow-empty="false"
                                    :show-labels="false"
                                    label="name" track-by="code"
                                    placeholder="Select Municipality">
                                </multiselect>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label>Barangay: <span v-if="errors.barangay_code" class="haveerror">({{( errors.barangay_code[0] )}})</span></label>
                                    <multiselect 
                                    v-model="barangay" 
                                    :options="barangays"
                                    :allow-empty="false"
                                    :show-labels="false"
                                    label="name" track-by="code"
                                    placeholder="Select Barangay">
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
        props: ['dropdowns','regions'],
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [],
                provinces: [],
                municipalities: [],
                barangays: [],
                region: '',
                province: '',
                municipality: '',
                barangay: '',
                fil :[],
                showModal: false
            }
        },
        watch: {
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
            },
            municipality(){
                this.barangay = '';
                this.fetchBarangay(this.municipality.code);
            }
        },
        methods : {
            set(){
                this.showModal = true;
            },  
            
            submit(){
                this.fil = {
                    'region' : (this.region != null) ? this.region.code : '',
                    'province' : (this.province != null) ? this.province.code : '',
                    'municipality' : (this.municipality != null) ? this.municipality.code : '',
                    'barangay' : (this.barangay != null) ? this.barangay.code : '',
                };
                this.$emit('status', this.fil);
                this.showModal = false;
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

            fetchBarangay($id){
                axios.get(this.currentUrl + '/lists/barangays/'+$id)
                .then(response => {
                    this.barangays = response.data.data;
                })
                .catch(err => console.log(err));
            },

            clear(){
                this.region = '';
                this.province = '';
                this.municipality = '';
                this.barangay = '';
                this.fil = {};
                this.$emit('status', this.fil);
                this.showModal = false;
            }
            
        }, components : { Multiselect }
    }
</script>





