@extends('cms.parent')

@section('title',__('cms.categories'))
@section('page_lg',__('cms.categories'))
@section('main_page_md')
<a href="#">Home</a>
@endsection
@section('page_sm',__('cms.categories'))

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
                        <h3 class="card-title">{{__('cms.create_category')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
            
                    <form id="create-category">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">{{__('cms.name')}}</label>
                                <input type="text" class="form-control" id="name" placeholder="{{__('cms.name')}}">
                            </div>
                            <div class="form-group">
                                <label for="description">{{__('cms.description')}}</label>
                                <input type="text" class="form-control" id="description" placeholder="{{__('cms.description')}}">
                            </div>
                            <div class="form-group">
                                <label for="category_image">category Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="category_image">
                                        <label class="custom-file-label" for="category_image">Choose Image</label>
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
{{-- <script src="{{asset('js/axios.js')}}"></script> --}}
<script>
    $(function () { bsCustomFileInput.init() });
</script>
<script>
    function performStore() {
        var formData = new FormData();
        formData.append('name', document.getElementById('name').value);
        formData.append('description', document.getElementById('description').value);
        formData.append('image',document.getElementById('category_image').files[0]);

        axios.post('/cms/admin/categories',formData)
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            document.getElementById('create-category').reset();
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }
</script>
@endsection