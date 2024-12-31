@extends('panel.layouts.base',['is_main'=>true])
@section('sub_title','View BackUps DB')
@section('content')
    @push('panel_css')
    @endpush
    <style>
        .actable td, .actable td p {
    padding: 8px !important;
}
.actable th:first-child, .actable td:first-child {
    width: 4% !important;
}
.actable th, .actable td {
    width: 25% !important;
}
    </style>
    <div class="row">
        <div class="col-12"  style="position:relative;">
            <div class="card mb-4 mx-4 pb-2"  style="position: sticky;right: 0;left: 17%;z-index: 3;top: 4px;">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-1 show_accro">
                                BackUp
                            </h5>
                        </div>
                        <div>
                            
                            <!--<a href="{{ route('panel.backup.backup') }}" class="btn bg-gradient-dark btn-sm mb-2" type="button">New BackUp</a>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-1">All BackUps</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-2 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        @if(sizeof($data) > 0)
                        <table class="table align-items-center mb-0 actable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="last-child text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Date
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:40%">
                                        Size
                                    </th>
                                    <th class="last-child text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Link
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($data as $key => $row)
                                <?php 
                                    $filename = str_replace('backup-', ' ', $row->getFilename());
                                    
                                    $filename = str_replace('.gz', ' ', $filename);
                                ?>
                                <tr>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $key + 1 }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $filename }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ number_format((($row->getSize()/1024/1024)),2) . " MB" }}</p>
                                    </td>
                                    <td>
                                        <a href="{{ route('panel.backup.download',$row->getFilename()) }}" class="mx-1" data-bs-toggle="tooltip"
                                            data-bs-original-title="Download">
                                            <i class="fas fa-download text-secondary"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
  @push('panel_js')

  @endpush
@stop
