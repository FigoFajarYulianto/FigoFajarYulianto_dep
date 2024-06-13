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
                                <div class="page-header-icon"><i data-feather="dollar-sign"></i></div>
                                Pendapatan
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


                    <form action="/dashboard/pendapatans" method="get" class="mb-5 bg-light p-3 m-0 shadow-sm rounded">
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
                    </form>


                    <table id="customTable" class="table table-bordered small" style="width:100%">
                        <thead class="text-uppercase bg-light">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $grandTotal = 0;
                            ?>
                            @foreach ($dates as $date)
                            <?php
                            $searchDate = [
                                'startdate' => date('Y-m-d', strtotime($date)),
                                'enddate' => date('Y-m-d', strtotime($date)),
                            ];
                            $total = \App\Models\Order::whereDate('created_at', '>=', $searchDate['startdate'])
                                ->whereDate('created_at', '<=', $searchDate['startdate'])
                                ->sum('total');
                            $grandTotal += $total;
                            ?>
                            <tr>
                                <td width="3%">{{ $loop->iteration }}</td>
                                <td width="20%"><a href="/dashboard/pendapatansdetail?startdate={{ date('Y-m-d', strtotime($date)) }}&enddate={{ date('Y-m-d', strtotime($date)) }}">{{ date('d/m/Y', strtotime($date)) }}</a></td>
                                <td>@currency($total)</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="2">GRAND TOTAL</td>
                                <td>@currency($grandTotal)</td>
                            </tr>
                    </table>
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