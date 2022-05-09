@extends('cms.parent')

@section('title',__('cms.sub_categories'))
@section('page_lg',__('cms.sub_categories'))
@section('main_page_md')
<a href="{{route('dashboards.index')}}">Home</a>
@endsection
@section('page_sm',__('cms.sub_categories'))

@section('styles')

@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('cms.sub_categories')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>{{__('cms.image')}}</th>
                                    <th>{{__('cms.title')}}</th>
                                    <th>{{__('cms.category')}}</th>
                                    <th>{{__('cms.meals')}}</th>
                                    <th>{{__('cms.created_at')}}</th>
                                    <th>{{__('cms.updated_at')}}</th>
                                    <th style="width: 40px">{{__('cms.settings')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subcategories as $subcategory)
                                <tr>
                                    <td>{{$subcategory->id}}</td>
                                    <td>
                                        <img height="80" src="{{Storage::url($subcategory->image ?? '')}}" />
                                    </td>
                                    <td>{{$subcategory->title}}</td>
                                    <td><span class="badge bg-info">{{$subcategory->category->name}}</td>
                                    <td>
                                        <a href="{{route('meals.index',['sub_category_id'=>$subcategory->id])}}"
                                            class="btn btn-app bg-info">
                                            <i class="fas fa-envelope"></i> {{$subcategory->meals_count}}
                                        </a>
                                    </td>
                                    <td>{{$subcategory->created_at->diffForHumans()}}</td>
                                    <td>{{$subcategory->updated_at->diffForHumans()}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('subCategories.edit',$subcategory->id)}}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" onclick="confirmDelete('{{$subcategory->id}}', this)"
                                                class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection

@section('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmDelete(id, reference) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            performDelete(id, reference);
        }
        });
    }

    function performDelete(id, reference) {
        axios.delete('/cms/admin/subCategories/'+id)
        .then(function (response) {
            console.log(response);
            // toastr.success(response.data.message);
            reference.closest('tr').remove();
            showMessage(response.data);
        })
        .catch(function (error) {
            console.log(error.response);
            // toastr.error(error.response.data.message);
            showMessage(error.response.data);
        });
    }

    function showMessage(data) {
        Swal.fire(
            data.title,
            data.text,
            data.icon
        );
    }
</script>
@endsection