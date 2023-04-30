{{-- <table class="table table-centered table-hover align-middle table-nowrap mb-0"> --}}
@php
    $header = (empty($noheader) ? true : false);
@endphp
<table class="table display table-hover table-bordered dataTable1 no-footer <?= (empty($dt) ? 'kdTable' : ($dt=="kdexp" ? 'kdTableExp' : '')) ?>">
    @if(!@empty($header))
    <thead>
        <tr>
            @if(!@empty($sequence))
                <th>#</th>
            @endif
            @if(!@empty($columns))
                @foreach ($columns as $column)
                    <th>
                        @if(is_array($column))
                            {{$column['label']}}
                        @else
                            {{$column}}
                        @endif
                    </th>
                @endforeach
            @endif
            @if(!@empty($actions))
                <th>Action{{count($actions)>1 ? 's' : ''}}</th>
            @endif
        </tr>
    </thead>
    @endif
    <tbody>
        @if(!empty($records))
            @foreach ($records as $key => $record)
                <tr>
                    @if(!@empty($sequence))
                        <td>{{ $records->firstItem() + $key }}</td>
                    @endif
                    @if(!@empty($columns))
                        @foreach ($columns as $key => $column)
                            <td>
                                @if(is_array($column))
                                    @if(!empty($column['format']) && $column['format']=="date")
                                        {{ Carbon::parse($record->$key)->format(config('app.date_format')) }}
                                    @elseif(!empty($column['format']) && $column['format']=="datetime")
                                        {{ Carbon::parse($record->$key)->format(config('app.datetime_format')) }}
                                    @elseif(!empty($column['format']) && $column['format']=="yn")
                                        {{strtolower($record->$key)=="y"?'Yes':'No'}}
                                    @elseif(!empty($column['format']) && $column['format']=="ai")
                                        {{$record->$key==1?'Active':'Inactive'}}
                                    @elseif(!empty($column['format']) && $column['format']=="number")
                                        {{number_format($record->$key)}}
                                    @elseif(!empty($column['format']) && $column['format']=="link")
                                        <a href="{{$record->$key}}">{{(!empty($column['visible']) && $column['visible'] ? $record->$key : 'Link')}}</a>
                                        @elseif(!empty($column['format']) && $column['format']=="img")
                                            {!!(!empty($column['img']) ? '<img src="'.(str_replace("{#}",$record->$key,$column['img'])).'" class="avatar-sm p-2">' : $record->$key)!!}
                                    @elseif(!empty($column['format']) && $column['format']=="html")
                                        @php
                                            if(!empty($column['keys'])) {
                                                $args = [];
                                                foreach($column['keys'] as $k) {
                                                    $args[] = $record->$k;
                                                }
                                                echo vsprintf($column['html'], $args);
                                            } else {
                                                echo str_replace("{#}",$record->$key,$column['html']);
                                            }
                                        @endphp
                                        {{-- "%.2f" --}}
                                        {{-- {!!(!empty($column['html']) ? str_replace("{#}",$record->$key,$column['html']) : $record->$key)!!} --}}
                                    @elseif(!empty($column['rkey']))
                                        @php
                                            $rkey = $column['rkey'];
                                            $key = !empty($column['key']) ? $column['key'] : $key;
                                        @endphp
                                        {{$record->$rkey?$record->$rkey->$key:''}}
                                    @elseif(!empty($column['mkeys']))
                                        @php
                                            $mKeys = current($column['mkeys']);
                                        @endphp
                                        {{$record->$key.($column['seperator']??'').$record->$mKeys}}
                                    @else
                                        {{$record->$key}}
                                    @endif
                                @else
                                    {{$record->$key}}
                                @endif
                            </td>
                        @endforeach
                    @endif
                    @if(!@empty($actions))
                        <td>
                            {{generateActions($actions,$record)}}
                        </td>
                    @endif
                </tr>
            @endforeach
        @endif
        @if (count($records) <= 0)
            {{-- <tr>
                <td colspan="6">No records found</td>
            </tr> --}}
        @endif
    </tbody>
</table>
