@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <?php echo $user->name; ?>
        </div>

        <div class="card-body">
          <form>

            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right">Name</label>
              <div class="col-md-6">
                <input type="text" class="form-control" value="<?php echo $user->name ?>" />
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right">Bio</label>
              <div class="col-md-6">
                <input type="textarea" class="form-control" value="<?php echo $user->bio ?>" />
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right">email</label>
              <div class="col-md-6">
                <input type="email" class="form-control" value="<?php echo $user->email ?>" />
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-8 offset-md-4">
                <button class="btn btn-primary">未実装</button>
              </div>
            </div>

          </form>
        </div>

      </div>

    </div>
  </div>
</div>
@endsection
