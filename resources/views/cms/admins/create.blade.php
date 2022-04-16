@extends('cms.parent')

@section('title','Temp')
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
                        <h3 class="card-title">{{__('cms.create_admin')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="create-form">
                        @csrf
                        <div class="card-body">
                           
                            <div class="form-group">
                                <label for="name">{{__('cms.name')}}</label>
                                <input type="text" class="form-control" id="name" placeholder="{{__('cms.name')}}">
                            </div>
                            <div class="form-group">
                                <label for="email">{{__('cms.email')}}</label>
                                <input type="email" class="form-control" id="email" placeholder="{{__('cms.email')}}">
                            </div>
                            <div class="form-group">
                                <label for="mobile">{{__('cms.mobile')}}</label>
                                <input type="mobile" class="form-control" id="mobile" placeholder="{{__('cms.mobile')}}">
                            </div>

                            <div class="form-group">
                                <label>{{__('cms.gender')}}</label>
                                <select class="form-control" id="gender">
                                    <option value="F" >{{__('cms.female')}}</option>
                                    <option value="M">{{__('cms.male')}}</option>
                                </select>
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
{{-- <script src="{{asset('js/axios.js')}}"></script> --}}
<script>
    function performStore() {
        // alert('Perform Store - FUNCTION JS');
        // console.log('performStore');
        
        //application/x-www-form-urlencoded
        axios.post('/cms/admin/admins', {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            mobile: document.getElementById('mobile').value,
            gender: document.getElementById('gender').value,

        })
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            document.getElementById('create-form').reset();
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }
</script>
@endsection