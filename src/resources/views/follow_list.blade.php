@extends('layouts.app')

@section('content')
<div id="follow-list"></div>
<script>
  const _params = {};
  _params.follows = <?php echo json_encode($follows) ?>;
  _params.loginUser = <?php echo json_encode($login_user) ?>;
</script>
<script src="{{ asset('js/follow-list.js') }}" defer></script>
@endsection
