@extends('admin.index')
@section('title','Admin-users-list')
@section('contents')
<div class="container-fluid">
    @if ($message = Session::get('message'))
        <div class="alert alert-success alert-block my-2" id="myAlert">
            <button type="button" class="close" data-dismiss="alert">X</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="hapo-admin py-3">
        <div class="hapo-admin-header d-flex justify-content-between py-3">
            <div class="d-flex">
                <div class="hapo-admin-header-name px-3 d-flex align-items-center">
                    Users List
                </div>
                {{-- <form class="form-inline col-xs-7 text-center" method="GET" action="{{ route('admin.users.index') }}" id="formSearchUser">
                    <input class="form-control" type="text" placeholder="Search" name="name" value="{{ request('name') }}" size="30">
                    <i class="fa fa-search"></i>
                </form> --}}
                <div class="col-xs-4 ml-4 text-right">
                    <a href="{{ Route('admin.users.create') }}" class="btn btn-danger" role="button">Create</a>
                </div>
            </div>
            {{-- <div class="hapo-admin-header-link px-5">
                <ul class="d-flex justify-content-center align-items-center m-0">
                    <li class="nav-item ml-4">
                        <a href="#"><i class="fas fa-tachometer-alt"></i> Home </a>
                    </li>
                    <span class="hapo-angle-right ml-4"><i class="fas fa-angle-right"></i></span>
                    <li class="nav-item ml-3">
                        <a href="#">Table</a>
                    </li>
                </ul>
            </div> --}}
        </div>
        <div class="hapo-admin-body mt-1 pb-5">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr align="center">
                        <th>STT</th>
                        <th class="fix-witdh-name">Role</th>
                        <th class="fix-witdh-name">Name</th>
                        <th class="fix-witdh-mail">Email</th>
                        <th class="fix-witdh-birth-day">Birth day</th>
                        <th class="fix-witdh-addess">Address</th>
                        <th class="fix-witdh-choice">Option</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($users as $key => $user)
                   <tr>
                        <td class="text-center"> {{ $users->firstItem() + $key }} </td>
                        <td class="text-center">{{ $user->role_label }} </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->format_birth_day }}</td>
                        <td>{{ $user->address }}</td>
                        <td class="d-flex justify-content-center align-items-center">
                            <!-- show -->
                            <a href data-id="{{ $user->id }}" class="icon-show mx-1" data-toggle="modal" data-target="#showUser" ><span class="btn btn-info"><i class="fas fa-user" aria-hidden="true"></i></span></a>
                            <!-- edit -->
                            <a href="{{ route('admin.users.edit', $user->id) }}"  class="icon-edit mx-1" ><span class="btn btn-primary"> <i class="fas fa-edit" aria-hidden="true"></i></span> </a>
                            <!-- delete -->
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="post" id="delete">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger icon-delete" onclick="return confirm('Are you sure ?')" >
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </form>
                       </td>
                   </tr>
                   @endforeach
                </tbody>
                <tfoot>
                    <tr align="center">
                        <th>STT</th>
                        <th class="fix-witdh-name">Role</th>
                        <th class="fix-witdh-name">Name</th>
                        <th class="fix-witdh-mail">Email</th>
                        <th class="fix-witdh-birth-day">Birth day</th>
                        <th class="fix-witdh-addess">Address</th>
                        <th class="fix-witdh-choice">Option</th>
                    </tr>
                </tfoot>
            </table>
            <div class="col-12 text-right hapo-admin-pages">
                {{ $users->appends($_GET)->links() }}
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="showUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">

      </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    var url;
    var id;
    $('.icon-show').click(function(event) {
        event.preventDefault();
        id = $(this).data('id');
        url = 'users/';
        $.ajax({
            url: url + id,
            type: 'GET',
        })
        .done(function(res) {
            console.log(res);
            $('.modal-content').html(res);
        })
    });
</script>
@endsection
