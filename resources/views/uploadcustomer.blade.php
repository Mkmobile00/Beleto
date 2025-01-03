<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{route('customer.import')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <input type="file" name="csv_file" class="form-control" accept=".csv,.xlsx,.xls" required>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">{{__('admin.import')}}</button>
        </div>
    </form>
</body>
</html>