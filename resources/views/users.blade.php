@extends('layouts.app')

@section('content')
<div class="container">
  <h1>It is users.</h1>
  <?php  foreach ($users as $key => $value) {
    echo "<a href='/user/$value->id'>$value->name $value->email</a>" ;
  } ?>
</div>
@endsection
