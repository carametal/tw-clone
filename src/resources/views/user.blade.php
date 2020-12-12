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
          <form action="/user/<?php echo $id ?>" method="post">
            @csrf

            <input type="hidden" name="id" value="<?php echo $id ?>"/>

            <div class="form-group row mb-0">
              <div class="col-md-8 offset-md-4">
                <?php if ($updated): ?>
                  <p class="text-success">更新しました。</p>
                <?php endif;?>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right">Name</label>
              <div class="col-md-6">
                <input type="text" name="name" class="form-control" value="<?php echo $user->name ?>" />
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right">Email</label>
              <div class="col-md-6">
                <input type="email" name="email" class="form-control" value="<?php echo $user->email ?>" />
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right">Bio</label>
              <div class="col-md-6">
                <textarea name="bio" class="form-control" rows="5"><?php echo $user->bio ?></textarea>
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-8 offset-md-4">
                <button class="btn btn-primary">更新</button>
              </div>
            </div>

          </form>
        </div>

      </div>

    </div>
  </div>
</div>
@endsection
