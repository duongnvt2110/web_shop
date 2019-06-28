<template>
    <div>
        <div class="input-group mb-2">
            <input type="text" v-model="search_text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
            <!-- <select  @change="getCategoryChange"  class="custom-select" id="inputCategorys">
                <option selected value="null">Choose...</option>
                <option value="null">Tất Cả</option>
                <option v-for="category in categories" :value="category.id">{{category.name}}</option>
            </select> -->
            <select @change='getLatest' class="custom-select" id="orderLatest">
                <option selected>Choose...</option>
                <option value="desc">Đơn Hàng Mới</option>
                <option value="asc">Đơn Hàng Cũ</option>
            </select>
        </div>
        <div class="card" v-for="order in reloadOrder" v-if='order["products"].length !==0' >
            <div class="card-header">
                <div class="float-left" :style="(order['cancel']===1 )?'color:#bd2130;':'color:#28a745;'">
                    <a>{{order.id}}</a>
                    <div v-if="order['cancel']===1">
                        <span>Order Cancelled</span>
                    </div>
                    <div v-else-if="order['confirm']===1 &&  order['delivery']!==1">
                        <span>Order Verify</span>
                    </div>
                    <div v-else-if="order['confirm']===1 &&  order['delivery']===1">
                        <span>Order Delivery</span>
                    </div>
                </div>
                <div class="float-right mr-3">
                    <a @click="confirmOrder(order.id)"
                    class="btn " :class="(order['confirm']===1 || order['cancel']===1 || order['delivery']===1) ?'disabled':''"
                        role="button" aria-disabled="true">
                        <i class="fa fa-check" data-toggle="tooltip" title="Verify Order"
                            :style="(order['confirm']===1)?'color:#28a745;':'color:#3490dc;'">
                        </i>
                    </a>
                    <a @click="cancelOrder(order.id)"
                        :class="(order['confirm']===1 || order['cancel']===1 || order['delivery']===1 )?'disabled':''"
                        class="btn " role="button" aria-disabled="true">
                        <i class="fa fa-times" data-toggle="tooltip" title="Cancel Order"
                            :style="(order['cancel']===1)?'color:#bd2130;':'color:#3490dc;'"></i>
                    </a>
                    <a @click="deliveryOrder(order.id)"
                        :class="(order['confirm'] !==1 || order['cancel']===1) ?'disabled':''"
                        class="btn " role="button" aria-disabled="true">
                        <i class="fas fa-truck" data-toggle="tooltip" title="Verify Delivery"
                            :style="(order['delivery']===1)?'color:#28a745;':'color:#3490dc;'"></i>
                    </a>
                    <a @click="deleteOrder(order.id)"
                        class="">
                        <i class="fa fa-trash fa-lg" style="color:#3490dc;"></i>
                    </a>
                </div>

            </div>
            <div class="card-body">
                 <div class="justify-content-center card">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-striped table-product">
                            <colgroup>
                                <col :style="{width: '100px'}">
                                <col :style="{width: '100px'}">
                                <col :style="{width: '100px'}">
                                <col :style="{width: '100px'}">
                                <col :style="{width: '50px'}">
                                <col :style="{width: '50px'}">
                                <col :style="{width: '50px'}">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Number Phone</th>
                                    <th scope="col">Product Image</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Quality</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="product in order['products']">
                                    <td>
                                        {{order.user.name}}
                                    </td>
                                    <td>
                                        {{order.user.phone_number}}
                                    </td>
                                    <td><img class="img-thumbnail"
                                        v-bind:src="product.thumnail" :style="{ height:'70px',width: '100px'}"/>
                                    </td>
                                    <td><a href="#">{{product.product_name}}</a></td>
                                    <td>
                                        {{product.pivot.quantity}}
                                    </td>
                                    <td>
                                        {{(
                                        product.price*product.pivot.quantity
                                        *product.fee_ship*product.tax)
                                        .toLocaleString()
                                        }}
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
    export default {
       data(){
            return {
                data:false,
                order:false,
                search_text:null,
                latest:null,
            }
        },
        watch:{
            search_text(){
                // this.searchProduct();
                this.debouncedGetAnswer();
            },
            latest(){
                this.debouncedGetAnswer();
            }
        },
        created(){
            //_.debounce is a function provided by lodash to limit how
            this.debouncedGetAnswer = _.debounce(this.searchOrder, 500)
        },
        mounted(){
            this.getOrder();
        },
        computed:{
            reloadOrder(){
                if(! this.order ){
                    return this.data;
                }else{
                    this.data = this.order;
                    return this.data;
                }
            }
        },
        methods:{
             getOrder(){
                axios.get(this.$url+'/admin/show/order/')
                .then(response=>{
                    this.data = response.data;
                })
            },
            confirmOrder(order_id){
                axios.patch(this.$url+'/admin/confirm/order/'+order_id )
                .then(response=>{
                    this.order= response.data
                });
                flash('Order Has Been Verified','success');
            },
            deliveryOrder(order_id){
                axios.patch(this.$url+'/admin/delivery/order/'+order_id )
                .then(response=>{
                    this.order= response.data
                });
                flash('Order Has Been Delivery','success');
            },
            cancelOrder(order_id){
                axios.patch(this.$url+'/admin/cancel/order/'+order_id )
                .then(response=>{
                    this.order= response.data
                });
                flash('Order Has Been Cancelled','success');
            },
            deleteOrder(order_id){
                axios.delete(this.$url+'/admin/delete/order/'+order_id )
                .then(response=>{
                    this.order= response.data
                });
                flash('Order Has Been Delete','success');
            },
            searchOrder(){
                axios.post(this.$url+'/admin/order/search?text='+this.search_text+
                    '&latest='+this.latest,{
                        search_text:this.search_text,
                        latest:this.latest
                })
                .then(response=>{
                    this.data = response.data;
                });
            },
            getLatest(e){
                this.latest =  e.target.value;
            }
        }
    }
</script>
