<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

  

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

       
        

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{auth()->guard('customer')->user()->customerDetail->first_name }} {{auth()->guard('customer')->user()->customerDetail->last_name }}</span>
                <img class="img-profile rounded-circle" src="{{  asset('Uploads/customer/' .auth()->guard('customer')->user()->customerDetail->photo)}}">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="javascript:;" data-toggle="modal" data-target="#staticBackdrop">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="javascript:;" data-toggle="modal" data-target="#staticBackdropUpdatyeProfile">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Update Password
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{route('customer.logout')}}" >
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>

{{-- -------------------------------------Update Profile---------------------------------------- --}}
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Update Profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {{ Form::open(['url'=>route('kantipur.update-profile',auth()->guard('customer')->user()->id),'files'=>true,'class'=>'row g-3'])}}
            @method('put')
              <div class="col-12">
                {{ Form::label('first_name','First Name:')}}
                {{ Form::text('first_name',auth()->guard('customer')->user()->customerDetail->first_name ?? '',['class'=>'form-control form-control-sm '.($errors->has('first_name') ?'is-invalid':''),'required'=>true,'placeholder'=>'Enter Profile First Name Here.....'])}}
                @error('first_name')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="col-12">
                {{ Form::label('last_name','Last Name:')}}
                {{ Form::text('last_name',auth()->guard('customer')->user()->customerDetail->last_name ?? '',['class'=>'form-control form-control-sm '.($errors->has('last_name') ?'is-invalid':''),'required'=>true,'placeholder'=>'Enter Profile Last Name Here.....'])}}
                @error('last_name')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
  
              <div class="col-12">
                {{ Form::label('email','Email:')}}
                {{ Form::text('email',auth()->guard('customer')->user()->email ?? '',['class'=>'form-control form-control-sm '.($errors->has('email') ?'is-invalid':''),'required'=>true,'placeholder'=>'Enter Email Here.....','readonly'=>'readonly'])}}
                @error('email')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <input type="text" name="customer_id" hidden value="{{auth()->guard('customer')->user()->id}}">
  
              
  
             
  
              <div class="col-12">
                {{ Form::label('image','Profile Image:')}}
                {{ Form::file('image',['class'=>($errors->has('image') ?'is-invalid':''),'required'=>false,'accept'=>'image/*'])}}
                @error('image')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
  
              @if(auth()->guard('customer')->user()->customerDetail && auth()->guard('customer')->user()->customerDetail->photo !=null)
              <div>
                <img src="{{  asset('Uploads/customer/' .auth()->guard('customer')->user()->customerDetail->photo)}}" alt="" class="img-fluid img-thumbnail">
              </div>
              @endif
  
  
              <div class="modal-footer">
                {{ Form::button('<i class="bi bi-x"></i> Reset',['class'=>'btn btn-sm btn-danger','type'=>'reset'])}}
                {{ Form::button('<i class="bi bi-send"></i> Update',['class'=>'btn btn-sm btn-success','type'=>'submit'])}}
              </div>
            {{ Form::close()}}
        </div>
      </div>
    </div>
  </div>

  {{-- -------------------------------------Update Profile---------------------------------------- --}}


  {{-- -------------------------------------Update Password---------------------------------------- --}}
  <div class="modal fade" id="staticBackdropUpdatyeProfile" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropUpdatyeProfileLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropUpdatyeProfileLabel">Update Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="javascript:;" method="put" id="updatePasswordForm">
                @csrf
            
          @method('put')
            <div class="col-12">
              {{ Form::label('old_password','Old Password:')}}
              {{ Form::password('old_password',['class'=>'form-control form-control-sm '.($errors->has('old_password') ?'is-invalid':''),'required'=>true,'placeholder'=>'Enter Old Password Here.....'])}}
              <span class="text-danger" hidden id="old_passwordError"></span>
            </div>
            <div class="col-12">
              {{ Form::label('password','New Password:')}}
              {{ Form::password('password',['class'=>'form-control form-control-sm '.($errors->has('password') ?'is-invalid':''),'required'=>true,'placeholder'=>'Enter New Password Here.....'])}}
              <span class="text-danger" hidden id="passwordError"></span>
            </div>

            <div class="col-12">
              {{ Form::label('password_confirmation','Re-Type Password:')}}
              {{ Form::password('password_confirmation',['class'=>'form-control form-control-sm '.($errors->has('password_confirmation') ?'is-invalid':''),'required'=>true,'placeholder'=>'Enter Password Again.....'])}}
              <span class="text-danger" hidden id="password_confirmationError"></span>
            </div>


            <div class="modal-footer">
              {{ Form::button('<i class="bi bi-x"></i> Reset',['class'=>'btn btn-sm btn-danger','type'=>'reset'])}}
              {{ Form::button('<i class="bi bi-send"></i> Update',['class'=>'btn btn-sm btn-success updatePassword','type'=>'submit'])}}
            </div>
            </form>
        </div>
      </div>
    </div>
  </div>
  {{-- -------------------------------------Update Password---------------------------------------- --}}