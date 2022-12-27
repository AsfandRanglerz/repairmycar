@extends('admin.layout.app')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Model</h4>
                            </div>
                         <form action="{{ route('admin.update-model', $model->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Comapny Name</label>
                                        <input id="test_name" name="company" class="form-control test_name" 
                                         value="{{ $model->company->company }}"  readonly>   
                                    </div>
                                    <div class="form-group">  
                                        <input type="text" class="form-control" name="car_model" 
                                        value="{{ $model->car_model }}">
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1" type="submit">Update Model</button>
                                </div>
                            </form>
                        </div>
                    </div>
                   
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
<script>
     $(document).on('click', '.glyphicon-trash', function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    document.getElementById('del_form' + $(this).data('id')).submit();
                }
            });
        });
</script>
@endsection

