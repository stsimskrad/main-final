<template>
    <Header :title="title" :content="title" :items="items" />

    <div class="col-12 mt-n3">
        <div class="card">
            <div class="card-body" :style="{ height: height + 'px' }">
                
                <div class="row">
                    <div class="col-xl-6">
                        <button @click="create()" type="button" class="btn btn-sm w-sm mb-n3 me-1 btn-outline-light">Create</button>
                        <Link href="schools/requests">
                            <button type="button" class="btn btn-sm w-sm mb-n3 btn-outline-light">Requests</button>
                        </Link>
                    </div>
                    <div class="col-xl-6">
                        <ul class="list-inline user-chat-nav text-end mb-0 dropdown">
                            <li class="list-inline-item d-non d-sm-inline-block" style="margin-right: 50px;">     
                                <i class='bx bxs-error-circle bx-tada text-warning h4' style="margin-left: -22px; position: absolute;"></i> <span class="text-muted font-size-11">Incomplete Scholar Information</span>
                            </li>
                            <Pagination @fetch="fetch" :links="links" :pagination="meta"/>
                        </ul>
                    </div>
                    <div class="col-xl-12 d-inline-block mb-2">
                        <div class="input-group mb-2" ref="www">
                            <label class="input-group-text bg-light"> <i class='bx bx-search-alt'></i></label>
                            <input type="text" class="form-control" style="width: 55%;" placeholder="Search..." v-model="keyword"/>
                          
                            <select  v-model="term" @change="fetch()" placeholder="Choose Term Type" class="form-select" :class="(term == null) ? 'text-muted' : ''" style="width: 100px;">
                                <option :value="null" selected>All Terms</option>
                                <option :value="aa" v-for="aa in terms" v-bind:key="aa.id">{{ aa.name }}</option>
                            </select>
                            <select  v-model="grading" @change="fetch()" placeholder="Choose Grading" class="form-select" :class="(grading == null) ? 'text-muted' : ''" style="width: 100px;">
                                <option :value="null" selected>All Gradings</option>
                                <option :value="bb" v-for="bb in gradings" v-bind:key="bb.id">{{ bb.name }}</option>
                            </select>
                            <select v-model="klass" @change="fetch()" placeholder="Choose Class" class="form-select" :class="(klass == null) ? 'text-muted' : ''" style="width: 100px;">
                                <option :value="null" selected>All Classes</option>
                                <option :value="cc" v-for="cc in classes" v-bind:key="cc.id">{{ cc.name }}</option>
                            </select>
                            <!-- <input type="text" class="form-control" style="width: 100px;" placeholder="Enter Year" v-model="year"  @keyup="fetch()"/> -->
                            <label style="cursor: pointer;"  @click="openf=openFilter('location')" class="input-group-text bg-light"> <i class='bx bxs-map' :class="(Object.keys(this.arr).length > 0) ? 'bx-flashing text-primary' : ''"></i></label>
                            <!-- <label style="cursor: pointer;" class="input-group-text bg-light"> <i class='bx bxs-graduation' :class="(Object.keys(this.arr2).length > 0) ? 'bx-flashing text-primary' : ''"></i></label> -->
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-centered table-nowrap align-middle">
                        <thead class="thead-light font-size-11">
                            <tr>
                                <th style="width: 2%;"></th>
                                <th style="width: 50%;">Name</th>
                                <th style="width: 12%;" class="text-center">Class</th>
                                <th style="width: 12%;" class="text-center">Term</th>
                                <th style="width: 12%;" class="text-center">Grading</th>
                                <th style="width: 7%;" class="text-center">Status</th>
                                <th style="width: 5%;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="list in lists" v-bind:key="list.id">
                                <td>
                                    <div class="avatar-xs">
                                        <span class="avatar-title rounded-circle">{{list.name.charAt(0)}}</span>
                                    </div>
                                </td>
                                <td>
                                    <h5 class="font-size-13 mb-0 text-dark">{{list.name }} - {{list.campus }}</h5>
                                    <p class="font-size-12 text-muted mb-0">{{list.municipality.name }}, {{list.province.name }}, {{list.region.region }}</p>
                                </td>
                                <td class="text-center">{{list.class.name}}</td>
                                <td class="text-center">{{list.term.name}}</td>
                                <td class="text-center">{{list.grading.name}}</td>
                                <td class="text-center">
                                    <span v-if="list.status == 'active'" class="badge bg-success">{{list.status}}</span>
                                    <span v-else class="badge bg-danger">{{list.status}}</span>
                                </td>
                                <td class="text-end">
                                    <a class="me-3 text-warning" @click="edit(list)"><i class='bx bx-edit-alt' ></i></a>
                                    <Link :href="`/schools/${list.code}`" class="text-info"><i class='bx bxs-show'></i></Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <Edit :regions="regions" :terms="terms" :gradings="gradings" @info="message" ref="update"/>
                <Create :regions="regions" :terms="terms" :classes="classes" :gradings="gradings"  @info="message" ref="create"/>
                <FilterLocation :regions="regions"  @status="message" ref="location"/>
            </div>
        </div>
    </div>

</template>
<script>
import Edit from './Modals/Edit.vue';
import Create from './Modals/Create.vue';
import FilterLocation from './Modals/FilterLocation.vue';
import Header from "@/Shared/Header.vue";
import Pagination from "@/Shared/Pagination.vue";
import _ from 'lodash';

export default {
    components : { Header, Pagination, FilterLocation, Create, Edit },
    inject:['count2', 'height'],
    props: ['dropdowns','regions'],
    data() {
        return {
            currentUrl: window.location.origin,
            title: "Schools",
            items: [
                {text: "School", href: "/",},
                {text: "Lists",active: true,},
            ],
            lists: [],
            meta: {},
            links: {},
            keyword: '',
            showModal: false,
            editable: false,
            term: null,
            klass: null,
            grading: null,
            is_upsystem: false,
            arr: {}
        };
    },
    watch: {
        keyword(newVal){
            this.checkSearchStr(newVal)
        }
    },
    created(){
        this.fetch();
    },
    computed: {
        terms : function() {
            return this.dropdowns.filter(x => x.classification === "Term Type");
        },
        classes : function() {
            return this.dropdowns.filter(x => x.classification === "Class");
        },
        gradings : function() {
            return this.dropdowns.filter(x => x.classification === "Grading System");
        },
    },
    methods : {
        checkSearchStr: _.debounce(function(string) {
            this.fetch();
        }, 300),

        fetch(page_url){
            let info = {
                'keyword' : this.keyword,
                'term' : (this.term ==  null) ? null : this.term.id, 
                'grading' : (this.grading ==  null) ? null : this.grading.id, 
                'class' : (this.klass ==  null) ? null : this.klass.id, 
                'is_upsystem' : this.is_upsystem,
                'counts' : this.count2
            };

            info = (Object.keys(info).length == 0) ? '-' : JSON.stringify(info);
            let location = (Object.keys(this.arr).length == 0) ? '-' : JSON.stringify(this.arr);

            page_url = page_url || '/schools';
            axios.get(page_url,{
                params : {
                    keyword : this.keyword,
                    count: this.count3,
                    search: true,
                    info : info,
                    location: location,
                }
            })
            .then(response => {
                if(response){
                    this.lists = response.data.data;
                    this.meta = response.data.meta;
                    this.links = response.data.links;
                }
            })
            .catch(err => console.log(err));
        },

        openFilter(type,val = null){
            this.$refs[type].set(val);
            this.editable = type;
        },

        create(){
            this.$refs.create.show();
            this.editable = false;
        },

        edit(data){
            this.$refs.update.show(data);
            this.editable = true;
        },

        message(list){
            // let index = this.lists.findIndex(u => u.id === list.id);
            if(!this.editable){
                // let index = this.lists.findIndex(u => u.id === list.id);
                this.lists.unshift(list);
                this.lists.splice((this.count2-1),1);
            }else if(this.editable == 'location'){
                this.arr = list;
                this.fetch();
            }else{
                let index = this.lists.findIndex(u => u.id === list.id);
                this.lists[index] = list;
            }
        },
    }
}
</script>