@extends('layouts1.body')
@section('section')
    <div class="">
        <div class="">
            <div class="card">
                <div class="datatables">
                <table class="table table-full table-full-small" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th> id </th>
                        <th class="hidden-480"> Domain </th>
                        <th class="hidden-480"> Name </th>
                        <th class="hidden-480"> Email </th>
                        <th class="hidden-480"> Phone </th>
                        <th class="hidden-480"> Address </th>
                        <th class="hidden-480"> City </th>
                        <th class="hidden-480"> State </th>
                        <th class="hidden-480"> Zip </th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($companies as $key => $val)
                        <tr>
                            <td> {{$val->id}} </td>
                            <td> {{$val->domain}} </td>
                            <td> {{$val->name}} </td>
                            <td> {{$val->email}} </td>
                            <td> {{$val->phone}} </td>
                            <td> {{$val->address}} </td>
                            <td> {{$val->city}} </td>
                            <td> {{$val->state}} </td>
                            <td> {{$val->zip}} </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div>
                    <a href="/dashboard/create-company" class="btn btn-success white-text" style="float: right; color: white !important;"><div class="ripple-wrapper"></div>Add New Company</a>
                    {{--<button type="submit" class="btn btn-link black-text">Login</button>--}}
                </div>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function showModal(id, heading) {
//            var heading = $(this).attr("data-name")
//            var id = $(this).data("id");
            console.log(heading);
            $('#myModalLabel').text(heading);
            $('#myModal').modal('show');
        }
    </script>
@stop
