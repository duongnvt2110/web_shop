<<template>
    <div>
        <h4 class="header-text text-center ">All Product</h4>
        <div class="row">
            <div class="col-md-3 col-sm-6" v-for="product in products">
                <div class="card card-blue">
                    <div class="icon">
                        <img class="img-thumbnail" :src="product.thumnail"/>
                    </div>
                    <div class="text">
                        <h4 class="my-0 font-weight-normal">{{product.name}}</h4>
                        <h1 class="card-title pricing-card-title">{{product.price}} <small class="text-muted">/ mo</small></h1>
                        <p>All appointments sync with your Google calendar so your availability is always up to date. See your schedule at a glance from any device.</p>
                        <button type="button" @click="addToCart(product.id)" class="btn btn-lg btn-block btn-outline-primary">Add To Cart</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="card mb-4 shadow-sm" >
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">{{product.name}}</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">{{product.price}} <small class="text-muted">/ mo</small></h1>
                    <ul class="list-unstyled mt-3 mb-4">
                    <li>{{product.full_description}}</li>
                    <li>2 GB of storage</li>
                    <li>Email support</li>
                    <li>Help center access</li>
                    </ul>
                    <button type="button" @click="addToCart(product.id)" class="btn btn-lg btn-block btn-outline-primary">Add To Cart</button>
                </div>
            </div>
        </div> -->
    </div>
</template>
<script>
    export default {
        props:['products'],
        methods:{
            buyIt(id){
                axios.post(this.$url+'/buy/'+id,{
                    product_id: id,
                }).then(response=>{
                    console.log(response);
                }).catch(error=>{
                    console.log(error.data);
                });
            },
            addToCart(id){
                axios.post(this.$url+'/cart/add/'+id,{
                    product_id: id,
                }).then(response=>{
                    window.events.$emit('add',response.data);
                }).catch(error=>{
                    console.log(error.response);
                    flash(error.response.statusText,'danger');
                    setTimeout(() => {
                        window.location.replace(this.$url+'/login');
                    }, 3000);
                });
            }
        }
    }
</script>
