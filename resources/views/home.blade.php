@extends('template')
@section('content')
<h3 class="mt-4">DASHBOARD</h3>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">/ Dashboard</li>
</ol>
<div class="row mt-3">
    <div class="col-3">
        {{-- <div class="card bg-primary bg-opacity-50">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="row text-center fw-bold fs-3">
                            <div class="col-12">12</div>
                            <div class="col-12">Customer</div>
                        </div>
                    </div>
                    <div class="col-3"><i class="fa-regular fa-user fa-5x"></i></div>
                </div>
            </div>
        </div> --}}

        {{-- <div class="card bg-primary" style="width: 18rem;">
            <ul class="list-group list-group-flush bg-primary ">
              <li class="list-group-item">12 Person</li>
              <li class="list-group-item">See Details</li>
            </ul>
        </div> --}}

        <div class="card bg-primary">
            <ul class="list-group list-group-flush bg-primary ">
                <li class="list-group-item fs-3 fw-bold">12 <sub>Customer</sub></li>
                <li class="list-group-item">See Details <span class="float-end">></span></li>
              </ul>
        </div>

    </div>
    <div class="col-3">
        <div class="card bg-primary bg-opacity-50">
            <div class="card-body">
                <h5 class="card-title"><i class="fa-regular fa-user"></i> Customer</h5>
                <div class="fs-3 text-end">12 Person</div>
            </div>
          </div>
    </div>
    <div class="col-3">

    </div>
    <div class="col-3">

    </div>
</div>
@endsection
