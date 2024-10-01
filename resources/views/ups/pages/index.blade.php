@extends('layouts.default')

@section('title', 'Data OLT')

@push('addon-style')


<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">

<style>
    .truncate {
        max-width: 150px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

@endpush

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-header">
                <!-- Button trigger modal -->
                <a href="{{ route('olt.create') }}" class="btn btn-primary rounded">
                    Add OLT
                </a>
                <a href="{{ route('corpnet.index') }}" class="float-right btn btn-info rounded">
                    Back
                </a>
            </div>

            <div class="card-body">
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                    <thead>



                        <tr>
                            <th>No</th>
                            <th>UPS</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @php
                        $no = 1;
                        @endphp --}}

                        <tr>
                            <td>1</td>
                            <td>UPS 03</td>
                            <td>

                                <a href="http://10.10.21.103/#battery_inverter_page" target="_blank"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>

                            </td>

                        </tr>
                        <tr>
                            <td>2</td>
                            <td>UPS 04</td>
                            <td>

                                <a href="http://10.10.21.104/#battery_inverter_page" target="_blank"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>

                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>UPS 05</td>
                            <td>

                                <a href="http://10.10.21.105/#battery_inverter_page" target="_blank"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>

                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>UPS 06</td>
                            <td>

                                <a href="http://10.10.21.106/#battery_inverter_page" target="_blank"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>

                            </td>
                        </tr>
                        <td>5</td>
                        <td>UPS 07</td>
                        <td>

                            <a href="http://10.10.21.107/#battery_inverter_page" target="_blank"
                                class="btn btn-primary btn-sm">
                                <i class="fa fa-pencil"></i>
                            </a>

                        </td>
                        <tr>
                            <td>6</td>
                            <td>UPS 09</td>
                            <td>

                                <a href="http://10.10.21.109/#battery_inverter_page" target="_blank"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>

                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>UPS 10</td>
                            <td>

                                <a href="http://10.10.21.110/#battery_inverter_page" target="_blank"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>

                            </td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>UPS 10</td>
                            <td>

                                <a href="http://10.10.21.111/#battery_inverter_page" target="_blank"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>

                            </td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>UPS 13</td>
                            <td>

                                <a href="http://10.10.21.113/#battery_inverter_page" target="_blank"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>

                            </td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>UPS 15</td>
                            <td>

                                <a href="http://10.10.21.115/#battery_inverter_page" target="_blank"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>

                            </td>
                        </tr>
                        <tr>
                            <td>11</td>
                            <td>UPS 16</td>
                            <td>

                                <a href="http://10.10.21.116/#battery_inverter_page" target="_blank"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>

                            </td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>UPS 17</td>
                            <td>

                                <a href="http://10.10.21.117/#battery_inverter_page" target="_blank"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>

                            </td>
                        </tr>
                        <tr>
                            <td>13</td>
                            <td>UPS 20</td>
                            <td>

                                <a href="http://10.10.21.120/#battery_inverter_page" target="_blank"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>

                            </td>
                        </tr>
                        <tr>
                            <td>14</td>
                            <td>UPS 22</td>
                            <td>

                                <a href="http://10.10.21.122/#battery_inverter_page" target="_blank"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>

                            </td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>UPS 24</td>
                            <td>

                                <a href="http://10.10.21.124/#battery_inverter_page" target="_blank"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>

                            </td>
                        </tr>
                        <tr>
                            <td>16</td>
                            <td>UPS 25</td>
                            <td>

                                <a href="http://10.10.21.125/#battery_inverter_page" target="_blank"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>

                            </td>
                        </tr>
                        <tr>
                            <td>17</td>
                            <td>UPS 26</td>
                            <td>

                                <a href="http://10.10.21.126/#battery_inverter_page" target="_blank"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>

                            </td>
                        </tr>
                        <tr>
                            <td>18</td>
                            <td>UPS 27</td>
                            <td>

                                <a href="http://10.10.21.127/#battery_inverter_page" target="_blank"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>

                            </td>
                        </tr>
                        <tr>
                            <td>19</td>
                            <td>UPS 28</td>
                            <td>

                                <a href="http://10.10.21.128/#battery_inverter_page" target="_blank"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>

                            </td>
                        </tr>
                        <tr>
                            <td>20</td>
                            <td>UPS 29</td>
                            <td>

                                <a href="http://10.10.21.129/#battery_inverter_page" target="_blank"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>

                            </td>
                        </tr>
                        <tr>
                            <td>21</td>
                            <td>UPS 30</td>
                            <td>

                                <a href="http://10.10.21.130/#battery_inverter_page" target="_blank"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>

                            </td>
                        </tr>
                        <tr>
                            <td>22</td>
                            <td>UPS 31</td>
                            <td>

                                <a href="http://10.10.21.131/#battery_inverter_page" target="_blank"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>

                            </td>
                        </tr>
                        <tr>
                            <td>23</td>
                            <td>UPS 32</td>
                            <td>

                                <a href="http://10.10.21.132/#battery_inverter_page" target="_blank"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>

                            </td>
                        </tr>
                        <tr>
                            <td>24</td>
                            <td>UPS 33</td>
                            <td>

                                <a href="http://10.10.21.133/#battery_inverter_page" target="_blank"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>

                            </td>
                        </tr>
                        <tr>
                            <td>25</td>
                            <td>UPS 34</td>
                            <td>

                                <a href="http://10.10.21.134/#battery_inverter_page" target="_blank"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>

                            </td>
                        </tr>

                    </tbody>
                </table>


            </div>
        </div>
    </div>
</div>






@endsection


@push('addon-script')



<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js">
</script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js">
</script>
<script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    $(document).ready( function () {
var table = $('#example').DataTable({
columnDefs:[{targets:2,className:"truncate"}],
createdRow: function(row){
var td = $(row).find(".truncate");
td.attr("title", td.html());
}
});
} );



$('#delete-button').on('click', function (e) {
            e.preventDefault();
            
            const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    swalWithBootstrapButtons.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    );
    $('#delete-form').submit();
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your imaginary file is safe :)',
      'error'
    )
  }
})
        });

</script>



@endpush