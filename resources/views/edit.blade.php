@extends('app')

@section('content')

<h1>Form</h1>
<h2>Edit {{ ucfirst($field) }} </h2>

    {!! Form::model($table, ['url' => '/update_'.$field.'/' . $table->ID, 'method' => 'PATCH'])  !!}
        <div class="form-group">
        {!! Form::text($field, null , ['class' => 'form-control']) !!}
        </div>

            <div class="form-group">
            {!! Form::submit('Save Changes', ['class' => 'btn btn-primary']) !!}
            </div>

    {!! Form::close() !!}


@endsection