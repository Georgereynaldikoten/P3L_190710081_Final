@extends('layouts.app')

@section('content')


<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <!-- Button Back -->
            <div class="col-sm-13">
                <a href="{{ route('cashier.index') }}" class="btn btn-danger"><i class="material-icons">&#xf060</i>
                    <span>Back</span></a>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <h2>Manage <b>member</b></h2>
                </div>

                <div class="col-sm-6 button">
                    <a href="#addmemberModal" class="btn btn-success" data-toggle="modal"><i
                            class="material-icons">&#xE147;</i> <span>Add New member</span></a>
                </div>
            </div>
        </div>
        <!-- Make form to get Data member -->
        <form action="{{ route('member.search') }}" method="GET" role="search">
            <div class="input-group">
                <span class="input-group-btn mr-2 mt-0">
                    <button class="btn btn-info" type="submit" title="Search projects">
                        <span class="fas fa-search"></span>
                    </button>
                </span>
                <input type="text" class="form-control mr-2" name="search" placeholder="Masukan Nama" id="term">
                <a href="{{ route('member.index') }}" class=" mt-0">
                    <span class="input-group-btn">
                        <button class="btn btn-danger" type="button" title="Refresh page">
                            <span class="fas fa-sync-alt"></span>
                        </button>
                    </span>
                </a>
            </div>
        </form>
        <!-- End form to get Data member -->

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

                    <th>id</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Gender</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($members as $member)
                <tr>

                    <!-- get 2 first digit of id point 2 dgit point-->
                    <td>{{ substr($member->id, 0, 2) . '.' . substr($member->id, 2, 2) . '.' . substr($member->id, 4, 3) }}
                    </td>

                    <td>{{$member->member_name}}</td>
                    <td>{{$member->member_status}}</td>
                    <td>{{$member->member_email}}</td>
                    <td>{{$member->member_address}}</td>
                    <td>{{$member->member_gender}}</td>
                    <td width="150">
                        @csrf
                        <!-- Get id member -->
                        <input type="hidden" class="member_id" value="{{ $member->id }}">
                        <!-- Edit member using modal from id -->
                        <a href="{{ route('member.update', $member->id) }}" class="edit" data-toggle="modal"
                            data-target="#editmemberModal{{ $member->id }}"><i class="material-icons"
                                data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                        <!-- Delete member using modal from id -->
                        <a href="{{ route('member.delete', $member->id) }}" class="delete" data-toggle="modal"
                            data-target="#deletememberModal{{ $member->id }}"><i class="material-icons"
                                data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                        <!-- View member using modal from id -->
                        <a href="{{ route('member.show', $member->id) }}" class="view" data-toggle="modal"
                            data-target="#viewmemberModal{{ $member->id }}"><i class="material-icons"
                                data-toggle="tooltip" title="View">&#xE417;</i></a>
                        <!-- Reset Password member using modal from id -->
                        <a href="{{ route('member.reset', $member->id) }}" class="reset" data-toggle="modal"
                            data-target="#resetmemberModal{{ $member->id }}"><i class="material-icons"
                                data-toggle="tooltip" title="Reset Password">&#xE8B3;</i></a>
                        <!-- Generate PDF member using modal from id -->
                        <a href="" class="pdf" data-toggle="modal"
                            data-target="#generatememberModal{{ $member->id }}"><i class="material-icons"
                                data-toggle="tooltip" title="Generate PDF">&#xE24D;</i></a>




                    </td>
                </tr>
                <!--Edit Modal HTML with id member -->
                <div id="editmemberModal{{ $member->id }}" class="modal fade" value="{{ $member->id }}" tabindex="-1"
                    role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="#edit-court-form" method="post"
                                action="{{ route('member.update', $member->id) }}">
                                @csrf
                                @method('PUT')
                                <!-- Insert hidden input to get id member -->
                                <input type="hidden" name="id" id="id" value="{{ $member->id }}">
                                <!-- Insert hidden input to get id_user member -->
                                <input type="hidden" name="id_user" id="id_user" value="{{ $member->id_user }}">
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit member</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <!-- Name member Edit -->
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="member_name"
                                            placeholder="Nama Member" value="{{ $member->member_name }}"
                                            id="member_name" required>
                                        @error('member_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- member Status Edit -->
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control border" name="member_status" id="member_status"
                                            required>
                                            <option value="{{ $member->member_status }}">
                                                {{$member->member_status}}</option>
                                            <option value="Active">Active</option>
                                            <option value="Non Active">Non Active</option>
                                        </select>
                                        @error('member_status')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- member Address Edit -->
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" name="member_address"
                                            placeholder="Alamat Member" value="{{ $member->member_address }}"
                                            id="member_address" required>
                                        @error('member_address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- member gender Edit -->
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select class="form-control border" name="member_gender" id="member_gender"
                                            required>
                                            <option value="{{ $member->member_gender }}">
                                                {{$member->member_gender}}</option>
                                            <option value="Pria">Pria</option>
                                            <option value="Wanita">Wanita</option>
                                        </select>
                                        @error('member_gender')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- member Birth date Edit -->
                                    <div class="form-group">
                                        <label>Birth Date</label>
                                        <input type="date" class="form-control" name="member_birth_date"
                                            placeholder="Tanggal Lahir Member" value="{{ $member->member_birth_date }}"
                                            id="member_birth_date" required>
                                        @error('member_birth_date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- member Phone Number Edit -->
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control" name="member_phone_number"
                                            placeholder="Nomor Telepon Member"
                                            value="{{ $member->member_phone_number }}" id="member_phone_number"
                                            required>
                                        @error('member_phone_number')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- member Email Edit -->
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="member_email"
                                            placeholder="Email Member" value="{{ $member->member_email }}"
                                            id="member_email" required>
                                        @error('member_email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- member Password Edit -->
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="member_password"
                                            placeholder="Password Member" value="{{ $member->member_password }}"
                                            id="member_password" required>
                                        @error('member_password')
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
                <!-- Reset Password Modal HTML -->
                <div id="resetmemberModal{{ $member->id }}" class="modal fade" value="{{ $member->id }}" tabindex="-1"
                    role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="#edit-court-form" method="post" action="{{ route('member.reset', $member->id) }}">
                                @csrf
                                @method('PUT')

                                <!-- Insert hidden input to get id member -->
                                <input type="hidden" name="id" id="id" value="{{ $member->id }}">
                                <!-- Insert hidden input to get id_user member -->
                                <input type="hidden" name="id_user" id="id_user" value="{{ $member->id_user }}">
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit member</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input type="password" class="form-control" name="member_password"
                                            placeholder="Password Member" id="member_password" required>
                                        @error('member_password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                                </div>
                                <div class="modal-footer">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                    <input type="submit" class="btn btn-success" value="Save">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Reset Password Modal -->

                <!-- Delete Modal HTML -->
                <div id="deletememberModal{{ $member->id }}" class="modal fade" value="{{ $member->id }}" tabindex="-1"
                    role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="#delete-court-form" method="post"
                                action="{{ route('member.delete', $member->id) }}">
                                @csrf
                                @method('DELETE')
                                <div class="modal-header">
                                    <h4 class="modal-title">Delete member</h4>
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

                <!-- show Modal HTML -->
                <div id="viewmemberModal{{ $member->id }}" class="modal fade" value="{{ $member->id }}" tabindex="-1"
                    role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <form id="#view-court-form" method="post" action="{{ route('member.show', $member->id) }}">
                                @csrf
                                @method('GET')
                                <!-- Nama member -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Show Details</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">&times;</button>
                                </div>
                                <!-- End Nama member -->
                                <!-- member Photo -->
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="{{ asset('assets/img/avatars/user.png') }}" width="90px"
                                                height="90px">
                                            <!-- Nama member-->
                                            <h5 class="modal-title-center"><b>{{$member->member_name}}</b></h5>
                                        </div>
                                        <br>

                                        <div class="col-md-12 mt-2">

                                            <div class="col">
                                                <h6><b>ID
                                                        :</b>{{substr($member->id,0,2). '.' . substr($member->id, 2, 2) . '.' . substr($member->id, 4, 3) }}
                                                </h6>
                                                <h6><b>Name :</b> {{$member->member_name}}</h6>
                                                <h6><b>Status :</b> {{$member->member_status}}</h6>
                                                <h6><b>Address :</b> {{$member->member_address}}</h6>
                                                <h6><b>Jenis Kelamin :</b> {{$member->member_gender}}</h6>
                                                <h6><b>Phone Number :</b> {{$member->member_phone_number}}</h6>
                                                <h6><b>Email :</b> {{$member->member_email}}</h6>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <!-- End Edit member -->

                            </form>
                        </div>
                    </div>
                </div>
                <!-- End show Modal -->

                <!-- Generate PDF Modal HTML -->
                <div id="generatememberModal{{ $member->id }}" class="modal fade" value="{{ $member->id }}"
                    tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="#generatePDF-court-form" method="post"
                                action="{{ route('member.card', $member->id) }}">
                                @csrf
                                @method('GET')
                                <div class="modal-header">
                                    <h4 class="modal-title">Generate PDF</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">&times;</button>
                                </div>
                                <!-- Nama member -->
                                <div class="modal-body">
                                    <p>Are you sure you want to generate PDF?</p>
                                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                                </div>
                                <div class="modal-footer">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                    <input type="submit" class="btn btn-success" value="Generate">
                                </div>
                                <!-- End Nama member -->
                            </form>
                        </div>

                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
        <!-- End Table -->
        <!-- Make Pagination -->
        <div class="clearfix">
            <div class="hint-text">Showing <b>{{ $members->count() }}</b> out of
                <b>{{ $members->total() }}</b>
                entries</div>
            {{ $members->links() }}
        </div>

        <!-- End Pagination -->

    </div>
</div>


<!-- Add Modal HTML -->
<div id="addmemberModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('member.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Add member </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="member_name" placeholder="Nama Member" required>
                        @error('member_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- member Status -->
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control border" name="member_status" required>
                            <option value="">Select Status</option>
                            <option value="aktif">aktif</option>
                            <option value="non-aktif">non-aktif</option>
                        </select>
                        @error('member_status')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- member Address -->
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="member_address" placeholder="Alamat Member"
                            value="{{ old('member_address') }}" required>
                        @error('member_address')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- member Gender -->
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select class="form-control border" name="member_gender" required>
                            <option value="">Select Gender</option>
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                        @error('member_gender')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Member Birth Date -->
                    <div class="form-group">
                        <label>Birth Date</label>
                        <input type="date" class="form-control" name="member_birth_date"
                            placeholder="Tanggal Lahir Member" value="{{ old('member_birth_date') }}" required>
                        @error('member_birth_date')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- member Phone Number -->
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" class="form-control" name="member_phone_number"
                            placeholder="Nomor Telepon Member" required>
                        @error('member_phone_number')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- member Email -->
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="member_email" placeholder="Email Member"
                            required>
                        @error('member_email')
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







</script>

@endsection
