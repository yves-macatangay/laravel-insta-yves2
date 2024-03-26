@extends('layouts.app')

@section('title', $user->name.' - Following')

@section('content')
@include('user.profiles.header')

@if($user->follows->isNotEmpty())
    <div class="row justify-content-center">
        <div class="col-4">
            <h4 class="h5 text-muted text-center">Following</h4>

            @foreach($user->follows as $follow)
                <div class="row mb-3 align-items-center">
                    <div class="col-auto">
                        <a href="{{ route('profile.show', $follow->followed->id) }}">
                            @if($follow->followed->avatar)
                                <img src="{{ $follow->followed->avatar }}" alt="" class="rounded-circle avatar-sm">
                            @else
                                <i class="fa-solid fa-circle-user icon-sm text-secondary"></i>
                            @endif 
                        </a>
                    </div>
                    <div class="col ps-0 text-truncate">
                        <a href="{{ route('profile.show', $follow->followed->id) }}" class="text-decoration-none text-dark fw-bold">
                            {{ $follow->followed->name }}
                        </a>
                    </div>
                    <div class="col-auto">
                        {{-- buttons --}}
                        @if($follow->followed->id != Auth::user()->id)
                            @if($follow->followed->isFollowed())
                                {{-- unfollow --}}
                                <form action="{{ route('follow.destroy', $follow->followed->id)}}" method="post">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="border-0 shadow-none p-0 bg-transparent text-muted">Following</button>
                                </form>
                            @else
                                {{-- follow --}}
                                <form action="{{ route('follow.store', $follow->followed->id)}}" method="post">
                                    @csrf 
                                    <button type="submit" class="border-0 shadow-none p-0 bg-transparent text-primary">Follow</button>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
    <h4 class="h5 text-muted text-center">Not following anyone yet.</h4>
@endif

@endsection