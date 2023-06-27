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
                <div class="col-sm-6">
                    <h2>Manage <b>Instructure</b></h2>
                </div>

                <div class="col-sm-6 button">
                    <a href="#addInstructureModal" class="btn btn-success" data-toggle="modal"><i
                            class="material-icons">&#xE147;</i> <span>Add New Instructure</span></a>
                </div>
            </div>
        </div>
        <!-- Make form to get Data Instructure -->
        <form action="{{ route('instructure.search') }}" method="GET" role="search">
            <div class="input-group">
                <span class="input-group-btn mr-2 mt-0">
                    <button class="btn btn-info" type="submit" title="Search projects">
                        <span class="fas fa-search"></span>
                    </button>
                </span>
                <input type="text" class="form-control mr-2" name="search" placeholder="Masukan Nama" id="term">
                <a href="{{ route('instructure.index') }}" class=" mt-0">
                    <span class="input-group-btn">
                        <button class="btn btn-danger" type="button" title="Refresh page">
                            <span class="fas fa-sync-alt"></span>
                        </button>
                    </span>
                </a>
            </div>
        </form>
        <!-- End form to get Data Instructure -->

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
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($instructures as $instructure)
                <tr>

                    <td>{{$instructure->id}}</td>
                    <td>{{$instructure->instructure_name}}</td>
                    <td>{{$instructure->instructure_email}}</td>
                    <td>{{$instructure->instructure_address}}</td>
                    <td>{{$instructure->instructure_phone_number}}</td>
                    <td width="150">
                        <!-- Get id instructure -->
                        <input type="hidden" class="instructure_id" value="{{ $instructure->id }}">
                        <!-- Edit Instructure using modal from id -->
                        <a href="{{ route('instructure.update', $instructure->id) }}" class="edit" data-toggle="modal"
                            data-target="#editInstructureModal{{ $instructure->id }}"><i class="material-icons"
                                data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                        <!-- Delete Instructure using modal from id -->
                        <a href="{{ route('instructure.delete', $instructure->id) }}" class="delete" data-toggle="modal"
                            data-target="#deleteInstructureModal{{ $instructure->id }}"><i class="material-icons"
                                data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                        <!-- View Instructure using modal from id -->
                        <a href="{{ route('instructure.show', $instructure->id) }}" class="view" data-toggle="modal"
                            data-target="#viewInstructureModal{{ $instructure->id }}"><i class="material-icons"
                                data-toggle="tooltip" title="View">&#xE417;</i></a>



                    </td>
                </tr>
                <!--Edit Modal HTML with id instructure -->
                <div id="editInstructureModal{{ $instructure->id }}" class="modal fade" value="{{ $instructure->id }}"
                    tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="#edit-court-form" method="post"
                                action="{{ route('instructure.update', $instructure->id) }}">
                                @csrf
                                @method('PUT')
                                <!-- Insert hidden input to get id instructure -->
                                <input type="hidden" name="id" id="id" value="{{ $instructure->id }}">
                                <!-- Insert hidden input to get id_user instructure -->
                                <input type="hidden" name="id_user" id="id_user" value="{{ $instructure->id_user }}">
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit Instructure</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <!-- Name Instructure Edit -->
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="instructure_name"
                                            placeholder="Nama Instructur" value="{{ $instructure->instructure_name }}"
                                            id="instructure_name" required>
                                        @error('instructure_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Instructure Address Edit -->
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" name="instructure_address"
                                            placeholder="Alamat Instructur"
                                            value="{{ $instructure->instructure_address }}" id="instructure_address"
                                            required>
                                        @error('instructure_address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Instructure gender Edit -->
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select class="form-control border" name="instructure_gender" id="instructure_gender"
                                            required>
                                            <option value="{{ $instructure->instructure_gender }}">
                                                {{$instructure->instructure_gender}}</option>
                                            <option value="Pria">Pria</option>
                                            <option value="Wanita">Wanita</option>
                                        </select>
                                        @error('instructure_gender')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Instructure Birth Date Edit -->
                                    <div class="form-group">
                                        <label>Birth Date</label>
                                        <input type="date" class="form-control" name="instructure_birth_date"
                                            placeholder="Tanggal Lahir Instructur"
                                            value="{{ $instructure->instructure_birth_date }}"
                                            id="instructure_birth_date" required>
                                        @error('instructure_birth_date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Instructure Phone Number Edit -->
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control" name="instructure_phone_number"
                                            placeholder="Nomor Telepon Instructur"
                                            value="{{ $instructure->instructure_phone_number }}"
                                            id="instructure_phone_number" required>
                                        @error('instructure_phone_number')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Count Instructure Present Edit -->
                                    <div class="form-group">
                                        <label>Count Present</label>
                                        <input type="text" class="form-control" name="count_instructure_present"
                                            placeholder="Jumlah Kehadiran Instructur"
                                            value="{{ $instructure->count_instructure_present }}"
                                            id="count_instructure_present" required>
                                        @error('count_instructure_present')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Instructure Email Edit -->
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="instructure_email"
                                            placeholder="Email Instructur" value="{{ $instructure->instructure_email }}"
                                            id="instructure_email" required>
                                        @error('instructure_email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Instructure Password Edit -->
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="instructure_password"
                                            placeholder="Password Instructur"
                                            value="{{ $instructure->instructure_password }}" id="instructure_password"
                                            required>
                                        @error('instructure_password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Count Instructure Absent Edit -->
                                    <div class="form-group">
                                        <label>Count Absent</label>
                                        <input type="text" class="form-control" name="count_instructure_absent"
                                            placeholder="Jumlah Absen Instructur"
                                            value="{{ $instructure->count_instructure_absent }}"
                                            id="count_instructure_absent" required>
                                        @error('count_instructure_absent')
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
                <div id="deleteInstructureModal{{ $instructure->id }}" class="modal fade" value="{{ $instructure->id }}"
                    tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="#delete-court-form" method="post"
                                action="{{ route('instructure.delete', $instructure->id) }}">
                                @csrf
                                @method('DELETE')
                                <div class="modal-header">
                                    <h4 class="modal-title">Delete Instructure</h4>
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
                <div id="viewInstructureModal{{ $instructure->id }}" class="modal fade" value="{{ $instructure->id }}"
                    tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <form id="#view-court-form" method="post"
                                action="{{ route('instructure.show', $instructure->id) }}">
                                @csrf
                                @method('GET')
                                <!-- Nama Instructure -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Show Details</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">&times;</button>
                                </div>
                                <!-- End Nama Instructure -->
                                <!-- Instructure Photo -->
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                        <img src="{{ asset('assets/img/avatars/user.png') }}" width="90px" height="90px">
                                        <!-- Nama Instructure-->
                                        <h5 class="modal-title-center"><b>{{$instructure->instructure_name}}</b></h5>                                  
                                        </div>
                                        <br>
                                        
                                        <div class="col-md-12 mt-2">
                                            
                                                <div class="col">
                                                    <h6><b>Name :</b> {{$instructure->instructure_name}}</h6>
                                                    <h6><b>Address :</b> {{$instructure->instructure_address}}</h6>
                                                    <h6><b>Jenis Kelamin :</b> {{$instructure->instructure_gender}}</h6>
                                                    <h6><b>Phone Number :</b> {{$instructure->instructure_phone_number}}</h6>
                                                    <h6><b>Count Present :</b> {{$instructure->count_instructure_present}}</h6>
                                                    <h6><b>Email :</b> {{$instructure->instructure_email}}</h6>
                                                    <h6><b>Count Absent :</b> {{$instructure->count_instructure_absent}}</h6>
                                                    
                                                </div>
                                        </div>
                                    </div>
                                </div>           
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End show Modal -->
                @endforeach
            </tbody>
        </table>
        <!-- End Table -->
        <!-- Make Pagination -->
        <div class="clearfix">
            <div class="hint-text">Showing <b>{{ $instructures->count() }}</b> out of
                <b>{{ $instructures->total() }}</b>
                entries</div>
            {{ $instructures->links() }}
        </div>

        <!-- End Pagination -->

    </div>
</div>


<!-- Add Modal HTML -->
<div id="addInstructureModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('instructure.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Add Instructure </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="instructure_name" placeholder="Nama Instructur"
                            required>
                        @error('instructure_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Instructure Address -->
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="instructure_address"
                            placeholder="Alamat Instructur" value="{{ old('instructure_address') }}" required>
                        @error('instructure_address')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Instructure Gender -->
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select class="form-control border" name="instructure_gender" required>
                            <option value="">Select Gender</option>
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                        @error('instructure_gender')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Instructure Birth Date -->
                    <div class="form-group">
                        <label>Birth Date</label>
                        <input type="date" class="form-control" name="instructure_birth_date"
                            placeholder="Tanggal Lahir Instructur" value="{{ old('instructure_birth_date') }}" required>
                        @error('instructure_birth_date')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Instructure Phone Number -->
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" class="form-control" name="instructure_phone_number"
                            placeholder="Nomor Telepon Instructur" required>
                        @error('instructure_phone_number')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Count Instructure Present -->
                    <div class="form-group">
                        <label>Count Instructure Present</label>
                        <input type="text" class="form-control" name="instructure_count_present"
                            placeholder="Jumlah Kehadiran Instructur" value=0 required>
                        @error('instructure_count_present')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Instructure Email -->
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="instructure_email" placeholder="Email Instructur"
                            required>
                        @error('instructure_email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Instructure Password -->
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="instructure_password"
                            placeholder="Password Instructur" required>
                        @error('instructure_password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Count Instructure Absent -->
                    <div class="form-group">
                        <label>Count Instructure Absent</label>
                        <input type="text" class="form-control" name="instructure_count_absent"
                            placeholder="Jumlah Absensi Instructur" value=0 required>
                        @error('instructure_count_absent')
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
