@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h1 class="card-header">Clients List</h1>
                <div class="card-body">
                    <!-- Sorts and Filters -->
                    <div class="m-3">
                     <img class="fit-picture"  src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTXBXyDU-tpkUZ0IRH7Heewbhz9zV98a6mC1FLhtxwoEzvrnKCPIFk8eHxp38yRpkGrpNs&usqp=CAU"  alt="Grapefruit slice atop a pile of other slices">
                        <form action="{{route('clients-index')}}" method="get">
                            <fieldset>
                                <div class="row">
                                <h4 class="card-title">Sort</h4>
                                    <div class="col-2">
                                        <select class="form-select" name="sort_by">
                                            <option value="" @if(''==$sortBy) selected @endif>No sort</option>
                                            <option value="last_name" @if('last_name'==$sortBy) selected @endif>Last Name</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <select class="form-select" name="order_by">
                                            <option value="asc" @if('asc'==$orderBy) selected @endif>ASC</option>
                                            <option value="desc" @if('desc'==$orderBy) selected @endif>DESC</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4 mt-1">
                                        <button type="submit" class="btn btn-outline-info">Show</button>
                                        <a class="btn btn-outline-secondary m-1" href="{{route('clients-index')}}">Clear</a>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>

                    <!-- Clients List -->
                    <ul class="list-group list-group-flush">
                        @forelse($clients as $client)
                        <li class="list-group-item">
                            <div class="justify-content-between" style="display: flex; flex-direction: row; align-items: center;">
                                <div class="d-flex">
                                    <div>
                                        <div class="fw-bold fs-3 mb-3">{{$client->first_name}} {{$client->last_name}}</div>
                                        @if($client->accounts()->count() > 0)
                                            <div>Total balance:</div>
                                            <div class="fw-bold mb-3">{{$client->accounts()->sum('balance')}} €</div>
                                        @endif
                                        <div>List of accounts and balance:</div>
                                        @if($client->accounts()->count() > 0)
                                            <ol class="list-group list-group-numbered list-group-flush">
                                                @foreach($client->accounts as $account)
                                                    <li class="list-group-item fw-bold">{{$account->iban}} - {{$account->balance}} €</li>
                                                @endforeach
                                            </ol>
                                        @else
                                            <p class="fw-bold mb-3">No accounts</p>
                                            {{-- <button class="btn btn-outline-success mb-3" onclick="window.location.href='{{route('accounts-create', ['client_id' => $client->id])}}'">Add Account</button> --}}
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <a class="btn btn-warning m-1" href="{{route('clients-edit', $client)}}">Edit client </a>
                                    <a class="btn btn-danger m-1" href="{{route('clients-delete', $client)}}">Delete client</a>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">
                            <p class="text-center">No clients</p>
                        </li>
                    @endforelse
                    </ul>
                </div>
            </div>
        </div>
        <!-- Pagination -->
        <div class="col-md-12 mt-4">
            {{$clients->links()}}
        </div>
    </div>
</div>
@endsection