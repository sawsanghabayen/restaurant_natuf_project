@extends('cms.parent')

@section('title','Edit')
@section('page-lg','Temp')
@section('main-pg-md','CMS')
@section('page-sm','Temp')

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
                        <h3 class="card-title">{{__('cms.edit_resturant')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="create-form">
                        @csrf
                        <div class="card-body">
                    
                            <div class="form-group">
                                <label for="name">{{__('cms.name')}}</label>
                                <input type="text" class="form-control" id="rest_name" value="{{$resturant->rest_name}}"
                                    placeholder="{{__('cms.name')}}">
                            </div>
                            <div class="form-group">
                                <label for="name">{{__('cms.description')}}</label>
                                <input type="text" class="form-control" id="description" value="{{$resturant->description}}"
                                    placeholder="{{__('cms.description')}}">
                            </div>
                            <div class="form-group">
                                <label for="mobile">{{__('cms.mobile')}}</label>
                                <input type="text" class="form-control" id="mobile" value="{{$resturant->mobile}}"
                                    placeholder="{{__('cms.mobile')}}">
                            </div>
                            <div class="form-group">
                                <label for="mobile">{{__('cms.telephone')}}</label>
                                <input type="text" class="form-control" id="telephone" value="{{$resturant->telephone}}"
                                    placeholder="{{__('cms.telephone')}}">
                            </div>
                            <div class="form-group">
                                <label for="email">{{__('cms.email')}}</label>
                                <input type="email" class="form-control" id="email" value="{{$resturant->email}}"
                                    placeholder="{{__('cms.email')}}">
                            </div>
                            <div class="form-group">
                                <label for="name">{{__('cms.address')}}</label>
                                <input type="text" class="form-control" id="address" value="{{$resturant->address}}"
                                    placeholder="{{__('cms.address')}}">
                            </div>
                            <div class="form-group">
                                <label for="resturant_image">Resturant Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="resturant_image" value="{{$resturant->title}}">
                                        <label class="custom-file-label" for="resturant_image">Choose Image</label>
                                    </div>
                                
                                </div>
                            </div>
                           
                     
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="button" onclick="performUpdate('{{$resturant->id}}')" class="btn btn-primary">{{__('cms.save')}}</button>
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


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('front/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('front/lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Contact Javascript File -->
    <script src="{{asset('front/mail/jqBootstrapValidation.min.js')}}"></script>
    <script src="{{asset('front/mail/contact.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('front/js/main.js')}}"></script>
    <script src="https://unpkg.com/axios@0.27.2/dist/axios.min.js"></script>
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
       <script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>

    
<script>


    function performUpdate(id) {
        var formData = new FormData();
        formData.append('rest_name', document.getElementById('rest_name').value);
        formData.append('description', document.getElementById('description').value);
        formData.append('telephone', document.getElementById('telephone').value);
        formData.append('mobile', document.getElementById('mobile').value);
        formData.append('email', document.getElementById('email').value);
        formData.append('address', document.getElementById('address').value);
        if(document.getElementById('resturant_image').files[0] != undefined) {
            formData.append('image',document.getElementById('resturant_image').files[0]);
        }
        formData.append('_method','PUT');     

        axios.post('/cms/admin/resturants/{{$resturant->id}}',formData)
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            window.location.href = '/cms/admin/dashboards';
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }
</script>
@endsection