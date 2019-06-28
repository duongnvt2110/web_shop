@extends('layouts.app')
@section('content')

<form action="{{route('product.store')}}" method="post">
    {{ csrf_field() }}
    {{--  <input type="hidden" name="_token" :value="csrf">  --}}
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card card-header">
                    <strong>Infomation</strong>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text" name="product_name" class="form-control"
                            placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="name">Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Choose One...</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}"
                                    {{ old('category_id') == $category  ->id ? 'selected' : '' }}>
                                    {{$category->slug}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="short-description">Short Descriptions</label>
                        <textarea class="form-control" name="short_description"
                            rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="full-description">Full Description</label>
                        <textarea id="my-editor" name="full_description" class="form-control">{!! old('content', 'test editor content') !!}</textarea>
                        {{--  <!-- <ckeditor :editor="editor" v-model="editorData" :config="editorConfig" ></ckeditor> -->
                        <!-- <textarea class="form-control" id="editor"></textarea> -->  --}}
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
                            <input type="number" name="price" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-sm-4 my-1">
                        <div class="form-group">
                            <label for="short-description">Tax</label>
                            <input type="number" name="tax" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-sm-4 my-1">
                        <div class="form-group">
                            <label for="short-description">Fee Ship</label>
                            <input type="number" name="fee_ship" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-2">
                <div class="card-header ">
                    <button class="btn btn-outline-secondary float-right" type="submit" name="published" value='1'>Published</button>
                    <button class="btn btn-outline-secondary float-left" type="submit" name="published" value='0'>Save a Draft</button>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <strong>Thumbnail</strong>
                </div>
                <div class="card-body">
                    <div class="custom-file">
                        <span class="input-group-btn">
                            <a id="lfm-s" data-input="thumbnail" data-preview="single" class="btn btn-primary">
                                <i class="fa fa-picture-o"></i> Choose
                            </a>
                            </span>
                    </div>
                </div>
                <div class="card-footer " id="image-thumnail">
                    <input id='url_thumbail' type='hidden' name='thumnail' class='form-control'>
                    <img id="single" style="margin-top:15px;max-height:100px;">
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <strong>Related Images</strong>
                </div>
                <div class="card-body">
                    <div class="custom-file">
                        <span class="input-group-btn">
                            <a id="lfm-m" data-input="multi" data-preview="multi" class="btn btn-primary">
                              <i class="fa fa-picture-o"></i> Choose
                            </a>
                          </span>
                    </div>
                </div>
                <div class="card-footer " id="image-relation">
                    <img id="multi" style="margin-top:15px;max-height:100px;">
                </div>
            </div>
        </div>
    </div>
</form>

{{--  <create-product></create-product>  --}}
@endsection
@section ('scripts')
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
    var options = {
            filebrowserImageBrowseUrl: './laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: './laravel-filemanager/upload?type=Images&_token='+ $('meta[name=csrf-token]').attr("content"),
            filebrowserBrowseUrl: './laravel-filemanager?type=Files',
            filebrowserUploadUrl: './laravel-filemanager/upload?type=Files&_token='+ $('meta[name=csrf-token]').attr("content")
        };
</script>
<script>
     CKEDITOR.replace('my-editor', options);
</script>
<script>
    var route_prefix = "./laravel-filemanager";
</script>
<script>
    {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/lfm.js')) !!}
</script>
<script>
    $('#lfm-m').filemanager('image', {prefix: route_prefix});
    $('#lfm-s').filemanager('image', {prefix: route_prefix});
</script>
<script

</script>
@endsection

