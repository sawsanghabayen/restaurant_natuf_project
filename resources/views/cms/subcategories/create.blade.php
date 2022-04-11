@extends('cms.parent')

@section('title','Temp')
@section('page-lg','Temp')
@section('main-pg-md','CMS')
@section('page-md','Temp')

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
                        <h3 class="card-title">{{__('cms.create_subcategory')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
            
                    <form id="create-subcategory">
                        @csrf
                           <div class="card-body">
                            <div class="form-group">
                                <label>{{__('cms.category')}}</label>
                                <select class="form-control" id="category_id">
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">{{__('cms.title')}}</label>
                                <input type="text" class="form-control" id="title" placeholder="{{__('cms.title')}}">
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
                            <button type="button" onclick="performStore()"
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
    function performStore() {
        var formData = new FormData();
        formData.append('category_id', document.getElementById('category_id').value);
        formData.append('title', document.getElementById('title').value);
        formData.append('image',document.getElementById('subcategory_image').files[0]);

        axios.post('/cms/admin/subcategories',formData)
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            document.getElementById('create-subcategory').reset();
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }
</script>
@endsection