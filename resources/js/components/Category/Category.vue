<template>
    <div class="container-fuild ">
        <div class="row justify-content-center">

            <create-category v-on:store="getCategoryFromchild" v-on:update="updateCategoryFromchild" ></create-category>

            <div class="col-md-6 table-responsive">

                <show-category
                    :categories='getCategories'
                    v-on:store="getCategoryFromchild"
                    v-on:update="updateCategoryFromchild" >
                </show-category>

                <paginate :paginate='getCategories' @paginate="getPaginateCategories"></paginate>
            </div>

        </div>
    </div>
</template>


<script>
    import CreateCategory from './FormCategory.vue';
    import ShowCategory from './ShowCategory.vue';

    export default {

        components: {CreateCategory,ShowCategory},

        data(){
            return {
                categories: false,
                paginate:false,
            }
        },
        mounted() {
            this.getPaginateCategories();
        },
        computed:{
            getCategories(){
                if( ! this.categories ){
                    return this.paginate;
                }else if(this.categories.total > this.paginate.total){
                        this.paginate = this.categories;
                        return this.categories;
                }else if(this.categories.total < this.paginate.total){
                        this.paginate = this.categories;
                        return this.categories;
                }else{
                    return this.paginate;
                }
            },
        },
        methods:{
            getPaginateCategories(page){
                axios.get(this.getFullUrl(page))
                .then(response=>{
                    this.paginate = response.data;
                });
            },
            getCategoryFromchild(value){
                this.categories = value;
            },
            updateCategoryFromchild(value){
                this.paginate = value;
            },
            getFullUrl(page){
                if(! page){

                    // return 'error'
                    let reg =/(\d+)/g;

                    // let query = reg.exec(location.href);

                    let query = location.search.match(reg);

                    page = query ? query[0]: 1;

                }
                return this.$url+'/admin/paginate/categories?page='+ page;
            }
        }
    }
</script>
