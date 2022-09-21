<template>
    <Header :title="title" :content="title" :items="items" />
    <div class="col-12 mt-n3">
        <div class="card">
            <div class="card-body" :style="{ height: height + 'px' }">
                <div class="row">
                    <div class="col-xl-6">
                        <Link href="scholars/new">
                            <button type="button" class="btn btn-sm w-sm mb-n3 me-1 btn-outline-light">Create</button>
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
                            <input type="text" class="form-control" style="width: 55%;" placeholder="Search..." v-model="keyword" @keyup="fetch()"/>
                            <select v-model="is_undergrad" @change="fetch()" class="form-select" :class="(program == null) ? 'text-muted' : ''" style="width: 100px; font-weight: 500;">
                                <option value="all" selected="">All</option>
                                <option value="1">Undergraduate</option>
                                <option value="0">JLSS</option>
                            </select>
                            <select  v-model="program" @change="fetch()" placeholder="Choose Program" class="form-select" :class="(program == null) ? 'text-muted' : ''" style="width: 100px;">
                                <option :value="null" selected>All Program</option>
                                <option :value="program" v-for="program in programs" v-bind:key="program.id">{{ program.name }}</option>
                            </select>
                            <select  v-model="status" @change="fetch()" placeholder="Choose Program" class="form-select" :class="(status == null) ? 'text-muted' : ''" style="width: 100px;">
                                <option :value="null" selected>All Status</option>
                                <option :value="stat" v-for="stat in statuses" v-bind:key="stat.id">{{ stat.name }}</option>
                            </select>
                            <input type="text" class="form-control" style="width: 100px;" placeholder="Enter Year" v-model="year"  @keyup="fetch()"/>
                            <label style="cursor: pointer;" @click="openf=openFilter('location')" class="input-group-text bg-light"> <i class='bx bxs-map' :class="(Object.keys(this.arr).length > 0) ? 'bx-flashing text-primary' : ''"></i></label>
                            <label style="cursor: pointer;" @click="openFilter('education')" class="input-group-text bg-light"> <i class='bx bxs-graduation' :class="(Object.keys(this.arr2).length > 0) ? 'bx-flashing text-primary' : ''"></i></label>
                        </div>
                    </div>
                </div>

                
                <div class="table-responsive">
                    <table class="table table-centered table-nowrap">
                        <thead class="thead-light">
                            <tr class="font-size-11">
                                <th style="width: 2%;"></th>
                                <th>Name</th>
                                <th class="text-center">Program </th>
                                <th class="text-center">Education</th>
                                <th class="text-center">Awarded Year</th>
                                <th class="text-center">Status</th>
                                <th class="text-end">
                                    <i class='bx bx-filter h3' style="position: absolute; margin-top: -20px; margin-left: -33px; cursor: pointer;"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            <tr v-for="user in lists" v-bind:key="user.id" style="cursor: pointer;" :class="[(user.is_completed == 0) ? 'table-warnings' : '']">
                                <td>
                                    <div class="avatar-xs" v-if="user.profile.avatar == 'n/a'">
                                        <span class="avatar-title rounded-circle">{{user.profile.lastname.charAt(0)}}</span>
                                    </div>
                                    <div v-else>
                                        <img class="rounded-circle avatar-xs" :src="currentUrl+'/images/avatars/avatar.jpg'" alt="">
                                    </div>
                                </td>
                                <td>
                                    <h5 class="font-size-13 mb-0 text-dark">{{user.profile.lastname}}, {{user.profile.firstname}} {{user.profile.middlename[0]}}.</h5>
                                    <p class="font-size-11 text-muted mb-0">{{user.address.municipality.name}}, {{user.address.province.name}},  {{user.address.region.region }}</p>
                                </td>
                                <td class="text-center">
                                    <h5 class="font-size-13 mb-0 text-dark">{{user.program.name}}</h5>
                                    <p class="font-size-11 text-muted mb-0">{{(user.is_undergrad) ? 'Undergraduate' : 'JLSS Program' }}</p>
                                </td>
                                <td class="text-center">
                                    <!-- user.education.name }}  {{(user.school == null) ? '' : (user.school.is_main == 1) ? '' : ' - '+user.school.campus }} -->
                                    <h5 class="font-size-11 mb-0 text-dark">{{ user.education.school.school.name }} - {{ user.education.school.campus }}</h5> 
                                    <p class="font-size-11 text-muted mb-0">{{ (!Object.keys(user.education.course).includes('name'))  ? user.education.course : user.education.course.name }}</p>
                                </td>
                                <td class="text-center fw-bold text-primary">{{user.awarded_year}}</td>
                                <td class="text-center">
                                    <span v-if="user.status.type == 'ongoing'" :class="'badge bg-'+user.status.color">{{user.status.name}}</span>
                                    <span v-else :class="'badge badge-pill badge-soft-'+user.status.color">{{user.status.name}}</span>
                                </td>
                                <td class="text-end">
                                    <button type="button" @click="addUser(user)" class="bg-light btn btn-light me-1" v-if="user.user == null"><i class='bx text-primary bxs-user-plus'></i></button>
                                    <button type="button" @click="openFilter('update',user)" class="bg-light btn btn-light me-1" v-if="user.is_completed == 0"><i class='bx text-warning bxs-info-circle'></i></button>
                                    <Link :href="`/scholars/${user.code}`">
                                        <button type="button" class="bg-soft-info btn btn-light" style="margin-end: -10px;">
                                            <span class="d-none d-sm-inline-block">  <i class='bx bx-user-circle'></i></span>
                                        </button>
                                    </Link>                              
                                </td>
                            </tr>
                            <tr v-if="lists.length == 0">
                                <td class="text-center" colspan="7">
                                    No records for scholars
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <FilterLocation :regions="regions"  @status="message" ref="location"/>
                <FilterEducation @status="message" ref="education"/>
                <Update :dropdowns="dropdowns" @status="message" ref="update"/>
                <Login  @status="message" ref="login"/>
            </div>
        </div>
    </div>
</template>

<script>
    import Login from './Modals/Login.vue';
    import Update from './Modals/Update.vue';
    import FilterLocation from './Modals/FilterLocation.vue';
    import FilterEducation from './Modals/FilterEducation.vue';
    import Header from "@/Shared/Header.vue";
    import Pagination from "@/Shared/Pagination.vue";
    import _ from 'lodash';
    
    export default {
        props: ['dropdowns','programs','regions'],
        components : { Header, Pagination, FilterEducation, FilterLocation, Update, Login },
        inject:['count2', 'height'],
        data() {
            return {
                currentUrl: window.location.origin,
                title: "Scholars",
                items: [
                    {text: "Scholar", href: "/",},
                    {text: "Lists",active: true,},
                ],
                lists: [],
                meta: {},
                links: {},
                keyword: '',
                selected: [],
                showModal: false,
                editable: false,
                program: null,
                status: null,
                year: null,
                arr: {},
                arr2: {},
                show: false,
                is_undergrad : 'all',
            };
        },
        watch: {
            keyword(newVal){
                this.checkSearchStr(newVal)
            },
            datares: {
                deep: true,
                handler(val = null) {
                    if(val != null && val !== ''){
                        this.message(val.data);
                    }
                },
            },
        },
        computed: {
            statuses : function() {
                return this.dropdowns.filter(x => x.classification === 'Status');
            },
            datares() {
                return this.$page.props.flash.datares;
            },
        },
        created(){
            this.fetch();
        },
        methods : {
            checkSearchStr: _.debounce(function(string) {
                this.fetch();
            }, 300),
    
            fetch(page_url){
                let info = {
                    'keyword' : this.keyword,
                    'status' : (this.status ==  null) ? null : this.status.id, 
                    'program' : (this.program ==  null) ? null : this.program.id, 
                    'year' : (this.year === '' || this.year == null) ? '' : this.year,
                    'is_undergrad' : this.is_undergrad,
                    'counts' : this.count2
                };
    
                info = (Object.keys(info).length == 0) ? '-' : JSON.stringify(info);
                let location = (Object.keys(this.arr).length == 0) ? '-' : JSON.stringify(this.arr);
                let education = (Object.keys(this.arr2).length == 0) ? '-' : JSON.stringify(this.arr2);
    
                page_url = page_url || '/scholars';
                axios.get(page_url,{
                    params: {  
                        info : info,
                        location: location,
                        education: education,
                        search: true
                    }
                })
                .then(response => {
                    this.lists = response.data.data;
                    this.meta = response.data.meta;
                    this.links = response.data.links;
                })
                .catch(err => console.log(err));
            },
    
            filter(data,name,type){
                switch(type){
                    case 'program':
                        this.program = data;
                        this.$emit('status', 'program', name);
                    break;
                    case 'status':
                        this.status = data;
                        this.$emit('status', 'status', name);
                    break;
                }
    
                let info = {
                    'keyword' :  (this.keyword != '' && this.keyword != null) ? this.keyword : '-',
                    'status' : (this.status != '' && this.status != null) ? this.status : '-',
                    'program' : (this.program != '' && this.program != null) ? this.program : '-',
                    'year' : this.year,
                    'counts' : this.counts
                };
    
                info = (Object.keys(info).length == 0) ? '-' : JSON.stringify(info);
                let location = (Object.keys(this.arr).length == 0) ? '-' : JSON.stringify(this.arr);
                let education = (Object.keys(this.arr2).length == 0) ? '-' : JSON.stringify(this.arr2);
                this.fetch(this.currentUrl + '/request/scholar/'+info+'/'+education+'/'+location);
            },
    
            openFilter(type,val = null){
                this.$refs[type].set(val);
                this.editable = type;
            },
            
            addUser(user){
                this.$refs.login.set(user);
                this.editable = 'login';
            },
    
            yr(){
                (this.show == false) ? this.show = true : this.show = false;
            },
    
            message(list){
                let index = this.lists.findIndex(u => u.id === list.id);
                if(!this.editable){
                    this.lists.splice(index,1);
                }else if(this.editable == 'location'){
                    this.arr = list;
                    this.fetch();
                }else if(this.editable == 'education'){
                    this.arr2 = list;
                    this.fetch();
                }else{
                    this.lists[index] = list;
                }
            },
        }
    }
    </script>
    