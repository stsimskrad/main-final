<template>
    <b-modal v-model="showModal" size="lg" title="Priority S&T Programs and Study Placement" hide-footer no-close-on-backdrop centered>
        <div class="row">
            <div class="card-body border-bottom mt-n2">
                <div class="d-flex align-items-start mt-n3 mb-n2">
                    <div class="flex-shrink-0 me-3">
                        <img :src="currentUrl+'/images/'+list.avatar" alt=""
                            class="avatar-md rounded-circle img-thumbnail">
                    </div>
                    <div class="flex-grow-1 align-self-center">
                        <div class="text-muted">
                            <h6 class="mb-0">{{ list.name }}</h6>
                            <p class="mb-0">{{ list.municipality.name }},
                                {{ list.province.name }}, {{ list.region.region }}</p>
                            <p class="mb-n1">{{ list.shortcut}} - <span
                                    class="text-info">{{ list.campus }}</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-nowrap align-middle">
                        <tbody>
                            <tr v-for="course in list.courses" v-bind:key="course.id">
                                <td>
                                    <h5 class="font-size-12 m-0 text-dark">{{ course.name }}</h5>
                                </td>
                                <td class="text-center">
                                    {{ course.certification }}
                                </td>
                                <td class="text-end">
                                    {{ course.years }} years
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </b-modal>
</template>
<script>
export default {
    data(){
        return {
            currentUrl: window.location.origin,
            showModal: false,
            list: { municipality: {}, province: {}, region: {}}
        }
    },

    methods: {
        set(data){
            this.showModal = true;
            this.list = data;
        }
    }
}
</script>