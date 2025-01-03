@extends('customerdashboard.main')
@section('contents')
<div class="container-fluid">

   
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Device List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Device Type</th>
                            <th>Device Name</th>
                            <th>Device Serial Num</th>
                            <th>Added Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customer->deviceList as $key=>$device)
                        <tr>
                            <td>{{@$key+1}}</td>
                            <td>{{@$device->device_type->name}}</td>
                            <td>{{@$device->device_name}}</td>
                            <td>{{@$device->device_serial_num}}</td>
                            <td>{{@$device->added_date}}</td>
                            <td>
                                <a href="javascript:;"
                                    class="btn btn-sm  icon btn-rounded btn-danger btn-style delete-visitor"
                                    data-id="{{ $device->id }}">
                                    <i class="fas fa-trash"></i>
                                </a>
                                {{ Form::open(['url' => route('customer.deletedevicelist', $device->id), 'class' => 'delete-form']) }}
                                @method('delete')
                                <input type="text" hidden name="ipaddress" value="" class="ipaddress">
                                {{ Form::close() }}
                            </td>
                        </tr>
                        @endforeach
                        
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
    <script>
        $(document).on('click','.delete-visitor',function(e){

        e.preventDefault();
        let clicked=confirm('Are You Sure Want To Remove List');

        if(clicked)
        {
            $(this).parent().find('form').submit();
        }
        });
    </script>

<script>
//     function generateUniqueId() {
// // Get user agent
// var userAgent = navigator.userAgent;

// // Get screen dimensions
// var screenWidth = window.screen.width;
// var screenHeight = window.screen.height;

// // Generate a unique identifier based on user agent and screen dimensions
// var uniqueId = hashCode(userAgent + screenWidth + screenHeight);

// return uniqueId;
// }

// // Function to generate a hash code from a string
// function hashCode(str) {
// var hash = 0, i, chr;
// if (str.length === 0) return hash;
// for (i = 0; i < str.length; i++) {
//     chr   = str.charCodeAt(i);
//     hash  = ((hash << 5) - hash) + chr;
//     hash |= 0; // Convert to 32bit integer
// }
// return hash;
// }

// // Usage example
// var userId = generateUniqueId();
// setUniqueKey();
// function setUniqueKey(){
// $('.ipaddress').val(userId);
// }

function generateUserID() {
    // Check if the userID exists in local storage
    var userID = localStorage.getItem('userID');

    // If it doesn't exist, generate a new one and store it
    if (!userID) {
        userID = generateUUID();
        localStorage.setItem('userID', userID);
    }

    return userID;
}

function generateUUID() {
    // Generate a UUID (Universally Unique Identifier)
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
        var r = Math.random() * 16 | 0,
            v = c == 'x' ? r : (r & 0x3 | 0x8);
        return v.toString(16);
    });
}

// Usage
var userID = generateUserID();
// alert(userID);
setUniqueKey();
function setUniqueKey(){
$('.ipaddress').val(userID);
}
</script>
@endpush