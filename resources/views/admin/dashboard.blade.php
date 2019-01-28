@extends('layout.header')
@section('content')
@include('layout.navbar')
    <div class="container-fluid main-section">
        <div class="col-md-12">
            <h2 class="float-left">User Attendance</h2>
            <form class="form-inline my-2 my-lg-0 float-right" method="POST" action="{{route('filter_attendance')}}">
                @csrf
                <label for="">Start date: </label>
                <input type="text" class="form-control" name="start_date" id="start_date" required>
                @if($errors->has('start_date'))
                    <p class="help-block has-error">{{$errors->first('start_date')}}</p>
                @endif
                <label for="">end date: </label>
                <input type="text" class="form-control" name="end_date" id="end_date" required>
                @if($errors->has('end_date'))
                    <p class="help-block has-error">{{$errors->first('end_date')}}</p>
                @endif
                <button class="btn btn-outline-success my-2 my-sm-0" id="filter" type="submit">Filter</button>
            </form>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12">
            <table id="user_attendance" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>User</th>
                        @foreach($all_dates as $date)
                            <th>{{$date->date}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)                
                    <tr>
                        <td>{{$user->getFullName()}}</td>
                        @foreach ($all_dates as $date)
                            @php
                                $att = \App\DayPivot::where('user_id', $user->id)->where('day_id', $date->id)->first();
                                if (!$att) {
                                    $att = new \stdClass();
                                    $att->in_time = '-';
                                }
                            @endphp
                            <td>{{$att->in_time}}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>                    
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#user_attendance').DataTable();
            $('#start_date').datetimepicker({
                format : 'YYYY-MM-DD',
            });
            $('#end_date').datetimepicker({
                format : 'YYYY-MM-DD',
            });
        });
    </script>
@endsection