@extends('layouts.app')

@section('content')
<div id="user-list"></div>
<script>
  const _params = {};
  _params.users = <?php echo json_encode($users) ?>;
  _params.loginUser = <?php echo json_encode($login_user) ?>;
</script>
<script src="{{ asset('js/userlist.js') }}" defer></script>
@endsection
