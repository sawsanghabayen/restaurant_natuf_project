@extends('cms.parent')

@section('title',__('cms.sub_categories'))
@section('page_lg',__('cms.sub_categories'))
@section('main_page_md')
<a href="#">Home</a>
@endsection
@section('page_sm',__('cms.sub_categories'))

@section('styles')

@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{__('cms.edit_subcategory')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
            
                    <form id="update-subcategory">
                        @csrf
                           <div class="card-body">
                            <div class="form-group">
                                <label>{{__('cms.category')}}</label>
                                <select class="form-control" id="category_id">
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}" @if($subCategory->category_id == $category->id) selected @endif> 
                                        {{$category->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">{{__('cms.title')}}</label>
                                <input type="text" class="form-control" id="title" value="{{$subCategory->title}}" placeholder="{{__('cms.title')}}">
                            </div>
                            <div class="form-group">
                                <label for="subcategory_image">Sub Category Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="subcategory_image">
                                        <label class="custom-file-label" for="subcategory_image">Choose Image</label>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                            </div>

                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="button" onclick="performUpdate('{{$subCategory->id}}')"
                                class="btn btn-primary">{{__('cms.save')}}</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection

@section('scripts')
<script src="{{asset('cms/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script>
    $(function () { bsCustomFileInput.init() });
</script>
<script>
    function performUpdate(id) {
        var formData = new FormData();
        formData.append('category_id', document.getElementById('category_id').value);
        formData.append('title', document.getElementById('title').value);
        if(document.getElementById('subcategory_image').files[0] != undefined) {
            formData.append('image',document.getElementById('subcategory_image').files[0]);
        }
        formData.append('_method','PUT');

        axios.post('/cms/admin/subCategories/{{$subCategory->id}}',formData)
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            window.location.href = '/cms/admin/subCategories';
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }
</script>
@endsection