<template>
    <div class="col-md-5">
        <div class="card">
            <div class="card card-header">
                <strong>New Category</strong>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" v-model="category_name" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="name">Slug</label>
                    <input type="text" v-model="getCategorySlug" class="form-control" placeholder="" readonly>
                </div>
            </div>
            <div class="card-footer">
                <div class="form-group" v-show="! this.update">
                    <button class="btn btn-outline-secondary float-left" type="submit" @click="store">Published</button>
                </div>
                <div class="form-group" v-show="this.update">
                    <button class="btn btn-outline-secondary float-left" type="submit" @click="updateCategory(id)">Update</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                category_name:null,
                category_slug:null,
                id:null,
                update:false,
            }
        },
        created(){
            window.events.$on('edit',(data) => {
                this.category_name = data.name,
                this.category_slug = data.slug,
                this.id = data.id,
                this.update=true
            })
        },
        computed:{
            getCategorySlug() {
                if(this.category_name !== null){
                    let reg= /\s/g;
                    this.category_slug = this.category_name.toLowerCase().replace(reg,'-');
                    return this.category_slug;
                }
            }
        },
        methods:{
            store(){
                axios.post(this.$url+'/admin/categories/store',{

                    slug:this.category_slug,

                    name:this.category_name

                }).then(response => {

                    this.categories=response.data;

                    flash('Created !');

                    this.$emit('store',this.categories);

                }).catch(error=>{

                    if(error.response.status===422){

                        flash(error.response.data,'danger');

                    }
                })

            },
            updateCategory(id){
                axios.patch(this.$url+'/admin/categories/edit/'+id,{

                    slug:this.category_slug,
                    name:this.category_name,
                    id:this.id,

                }).then(response=>{

                    this.category_name = null,
                    this.category_slug = null,
                    this.id = null,
                    this.update=false;
                    this.categories=response.data;
                    flash('Updated');
                    this.$emit('update',this.categories);

                });
            }
        }
    }
</script>
