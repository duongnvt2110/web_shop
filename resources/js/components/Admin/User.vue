<template>
    <div class="container-fuild ">
        <div class="row justify-content-center">
            <div class="col mb-2">
                <input type="text" v-model="search_text" class="form-control" placeholder="Search" aria-label="Username">
            </div>
            <div class="col-md-12 table-responsive">
                <admin-view-user :users='getUser' v-on:rule="getUserRule" v-on:delete="getUserFromChild"></admin-view-user>
            </div>
            <paginate :paginate='getUser' @paginate='getPaginateUser'></paginate>
        </div>
    </div>
</template>

<<script>

    import AdminViewUser from './AdminViewUser.vue';

    export default {

        components :{ AdminViewUser },

        data(){
            return {
                users:false,
                paginate:false,
                search_text:null,
            }
        },
        watch:{
            search_text(){
                this.debouncedGetAnswer();
            }
        },
        created(){
            //_.debounce is a function provided by lodash to limit how
            this.debouncedGetAnswer = _.debounce(this.getSearchUser, 500)
        },
        mounted() {
            this.getPaginateUser();
        },
        computed:{
            getUser(){
                if( ! this.users ){
                    return this.paginate;
                }else if(this.users.total < this.paginate.total){
                    this.paginate = this.users;
                    return this.paginate;
                }else{
                    return this.paginate;
                }
            }
        },
        methods: {
            getPaginateUser(page){
                axios.get(this.getFullUrl(page))
                .then(response=>{
                    this.paginate = response.data;
                });
            },
            getSearchUser(){
                axios.post(this.$url+'/admin/user/search?text='+this.search_text,{
                    search_text:this.search_text,
                })
                .then(response=>{
                    this.paginate = response.data;
                });
            },
            getUserFromChild(value){
                this.users = value;
            },
            getUserRule(value){
                this.paginate = value;
            },
            getUrl(){
                var reg= /(.*?)\/public/g;
                var url = reg.exec(location.pathname);
                return url[0];
            },
            getFullUrl(page){

                if( !page ){

                    let reg =/(\d+)/g;

                    let query = location.search.match(reg);

                    page = query ? query[0]: 1;

                }
                return this.$url+'/admin/paginate/user?page='+ page;
            }
        },
    }
</script>
