<template>
    <div>
        <div class="card" v-for="order in reloadOrder" v-if='order["products"].length !==0' >
            <div class="card-header" :style="(order['cancel']===1)?'color:#bd2130;':'color:#28a745;'">
                <div class="float-left d-inline-block">
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
                <div class="float-right d-inline-block mr-3">
                    <a class="btn" role="button">
                        <i class="fa fa-check" data-toggle="tooltip"
                            :title="(order['confirm']===1)?'Verify Order':'Not Verify'"
                            :style="(order['confirm']===1)?'color:#28a745;':'color:#3490dc;'">
                        </i>
                    </a>
                    <a @click="cancelOrder(order.id)"
                        :class="(order['confirm']===1 || order['cancel']===1)?'disabled':''"
                        class="btn " role="button" aria-disabled="true">
                        <i class="fa fa-times" data-toggle="tooltip" title="Cancel Order"
                            :style="(order['cancel']===1)?'color:#bd2130;':'color:#3490dc;'">
                        </i>
                    </a>
                    <a
                        class="btn  " role="button" aria-disabled="true">
                        <i class="fas fa-truck" data-toggle="tooltip"
                            :title="(order['delivery']===1)?'Verify Delivery':'Not Delivery'"
                            :style="(order['delivery']===1)?'color:#28a745;':'color:#3490dc;'"></i>
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
                                <col :style="{width: '50px'}">
                                <col :style="{width: '50px'}">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Quality</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody >
                               <tr v-for="product in order['products']"  >
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
                order:false
            }
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
                axios.get(this.$url+'/show/order/'+window.App.user)
                .then(response=>{
                    this.data = response.data;
                })
            },
            cancelOrder(order_id){
                axios.patch(this.$url+'/cancel/order/'+order_id )
                .then(response=>{
                    this.order= response.data
                });
                flash('Order Has Been Cancelled','success');
            }

        }
    }
</script>
