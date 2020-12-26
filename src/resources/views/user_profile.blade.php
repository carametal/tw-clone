@extends('layouts.app')

@section('content')
<div id="user-profile"></div>
<script>
  const _params = {};
  _params.id = <?php echo json_encode($id) ?>;
  _params.user = <?php echo json_encode($user) ?>;
</script>
<script src="{{ asset('js/user-profile.js') }}" defer></script>
@endsection