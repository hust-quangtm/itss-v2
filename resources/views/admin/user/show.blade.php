<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">User Detail</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
      <div class="container-fluid">
          <div class="container">
              <div class="row">
                  <div class="col-3 p-0 hapo-img-avatar">
                      <img src="{{url('storage/users',$user->avatar)}}" alt="">
                  </div>
                  <div class="col-8 offset-1 p-0">
                      <div class="hapo-infor-name"><p>Name : <strong>{{ $user->name }}</strong></p></div>
                      <div class="hapo-infor-name"><p>Brith Day : <strong>{{ $user->birth_day }}</strong></p></div>
                      <div class="hapo-infor-name"><p>Email : <strong>{{ $user->email }}</strong></p></div>
                      <div class="hapo-infor-name"><p>Phone : <strong>{{ $user->phone }}</strong></p></div>
                      <div class="hapo-infor-name"><p>Address : <strong>{{ $user->address }}</strong></p></div>
                      <div class="hapo-infor-name"><p>Role : <strong>{{ $user->role_label }}</strong></p></div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
  </div>
