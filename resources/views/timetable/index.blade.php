@extends('layouts.app')

@section('content')


<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <!-- Button Back -->
            <div class="col-sm-13">
                <a href="{{ route('admin.index') }}" class="btn btn-danger"><i class="material-icons">&#xf060</i>
                    <span>Back</span></a>
            </div>

            <div class="row">
                <div class="col-sm-5">
                    <h2>Manage <b>Timetable</b></h2>
                </div>
                <div class="col-sm-4 button">
                    <a href="#addTimetableModal" class="btn btn-success" data-toggle="modal"><i
                            class="material-icons">&#xE147;</i> <span>Add New Timetable</span></a>
                </div>
                <div class="col-sm-3 button">
                    <a href="{{ route('timetable.generate') }}" class="btn btn-success"><i
                            class="material-icons">&#xe24d;</i> <span>Generate Timetable</span></a>
                </div>
            </div>

        </div>


        <!-- Table -->
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>

        @elseif ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
        @endif


        <table class="table table-striped table-hover  table-responsive-lg">
            <thead>
                <tr>

                    <th>Date</th>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Class</th>
                    <th>Timetable</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($timetables as $timetable)
                <tr>

                    <td>{{$timetable->timetable_date}}</td>
                    <td>{{$timetable->timetable_day}}</td>
                    <td>{{$timetable->timetable_time}}</td>
                    <td>{{$timetable->class->class_name}} ({{$timetable->timetable_status}})</td>
                    <td>{{$timetable->instructure->instructure_name}}</td>
                    <td width="150">
                        <!-- Get id timetable -->
                        <input type="hidden" class="timetable_id" value="{{ $timetable->id }}">
                        <!-- Get id class -->
                        <input type="hidden" class="class_id" value="{{ $timetable->id_class }}">
                        <!-- Get id instructure -->
                        <input type="hidden" class="instructure_id" value="{{ $timetable->id_instructure }}">

                        <!-- Edit Timetable using modal from id -->
                        <a href="" class="edit" data-toggle="modal"
                            data-target="#editTimetableModal{{ $timetable->id }}"><i class="material-icons"
                                data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                        <!-- Delete Timetable using modal from id -->
                        <a class="delete" data-toggle="modal" data-target="#deleteTimetableModal{{ $timetable->id }}"><i
                                class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>

                    </td>
                </tr>
                <!--Edit Modal HTML with id timetable -->
                <div id="editTimetableModal{{ $timetable->id }}" class="modal fade" value="{{ $timetable->id }}"
                    tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="#edit-court-form" method="post"
                                action="{{ route('timetable.update', $timetable->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="modal-header">
                                    <h4 class="modal-title">Edit Timetable</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <!-- Timetable Class Edit -->
                                    <div class="form-group">
                                        <label>Class Name</label>
                                        <select class="form-control border" name="id_class" id="id_class" required>
                                            <option value="{{ $timetable->id_class }}">
                                                {{$timetable->class->class_name}}</option>
                                            @foreach ($timetables as $timetable)
                                            <option value="{{ $timetable->id_class }}">
                                                {{$timetable->class->class_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('id_class')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Timetable Instructure Edit -->
                                    <div class="form-group">
                                        <label>Instructure Name</label>
                                        <select class="form-control border" name="id_instructure" id="id_instructure"
                                            required>
                                            <option value="{{ $timetable->id_instructure }}">
                                                {{$timetable->instructure->instructure_name}}</option>
                                            @foreach ($timetables as $timetable)
                                            <option value="{{ $timetable->id_instructure }}">
                                                {{$timetable->instructure->instructure_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('id_instructure')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Timetable Type Hidden -->
                                    <input type="hidden" class="form-control" name="timetable_type" value="reguler"
                                        id="timetable_type" required>

                                    <!-- Timetable day Edit -->
                                    <div class="form-group">
                                        <label>Day</label>
                                        <select class="form-control border" name="timetable_day" id="timetable_day"
                                            required>
                                            <option value="{{ $timetable->timetable_day }}">
                                                {{$timetable->timetable_day}}</option>
                                            <option value="Senin">Senin</option>
                                            <option value="Selasa">Selasa</option>
                                            <option value="Rabu">Rabu</option>
                                            <option value="Kamis">Kamis</option>
                                            <option value="Jumat">Jumat</option>
                                            <option value="Sabtu">Sabtu</option>
                                            <option value="Minggu">Minggu</option>
                                        </select>
                                        @error('timetable_day')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Timetable Date Edit -->
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input type="date" class="form-control" name="timetable_date"
                                            placeholder="Tanggal Timetable" value="{{ $timetable->timetable_date }}"
                                            id="timetable_date" required>
                                        @error('timetable_date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Timetable Time Edit -->
                                    <div class="form-group">
                                        <label>Time</label>
                                        <input type="time" class="form-control" name="timetable_time"
                                            placeholder="Jam Timetable" value="{{ $timetable->timetable_time }}"
                                            id="timetable_time" required>
                                        @error('timetable_time')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Timetable Status Edit -->
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control border" name="timetable_status"
                                            id="timetable_status" required>
                                            <option value="{{ $timetable->timetable_status }}">
                                                {{$timetable->timetable_status}}</option>
                                            <option value="Active">Active</option>
                                            <option value="Non-Active">Non-Active</option>
                                        </select>
                                        @error('timetable_status')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                    <input type="submit" class="btn btn-success" value="Save">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <!-- End Edit Modal -->


                <!-- Delete Modal HTML -->
                <div id="deleteTimetableModal{{ $timetable->id }}" class="modal fade" value="{{ $timetable->id }}"
                    tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="#delete-court-form" method="post"
                                action="{{ route('timetable.delete', $timetable->id) }}">
                                @csrf
                                @method('DELETE')
                                <div class="modal-header">
                                    <h4 class="modal-title">Delete Timetable</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete these Records?</p>
                                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                                </div>

                                <div class="modal-footer">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                    <input type="submit" class="btn btn-danger" value="Delete">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Delete Modal -->
                @endforeach
            </tbody>
        </table>

        <!-- End Table -->
        <!-- Make Pagination -->
        <div class="clearfix">
            <div class="hint-text">Showing <b>{{ $timetables->count() }}</b> out of
                <b>{{ $timetables->total() }}</b>
                entries</div>
            {{ $timetables->links() }}
        </div>

        <!-- End Pagination -->

    </div>
</div>

    <!-- End Table Content -->



    <!-- Add Modal HTML -->
    <div id="addTimetableModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('timetable.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add Timetable </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                        <!-- Timetable Class -->
                        <div class="form-group">
                            <label>Class Name</label>
                            <select class="form-control border" name="id_class" id="id_class" required>
                                <option value="{{ $timetable->id_class }}">
                                    {{$timetable->class->class_name}}</option>
                                @foreach ($timetables as $timetable)
                                <option value="{{ $timetable->id_class }}">
                                    {{$timetable->class->class_name}}</option>
                                @endforeach
                            </select>
                            @error('id_class')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Timetable Timetable -->
                        <div class="form-group">
                            <label>Timetable Name</label>
                            <select class="form-control border" name="id_instructur" id="id_instructur" required>
                                <option value="{{ $timetable->id_instructur }}">
                                    {{$timetable->instructure->instructure_name}}</option>
                                @foreach ($timetables as $timetable)
                                <option value="{{ $timetable->id_instructure }}">
                                    {{$timetable->instructure->instructure_name}}</option>
                                @endforeach
                            </select>
                            @error('id_instructur')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Timetable Type -->
                        <div class="form-group">
                            <label>Type</label>
                            <select class="form-control border" name="timetable_type" id="timetable_type" required>
                                <option value="{{ $timetable->timetable_type }}">
                                    {{$timetable->timetable_type}}</option>
                                <option value="Private">Private</option>
                                <option value="Group">Group</option>
                            </select>
                            @error('timetable_type')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Timetable Day -->
                        <div class="form-group">
                            <label>Day</label>
                            <select class="form-control border" name="timetable_day" id="timetable_day" required>
                                <option value="{{ $timetable->timetable_day }}">
                                    {{$timetable->timetable_day}}</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesay">Wednesay</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                            </select>
                            @error('timetable_day')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Timetable Date -->
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" class="form-control" name="timetable_date"
                                placeholder="Tanggal Timetable" value="{{ old('timetable_date') }}" required>
                            @error('timetable_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Timetable Time -->
                        <div class="form-group">
                            <label>Time</label>
                            <input type="time" class="form-control" name="timetable_time"
                                placeholder="Jam Timetable" value="{{ old('timetable_time') }}" required>
                            @error('timetable_time')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Timetable status -->
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control border" name="timetable_status" id="timetable_status"
                                required>
                                <option value="{{ $timetable->timetable_status }}">
                                    {{$timetable->timetable_status}}</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                            @error('timetable_status')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-success" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Modal -->
    <!-- End Add Modal -->







    </script>

    @endsection
