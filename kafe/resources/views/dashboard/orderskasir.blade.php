@extends('dashboard.template')
@section('content')

<?php
$now = date('Y-m') . '-01';
$lastDateInMonth = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($now)), date('Y', strtotime($now)));

$startdate = request('startdate') ?? $now;
$enddate = request('enddate') ?? date('Y-m-d', strtotime(date('Y-m') . '-' . $lastDateInMonth));

function dateRange($first, $last, $step = '+1 day', $format = 'Y-m-d')
{
    $dates = [];
    $current = strtotime($first);
    $last = strtotime($last);

    while ($current <= $last) {
        $dates[] = date($format, $current);
        $current = strtotime($step, $current);
    }

    return $dates;
}

$dates = dateRange($startdate, $enddate);
?>

<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-fluid px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="coffee"></i></div>
                                Order Kasir
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-fluid px-4">
            <div class="card">
                <div class="card-body">


                    <form action="/dashboard/kasir/orders" method="get" class="mb-5 bg-light p-3 m-0 shadow-sm rounded">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-6">
                                    <label for="faktur" class="small">No. Faktur</label>
                                    <input type="text" name="faktur" id="faktur" class="form-control form-control-sm mt-1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-6">
                                    <label for="meja" class="small">No. Meja</label>
                                    <input type="number" name="meja" id="meja" class="form-control form-control-sm mt-1">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="startdate" class="small">Mulai Tanggal</label>
                                    <input type="date" name="startdate" id="startdate" class="form-control form-control-sm mt-1" value="{{ request('startdate', $startdate) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="enddate" class="small">Sampai Tanggal</label>
                                    <input type="date" name="enddate" id="enddate" class="form-control form-control-sm mt-1" value="{{ request('enddate', $enddate) }}">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-dark btn-sm">Filter</button>
                        {{-- <button type="button" class="btn btn-sm btnReset btn-outline-dark">Reset</button> --}}
                    </form>

                    <div class="table-responsive">
                        <table id="customTable" class="table table-bordered small" style="width:100%">
                            <thead class="text-uppercase bg-light">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Faktur</th>
                                    <th>Meja</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $grandTotal = 0;
                                $grandTotalDiskon = 0;
                                $grandTotalOrder = 0;
                                ?>
                                @foreach ($orders as $row)
                                <?php
                                $grandTotal += $row->total;
                                $grandTotalDiskon += $row->total_diskon;
                                $grandTotalOrder += $row->total_order;
                                ?>
                                <tr>
                                    <td>{{ $orders->firstItem() + $loop->index }}</td>
                                    <td>{{ $row->created_at->format('d/m/Y')}} {{ $row->created_at->format('h:i')}}</td>
                                    <td><a href="/dashboard/kasir/orders/{{ $row->id }}/edit">{{ $row->faktur }}</a>
                                    </td>
                                    <td>{{ $row->meja }}</td>
                                    <td>@currency($row->total)</td>
                                    <td>{{ $row->status->nama ?? '' }}</td>
                                    <td>
                                        <form action="/dashboard/orders/{{ $row->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?');"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="bg-light" style="font-weight: bold;">
                                    <td colspan="4">GRAND TOTAL</td>
                                    <td>@currency($grandTotal)</td>
                                    <td colspan="2"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div>

                        <p>Showing
                            {{ $orders->firstItem() }}
                            To
                            {{ $orders->lastItem() }}
                            Of
                            {{ $orders->total() }}
                        </p>

                    </div>
                    <div class="pull-right">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
        <!-- Create group modal-->
        <div class="modal fade" id="createGroupModal" tabindex="-1" role="dialog" aria-labelledby="createGroupModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createGroupModalLabel">Create New Group</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-0">
                                <label class="mb-1 small text-muted" for="formGroupName">Group Name</label>
                                <input class="form-control" id="formGroupName" type="text" placeholder="Enter group name..." />
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger-soft text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary-soft text-primary" type="button">Create New Group</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Edit group modal-->
        <div class="modal fade" id="editGroupModal" tabindex="-1" role="dialog" aria-labelledby="editGroupModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editGroupModalLabel">Edit Group</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-0">
                                <label class="mb-1 small text-muted" for="formGroupName">Group Name</label>
                                <input class="form-control" id="formGroupName" type="text" placeholder="Enter group name..." value="Sales" />
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger-soft text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary-soft text-primary" type="button">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection