<template>
    <Header :title="title" :content="title" :items="items" />
    <div class="col-12 mt-n3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start">
                    <div class="flex-shrink-0 me-3">
                        <img :src="currentUrl+'/images/'+school.data.avatar" alt=""
                            class="avatar-md rounded-circle img-thumbnail">
                    </div>
                    <div class="flex-grow-1 align-self-center">
                        <div class="text-muted">
                            <h5 class="mb-1">{{ school.data.name }}</h5>
                            <p class="mb-0">{{ school.data.address }}, {{ school.data.municipality.name }},
                                {{ school.data.province.name }}, {{ school.data.region.region }}</p>
                            <p class="mb-n1">{{ school.data.shortcut}} - <span
                                    class="text-info">{{ school.data.campus }}</span></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row g-2">
        <div class="col-4">
            <div class="card mt-n3">
                <div class="card-body mb-n3">
                    <div class="mb-3 float-end">
                        <ul class="mb-0">
                            <li class="list-inline-item d-non d-sm-inline-block mr-4">
                                <i class='bx bxs-notepad text-success'></i> <span class="text-muted font-size-11">With
                                    Prospectus</span>
                            </li>
                            <li class="list-inline-item d-non d-sm-inline-block mr-4">
                                <i class='bx bxs-notepad text-danger'></i> <span class="text-muted font-size-11">No
                                    Prospectus</span>
                            </li>
                        </ul>
                    </div>
                    <p class="text-muted fw-bold">Courses</p>
                </div>
                <div class="card-body border-top">
                    <div class="row">
                        <div class="col-sm-6">
                            <div>
                                <p class="text-muted mb-1">Officially Enrolled</p>
                                <h5>435 </h5>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end mt-4 mt-sm-0">
                                <p class="text-muted mb-1">No. of Scholars</p>
                                <h5>890</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top" :style="{ height: (height-275) + 'px' }">
                    <div class="row">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card mt-n3">
                <div class="card-body mb-n3">
                    <div class="mb-3 float-end">
                        <button @click="addCourse" class="btn btn-sm btn-light w-md ml-1 mt-n1 mb-n1" type="button">Add
                            Course</button>
                    </div>
                    <p class="text-muted fw-bold">Courses</p>
                </div>
                <div class="card-body border-top" :style="{ height: (height-180) + 'px' }">
                    <table class="table table-centered table-nowrap">
                        <thead class="thead-light">
                            <tr class="font-size-11">
                                <th style="width: 2%;"></th>
                                <th>Name</th>
                                <th class="text-center">Certification</th>
                                <th class="text-center">Validity</th>
                                <th class="text-end">
                                    <i class='bx bx-filter h3'
                                        style="position: absolute; margin-top: -20px; margin-left: -33px; cursor: pointer;"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="list in lists" v-bind:key="list.id">
                                <td>
                                    <div class="avatar-xs">
                                        <span class="avatar-title rounded-circle">{{list.type.charAt(0)}}</span>
                                    </div>
                                </td>
                                <td>{{list.course.name}}</td>
                                <td class="text-center">{{list.certification}}</td>
                                <td class="text-center">{{list.validity}}</td>
                                <td class="text-end">
                                    <a class="me-3 text-warning" @click="edit(list)"><i class='bx bx-edit-alt'></i></a>
                                    <a class="text-danger"><i class='bx bx-trash'></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <Course ref="course" @info="message" />
</template>

<script>
    import Course from "./Modals/Course.vue";
    import Header from "@/Shared/Header.vue";
    import Pagination from "@/Shared/Pagination.vue";
    import _ from 'lodash';
    export default {
        components: {
            Header,
            Pagination,
            Course
        },
        inject: ['height'],
        props: {
            school: Object
        },
        data() {
            return {
                currentUrl: window.location.origin,
                title: "School Profile",
                items: [{
                        text: "School",
                        href: "/",
                    },
                    {
                        text: "Profile",
                        active: true,
                    },
                ],
                lists: []
            }
        },

        created() {
            this.lists = this.school.data.courses;
        },
        methods: {
            addCourse() {
                this.$refs.course.show(this.school);
            },

            message(list) {

                if (!this.editable) {
                    this.lists.unshift(list);
                    this.lists.splice((this.count2 - 1), 1);
                } else {
                    let index = this.lists.findIndex(u => u.id === list.id);
                    this.lists[index] = list;
                }
            },

            edit(data) {
                this.$refs.course.edit(this.school, data);
            }
        }
    }

</script>
