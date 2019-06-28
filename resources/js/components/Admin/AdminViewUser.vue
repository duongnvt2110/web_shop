<template>
        <div class="card">
            <table class="table table-striped table-product">
                <colgroup>
                    <col :style="{width: '100px'}">
                    <col :style="{width: '100px'}">
                    <col :style="{width: '100px'}">
                    <col :style="{width: '100px'}">
                    <col :style="{width: '100px'}">
                </colgroup>
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Verify</th>
                        <th scope="col">Created On</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users.data">
                        <td>{{user.name}}</td>
                        <td>{{user.email}}</td>
                        <td>{{user.confirmed}}</td>
                        <td>{{user.created_at}}</td>
                        <td>
                            <a  @click="unlockUser(user.id)" v-if="user.locked" class="product-action" data-toggle="tooltip" title="Unlock User"><i class="fa fa-unlock" style="color:#3490dc;"></i></a>
                            <a  @click="lockUser(user.id)" v-else class="product-action" data-toggle="tooltip" title="Lock User"><i class="fas fa-lock" style="color:#721c24;"></i></a>
                            <a  @click="deleteUser(user.id)" class="product-action" data-toggle="tooltip" title="Delete User"><i class="fa fa-trash fa-lg" style="color:#3490dc;"></i></a>
                            <a  :href="$url+'/admin/user/'+user.id" class="product-action" data-toggle="tooltip" title="Edit User"><i class="fas fa-edit fa-lg" style="color:#3490dc;"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
</template>
<script>
export default {

    props:['users'],

    data(){
        return {
            user:false,
        }
    },
    methods:{
        deleteUser(id){
            axios.delete(this.$url+'/admin/user/delete/'+id)
            .then(response => {
                this.user = response.data;
                this.$emit('delete',this.user)
            })
            .catch(error=>{
                console.log(error);
            });
        },
        lockUser(id){
            axios.get(this.$url+'/admin/user/locked/'+id)
            .then(respone=>{
                this.user = respone.data;
                this.$emit('rule',this.user);
            });

        },
        unlockUser(id){
            axios.get(this.$url+'/admin/user/unlocked/'+id)
            .then(respone=>{
                this.user = respone.data;
                this.$emit('rule',this.user);
            });

        }
    }
}
</script>
