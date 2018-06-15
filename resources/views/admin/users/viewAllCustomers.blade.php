@extends('layouts.adminDashboard')

@section('body')
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        Registered Customers ({{$totalUsers}})
        <span class="pull-right clickable panel-toggle panel-button-tab-left">
          <em class="fa fa-toggle-up"></em>
        </span>
      </div>
      <div class="panel-body">
        <table>
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Contact</th>
              <th scope="col">Address</th>
              <th scope="col">Block/Unblock</th>
              <th scope="col">View</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
            <tr>
              <td data-label="#">{{ (($users->currentPage() - 1 ) * $users->perPage() ) + $loop->iteration }}</td>
              <td data-label="Customer">{{$user->name}}</td>
              <td data-label="Email">{{$user->email}}</td>
              <td data-label="Contact">{{$user->contact}}</td>
              <td data-label="Address">{{$user->address.' '.$user->society.', '.$user->city}}</td>
              <td data-label="Block/Unblock">
                @if($user->status == 0)
                <a href="/admin/unBlockCustomer/{{$user->id}}">
                  <span style="color:green">UnBlock</span>
                </a>
                @endif @if($user->status == 1)
                <a href="/admin/blockCustomer/{{$user->id}}">
                  <span style="color:red">Block</span>
                </a>
                @endif
              </td>
              <td data-label="View">
                <a href="/admin/viewSpecificCustomer/{{$user->id}}">
                  <i class="fa fa-search" aria-hidden="true"></i>
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $users->links() }}
      </div>
    </div>
  </div>
</div>
<!--/.row-->
@endsection