<div style="width: 600px;margin: 0 auto">
    <div style="text-align: center">
        <h2>Hello {{ $user->name }}</h2>
        <p>This is information about your checkout</p>

    </div>
            <h3>Time: {{ $order->created_at }}</h3>
            <h3>Email:  {{ $user->email }}</h3>
            <h3>Mobile:  {{ $user->phone }}</h3>
            <h3>Address:  {{ $user->address }}</h3>
            <table border="1" cellspacing="0" cellpadding="10" style="width=100%">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Name Product</td>
                        <td>Quantity</td>
                        <td>Totalprice</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->order_details as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->product->name}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>{{number_format($item->total_price,2)}}$</td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        
</div>
