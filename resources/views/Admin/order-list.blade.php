@extends('layouts.admin')
@section('content')
<script>
        $(document).ready( function () {
            $('.order-list').DataTable();
        } );
</script>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Lista zamówień
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <table class="table order-list">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Klient</th>
                                        <th>Data złożenia</th>
                                        <th>Kwota</th>
                                        <th>Status</th>
                                        <th>Akcje</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    <tr>
                                         <td>{{$order->id}}</td>
                                         <td>{{$order->address->getClientName()}}</td>
                                         <td>{{$order->created_at}}</td>
                                         <td>{{$order->getOrderAmount()}}</td>
                                         <td>{{$order->getStatusText()}}</td>
                                         <td>
                                             <a href="{{route('adminOrderDetails',["id" => $order->id])}}" class="btn btn-sm btn-primary">Szczegóły</a>
                                         </td>
                                     </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="col-12">
                            {{ $orders->links() }}
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
