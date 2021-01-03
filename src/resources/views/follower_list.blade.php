@extends('layouts.app')

@section('content')
<div id="follower-list"></div>
<script>
  const _params = {};
  _params.followers = <?php echo json_encode($followers) ?>;
  _params.loginUser = <?php echo json_encode($login_user) ?>;
</script>
<script src="{{ asset('js/follower-list.js') }}" defer></script>
@endsection
