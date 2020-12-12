@extends('layouts.app')

@section('content')
<div class="container">
  <h1>It is users.</h1>
  <?php  foreach ($users as $key => $value): ?>
    <a href="{{ route('user', ['id' => $value->id]) }}">{{$value->name}} {{$value->email}}</a>
  <?php endforeach; ?>
</div>
@endsection
