<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Order Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Amount</th>
            <th>Payment Type</th>
            <th>Payment Id</th>
            <th>IsPaid</th>
        </tr>
    </thead>
    <tbody >
        
        @foreach ($order as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->tracking_code}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->phone}}</td>
                <td>{{$item->total}}</td>
                <td>{{$item->payment_type}}</td>
                <td>{{$item->payment_id}}</td>

                <td>@if ($item->ispaid==1)
                    <span>Paid</span>
                    
                    @else
                    <span>Pending</span>

                @endif</td>

              
                    

            </tr>
        @endforeach
    </tbody>
      </table>
