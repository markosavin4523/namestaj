@props(["o","statuses"]);
<tr>
    <td>
        <div>
            {{ $o->user->email ?? $o->details->first_name." ".$o->details->last_name}}
        </div>
    </td>
    <td>
        <div>{{ $o->order_number }}</div>
    </td>
    <td>
        <div>{{ $o->total_price }} RSD</div>
    </td>
    <td>
        <div class="text-muted">{{ $o->created_at->format('d.m.Y H:i') }}</div>
    </td>
    <td>
        <form action="{{ route('admin.order.update',["order"=>$o->id]) }}" method="POST" class="d-flex flex-row">
            @csrf
            @method("patch")
            <select name="status" class="form-select col-6">
                @foreach($statuses as $s)
                    <option value="{{$s->id}}" {{ $o->status->id == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                @endforeach
            </select>
            <button class="btn btn-primary"><i class="fa fa-check"></i></button>
        </form>
    </td>
    <td>
        <a href="javascript:void(0)"
           class="btn btn-info btn-sm"
           data-toggle="collapse"
           data-target="#details-{{ $o->id }}">
            Proizvodi
        </a>
    </td>
</tr>

<tr class="collapse" id="details-{{ $o->id }}">
    <td colspan="6">
        <div class="p-3 bg-light">
            <h6>Stavke porudžbine:</h6>
            <ul>
                @foreach($o->products as $p)
                    <li>
                        <img src="{{ asset($p->image_path) }}" width="60" alt="slika">
                        {{ $p->name }}
                        --{{ $p->pivot->quantity }} kom
                        --{{ $p->price }}RSD / komad
                    </li>
                @endforeach
            </ul>
            <h6>Informacije o dostavi:</h6>
            <ul>
                <li>{{ $o->details->first_name. " ".$o->details->last_name }}</li>
                <li>{{ $o->details->zip." -- ".$o->details->city->name. " -- ".$o->details->address }}</li>
                <li>{{ $o->details->phone }}</li>
            </ul>
            <h6>
                Ukupna cena:
                <p>{{ $o->total_price }} RSD</p>
            </h6>
        </div>
    </td>
</tr>
