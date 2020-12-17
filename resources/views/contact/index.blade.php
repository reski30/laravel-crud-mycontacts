@extends('contact')

@section('main')

<div class="container">
    <div class="row">
        <div class="col-md-9 mb-3">
            <a href="{{ url("contacts/create") }}" class="btn btn-success mb-2">Add New</a>
        </div>
        <div class="col-md-3 mb-3">
            <form action="{{ url("/") }}" class="form-inline" method="GET">
                <div class="form-group mb-2">
                    <input value="{{ Request::get('keyword') }}" name="keyword" type="text" class="form-control mr-2"
                        placeholder="Search by Name">
                </div>
                <button type="submit" class="btn btn-primary mb-2">Search</button>
            </form>
        </div>
    </div>
</div>

@if(session()->get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong> {{ session()->get('success')}} </strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif



    <div class="row">   
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->id }}</td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->phone }}</td>
                        <td>{{ $contact->address }}</td>
                        <td>
                            <a href="{{ url("contacts/{$contact->id}/edit") }}" class="btn btn-primary">EDIT</a>
                        </td>
                        <td>
                            <form action="{{ url("contacts/$contact->id") }}" method="post">
                                @csrf
                                @method('DELETE')
                                    <button class="btn btn-danger">DELETE</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div> 
    </div>
    
@endsection