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
                                Update Profile
                            </div>
                        </div>
                        <div class="panel-body">
                            @if(Session::has('message'))
                                <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                            @endif
                            <form action="" enctype="multipart/form-data" wire:submit.prevent="updateProfile()">
                                <div class="col-md-4">
                                    @if($newimage)
                                        <img src="{{$newimage->temporaryUrl()}}" width="100%" alt="">
                                    @elseif($image)
                                        <img src="{{asset('assets/images/profile')}}/{{$image}}" width="100%" alt="">
                                    @else
                                        <img src="{{asset('assets/images/profile/dummyprof.jpeg')}}" width="100%" alt="">
                                    @endif    
                                    <input type="file" class="form-control" wire:model="newimage">
                                </div>
                                <div class="col-md-8">
                                    <p><b>Name: </b><input type="text" class="form-control" wire:model="name"></p>
                                    <p><b>Email: </b>{{$email}}</p>
                                    <p><b>Phone: </b><input type="text" class="form-control" wire.model="mobile"></p>
                                    <hr>
                                    <p><b>Address: </b><input type="text" class="form-control" wire.model="address"></p>
                                    <button type="submit" class="btn btn-info pull-right">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
