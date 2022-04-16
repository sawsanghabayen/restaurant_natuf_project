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
                        <h3 class="card-title">{{__('cms.edit_category')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="create-form">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">{{__('cms.name')}}</label>
                                <input type="text" class="form-control" id="name" value="{{$category->name}}"
                                    placeholder="{{__('cms.name')}}">
                            </div>
                            <div class="form-group">
                                <label for="description">{{__('cms.description')}}</label>
                                <input type="description" class="form-control" id="description" value="{{$category->description}}"
                                    placeholder="{{__('cms.description')}}">
                            </div>
                            <div class="form-group">
                                <label for="category_image">category Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="category_image">
                                        <label class="custom-file-label" for="category_image">Choose file</label>
                                    </div>
                                    {{-- <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="button" onclick="performUpdate('{{$category->id}}')"
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
{{-- <script src="{{asset('js/axios.js')}}"></script> --}}
<script>
    $(function () { bsCustomFileInput.init() });
</script>
<script>
    function performUpdate(id) {
        var formData = new FormData();
        formData.append('name',document.getElementById('name').value);
        formData.append('description',document.getElementById('description').value);
        if(document.getElementById('category_image').files[0] != undefined) {
            formData.append('image',document.getElementById('category_image').files[0]);
        }
        formData.append('_method','PUT');

        axios.post('/cms/admin/categories/{{$category->id}}', formData)
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            window.location.href = '/cms/admin/categories';
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }
</script>
@endsection