@extends('admin.index')
@section('title','Admin-tag-list')
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
                    List Tag
                </div>
                <form class="form-inline col-xs-7 text-center" method="GET" action="{{ route('admin.tags.index') }}" id="formSearchUser">
                    <input class="form-control" type="text" placeholder="Search" name="name" value="{{ request('name') }}" size="30">
                    <i class="fa fa-search"></i>
                </form>
                <div class="col-xs-4 ml-4 text-right">
                    <a href="{{ Route('admin.tags.create') }}" class="btn btn-danger" role="button">Create</a>
                </div>
            </div>
            <div class="hapo-admin-header-link px-5">
                <ul class="d-flex justify-content-center align-items-center m-0">
                    <li class="nav-item ml-4">
                        <a href="#"><i class="fas fa-tachometer-alt"></i> Home </a>
                    </li>
                    <span class="hapo-angle-right ml-4"><i class="fas fa-angle-right"></i></span>
                    <li class="nav-item ml-3">
                        <a href="#">Table</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="hapo-admin-body mt-1 pb-5">

            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr align="center">
                        <th>STT</th>
                        <th class="fix-witdh-name">Name</th>
                        <th class="fix-witdh-create-at">Create at</th>
                        <th class="fix-witdh-choice">Option</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($tags as $key => $tag)
                   <tr>
                        <td class="text-center"> {{ $tags->firstItem() + $key }} </td>
                        <td class="text-center">{{ $tag->tag_name }}</td>
                        <td class="text-center"> {{ $tag->format_created_at }} </td>
                        <td class="d-flex justify-content-center align-items-center">
                            <!-- edit -->
                            <a href="{{ route('admin.tags.edit', $tag->id) }}"  class="icon-edit mx-1" ><span class="btn btn-primary"> <i class="fas fa-edit" aria-hidden="true"></i></span> </a>
                            <!-- delete -->
                            <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="post" id="delete">
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
                        <th class="fix-witdh-name">Name</th>
                        <th class="fix-witdh-create-at">Create at</th>
                        <th class="fix-witdh-choice">Option</th>
                    </tr>
                </tfoot>
            </table>
            <div class="col-12 text-right hapo-admin-pages">
                {{ $tags->appends($_GET)->links('pagination') }}
            </div>
        </div>
    </div>
</div>
@endsection
