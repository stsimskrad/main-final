<template>
    <Header :title="title" :content="title" :items="items" />
    <div class="col-12 mt-n3">
        <div class="card">
            <div class="card-body" :style="{ height: height + 'px' }">
                <b-form class="customform">
                    <div class="row mt-2">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Firstname: <span v-if="form.errors.name" v-text="form.errors.name" class="haveerror"></span></label>
                                <input type="text" class="form-control" :class="[(form.errors.name) ? 'is-invalid' : '']" v-model="form.name" style="text-transform: capitalize;">
                            </div>
                        </div>    
                        <div class="col-md-3 mt-2">
                            <div class="form-group">
                                <label>Middlename: <span v-if="form.errors.others" v-text="form.errors.others" class="haveerror"></span></label>
                                <input type="text" class="form-control" :class="[(form.errors.others) ? 'is-invalid' : '']" v-model="form.others" style="text-transform: capitalize;">
                            </div>
                        </div>  
                        <div class="col-md-3 mt-2">
                            <div class="form-group">
                                <label>Lastname: <span v-if="form.errors.others" v-text="form.errors.others" class="haveerror"></span></label>
                                <input type="text" class="form-control" :class="[(form.errors.others) ? 'is-invalid' : '']" v-model="form.others" style="text-transform: capitalize;">
                            </div>
                        </div>  
                        <div class="col-md-3 mt-2">
                            <div class="form-group">
                                <label>Others: <span v-if="form.errors.others" v-text="form.errors.others" class="haveerror"></span></label>
                                <input type="text" class="form-control" :class="[(form.errors.others) ? 'is-invalid' : '']" v-model="form.others" style="text-transform: capitalize;">
                            </div>
                        </div>  
                    </div>
                </b-form>
            </div>
        </div>
    </div>
</template>
<script>
    import Header from "@/Shared/Header.vue";
    import Pagination from "@/Shared/Pagination.vue";
    import _ from 'lodash';
    
    export default {
        props: ['dropdowns','programs','regions'],
        components : { Header, Pagination },
        inject:['count2', 'height'],
        data() {
            return {
                currentUrl: window.location.origin,
                title: "Create Scholar",
                items: [
                    {text: "Scholar", href: "/",},
                    {text: "Create", active: true,},
                ],
                lists: [],
                meta: {},
                links: {},
                form: this.$inertia.form({
                    id: '',
                    firstname: '',
                    middlename: '',
                    lastname: '',
                    suffix: '',
                    editable: false
                }),
            };
        },
        computed: {
            statuses : function() {
                return this.dropdowns.filter(x => x.classification === 'Status');
            },
            datares() {
                return this.$page.props.flash.datares;
            },
        },
        methods : {
        }
    }
    </script>
    