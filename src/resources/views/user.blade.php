@extends('layouts.app')

@section('content')
<div id="user-root"></div>
<script>
  const _params = {};
  _params.id = <?php echo json_encode($id) ?>;
  _params.user = <?php echo json_encode($user) ?>;
  _params.authenticatedUserId = <?php echo json_encode($authenticated_user_id) ?>;
</script>
<script src="{{ asset('js/userapp.js') }}" defer></script>
@endsection
