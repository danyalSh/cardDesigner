@extends('layouts1.body')

@section('section')
    <div class="">
        <div class="row">
            <div class="">
                <table class="table table-full table-full-small" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th> id </th>
                        <th class="hidden-480"> First Name </th>
                        <th class="hidden-480"> Last Name </th>
                        <th class="hidden-480"> Email </th>
                        <th class="hidden-480"> Phone </th>
                        <th class="hidden-480"> Designation </th>
                    </tr>
                    </thead>
                    <tbody>

                    {{--`first_name`, `last_name`, `email`, `phone`, `card_front`, `card_back`, `designation`--}}

                    @foreach($users as $key => $val)
                        <tr>
                            <td> {{$val->id}} </td>
                            <td> {{$val->first_name}} </td>
                            <td> {{$val->last_name}} </td>
                            <td> {{$val->email}} </td>
                            <td> {{$val->phone}} </td>
                            <td> {{$val->designation}} </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div><a href="/dashboard/create-user" class="btn btn-success white-text"  style="float: right; color: white !important;">Add New User</a></div>
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
