<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Takeaway - view sms log</title>
</head>
<body>
<table>
    <tr>
        <th>From</th>
        <th>To</th>
        <th>Body</th>
        <th>Status</th>
        <th>Created at</th>
    </tr>
@foreach($smsLog as $row)
    <tr>
        <td>{{ $row['from'] }}</td>
        <td>{{ $row['to'] }}</td>
        <td>{{ $row['body'] }}</td>
        <td>{{ $row['status'] }}</td>
        <td>{{ $row['created_at'] }}</td>
    </tr>
@endforeach
</table>
</body>
</html>
