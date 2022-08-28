<template>
    <Header :title="title" :content="title" :items="items" />

    <div class="col-12 mt-n3">
        <div class="card">
            <div class="card-body" :style="{ height: height + 'px' }">
                <div class="row mb-3">
                    <div class="col-xl-6 col-sm-6 d-inline-block">
                        <button @click="create()" type="button" class="btn btn-danger waves-effect waves-light me-1"><i class='bx bx-plus-medical'></i></button>
                        <form class="d-inline-block ">
                            <div class="search-box">
                                <div class="position-relative">
                                    <input type="text" class="form-control bg-light border-light rounded" placeholder="Search..." v-model="keyword">
                                    <i class='bx bx-search-alt search-icon'></i>
                                </div>
                            </div>
                        </form>
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
                            <tr>
                                <th style="width: 2%;"></th>
                                <th>Name</th>
                                <th class="text-center">Created at</th>
                                <th class="text-center">Updated at</th>
                                <th></th>
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
                                    <h5 class="font-size-13 mb-0 text-dark">{{list.name}}</h5>
                                    <p class="font-size-12 text-muted mb-0">{{list.acronym}} | {{list.code}}</p>
                                </td>
                                <td class="text-center">{{list.created_at}}</td>
                                <td class="text-center">{{list.updated_at}}</td>
                                <td class="text-end">
                                    <a class="me-3 text-warning" @click="edit(list)"><i class='bx bx-edit-alt' ></i></a>
                                    <a class="text-danger"><i class='bx bx-trash'></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <Create @info="message" ref="create"/>
            </div>
        </div>
    </div>

</template>
<script>
import Create from "./Modals/Create.vue";
import Header from "@/Shared/Header.vue";
import Pagination from "@/Shared/Pagination.vue";
import _ from 'lodash';

export default {
    components : { Header, Pagination, Create},
    inject:['count3', 'height'],
    data() {
        return {
            currentUrl: window.location.origin,
            title: "Agencies",
            items: [
                {text: "Agency", href: "/",},
                {text: "Lists",active: true,},
            ],
            lists: [],
            meta: {},
            links: {},
            keyword: '',
            showModal: false,
            editable: false
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
    methods : {
        checkSearchStr: _.debounce(function(string) {
            this.fetch();
        }, 300),

        fetch(page_url){
            page_url = page_url || '/agencies';
            axios.get(page_url,{
                params : {
                    keyword : this.keyword,
                    count: this.count3,
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

        create(){
            this.$refs.create.show();
            this.editable = false;
        },

        edit(data){
            this.$refs.create.edit(data);
            this.editable = true;
        },

        message(list){
            if(!this.editable){
                this.lists.unshift(list);
            }else{
                let index = this.lists.findIndex(u => u.id === list.id);
                this.lists[index] = list;
            }
        },
    }
}
</script>