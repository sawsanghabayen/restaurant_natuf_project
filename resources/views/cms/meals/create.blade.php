@extends('cms.parent')

@section('title',__('cms.meals'))
@section('page_lg',__('cms.meals'))
@section('main_page_md')
<a href="#">Home</a>
@endsection
@section('page_sm',__('cms.meals'))

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
                        <h3 class="card-title">{{__('cms.create_meal')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
            
                    <form id="create-meal">
                        @csrf
                           <div class="card-body">
                            <div class="form-group">
                                <label>{{__('cms.category')}}</label>
                                <select class="form-control" id="category_id">
                                    <option  value="-1">Select Category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>{{__('cms.sub_category')}}</label>
                                <select class="form-control" id="sub_category_id">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">{{__('cms.title')}}</label>
                                <input type="text" class="form-control" id="title" placeholder="{{__('cms.title')}}">
                            </div>

                            <div class="form-group">
                                <label for="description">{{__('cms.description')}}</label>
                                <input type="text" class="form-control" id="description" placeholder="{{__('cms.description')}}">
                            </div>
                            <div class="form-group">
                                <label for="price">{{__('cms.price')}}</label>
                                <input type="number" class="form-control" id="price" placeholder="{{__('cms.price')}}">
                            </div>
                            <div class="form-group">
                                <label for="meal_image">Meal Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image">
                                        <label class="custom-file-label" for="image">Choose Image</label>
                                    </div>
                                
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="active" name="active"  >
                                    <label class="custom-control-label" for="active">{{__('cms.active')}}</label>
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

    $('#category_id').on('change',function(){
        if(this.value!==-1)
        getSubCategories(this.value);
        else
        $('#sub_category_id').empty();

    });

     function getSubCategories(categoryId){
        axios.get('/cms/admin/categories/'+categoryId)
        .then(function (response) {
            console.log(response);
            // console.log(response.data.data);
            $('#sub_category_id').empty();
            $.each(response.data.data , function(i, item){
             $('#sub_category_id').append(new Option(  item['title'] ,item['id'] ))
             });
           
            
        }).catch(function (error) {
            console.log(error.response);
        });
    }

    
    function performStore() {
        var formData = new FormData();
        formData.append('sub_category_id', document.getElementById('sub_category_id').value);
        formData.append('title', document.getElementById('title').value);
        formData.append('description', document.getElementById('description').value);
        formData.append('price', document.getElementById('price').value);
        formData.append('image',document.getElementById('image').files[0]);
        formData.append('active', document.getElementById('active').checked ? 1 : 0);

        axios.post('/cms/admin/meals',formData)
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            document.getElementById('create-meal').reset();
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }
</script>
@endsection