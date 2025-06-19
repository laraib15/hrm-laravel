@extends('layouts.master')
@section('pageTitle')
    Roles
@endsection

@section('content')
    <div class="content">
        <div class="card mb-3" >
            <div class="card-header">

        <h4 class="col-12 d-flex no-block align-items-center">{{ $title }} </h4> </div>

        <div class="card-body">
            <form role="form" action="{{$url }}" method="post">
                {{ csrf_field() }}
                  <div class="box-body">
                  <div class="col-lg-offset-3 col-lg-6">
                    <div class="form-group">
                      <label for="name">Role title</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="role Title"  value="{{old('name', $role->name) }}">
                      <span class="text-danger ">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </span>
    </div>

                    <label style="margin-bottom: 0.4cm;" for="name">Module Access</label>

                    <div class="row">
                        <div class="col-sm-9">
                            <div class="checkbox">
                                @php
    $groupedPermissions = $permissions->groupBy(function ($item) {
        return explode('.', $item->name)[0];
    });
@endphp

@foreach ($groupedPermissions as $module => $modulePermissions)
    <div class="row mb-3">
        <div class="col-sm-3 font-weight-bold text-capitalize">
            {{ $module }}
        </div>
        <div class="col-sm-9">
            <div class="checkbox">
                @foreach ($modulePermissions as $permission)
                    <label style="margin-left: 5px;">
                        <input type="checkbox" name="permission[]"
                               value="{{ $permission->id }}"

                              {{ $role && $role->permissions && $role->permissions->contains('id', $permission->id) ? 'checked' : '' }}>
                        {{ $permission->name }}
                    </label>
                @endforeach
            </div>
        </div>
    </div>
@endforeach

                            </div>
                        </div>
                    </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href='{{ route('role.view') }}' class="btn btn-warning">Back</a>
                  </div>

                  </div>

                  </div>

                </form>
              </div>
              <!-- /.box -->


            </div>
            <!-- /.col-->
          </div>
          <!-- ./row -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
  @endsection
