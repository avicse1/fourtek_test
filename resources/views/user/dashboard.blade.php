@extends('layout.header')
@section('content')
@include('layout.navbar')
    <div class="container-fluid main-section">
        <div class="col-md-12">
            <h2 class="float-left">My Attendance</h2>
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#mark_attendance">
                Mark Attendance
            </button>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12">
            <table id="my_attendance" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach($attendances as $attend)                
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$attend->date}}</td>
                        <td>{{$attend->pivot->in_time}}</td>
                    </tr>
                    @endforeach
                    
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="mark_attendance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" action="{{route('mark_attendance')}}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Mark attendance</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group col-md-12">
                            <label>Date</label>
                            <input type="text" class="form-control" name="date" id="date" required>
                            @if($errors->has('date'))
                                <p class="help-block has-error">{{$errors->first('date')}}</p>
                            @endif
                        </div>
                        <div class="form-group col-md-12">
                            <label>Time</label>
                            <input type="text" class="form-control" name="time" id="time" required>
                            @if($errors->has('time'))
                                <p class="help-block has-error">{{$errors->first('time')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#my_attendance').DataTable();

            $('#date').datetimepicker({
                format : 'YYYY-MM-DD',
            });
            $('#time').datetimepicker({                      
                format: 'HH:mm',
            });
        });
    </script>
@endsection