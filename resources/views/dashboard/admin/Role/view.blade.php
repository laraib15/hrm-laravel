@extends('layouts.master')
@section('pageTitle')
    Roles
@endsection

@section('content')
<div class="content">
    @if(Session::get('message'))
    <div class="alert alert-success">
      {{ Session::get('message') }}
    </div>
    @endif

        <div class="card mb-3" >
            <div class="card-header">

        <h4 class="col-12 d-flex no-block align-items-center">Roles <a class='col-lg-offset-5 btn btn-success' href="{{route('role.create')}}">Add New</a></h4> </div>

        <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>S.No</th>
                          <th>Role Name</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($role as $role)
                            <tr>
                              <td>{{ $loop->index + 1 }}</td>
                              <td>{{ $role->name }}</td>

                                <td><a href="{{ route('role.edit',$role->id) }}"><span class="glyphicon glyphicon-edit"></span></a></td>
                                <td>
                                  <form id="delete-form-{{ $role->id }}" method="post" action="{{ route('role.delete',$role->id) }}" style="display: none">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                  </form>
                                  <a href="" onclick="
                                  if(confirm('Are you sure, You Want to delete this?'))
                                      {
                                        event.preventDefault();
                                        document.getElementById('delete-form-{{ $role->id }}').submit();
                                      }
                                      else{
                                        event.preventDefault();
                                      }" ><span class="glyphicon glyphicon-trash"></span></a>
                                </td>
                              </tr>
                            </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                          <th>S.No</th>
                          <th>Role Name</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                        </tfoot>
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        Footer
      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>
@endsection
