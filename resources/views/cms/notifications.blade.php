@extends('cms.parent')

@section('title',__('cms.notifications'))
@section('page_lg',__('cms.notifications'))
@section('main_page_md')
<a href="{{route('dashboards.index')}}">Home</a>
@endsection
@section('page_sm',__('cms.notifications'))
@section('styles')

@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('cms.notifications')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>{{__('cms.from')}}</th>
                                    <th>{{__('cms.subject')}}</th>
                                    <th>{{__('cms.message')}}</th>
                                    <th>{{__('cms.created_at')}}</th>
                                    <th>{{__('cms.read_at')}}</th>
                                    <th style="width: 40px">{{__('cms.settings')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                             
                                @foreach ($notifications as $notification)
                                {{-- {{dd($notification)}} --}}
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$notification->data['name']}}</td>
                                    <td>{{$notification->data['subject']}}</td>
                                    <td>{{$notification->data['message']}}</td>
                                    <td>{{$notification->created_at->diffForHumans()}} </td>
                                    <td>{{$notification->read_at->diffForHumans()}} </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="#" onclick="confirmDelete('{{$notification->id}}', this)"
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
        axios.delete('/cms/admin/notifications/'+id)
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