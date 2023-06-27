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
                    <h2>Manage <b>deposit</b></h2>
                </div>

                <div class="col-sm-6 button">
                    <a href="#addmemberModal" class="btn btn-success" data-toggle="modal"><i
                            class="material-icons">&#xE147;</i> <span>Add New deposit</span></a>
                </div>
            </div>
        </div>
        <!-- Make form to get Data deposit -->
        <form action="{{ route('deposit.searchdeposituang') }}" method="GET" role="search">
            <div class="input-group">
                <span class="input-group-btn mr-2 mt-0">
                    <button class="btn btn-info" type="submit" title="Search projects">
                        <span class="fas fa-search"></span>
                    </button>
                </span>
                <input type="text" class="form-control mr-2" name="search" placeholder="Masukan Nama" id="term">
                <a href="{{ route('deposit.index') }}" class=" mt-0">
                    <span class="input-group-btn">
                        <button class="btn btn-danger" type="button" title="Refresh page">
                            <span class="fas fa-sync-alt"></span>
                        </button>
                    </span>
                </a>
            </div>
        </form>
        <!-- End form to get Data deposit -->

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
                @foreach ($members as $deposit)
                <tr>

                    <!-- get 2 first digit of id point 2 dgit point-->
                    <td>{{ substr($deposit->id, 0, 2) . '.' . substr($deposit->id, 2, 2) . '.' . substr($deposit->id, 4, 3) }}
                    </td>

                    <td>{{$deposit->member_name}}</td>
                    <td>{{$deposit->member_status}}</td>
                    <td>{{$deposit->member_email}}</td>
                    <td>{{$deposit->member_address}}</td>
                    <td>{{$deposit->member_gender}}</td>
                    <td width="150">
                        @csrf
                        <!-- Get id deposit -->
                        <input type="hidden" class="member_id" value="{{ $deposit->id }}">
                        <!-- Edit deposit using modal from id -->
                        <a href="{{ route('deposit.update', $deposit->id) }}" class="edit" data-toggle="modal"
                            data-target="#editmemberModal{{ $deposit->id }}"><i class="material-icons"
                                data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                        <!-- Delete deposit using modal from id -->
                        <a href="{{ route('deposit.delete', $deposit->id) }}" class="delete" data-toggle="modal"
                            data-target="#deletememberModal{{ $deposit->id }}"><i class="material-icons"
                                data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                        <!-- View deposit using modal from id -->
                        <a href="{{ route('deposit.show', $deposit->id) }}" class="view" data-toggle="modal"
                            data-target="#viewmemberModal{{ $deposit->id }}"><i class="material-icons"
                                data-toggle="tooltip" title="View">&#xE417;</i></a>
                        <!-- Reset Password deposit using modal from id -->
                        <a href="{{ route('deposit.reset', $deposit->id) }}" class="reset" data-toggle="modal"
                            data-target="#resetmemberModal{{ $deposit->id }}"><i class="material-icons"
                                data-toggle="tooltip" title="Reset Password">&#xE8B3;</i></a>
                        <!-- Generate PDF deposit using modal from id -->
                        <a href="" class="pdf" data-toggle="modal"
                            data-target="#generatememberModal{{ $deposit->id }}"><i class="material-icons"
                                data-toggle="tooltip" title="Generate PDF">&#xE24D;</i></a>




                    </td>
                </tr>
                <!--Edit Modal HTML with id deposit -->
                <div id="editmemberModal{{ $deposit->id }}" class="modal fade" value="{{ $deposit->id }}" tabindex="-1"
                    role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="#edit-court-form" method="post"
                                action="{{ route('deposit.update', $deposit->id) }}">
                                @csrf
                                @method('PUT')
                                <!-- Insert hidden input to get id deposit -->
                                <input type="hidden" name="id" id="id" value="{{ $deposit->id }}">
                                <!-- Insert hidden input to get id_user deposit -->
                                <input type="hidden" name="id_user" id="id_user" value="{{ $deposit->id_user }}">
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit deposit</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <!-- Name deposit Edit -->
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="member_name"
                                            placeholder="Nama Deposit" value="{{ $deposit->member_name }}"
                                            id="member_name" required>
                                        @error('member_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- deposit Status Edit -->
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control border" name="member_status" id="member_status"
                                            required>
                                            <option value="{{ $deposit->member_status }}">
                                                {{$deposit->member_status}}</option>
                                            <option value="Active">Active</option>
                                            <option value="Non Active">Non Active</option>
                                        </select>
                                        @error('member_status')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- deposit Address Edit -->
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" name="member_address"
                                            placeholder="Alamat Deposit" value="{{ $deposit->member_address }}"
                                            id="member_address" required>
                                        @error('member_address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- deposit gender Edit -->
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select class="form-control border" name="member_gender" id="member_gender"
                                            required>
                                            <option value="{{ $deposit->member_gender }}">
                                                {{$deposit->member_gender}}</option>
                                            <option value="Pria">Pria</option>
                                            <option value="Wanita">Wanita</option>
                                        </select>
                                        @error('member_gender')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- deposit Birth date Edit -->
                                    <div class="form-group">
                                        <label>Birth Date</label>
                                        <input type="date" class="form-control" name="member_birth_date"
                                            placeholder="Tanggal Lahir Deposit" value="{{ $deposit->member_birth_date }}"
                                            id="member_birth_date" required>
                                        @error('member_birth_date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- deposit Phone Number Edit -->
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control" name="member_phone_number"
                                            placeholder="Nomor Telepon Deposit"
                                            value="{{ $deposit->member_phone_number }}" id="member_phone_number"
                                            required>
                                        @error('member_phone_number')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- deposit Email Edit -->
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="member_email"
                                            placeholder="Email Deposit" value="{{ $deposit->member_email }}"
                                            id="member_email" required>
                                        @error('member_email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- deposit Password Edit -->
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="member_password"
                                            placeholder="Password Deposit" value="{{ $deposit->member_password }}"
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
                <div id="resetmemberModal{{ $deposit->id }}" class="modal fade" value="{{ $deposit->id }}" tabindex="-1"
                    role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="#edit-court-form" method="post" action="{{ route('deposit.reset', $deposit->id) }}">
                                @csrf
                                @method('PUT')

                                <!-- Insert hidden input to get id deposit -->
                                <input type="hidden" name="id" id="id" value="{{ $deposit->id }}">
                                <!-- Insert hidden input to get id_user deposit -->
                                <input type="hidden" name="id_user" id="id_user" value="{{ $deposit->id_user }}">
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit deposit</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input type="password" class="form-control" name="member_password"
                                            placeholder="Password Deposit" id="member_password" required>
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
                <div id="deletememberModal{{ $deposit->id }}" class="modal fade" value="{{ $deposit->id }}" tabindex="-1"
                    role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="#delete-court-form" method="post"
                                action="{{ route('deposit.delete', $deposit->id) }}">
                                @csrf
                                @method('DELETE')
                                <div class="modal-header">
                                    <h4 class="modal-title">Delete deposit</h4>
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
                <div id="viewmemberModal{{ $deposit->id }}" class="modal fade" value="{{ $deposit->id }}" tabindex="-1"
                    role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <form id="#view-court-form" method="post" action="{{ route('deposit.show', $deposit->id) }}">
                                @csrf
                                @method('GET')
                                <!-- Nama deposit -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Show Details</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">&times;</button>
                                </div>
                                <!-- End Nama deposit -->
                                <!-- deposit Photo -->
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="{{ asset('assets/img/avatars/user.png') }}" width="90px"
                                                height="90px">
                                            <!-- Nama deposit-->
                                            <h5 class="modal-title-center"><b>{{$deposit->member_name}}</b></h5>
                                        </div>
                                        <br>

                                        <div class="col-md-12 mt-2">

                                            <div class="col">
                                                <h6><b>ID
                                                        :</b>{{substr($deposit->id,0,2). '.' . substr($deposit->id, 2, 2) . '.' . substr($deposit->id, 4, 3) }}
                                                </h6>
                                                <h6><b>Name :</b> {{$deposit->member_name}}</h6>
                                                <h6><b>Status :</b> {{$deposit->member_status}}</h6>
                                                <h6><b>Address :</b> {{$deposit->member_address}}</h6>
                                                <h6><b>Jenis Kelamin :</b> {{$deposit->member_gender}}</h6>
                                                <h6><b>Phone Number :</b> {{$deposit->member_phone_number}}</h6>
                                                <h6><b>Email :</b> {{$deposit->member_email}}</h6>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <!-- End Edit deposit -->

                            </form>
                        </div>
                    </div>
                </div>
                <!-- End show Modal -->

                <!-- Generate PDF Modal HTML -->
                <div id="generatememberModal{{ $deposit->id }}" class="modal fade" value="{{ $deposit->id }}"
                    tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="#generatePDF-court-form" method="post"
                                action="{{ route('deposit.card', $deposit->id) }}">
                                @csrf
                                @method('GET')
                                <div class="modal-header">
                                    <h4 class="modal-title">Generate PDF</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">&times;</button>
                                </div>
                                <!-- Nama deposit -->
                                <div class="modal-body">
                                    <p>Are you sure you want to generate PDF?</p>
                                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                                </div>
                                <div class="modal-footer">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                    <input type="submit" class="btn btn-success" value="Generate">
                                </div>
                                <!-- End Nama deposit -->
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
            <form action="{{ route('deposit.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Add deposit </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="member_name" placeholder="Nama Deposit" required>
                        @error('member_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- deposit Status -->
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
                    <!-- deposit Address -->
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="member_address" placeholder="Alamat Deposit"
                            value="{{ old('member_address') }}" required>
                        @error('member_address')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- deposit Gender -->
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
                    <!-- Deposit Birth Date -->
                    <div class="form-group">
                        <label>Birth Date</label>
                        <input type="date" class="form-control" name="member_birth_date"
                            placeholder="Tanggal Lahir Deposit" value="{{ old('member_birth_date') }}" required>
                        @error('member_birth_date')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- deposit Phone Number -->
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" class="form-control" name="member_phone_number"
                            placeholder="Nomor Telepon Deposit" required>
                        @error('member_phone_number')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- deposit Email -->
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="member_email" placeholder="Email Deposit"
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
