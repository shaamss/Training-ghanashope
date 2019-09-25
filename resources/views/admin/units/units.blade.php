@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
                <div class="card">
                     <div class="card-header">Units</div>

                        <div class="card-body">


                                <form method="post" action="{{ 'units' }}" class="row">
                                    @csrf

                                        <div class="form-group col-md-6">
                                            <label for="unit_name">Unit Name</label>
                                            <input type="text" class="form-control" id="unit_name" name="unit_name" placeholder="Unit Name" required >
                                        </div>
                                        <div class="form-group col-md-6">
                                                <label for="unit_code">Unit Code</label>
                                                <input type="text" class="form-control" id="unit_code" name="unit_code" placeholder="Unit Code" required >
                                        </div>
                                        <div class="form-group col-md-12">
                                            <button type="submit" class="btn btn-primary">Save New Unit</button>
                                        </div>

                                </form>


                            <div class="row">
                                    @foreach ($units as $unit)

                                    <div class="col-md-3">

                                        <div class="alert alert-primary" role="alert">
                                            <span class="btn-spans">
                                                {{-- data attribute from php to js --}}
                                                <span><a class="edit-unit" ><i class="fas fa-edit"></i></a></span>
                                                <span><a class="delete-unit"
                                                    data-unitname = "{{ $unit->unit_name }}"
                                                    data-unitcode = "{{ $unit->unit_code }}"
                                                    data-unitid="{{ $unit->id }}" ><i class="fas fa-trash-alt"></i></a></span>
                                            </span>
                                        <p>{{ $unit->unit_name }}, {{ $unit->unit_code }}</p>
                                        </div>

                                    </div>

                                    @endforeach
                            </div>
                            {{ $units->links() }}

                         </div>
        </div>
    </div>
</div>


        {{-- edit modal --}}

    <div class="modal edit-window" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>

          {{-- delete  modal --}}

          <div class="modal delete-window" tabindex="-1" role="dialog" id="delete-window">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Delete Unit</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    {{-- delete form --}}

                    <form action="{{ route('units') }}" method="POST" style="position:relative">
                            @csrf
                        <div class="modal-body">
                            <p id="delete-message"> </p>

                            <input type="hidden" name="_method" value="delete"/>
                            <input type="hidden" name="unit_id" value="" id="unit_id">

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                            <button type="submit" class="btn btn-primary">DELETE</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>


@if (Session::has('message'))
              {{-- Toast --}}
        <div class="toast" style="position: absolute; top: 10%; right: 10%;">
            <div class="toast-header">
                <strong class="mr-auto">Unit</strong>
                {{-- <small>11 mins ago</small> --}}
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">

                    {{ Session::get('message') }}

            </div>
        </div>
@endif


@endsection

@section('script')

        <script>
            $(document).ready(function(){
                var $deleteUnit =$('.delete-unit');
                var $deleteWindow = $('#delete-window');
                var $unitId= $('#unit_id');
                var $deleteMessage = $('#delete-message');
                    //this behavior default scroll from down to up
                $deleteUnit.on('click', function(element){
                    //stop behavior default
                    element.preventDefault();
                    // gevin data from data Attribute
                    var unit_id = $(this).data('unitid');
                    var $unit_name = $(this).data('unitname');
                    var $unit_code = $(this).data('unitcode');
                    $unitId.val(unit_id);
                    $deleteMessage.text('Are you sure you want to delete ' + ' \[ ' + $unit_name + ' \] ' +' with code ' + ' \[ ' + $unit_code + ' \] ' + " ? ");
                    $deleteWindow.modal('show');
                });
            });
        </script>

    @if (Session::has('message'))
                <script>
                    jQuery(document).ready(function($){
                        var $toast = $('.toast').toast({
                            autohide :false
                        });

                        $toast.toast('show');
                    })
                </script>
    @endif
@endsection
