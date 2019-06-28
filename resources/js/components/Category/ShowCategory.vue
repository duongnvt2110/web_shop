<template>
        <div class="card">
            <table class="table table-striped table-product">
                <colgroup>
                    <col :style="{width: '100px'}">
                    <col :style="{width: '100px'}">
                    <col :style="{width: '100px'}">
                </colgroup>
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="category in categories.data">
                        <td>{{category.name}}</td>
                        <td>{{category.slug}}</td>
                        <td>
                            <a  @click="deleteCategory(category.id)" class="product-action"><i class="fa fa-trash fa-lg" style="color:#3490dc;"></i></a>
                            <a  @click="getEditCategory(category.id)" class="product-action"><i class="fas fa-edit fa-lg" style="color:#3490dc;"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
</template>
<script>
    export default {
        props: ['categories'],
        data(){
            return {
                items: false,
                data:false,
            }
        },
        methods:{
            deleteCategory(id){
                axios.delete(this.$url+'/admin/categories/delete/'+id)
                .then(response=>{
                    this.items=response.data;
                    this.$emit('store',this.items);
                    flash('delete Success');
                })
            },
            getEditCategory(id){
                 axios.get(this.$url+'/admin/categories/edit/'+id)
                .then(response=>{
                    this.data=response.data;
                    window.events.$emit('edit',this.data);
                })
            }
        }
    }
</script>
