<template>

    <Head title="DOST" />

    <body>
        <div>
            <nav class="navbar navbar-expand-lg navigation fixed-top sticky" id="navbar">
                <div class="container">
                    <a class="navbar-logo" href="/">
                        <img src="images/logo-dark.png" alt height="19" class="logo logo-dark" />
                        <img src="images/logo-light.png" alt height="19" class="logo logo-light" />
                    </a>

                    <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item"
                        data-toggle="collapse" data-target="#topnav-menu-content" @click="toggleMenu()">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav ms-auto" id="topnav-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="javascript: void(0);">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="javascript: void(0);">About</a>
                            </li>
                        </ul>

                        <div class="ms-lg-2">
                            <Link href="/login" class="btn btn-outline-success w-xs">Sign in</Link>
                        </div>
                    </div>
                </div>
            </nav>
            <div>
                <section class="section hero-section bg-ico-hero" id="home" style="margin-bottom: -230px;">
                    <div class="bg-overlay bg-primary"></div>
                    <div class="container">
                        <div class="row" style="margin-top: -120px;">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-1 me-n2">
                                        <img src="images/sei.png" alt="" class="avatar-sm">
                                    </div>
                                    <div class="col-10 ms-n4">
                                        <div class="text-white-50">
                                            <h5 class="text-white fw-semibold mb-0 hero-title" style="font-size: 21px;">
                                                STSIMS - Science Education Institute </h5>
                                            <p class="font-size-14">Science & Technology Scholarship Information
                                                Management
                                                System</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="about" class="section pt-4 bg-white">
                    <div class="container">
                        <div class="row mt-4">
                            <div class="col-lg-12 mt-4">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <div class="card border mini-stats-wid">
                                            <div class="card-body">
                                                <div class="d-flex flex-wrap">
                                                    <div class="me-3">
                                                        <p class="text-muted mb-1 fw-bold">S&T Undergraduate
                                                            Scholarships</p>
                                                        <h6 class="mb-0 text-success">Appication Open</h6>
                                                    </div>
                                                    <div class="avatar-sm ms-auto">
                                                        <div
                                                            class="avatar-title bg-light rounded-circle font-size-20 text-info">
                                                            <i class="bx bxs-graduation"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-muted border rounded p-3 mt-n3" style="height: 140px;">
                                            <p class="font-size-12">The S&T Undergraduate Scholarships Program aims to stimulate and entice talented Filipino youths to pursue lifetime productive careers in science and technology and ensure a steady, adequate supply of qualified S&T human resources which can steer the country towards national progress.</p>
                                         
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card border mini-stats-wid">
                                            <div class="card-body">
                                                <div class="d-flex flex-wrap">
                                                    <div class="me-3">
                                                        <p class="text-muted mb-1 fw-bold">Junior-Level Science
                                                            Scholarships</p>
                                                        <h6 class="mb-0 text-danger">Appication Closed</h6>
                                                    </div>
                                                    <div class="avatar-sm ms-auto">
                                                        <div
                                                            class="avatar-title bg-light rounded-circle font-size-20 text-primary">
                                                            <i class="bx bx-user-circle"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="text-muted border rounded p-3 mt-n3" style="height: 140px;">
                                            <p class="font-size-12">The Junior Level Science Scholarship (JLSS) Program aims to: provide scholarships that will finance the education of talented and deserving students in their third year of college and who are pursuing degree programs in the areas of science and technology; and ensure a steady, adequate supply of qualified S&T human resources who can steer the country towards national progress.</p>
                                         
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>

                <section id="team" class="section">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card bg-soft bg-info border shadow-none mb-3">
                                    <div class="p-1">
                                        <div class="d-flex mt-1">
                                            <div class="avatar-xs align-self-center ml-2 ms-2 mr-2">
                                                <div class="avatar-title rounded bg-transparent"><i
                                                        class="bx bx-news h4 mt-1"></i></div>
                                            </div>
                                            <div class="overflow-hidden mr-auto align-self-center">
                                                <h5 class="fw-bold font-size-12 mt-1 fw-bold">Announcements</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-4 col-sm-6">
                                        <div class="blog-box mb-4 mb-xl-0">
                                            <div class="position-relative"><img
                                                    src="http://stsims.local/images/post-2.jpg" alt=""
                                                    class="rounded img-fluid mx-auto d-block">
                                                <div class="badge bg-success blog-badge font-size-11">Announcement</div>
                                            </div>
                                            <div class="mt-4 text-muted font-size-12">
                                                <p class="mb-2"><i class="bx bx-calendar me-1"></i> May 14, 2022 6:38 pm
                                                </p>
                                                <h6 class="mb-3 fw-bold">2021 DOST-SEI Undergraduate Scholars</h6>
                                                <p>The long wait is over for the applicants to the 20..</p>
                                                <div><a href="#">Read more</a></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-sm-6">
                                        <div class="blog-box mb-4 mb-xl-0">
                                            <div class="position-relative"><img
                                                    src="http://stsims.local/images/post-1.jpg" alt=""
                                                    class="rounded img-fluid mx-auto d-block">
                                                <div class="badge bg-success blog-badge font-size-11">News</div>
                                            </div>
                                            <div class="mt-4 text-muted font-size-12">
                                                <p class="mb-2"><i class="bx bx-calendar me-1"></i> May 14, 2022 5:57 pm
                                                </p>
                                                <h6 class="mb-3 fw-bold">The DOST-SEI is proud to announce the
                                                    qualifiers for the 2021 Junior Level Science Scholarships! </h6>
                                                <p>Congratulations, scholars! May your journey as sci..</p>
                                                <div><a href="#">Read more</a></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-sm-6">
                                        <div class="blog-box mb-4 mb-xl-0">
                                            <div class="position-relative"><img
                                                    src="http://stsims.local/images/default.jpg" alt=""
                                                    class="rounded img-fluid mx-auto d-block">
                                                <div class="badge bg-success blog-badge font-size-11">News</div>
                                            </div>
                                            <div class="mt-4 text-muted font-size-12">
                                                <p class="mb-2"><i class="bx bx-calendar me-1"></i> May 14, 2022 5:54 pm
                                                </p>
                                                <h6 class="mb-3 fw-bold">STSIMS version 1 released.</h6>
                                                <p>The Science and Technology Scholarship Information..</p>
                                                <div><a href="#">Read more</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card bg-soft bg-info border shadow-none mb-3">
                                    <div class="p-1">
                                        <div class="d-flex mt-1">
                                            <div class="avatar-xs align-self-center ml-2 ms-2 mr-2">
                                                <div class="avatar-title rounded bg-transparent"><i
                                                        class="bx bx-info-circle h4 mt-1"></i></div>
                                            </div>
                                            <div class="overflow-hidden mr-auto align-self-center">
                                                <h5 class="fw-bold font-size-12 mt-1 fw-bold">Quick Links</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card border"><a href="https://www.science-scholarships.ph" target="_blank">
                                        <div class="card-body">
                                            <div class="d-flex flex-wrap">
                                                <div class="avatar-sm">
                                                    <div
                                                        class="avatar-title bg-light rounded-circle font-size-20 text-primary">
                                                        <i class="bx bxs-window-alt"></i></div>
                                                </div>
                                                <div class="ms-3 mt-1">
                                                    <p class="fw-bold text-truncated mb-0">S&amp;T E-Scholarship </p>
                                                    <h5 class="mb-0 text-muted font-size-12">Web Application System</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </a></div>
                                <div class="card border mt-n3"><a
                                        href="https://www.sei.dost.gov.ph/images/stsd/ugradFAQ.pdf" target="_blank">
                                        <div class="card-body">
                                            <div class="d-flex flex-wrap">
                                                <div class="avatar-sm">
                                                    <div
                                                        class="avatar-title bg-light rounded-circle font-size-20 text-warning">
                                                        <i class="bx bxs-user-voice"></i></div>
                                                </div>
                                                <div class="ms-3 mt-1">
                                                    <p class="fw-bold text-truncated text-warning mb-0">Frequently Asked
                                                        Questions </p>
                                                    <h5 class="mb-0 text-muted font-size-12">DOST - Science Education
                                                        Institute</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </a></div>
                                <div class="card border  mt-n3">
                                    <div class="card-body">
                                        <div class="d-flex flex-wrap">
                                            <div class="avatar-sm">
                                                <div
                                                    class="avatar-title bg-light rounded-circle font-size-20 text-primary">
                                                    <img src="images/sei.png" alt="" class="ms-1" style="width: 25px;">
                                                </div>
                                            </div>
                                            <div class="ms-3 mt-1"><a href="https://www.sei.dost.gov.ph/"
                                                    target="_blank">
                                                    <p class="fw-bold text-truncated mb-0">Science Education Institute
                                                    </p>
                                                </a> <a href="https://www.dost.gov.ph/" target="_blank">
                                                    <h5 class="mb-0 text-muted font-size-12">Department of Science and
                                                        Technology
                                                    </h5>
                                                </a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group bg-light rounded mb-3"><input type="email"
                                        placeholder="Enter Email address" aria-label="Recipient's username"
                                        aria-describedby="button-addon2" class="form-control bg-transparent border-0">
                                    <div class="input-group-append"><button type="button" id="button-addon2"
                                            class="btn btn-primary rounded"><i class="bx bx-envelope"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="about" class="section pt-4 bg-white">
                    <div class="container">
                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <div class="text-center mb-5">
                                    <div class="small-title">Search / Filter</div>
                                    <h4>Priority S&T Programs and Study Placement</h4>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row g-3">
                                    <div class="col-lg-12">

                                        <div class="input-group mb-2" ref="www">
                                            <label class="input-group-text bg-light"> <i
                                                    class='bx bx-search-alt'></i></label>
                                            <input type="text" class="form-control" style="width: 55%;"
                                                placeholder="Search..." v-model="keyword" />

                                            <select v-model="type" @change="fetch()" placeholder="Choose type"
                                                class="form-select" style="width: 100px;">
                                                <option value="school" selected>School</option>
                                                <option value="course">Course</option>
                                            </select>
                                            <label v-if="type == 'school'" style="cursor: pointer;" @click="openf=openFilter('location')"
                                                class="input-group-text bg-light"> <i class='bx bxs-map'
                                                    :class="(Object.keys(this.arr).length > 0) ? 'bx-flashing text-primary' : ''"></i></label>
                                        </div>
                                        <div class="table-responsive" v-if="lists.length > 0">
                                            <ul class="float-end list-inline user-chat-nav text-end mb-0 dropdown">
                                                <Pagination @fetch="fetch" :links="links" :pagination="meta"/>
                                            </ul>   
                                            <h5 class="font-size-13 card-title mt-3 mb-2">List of Schools</h5>
                                            <table class="table table-nowrap align-middle">
                                                <tbody>
                                                    <tr v-for="list in lists" v-bind:key="list.id" style="cursor: pointer;" @click="view(list)">
                                                        <td class="text-start" style="width: 50px;"><img :src="currentUrl+'/images/'+list.avatar"
                                                                class="rounded-circle avatar-xs" alt=""></td>
                                                        <td>
                                                            <h5 class="font-size-12 m-0 text-dark">{{ list.name }} - {{ list.campus }}</h5>
                                                        </td>
                                                        <td class="text-end">
                                                            {{ list.region.region }}, {{ list.province.name }}, {{ list.municipality.name }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div v-else>
                                            <div v-if="keyword.length > 0" class="alert alert-warning mt-3" role="alert">No record found.</div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <footer class="landing-footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <img src="images/logo-light.png" alt height="20" />
                                </div>
                                <p class="mb-2">{{ new Date().getFullYear() }} © DOST-IX</p>
                            </div>
                        </div>
                    </div>
                </footer>
                <Priority ref="priority"/>
                <FilterLocation :regions="regions" @status="message" ref="location" />
            </div>
        </div>
    </body>
</template>
<script>
    import _ from 'lodash';
    import FilterLocation from '../Pages/Schools/Modals/FilterLocation.vue';
    import Priority from './Modals/Priority.vue';
    import Pagination from "@/Shared/Pagination.vue";
    export default {
        layout: null,
        components: {
            FilterLocation, Priority, Pagination
        },
        props: ['dropdowns', 'regions'],
        data() {
            return {
                currentUrl: window.location.origin,
                keyword: '',
                type: 'school',
                arr: {},
                lists: [],
                meta: {},
                links: {},
            };
        },

        created() {
            window.addEventListener("scroll", this.windowScroll);
        },

        destroyed() {
            window.removeEventListener("scroll", this.windowScroll);
        },

        watch: {
            keyword(newVal) {
                this.checkSearchStr(newVal)
            },
            type() {
                this.lists = [];
                this.keyword = '';
            }
        },

        methods: {
            checkSearchStr: _.debounce(function (string) {
                this.fetch();
            }, 300),

            fetch(page_url) {
                if(this.keyword != ''){
                    let location = (Object.keys(this.arr).length == 0) ? '-' : JSON.stringify(this.arr);
                    page_url = page_url || '/search/' + this.type;
                    axios.get(page_url, {
                            params: {
                                keyword: this.keyword,
                                location: location,
                            }
                        })
                        .then(response => {
                            if (response) {
                                this.lists = response.data.data;
                                this.meta = response.data.meta;
                                this.links = response.data.links;
                            }
                        })
                        .catch(err => console.log(err));
                }
            },

            windowScroll() {
                const navbar = document.getElementById("navbar");
                if (
                    document.body.scrollTop >= 50 ||
                    document.documentElement.scrollTop >= 50
                ) {
                    navbar.classList.add("nav-sticky");
                } else {
                    navbar.classList.remove("nav-sticky");
                }
            },

            openFilter(type, val = null) {
                this.$refs[type].set(val);
                this.editable = type;
            },

            toggleMenu() {
                document.getElementById("topnav-menu-content").classList.toggle("show");
            },

            message(list) {
                this.arr = list;
                this.fetch();
            },

            view(data){
                this.$refs.priority.set(data);
            }
        }
    }

</script>
