<script>
   export default {
        data(){
            return {
                products:false,
                data:false,
            }
        },
        mounted() {
            this.getCart();
        },
        computed: {
            getProduct(){
                if( this.products ){
                    this.data = this.products;
                    return this.data;
                }else{
                    return this.data;
                }
            }
        },
        methods:{
            getCart(){
                axios.get(this.$url+'/cart/get')
                .then(response=>{
                    this.products = response.data;
                })
            },
            minus(id){
                axios.post(this.$url+'/cart/minus/'+id)
                .then(response=>{
                    this.products = response.data;
                })
            },
            plus(id){
                axios.post(this.$url+'/cart/plus/'+id)
                .then(response=>{
                    this.products = response.data;
                })
            }
        }
    }
</script>
