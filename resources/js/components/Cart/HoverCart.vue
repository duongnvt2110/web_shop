<template>
    <div>
        <li class="nav-item">
                <a :href="this.$url+'/cart'" class="nav-link"  >
                    <i @mouseover="mouseHover"
                        class="fas fa-shopping-cart" style="margin-right: 4rem;">
                        <span class="badge badge-light">{{totalQuantity}}</span>
                    </i>

                </a>
            <div class="dropdown">
                <div class="dropdown-menu justify-content-center"
                @mouseleave="mouseHover"
                 v-show="active" style="display:block;min-width:24rem;margin-top: 0.7rem">
                    <div class="justify-content-center card">
                        <table class="table table-striped table-product">
                            <colgroup>
                                <col :style="{width: '100px'}">
                                <col :style="{width: '100px'}">
                                <col :style="{width: '100px'}">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Quality</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="product in getProduct">
                                    <td><img class="img-thumbnail" v-bind:src="product.thumnail" :style="{ height:'70px',width: '100px'}"/></td>
                                    <td><a href="#">{{product.product_name}}</a></td>
                                    <!-- <td><a v-text="getCategoryProduct(product.category_id)">123</a></td> -->
                                    <td>
                                        <div class="row justify-content-center">
                                            <div class="input-group-text" style="padding: 0.175rem 0.45rem;" @click.capture="minus(product.id)">-</div>
                                            <div class="col col-md-2 form-control" style="padding: 0.3rem 0rem;"><a>{{product.quantity}}</a></div>
                                            <div class="input-group-text" style="padding: 0.175rem 0.45rem;" @click="plus(product.id)">+</div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </li>
    </div>
</template>
<script>
    import CartAction from '../../mixins/CartAction.vue';
    export default {
        mixins:[CartAction],
        data(){
            return {
                active:false,
            }
        },
        created(){
            window.events.$on('add',() => {
                this.getCart();
            })
        },
        computed:{
            totalQuantity(){
                let count = 0;

                let item = JSON.parse(JSON.stringify(this.products));

                Object.keys(item).forEach(index => {
                    count += item[index]['quantity'];
                });

                return count;
            }
        },
        methods:{
            mouseHover(){
                this.active=! this.active;
            }
        }
    }
</script>
