@extends('layouts.app')
@section('content')

<form action="{{route('product.update',['id'=>$id])}}" method="post">
    @method('PATCH')
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
                        <input type="text" name="product_name" value="{{$product->product_name}}" class="form-control"
                            placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="name">Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Choose One...</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{ $product->category->id==$category->id ? 'selected' : '' }}>
                                {{$category->slug}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="short-description">Short Descriptions</label>
                        <textarea class="form-control" name="short_description"
                            row="3">{{$product->short_description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="full-description">Full Description</label>
                        <textarea id="my-editor" name="full_description" value="{{$product->full_description}}"
                            class="form-control">{!! old('content', 'test editor content') !!}</textarea>
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
                            <input type="number" name="price" value="{{$product->price}}" class="form-control"
                                placeholder="">
                        </div>
                    </div>
                    <div class="col-sm-4 my-1">
                        <div class="form-group">
                            <label for="short-description">Tax</label>
                            <input type="number" name="tax" value="{{$product->tax}}" class="form-control"
                                placeholder="">
                        </div>
                    </div>
                    <div class="col-sm-4 my-1">
                        <div class="form-group">
                            <label for="short-description">Fee Ship</label>
                            <input type="number" name="fee_ship" value="{{$product->fee_ship}}" class="form-control"
                                placeholder="">
                        </div>
                    </div>
                    <div class="col-sm-4 my-1">
                        <div class="form-group">
                            <label for="short-description">Publish or Unpublish</label>
                            <input type="text" name="published" value="{{$product->published}}" class="form-control"
                                placeholder="">
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-2">
                <div class="card-header ">
                    <button class="btn btn-outline-secondary float-right" type="submit">Updated</button>
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
                    <input id='url_thumbail' type='hidden' name='thumnail' value="{{$product->thumnail}}" class='form-control'>
                    <img id="single" src="{{$product->thumnail}}" style="margin-top:15px;max-height:100px;">
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <strong>Image</strong>
                </div>
                <div class="card-body">
                    <div class="custom-file">
                        <span class="input-group-btn">
                            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                <i class="fa fa-picture-o"></i> Choose
                            </a>
                        </span>
                    </div>
                </div>
                <div class="card-footer " id="image-relation">
                    <img id="holder" style="margin-top:15px;max-height:100px;">
                    @php $image= (array) json_decode($product->image);@endphp
                    @foreach($image as $item)
                    <div class='as' id="{{$loop->index}}" style="position: relative;display: inline-block;">
                        <input type='hidden' name='image[]' value="{{$item}}" class='form-control'>
                        <i class='fa fa-times delete' id="{{$loop->index}}" style="float:right" aria-hidden='true'></i>
                        <img id="image" name="image" src="{{$item}}" style="max-height:100px;">
                    </div>
                    @endforeach

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
    $(document).ready(function() {
        $(".delete").on('click', function () {
            console.log($(this).attr('id'));
            $("#"+$(this).attr('id')+"").remove();
        });
    });
</script>

@endsection
