<template>
    <Header :title="title" :content="title" :items="items" />

    <div class="col-12 mt-n3">
        <div class="card">
            <div class="card-body" :style="{ height: height + 'px' }">
                <div class="row mb-3">
                    <div class="col-xl-6 col-sm-6 d-inline-block">
                        <form class="d-inline-block ">
                            <div class="search-box">
                                <div class="position-relative">
                                    <input type="text" class="form-control bg-light border-light rounded" placeholder="Search..." v-model="keyword">
                                    <i class='bx bx-search-alt search-icon'></i>
                                </div>
                            </div>
                        </form>

                         <div class="d-inline-block dropdown ms-1" style="margin-top: -20px;">
                            <button class="btn btn-light w-xl dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                {{type}}
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" :class="[(type == t) ? 'text-primary' : '']" @click="onChange(t)" v-for="(t,index) in types" v-bind:key="index">{{t}}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-6 col-sm-6">
                        <ul class="list-inline user-chat-nav text-end mb-0 dropdown">
                            <Pagination v-if="meta" @fetch="fetch" :links="links" :pagination="meta"/>
                        </ul>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-centered table-nowrap align-middle">
                        <thead class="thead-light">
                            <tr class="font-size-11">
                                <th>Code</th>
                                <th class="text-center">{{ type }}</th>
                                <th class="text-center" v-if="type == 'Region'">Region</th>
                                <th class="text-center" v-if="type == 'Region'">Island</th>
                                <th class="text-center" v-if="type == 'Province'">Region Code</th>
                                <th class="text-center" v-if="type == 'Municipality'">Old Name</th>
                                <th class="text-center" v-if="type == 'Municipality'">Is Chartered?</th>
                                <th class="text-center" v-if="type == 'Municipality'">District</th>
                                <th class="text-center" v-if="type == 'Municipality'">Province Code</th>
                                <th class="text-center" v-if="type == 'Barangay'">District</th>
                                <th class="text-center" v-if="type == 'Barangay'">Municipality Code</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr v-for="list in lists" v-bind:key="list.id">
                                <td>{{list.code}}</td>
                                <td class="text-center">{{list.name}}</td>
                                <td class="text-center" v-if="type == 'Region'">{{list.region}}</td>
                                <td class="text-center" v-if="type == 'Region'">{{list.island}}</td>
                                <td class="text-center" v-if="type == 'Province'">{{list.region.name }} <span class="font-size-11 text-muted">- ({{list.region_code}})</span> </td>
                                <td class="text-center" v-if="type == 'Municipality'">{{ (list.old_name == NULL) ? 'n/a' : list.old_name }}</td>
                                <td class="text-center" v-if="type == 'Municipality'">{{ (list.is_chartered) ? 'yes' : 'no'}}</td>
                                <td class="text-center" v-if="type == 'Municipality'">{{ (list.district == NULL) ? 'No District' : list.district}}</td>
                                <td class="text-center" v-if="type == 'Municipality'">{{(list.province == NULL) ? 'n/a' : list.province.name  }} <span class="font-size-11 text-muted">- ({{(list.province_code == NULL) ? 'n/a' : list.province_code}})</span></td>
                                <td class="text-center" v-if="type == 'Barangay'">{{ (list.district == NULL) ? 'No District' : list.district}}</td>
                                <td class="text-center" v-if="type == 'Barangay'">{{(list.municipality == NULL) ? 'n/a' : list.municipality.name }} <span class="font-size-11 text-muted">- ({{ (list.municipality_code == NULL) ? 'n/a' : list.municipality_code}})</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
    
            </div>
        </div>
    </div>

</template>
<script>
import Header from "@/Shared/Header.vue";
import Pagination from "@/Shared/Pagination.vue";
import _ from 'lodash';

export default {
    components : { Header, Pagination },
    inject:['count4', 'height'],
    data() {
        return {
            currentUrl: window.location.origin,
            title: "Addresses",
            items: [
                {text: "Address", href: "/",},
                {text: "Lists",active: true,},
            ],
            lists: [],
            meta: {},
            links: {},
            keyword: '',
            type: 'Region',
            types: ['Region','Province','Municipality','Barangay'],
        };
    },

    created(){
        this.fetch();
    },

    watch: {
        keyword(newVal){
            this.checkSearchStr(newVal)
        }
    },

    methods: {
        checkSearchStr: _.debounce(function(string) {
            this.fetch();
        }, 300),

        fetch(page_url){
            page_url = page_url || '/addresses';
            axios.get(page_url,{
                params : {
                    keyword : this.keyword,
                    count: this.count4,
                    type: this.type,
                    search: true
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

        onChange(type){
            this.type = type;
            this.fetch();
        },

    }
}
</script>