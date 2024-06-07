@extends('layouts.inner_page')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">

<div class="col-lg-12">
    <div class="dashboard_title_area">
        <h2>Comprehensive User</h2>
        <p class="text">We are glad to see you again!</p>
    </div>
</div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
            <div class="packages_table table-responsive">
                <table class="table-style3 table at-savesearch" id="userTable">
                    <thead class="t-head">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Date Created</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="t-body">
                        @foreach($users as $user)
                        <tr>
                            <td>{{ucfirst($user->name)}}</td>
                            <?php
                            $dateString = $user->created_at;
                            $dateTime = new DateTime($dateString);
                            $formattedDate = $dateTime->format('M d, Y');
                            ?>
                            <td> {{$formattedDate}}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="" class="icon" data-bs-toggle="tooltip" data-bs-placement="top" title="fullscreen"><span class="flaticon-fullscreen-1"></span></a>
                                    <a href="" class="icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><span class="fas fa-pen fa"></span></a>
                                    <a href="" class="icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><span class="flaticon-bin"></span></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>


<script>
    // window.addEventListener('load', function() {
    //     $('#userTable').DataTable();
    //     console.log("DataTable initialized on window load");
    // });
    let table = new DataTable('#userTable', {
        ordering: false

    });

</script>
@endsection