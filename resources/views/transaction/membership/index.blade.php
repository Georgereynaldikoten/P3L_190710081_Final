@extends('layouts.app')

@section('content')


<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <!-- Button Back -->
            <div class="col-sm-13">
                <a href="{{ route('transaction.index') }}" class="btn btn-danger"><i
                        class="material-icons">&#xE15C;</i> <span>Back</span></a>
                  
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <h2>Control <b>Membership</b></h2>
                </div>

                <div class="col-sm-6 button">
                    <a href="#addmemberModal" class="btn btn-success" data-toggle="modal"><i
                            class="material-icons">&#xE147;</i> <span>Add New membership</span></a>
                </div>
            </div>
        </div>
        <!-- Make form to get Data membership -->
        <form action="{{ route('membership.search') }}" method="GET" role="search">
            <div class="input-group">
                <span class="input-group-btn mr-2 mt-0">
                    <button class="btn btn-info" type="submit" title="Search projects">
                        <span class="fas fa-search"></span>
                    </button>
                </span>
                <input type="text" class="form-control mr-2" name="search" placeholder="Masukan Nama" id="term">
                <a href="{{ route('membership.index') }}" class=" mt-0">
                    <span class="input-group-btn">
                        <button class="btn btn-danger" type="button" title="Refresh page">
                            <span class="fas fa-sync-alt"></span>
                        </button>
                    </span>
                </a>
            </div>
        </form>
        <!-- End form to get Data membership -->

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
                    <th>Member Start Date</th>
                    <th>Member End Date</th>
                    <th>Member Fee</th>
                    <th>P.Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($memberships as $membership)
                <tr>

                    <!-- get 2 first digit of id point 2 dgit point-->
                    <td>{{ substr($membership->id, 0, 2) }}</td>
                    <td>{{$membership->member->member_name}}</td>
                    <td>{{$membership->status_membership}}</td>
                    <td>{{$membership->membership_start_date}}</td>
                    <td>{{$membership->membership_end_date}}</td>
                    <td>{{$membership->membership_fee}}</td>
                    <td>{{$membership->membership_payment_status}}</td>
                
                    <td width="150">
                        @csrf
                        <!-- Get id membership -->
                        <input type="hidden" class="member_id" value="{{ $membership->id }}">
                
                        <!-- Generate PDF membership using modal from id -->
                        <a href="" class="pdf" data-toggle="modal"
                            data-target="#generatememberModal{{ $membership->id }}"><i class="material-icons"
                                data-toggle="tooltip" title="Generate PDF">&#xE24D;</i></a>




                    </td>
                </tr>

                <!-- Generate PDF Modal HTML -->
                <div id="generatememberModal{{ $membership->id }}" class="modal fade" value="{{ $membership->id }}"
                    tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="#generatePDF-court-form" method="post"
                                action="{{ route('membership.card', $membership->id) }}">
                                @csrf
                                @method('GET')
                                <div class="modal-header">
                                    <h4 class="modal-title">Generate PDF</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">&times;</button>
                                </div>
                                <!-- Nama membership -->
                                <div class="modal-body">
                                    <p>Are you sure you want to generate PDF?</p>
                                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                                </div>
                                <div class="modal-footer">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                    <input type="submit" class="btn btn-success" value="Generate">
                                </div>
                                <!-- End Nama membership -->
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
            <div class="hint-text">Showing <b>{{ $memberships->count() }}</b> out of
                <b>{{ $memberships->total() }}</b>
                entries</div>
            {{ $memberships->links() }}
        </div>

        <!-- End Pagination -->

    </div>
</div>


<!-- Add Modal HTML -->
<div id="addmemberModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('membership.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Add membership </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- membership Name -->
                    <div class="form-group">
                        <label>Name</label>
                        <select class="form-control border" name="id_member" required>
                            <option value="{{ $membership->id_member}}">
                                {{ $membership->member->member_name }}</option>
                            @foreach ($memberships as $membership)
                            <option value="{{ $membership->id_member }}">{{ $membership->member->member_name }}</option>
                            @endforeach
                        </select>
                        @error('id_member')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- status membership -->
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control border" name="status_membership" required>
                            <option value="">Select Status</option>
                            <option value="aktif">aktif</option>
                            <option value="non-aktif">non-aktif</option>
                        </select>
                        @error('status_membership')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- membership fee hidden -->
                    <input type="hidden" class="form-control" name="membership_fee" value="0" required>

                    <!-- membership Payment Method -->
                    <div class="form-group">
                        <label>Payment Method</label>
                        <select class="form-control border" name="membership_payment_method" required>
                            <option value="">Select Payment Method</option>
                            <option value="cash">Cash</option>
                            <option value="transfer">Transfer</option>
                        </select>
                        @error('membership_payment_method')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- membership Payment Status -->
                    <div class="form-group">
                        <label>Payment Status</label>
                        <select class="form-control border" name="membership_payment_status" required>
                            <option value="">Select Payment Status</option>
                            <option value="paid">Paid</option>
                            <option value="unpaid">Unpaid</option>
                        </select>
                        @error('membership_payment_status')
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
