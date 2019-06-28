<template>
    <!-- <form @click="published" :action="this.getUrl+'/product/store'" method="post">
        <input type="hidden" name="_token" :value="csrf">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card card-header">
                        <strong>Infomation</strong>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text" name="product_name"  v-model="product_name" class="form-control"  placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="short-description">Short Descriptions</label>
                            <textarea class="form-control" name="short_description" v-model="short_description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="full-description">Full Description</label>
                            <textarea id="my-editor" name="content" class="form-control">{!! old('content', 'test editor content') !!}</textarea>
                            <ckeditor :editor="editor" v-model="editorData" :config="editorConfig" ></ckeditor>
                            <textarea class="form-control" id="editor"></textarea>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <strong>Prices</strong>
                    </div>
                    <div class="card-body form-row">
                        <div class="col-sm-4 my-1">
                            <div class="form-group">
                                <label for="name">Prices</label>
                                <input type="number" name="prices" class="form-control"  placeholder="">
                            </div>
                        </div>
                        <div class="col-sm-4 my-1">
                            <div class="form-group">
                                <label for="short-description">Tax</label>
                                <input type="number" name="tax" class="form-control"  placeholder="">
                            </div>
                        </div>
                        <div class="col-sm-4 my-1">
                            <div class="form-group">
                                <label for="short-description">Fee Ship</label>
                                <input type="number" name="fee" class="form-control"  placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-2">
                    <div class="card-header ">
                        <button class="btn btn-outline-secondary float-right" type="submit" name="published">Published</button>
                        <button class="btn btn-outline-secondary float-left" type="submit" name="saveAndDraft">Save a Draft</button>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <strong>Image</strong>
                    </div>
                    <div class="card-body">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                        <div class="my-3">
                            <img :src="getUrl+'/storage/images/2pZjigAVMNqNrLxtTb2xHUMewDdoHiXmmwXaRW5N.jpeg'" alt="#" class="img-thumbnail">
                            <img :src="getUrl+'/storage/images/2pZjigAVMNqNrLxtTb2xHUMewDdoHiXmmwXaRW5N.jpeg'" alt="#" class="img-thumbnail">
                            <img :src="getUrl+'/storage/images/2pZjigAVMNqNrLxtTb2xHUMewDdoHiXmmwXaRW5N.jpeg'" alt="#" class="img-thumbnail">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form> -->
</template>

<script>
    // import ckeditor from '../mixins/ckeditor.vue';
    export default {
        // mixins:[ckeditor],

        data() {
            return {
                product_name:null,
                short_description:null,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            };
        },
        computed:{

        },
        methods: {
            published(){
                return true;
            }
        }

    }
</script>
