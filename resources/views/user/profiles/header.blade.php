<div class="row mb-5">
    <div class="col-4">
        {{-- icon/avatar --}}
        @if($user->avatar)
        <img src="{{ $user->avatar }}" alt="" class="rounded-circle image-lg d-block mx-auto">
        @else
        <i class="fa-solid fa-circle-user text-secondary icon-lg d-block text-center"></i>
        @endif
    </div>
    <div class="col">
        <div class="row align-items-center mb-3">
            <div class="col-auto">
                <h2 class="display-6 mb-0">{{ $user->name }}</h2>
            </div>
            <div class="col">
                {{-- button --}}
                @if($user->id == Auth::user()->id)
                    {{-- edit profile --}}
                    <a href="{{ route('profile.edit')}}" class="btn btn-sm btn-outline-secondary fw-bold">Edit Profile</a>
                @else
                    @if($user->isFollowed())
                        {{-- unfollow --}}
                        <form action="{{ route('follow.destroy', $user->id)}}" method="post">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-secondary fw-bold">Following</button>
                        </form>
                    @else
                    {{-- follow --}}
                    <form action="{{ route('follow.store', $user->id)}}" method="post">
                        @csrf 
                        <button type="submit" class="btn btn-sm btn-primary fw-bold">Follow</button>
                    </form>
                    @endif
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-auto">
                <a href="{{ route('profile.show', $user->id)}}" class="text-decoration-none text-dark">
                    <strong>{{ $user->posts->count() }}</strong> {{ $user->posts->count()==1 ? 'post' : 'posts' }}
                    {{-- <if condition> ? <true> : <false> --}}
                </a>
            </div>
            <div class="col-auto">
                <a href="{{ route('profile.followers', $user->id)}}" class="text-decoration-none text-dark">
                    <strong>{{ $user->followers->count() }}</strong> {{ $user->followers->count()==1 ? 'follower' : 'followers'}}
                </a>
            </div>
            <div class="col-auto">
                <a href="{{ route('profile.following', $user->id)}}" class="text-decoration-none text-dark">
                    <strong>{{ $user->follows->count() }}</strong> following
                </a>
            </div>
        </div>

        <p class="fw-bold">{{ $user->introduction }}</p>
    </div>
</div>