<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title>{{ $title }}</title>
</head>
<body>
  <h1>{{ $heading}}</h1>
  
  <table width="100%" style="width:100%" border="0">
     <thead>
        <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>Expiry Date</th>
            <th>User</th>
        </tr>
    </thead>
    <tbody>
        @foreach($videos as $key => $value)
        <tr>
            <th>{{++$key}}</th>
            <th>{{$value->usersubscribe->name}}</th>
            <th>{{$value->usersubscribe->expiry_date}}</th>
            <th>{{$value->user->name}}</th>
        </tr>
        @endforeach
    </tbody>
    </table>
</body>
</body>
</html>