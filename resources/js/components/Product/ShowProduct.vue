<template>
   <div class="container-fuild ">
       <div class="input-group mb-2">
            <input type="text" v-model="search_text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
            <select  @change="getCategoryChange"  class="custom-select" id="inputCategorys">
                <option selected value="null">Choose...</option>
                <option value="null">Tất Cả</option>
                <option v-for="category in categories" :value="category.id">{{category.name}}</option>
            </select>
            <select @change='getPriceChange' class="custom-select" id="inputPricing">
                <option selected>Choose...</option>
                <option value="desc">Giá Giảm Dần</option>
                <option value="asc">Giá Tăng Dần</option>
            </select>
        </div>
        <div class="justify-content-center card">
            <div class="col-md-12 table-responsive">
                <table class="table table-striped table-product">
                    <colgroup>
                        <col :style="{width: '100px'}">
                        <col :style="{width: '100px'}">
                        <col :style="{width: '50px'}">
                        <col :style="{width: '50px'}">
                        <col :style="{width: '100px'}">
                        <col :style="{width: '100px'}">
                    </colgroup>
                    <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Published</th>
                            <th scope="col">Date Update</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in getProduct.data">
                            <td><img class="img-thumbnail" v-bind:src="product.thumnail" :style="{ height:'70px',width: '100px'}"/></td>
                            <td><a href="#">{{product.product_name}}</a></td>
                            <!-- <td><a v-text="getCategoryProduct(product.category_id)">123</a></td> -->
                            <td>{{product.price}}</td>
                            <td>{{product.published}}</td>
                            <td>{{product.updated_at}}</td>
                            <td>
                                <a @click="deleteProduct(product.id)" class="product-action"><i class="fa fa-trash fa-lg" style="color:#3490dc;"></i></a>
                                <a :href='$url+"/admin/product/"+product.id' class="product-action"><i class="fas fa-edit fa-lg"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <paginate :paginate="this.data" @paginate="paginateProduct"></paginate>
    </div>
</template>

<script>
    export default {

        props:['categories'],

        data(){
            return {
                products:false,
                data :{
                    current_page:1,
                },
                price:null,
                category:null,
                search_text:null,
            }
        },
        watch:{
            search_text(){
                // this.searchProduct();
                this.debouncedGetAnswer();
            },
            price(){
                this.debouncedGetAnswer();
            },
            category(){
                 this.debouncedGetAnswer();
            }
        },
        mounted(){
            this.paginateProduct();
        },
        created(){
            //_.debounce is a function provided by lodash to limit how
            this.debouncedGetAnswer = _.debounce(this.searchProduct, 500)
        },
        computed:{
            getProduct(){
                if( ! this.products ){
                    return this.data;
                }else if(this.products.total < this.data.total){
                        this.data = this.products;
                    return this.data;
                }else{
                    return this.data;
                }
            },
        },
        methods:{
            paginateProduct(page){
                axios.get(this.getFullUrl(page))
                .then(response =>{
                    this.data = response.data;
                }).catch(error=>{
                   console.log(error);
                });
            },
            deleteProduct(id){
                axios.delete(this.$url+'/admin/product/'+id)
                .then(response => {
                        this.products = response.data;
                        flash('Delete Product Success');
                    }
                )
                .catch(error=>{
                    if(error.response.status===403){
                         flash(error.response.data,'danger');
                    }
                });
            },
            getCategoryProduct(id){
                this.categories.forEach(element => {
                    if(element.id === id){
                        return element.name;
                    }
                    return element.name;
                });
            },
            searchProduct(){
                axios.post(this.$url+'/admin/product/search',{
                        search_text:this.search_text,
                        price:this.price,
                        category:this.category

                })
                .then(response=>{
                    this.data = response.data;
                });
            },
            getPriceChange(e){
                this.price =  e.target.value;
            },
            getCategoryChange(e){
                console.log(e.target.value);
                this.category =  e.target.value;
            },
            getFullUrl(page){
                if(! page){

                    let reg =/(\d+)/g;

                    // let query = reg.exec(location.href);

                    let query = location.search.match(reg);

                    page = query ? query[0]: 1;

                }
                return this.$url+'/admin/paginate/product?page='+ page;
            }
        }

    }
</script>
