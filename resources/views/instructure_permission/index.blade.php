@extends('layouts.app')

@section('content')


<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <!-- Button Back -->
            <div class="col-sm-13">
                <a href="{{ route('manager.index') }}" class="btn btn-danger"><i class="material-icons">&#xf060</i>
                    <span>Back</span></a>
            </div>

            <div class="row">
                <div class="col-sm-5">
                    <h2>Manage <b>Permission Instructure</b></h2>
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

                    <th>ID</th>
                    <th>Nama Instructur</th>
                    <th>Sub-Instruktur</th>
                    <th>Tanggal Izin</th>
                    <th>Izin Sesi Ke-</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                <tr>

                    <td>{{$permission->id}}</td>
                    <td>{{$permission->instructure->instructure_name}}</td>
                    <td>{{$permission->subtitute_instructure}}</td>
                    <td>{{$permission->permission_date}}</td>
                    <td>{{$permission->permission_att_session}}</td>
                    <td>{{$permission->permission_status}}</td>

                    <td width="150">
                        

                        <!-- Give Permission using modal from id -->
                        <a href="" class="give" data-toggle="modal"
                            data-target="#givePermissionModal{{ $permission->id }}"><i class="material-icons"
                                data-toggle="tooltip" title="Give">&#xe8e0;</i></a>
                    </td>
                </tr>
                
                <!-- Give Permission like delete modal -->
                <div id="givePermissionModal{{ $permission->id }}" class="modal fade" value="{{ $permission->id }}"
                    tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="#givee-court-form" method="post"
                                action="{{ route('permission.update', $permission->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h4 class="modal-title">Give Permission</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure want to give permission to
                                        <b>{{ $permission->instructure->instructure_name}}</b>?</p>
                                </div>
                                <!-- hidden value of id -->
                                <input type="hidden" name="id" value= "{{ $permission->id }}">
                                <!-- Hidden value of permission_status -->
                                <input type="hidden" name="permission_status" value="confirm">
                                <!-- Hidden value of id instructure -->
                                <input type="hidden" name="id_instructure" value="{{ $permission->id_instructure }}">
                                <!-- Hidden value of id timetable -->
                                <input type="hidden" name="id_timetable" value="{{ $permission->id_timetable }}">
                                <!-- Hidden value of subtitute_instructure -->
                                <input type="hidden" name="subtitute_instructure" value="{{ $permission->subtitute_instructure }}">
                                <!-- Hidden value of permission_date -->
                                <input type="hidden" name="permission_date" value="{{ $permission->permission_date }}">
                                <!-- Hidden value of permission_att_session -->
                                <input type="hidden" name="permission_att_session" value="{{ $permission->permission_att_session }}">
                                <div class="modal-footer">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                    <input type="submit" class="btn btn-danger" value="Give it">
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
            <div class="hint-text">Showing <b>{{ $permissions->count() }}</b> out of
                <b>{{ $permissions->total() }}</b>
                entries</div>
            {{ $permissions->links() }}
        </div>

        <!-- End Pagination -->

    </div>
</div>







    </script>

    @endsection
