<template>
    <div>
        <div class="card" >
            <div class="card-header">
                <span>Cart Shop</span>
                <button class="btn btn-primary float-right mr-5" @click="storeOrder()">Pay It</button>
            </div>
            <div class="card-body">
                 <div class="justify-content-center card">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-striped table-product">
                            <colgroup>
                                <col :style="{width: '100px'}">
                                <col :style="{width: '100px'}">
                                <col :style="{width: '50px'}">
                                <col :style="{width: '50px'}">
                                <col :style="{width: '100px'}">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Quality</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="product in getProduct">
                                    <td><img class="img-thumbnail" v-bind:src="product.thumnail" :style="{ height:'70px',width: '100px'}"/></td>
                                    <td><a href="#">{{product.product_name}}</a></td>
                                    <!-- <td><a v-text="getCategoryProduct(product.category_id)">123</a></td> -->
                                    <td>
                                        <div class="row justify-content-center">
                                            <div class="input-group-text" style="padding: 0.175rem 0.45rem;"  @click.capture="minus(product.id)">-</div>
                                            <div  class="col col-md-2 form-control" style="padding: 0.175rem 0.55rem;">{{product.quantity}}</div>
                                            <div class="input-group-text" style="padding: 0.175rem 0.45rem;" @click="plus(product.id)">+</div>
                                        </div>
                                    </td>
                                    <td>{{(product.price*product.quantity*product.fee_ship*product.tax).toLocaleString()}}</td>
                                    <td>
                                        <a @click="deleteCart(product.id)" class="product-action"><i class="fa fa-trash fa-lg" style="color:#3490dc;"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import CartAction from '../../mixins/CartAction.vue';
    export default {
        mixins: [CartAction],
        methods:{
            storeOrder(){
                 axios.post(this.$url+'/buy',{
                     data : this.data
                 })
                .then(response=>{
                    this.products = response.data;
                    flash('Order Has Been Created');
                    setTimeout(() => {
                        window.location.replace(this.$url+'/home');
                    }, 3000);
                })
            },
            deleteCart(id){
                axios.delete(this.$url+'/cart/delete/'+id)
                .then(response=>{
                    this.products = response.data;
                })
            }
        }
    }
</script>
