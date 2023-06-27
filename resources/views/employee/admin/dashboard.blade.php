@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container-fluid">
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-0">Dashboard</h3>
        </div>
        <div class="row">
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-left-primary py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col mr-2">
                                <div class="text-uppercase text-primary font-weight-bold text-xs mb-1">
                                    <span><strong>Employee Control</strong></span><span
                                        style="font-size: 10px;color: rgb(154,154,154);"><br>Admin dapat mengatur data
                                        pegawai<br></span></div>
                                <div class="text-dark h6 mb-0">
                                    <p class="mb-0" style="font-size: 12px;color: rgb(154,154,154);">Click<a href="">
                                            <b>Here</b></a> to view more</p>

                                </div>

                            </div>
                            <div class="col-auto"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    viewBox="0 0 16 16" fill="currentColor"
                                    class="bi bi-file-earmark-person fa-2x text-gray-300">
                                    <path
                                        d="M4 0h5.5v1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h1V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z">
                                    </path>
                                    <path d="M9.5 3V0L14 4.5h-3A1.5 1.5 0 0 1 9.5 3z"></path>
                                    <path fill-rule="evenodd" d="M8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"></path>
                                    <path
                                        d="M8 12c4 0 5 1.755 5 1.755V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-.245S4 12 8 12z">
                                    </path>
                                </svg></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-left-success py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col mr-2">
                                <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>Promo
                                        Control</span><span style="font-size: 10px;color: rgb(154,154,154);"><br>Admin
                                        dapat mengatur data Promo<br></span></div>
                                <div class="text-dark h6 mb-0">
                                    <p class="mb-0" style="font-size: 12px;color: rgb(154,154,154);">Click<a href="">
                                            <b>Here</b></a> to view more</p>

                                </div>

                            </div>
                            <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-left-info py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col mr-2">
                                <div class="text-uppercase text-info font-weight-bold text-xs mb-1"><span>instructor
                                        Control</span><span style="font-size: 10px;color: rgb(154,154,154);"><br>Admin dapat mengatur data
                                        Instruktur<br></span></div>
                                <div class="text-dark h6 mb-0">
                                    <p class="mb-0" style="font-size: 12px;color: rgb(154,154,154);">Click<a href="{{route('instructure.index')}}">
                                            <b>Here</b></a> to view more</p>

                                </div>

                            </div>
                            <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
