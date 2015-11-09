@extends('app')

@section('content')

<form method="post" class="form-inline">
    <div class="form-group">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <button type="submit" formaction="/arrived" class="btn btn-default">Arrived</button>
    </div>

    <div class="form-group">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <button type="submit" formaction="/departed" class="btn btn-default">Departed</button>
    </div>
</form>

<h1>Entries for the month of {{ date('F') }}</h1>
<div class="CSSTableGenerator">
				<table>
					<tr>
						<td>
							Name
						</td>
						<td >
							Work Hours
						</td>
						<td>
							Break Hours
						</td>
						<td>
							OT Hours
						</td>
						<td>
							Date
						</td>
						<td>
							Arrived
						</td>
						<td>
							Departed
						</td>
						<td>
							Notes
						</td>
                    </tr>
                @foreach( $name as $inf )
                    
                    <tr>
                        <td>{{ $inf->name }}</td>
                        <td><a href="/show_workhours/{{ $inf->id }}">{{ $inf->work_hours }}</a></td>
                        <td><a href="/show_brhours/{{ $inf->id }}">{{ $inf->br_hours }}</a></td>
                        <td><a href="/show_othours/{{ $inf->id }}">{{ $inf->ot_hours }}</a></td>
                        <td><a href="/show_date/{{ $inf->id }}">{{ $inf->date }}</a></td>
                        <td><a href="/show_arrived/{{ $inf->id }}">{{ $inf->arrived }}</a></td>
                        <td><a href="/show_departed/{{ $inf->id }}">{{ $inf->departed }}</a></td>
                        <td><a href="/show_notes/{{ $inf->id }}">{{ $inf->notes }}</a></td>
                    </tr>

                @endforeach
                        <td>Total</td>
                        <td>{{ $workTotal }}</td>
                        <td>{{ $brTotal }}</td>
                        <td>{{ $otTotal }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
    </table>
</div>

@endsection