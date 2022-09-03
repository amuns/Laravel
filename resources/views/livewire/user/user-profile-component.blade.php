<div>
    <div>
        <style>
            nav svg{
                height: 20px;
            }
            nav .hidden{
                display: block !important;
            }
        </style>
        <div class="container" style="padding: 30px 0">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                Profile
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-4">
                                @if($user->profile->image)
                                    <img src="{{asset('assets/images/profile')}}/{{$user->profile->image}}" width="100%" alt="">
                                @else
                                    <img src="{{asset('assets/images/profile/dummyprof.jpeg')}}" width="100%" alt="">
                                @endif    
                            </div>
                            <div class="col-md-8">
                                <p><b>Name: </b>{{$user->name}}</p>
                                <p><b>Email: </b>{{$user->email}}</p>
                                <p><b>Phone: </b>{{$user->profile->mobile}}</p>
                                <hr>
                                <p><b>Address: </b>{{$user->profile->address}}</p>
                                <a href="{{route('user.editprofile')}}" class="btn btn-info pull-right">Update Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
