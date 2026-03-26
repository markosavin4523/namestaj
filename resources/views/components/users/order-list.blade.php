@props(['orders'])
<div class="card border-0 shadow-sm rounded-3 m-2">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="bg-light">
                <tr>
                    <th class="ps-4 py-3 text-uppercase fs-7 text-muted fw-bold">Broj Porudžbine</th>
                    <th class="py-3 text-uppercase fs-7 text-muted fw-bold">Datum</th>
                    <th class="py-3 text-uppercase fs-7 text-muted fw-bold text-center">Status</th>
                    <th class="py-3 text-uppercase fs-7 text-muted fw-bold text-end">Ukupna Cena</th>
                    <th class="pe-4 py-3 text-uppercase fs-7 text-muted fw-bold text-end"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td class="ps-4 fw-bold text-black">
                            #{{ $order->order_number }}
                        </td>
                        <td>
                            {{ $order->created_at->format('d.m.Y.') }}
                        </td>
                        <td class="text-center">
                                        <span class="px-3 py-2
                                         @if($order->order_status_id == 1)
                                          text-warning
                                           @elseif($order->order_status_id == 2)
                                           text-primary
                                           @else
                                           text-success
                                            @endif
                                            " >{{ $order->status->name  }}</span>
                        </td>
                        <td class="text-end fw-bold">
                            {{ number_format($order->total_price, 2, ',', '.') }} RSD
                        </td>
                        <td class="pe-4 text-end">
                            <a href="" class="btn btn-outline-dark btn-sm rounded-pill px-3">
                                Detalji
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
