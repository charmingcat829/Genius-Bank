<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap datatable">
          <thead>
            <tr>
              <th>@lang('No')</th>
              <th>@lang('Type')</th>
              <th>@lang('Txnid')</th>
              <th>@lang('Amount')</th>
              <th>@lang('Date')</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @forelse (auth()->user()->transactions as $key=>$data)
              <tr>
                <td data-label="@lang('No')">
                  <div>

                    <span class="text-muted">{{ $loop->iteration }}</span>
                  </div>
                </td>

                <td data-label="@lang('Type')">
                  <div>
                    {{ strtoupper($data->type) }}
                  </div>
                </td>

                <td data-label="@lang('Txnid')">
                  <div>
                    {{ $data->txnid }}
                  </div>
                </td>

                <td data-label="@lang('Amount')">
                  <div>
                    <p class="text-{{ $data->profit == 'plus' ? 'success' : 'danger'}}">{{ showprice($data->amount,$currency) }}</p>
                  </div>
                </td>

                <td data-label="@lang('Date')">
                  <div>
                    {{date('d M Y',strtotime($data->created_at))}}
                  </div>
                </td>
                
              </tr>
            @empty
              <p>@lang('NO DATA FOUND')</p>
            @endforelse

          </tbody>
        </table>
    </div>
</body>
</html>
