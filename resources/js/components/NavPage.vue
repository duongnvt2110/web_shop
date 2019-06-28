<<template>
    <div class="card">
        <ul class="nav flex-column">
            <li class="nav-item" >
                <a class="nav-link active" :href="this.$url+'/admin/home' ">Dashboard</a>
            </li>
            <li class="nav-item" >
                <a class="nav-link" data-toggle="collapse" data-target="#navbarToggleProduct"
                    aria-controls="navbarToggleExtraPage" aria-expanded="false">
                    Product
                </a>
                <div class="collapse" id="navbarToggleProduct" >
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link"  :href="this.$url+'/admin/categories'" >Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  :href="this.$url+'/admin/product/create'" >Create Product</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" :href="this.$url+'/admin/product/show'" >All Product</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" data-target="#navbarToggleUser"
                    aria-controls="navbarToggleExtraPage" aria-expanded="false">
                    Users
                </a>
                <div class="collapse" id="navbarToggleUser" >
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link"  :href="this.$url+'/admin/user'">Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  :href="this.$url+'/admin/user/activity'">Activity Log</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item" >
                <a class="nav-link" data-toggle="collapse" data-target="#navbarToggleOrder"
                    aria-controls="navbarToggleExtraPage" aria-expanded="false">
                    Order
                </a>
                <div class="collapse" id="navbarToggleOrder" >
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link"  :href="this.$url+'/admin/order'">Orders</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link"  role="tab">Link</a>
            </li>
        </ul>
    </div>
</template>

<script>

    export default {
        computed:{
            user(){
                return window.App.user;
            },
            admin(){
                if(window.App.admin){
                    return true;
                }else{
                    return false;
                }
            }
        }
    }
</script>
