<template>
    <div>
        <div class="card" >
            <div class="card-header">
                <button class="btn btn-primary" @click="updateInfo(info.id)">Update</button>
            </div>
            <div class="card-body">
                <div class="float-left col col-md-6">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Name</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" v-model="item.name">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Email</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" v-model="item.email">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Created On</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" readonly v-model="info.created_at">
                    </div>
                </div>
                <div class="float-right col col-md-6">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Address</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" v-model="item.address">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Phone Number</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" v-model="item.phone_number">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Last Activity</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" readonly v-model="info.last_activity">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
      props:['info'],
      data(){
          return {
              data:false,
              item:{
                name:this.info.name,
                phone_number:this.info.phone_number,
                email:this.info.email,
                address:this.info.address,
            }

          }
      },
      methods:{
        updateInfo(id){
            axios.patch(this.$url+'/update/info/'+id,{
                name:this.item.name,
                email:this.item.email,
                address:this.item.address,
                phone_number:this.item.phone_number,
            })
            .then(response=>{
                this.data = response.data;
            })
        }
      }
    }
</script>
