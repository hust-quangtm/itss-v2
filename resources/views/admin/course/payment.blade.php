@extends('admin.index')
@section('title','Course payment')
@section('contents')
    <div class="container-fluid">
        <table id="course-payment" class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th style="width:80%">Information</th>
                    <th>Price</th>
                    <!-- <th style="width:8%">Quantity</th> -->
                    {{-- <th style="width:22%" class="text-center">Subtotal</th> --}}
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td data-th="Course">
                        <div class="row">
                            <h4 class="nomargin">The cost to purchase the right to create 3 courses.</h4>
                            <h4 class="nomargin">If you don't pay the fee you won't be able to create the course..</h4>
                        </div>
                    </td>
                    <td data-th="Price">${{ $createCourseFee }}</td>
                </tr>
            </tbody>
          <tfoot>
              <tr>
                  <td colspan="5" class="text-right"><h3><strong>Total ${{ $createCourseFee }}</strong></h3></td>
              </tr>
              <tr>
                  <td colspan="5" class="text-right">
                      <a href="{{ route('admin.courses.index') }}" class="btn btn-danger"><i class="fa fa-angle-left"></i> See All Course</a>
                    </td>
                    <td colspan="5" class="text-right">
                        <form action="{{ route('admin.payment.payment') }}" method="post" class="text-center">
                            @csrf
                            <input type="submit" value="Checkout" class="btn btn-success border-0 py-lg-0 px-4 py-2"  onclick="return confirm('Are you sure?');">
                        </form>
                  </td>
                  <td colspan="5" class="text-right">
                </td>
              </tr>
          </tfoot>
        </table>
    </div>
@endsection
  
 