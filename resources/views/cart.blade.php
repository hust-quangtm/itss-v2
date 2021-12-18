@extends('layouts.app')
@section('title','Shopping Cart')
@section('content')
  <div class="container">
      <div class="row">
          <div class="col-lg-12 col-sm-12 col-12 main-section">
              <div class="dropdown">
                  <button type="button" class="btn btn-info" data-toggle="dropdown">
                      <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                  </button>
                  <div class="dropdown-menu">
                      <div class="row total-header-section">
                          <div class="col-lg-6 col-sm-6 col-6">
                              <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                          </div>

                          @php $total = 0 @endphp
                          @foreach((array) session('cart') as $id => $details)
                              @php $total += $details['price']  @endphp
                          @endforeach

                          <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                              <p>Total: <span class="text-info">$ {{ $total }}</span></p>
                          </div>
                      </div>
                      @if(session('cart'))
                          @foreach(session('cart') as $id => $details)
                              <div class="row cart-detail">
                                  <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                      <img src="{{ $details['image'] }}" />
                                  </div>
                                  <div class="col-lg-8 col-sm-8 col-8 cart-detail-course">
                                      <p>{{ $details['course_name'] }}</p>
                                      <span class="price text-info"> ${{ $details['price'] }}</span>
                                      <!-- <span class="count"> Quantity:{{ $details['quantity'] }}</span> -->
                                  </div>
                              </div>
                          @endforeach
                      @endif
                      <div class="row">
                          <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                              <a href="{{ route('cart') }}" class="btn btn-primary btn-block">View all</a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <br/>
  <div class="container">
      @if(session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
      @endif
      <table id="cart" class="table table-hover table-condensed">
        <thead>
            <tr>
                <th style="width:50%">Course</th>
                <th style="width:10%">Price</th>
                <th style="width:22%" class="text-center">Subtotal</th>
                <th style="width: 10%"></th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0 @endphp
            @if(session('cart'))
                @foreach(session('cart') as $id => $details)
                    @php $total += $details['price']  @endphp
                    <tr data-id="{{ $id }}">
                        <td data-th="Course">
                            <div class="row">
                                <div class="col-sm-3 hidden-xs"><img src="{{ asset('storage/images/' . $details['image']) }}" width="100" height="100" class="img-responsive"/></div>
                                <div class="col-sm-9">
                                    <h4 class="nomargin">{{ $details['course_name'] }}</h4>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">${{ $details['price'] }}</td>
                        <td data-th="Subtotal" class="text-center">${{ $details['price']}}</td>
                        <td data-th="take-course" class="text-center">
                            {{-- <form action="{{ route('course.user.store', $details['id']) }}" method="post" class="text-center">
                                @csrf
                                @if (Auth::user())
                                    <input type="submit" value="Take This Course" class="btn btn-light hapo-courses-btn border-0 py-lg-0 px-4 py-2"  onclick="return confirm('Take This Course?');">
                                @endif
                            </form> --}}
                            @if(session('course'))
                                @foreach(session('course') as $course)
                                    @if ($course['check_user_course'])
                                        <div class="w-100 text-center">
                                            <a href="{{ route('course.user.destroy', $course->id) }} " class="btn btn-light hapo-lesson-btn border-0 py-lg-0 px-4 py-2"  onclick="return confirm('Are you sure you want to leave this course?');" >Leave this Course</a>
                                        </div>
                                    @else
                                        <form action="{{ route('course.user.store', $course->id) }}" method="post" class="text-center">
                                            @csrf
                                            @if (Auth::user())
                                                <input type="submit" value="Take This Course" class="btn btn-light hapo-courses-btn border-0 py-lg-0 px-4 py-2"  onclick="return confirm('Take This Course?');">
                                            @endif
                                        </form>
                                @endif
                                @endforeach
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-right"><h3><strong>Total ${{ $total }}</strong></h3></td>
            </tr>
            <tr>
                <td colspan="5" class="text-right">
                    <a href="{{ route('course.all') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> See All Course</a>
                </td>
            </tr>
        </tfoot>
      </table>
  </div>
@endsection

@section('scripts')

<script type="text/javascript">

    $(".update-cart").change(function (e) {
        e.preventDefault();

        var ele = $(this);

        $.ajax({
            url: '{{ route('update.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.parents("tr").attr("data-id")
                // quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });

    $(".remove-from-cart").click(function (e) {
        e.preventDefault();

        var ele = $(this);

        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('remove.from.cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });

</script>

@endsection
