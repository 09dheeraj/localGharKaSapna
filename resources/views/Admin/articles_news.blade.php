@extends('layouts.inner_page')
@section('content')

<style>
    .switch-style1 input.form-check-input {
        background-color: rgb(246 129 33);
        border: none;
        height: 30px;
        width: 55px;
    }
</style>
<div class="row align-items-center pb40">
    <div class="col-xxl-3">
        <div class="dashboard_title_area">
            <h2>Manage News & Articles</h2>
            <p class="text">Welcome back! Here you can oversee and manage all the latest news and articles.</p>
        </div>
    </div>
    <div class="col-xxl-9">
        <div class="dashboard_search_meta d-md-flex align-items-center justify-content-xxl-end">
            <div class="item1 mb15-sm">
                <div class="search_area">
                    <input type="text" class="form-control bdrs12" placeholder="Search" id="searchInput">
                    <label><span class="flaticon-search"></span></label>
                </div>
            </div>

            <a href="{{route('post.news.articles')}}" target="_blank" class="ud-btn btn-thm">Add New Articles<i class="fal fa-arrow-right-long"></i></a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
            <div class="packages_table table-responsive">
                <table class="table-style3 table at-savesearch">
                    <thead class="t-head">
                        <tr>
                            <th scope="col">Listing title</th>
                            <th scope="col">Description</th>
                            <th scope="col">View</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="t-body" id="tableBody">
                        @foreach($articles as $data)
                        <tr>
                            <th scope="row">
                                <div class="listing-style1 dashboard-style d-xxl-flex align-items-center mb-0">
                                    <div class="list-thumb">
                                        <img class="w-100" src="{{asset('assets/articlesImages/'. $data->featured_image) }}" alt="">
                                    </div>
                                    <div class="list-content py-0 p-0 mt-2 mt-xxl-0 ps-xxl-4">
                                        <div class="h6 list-title"><a href="{{route('article', ['id' => base64_encode($data->id), 'name' => base64_encode($data->title)])}}">{{ Str::words($data->title, 5, '') }}...</a></div>
                                        <div class="list-price">{{ucwords($data->cat->name)}}</div>
                                    </div>
                                </div>
                            </th>
                            <td class="vam">{{ Str::words($data->short_description, 10, '')}}...</td>

                            <?php
                            $dateString = $data->created_at;
                            $dateTime = new DateTime($dateString);
                            $formattedDate = $dateTime->format('M d, Y');

                            $statusCounts = [
                                'pending' => '1',
                                'published' => '2',
                            ];
                            $count = $statusCounts[$data->status] ?? '';
                            ?>

                            <td class="vam">{{$formattedDate}}</td>
                            <td class="vam"><span class="pending-style style{{$count}}">{{$data->status}}</span></td>
                            <td class="vam">
                                <div class="d-flex">
                                    <a target="_blank" href="{{route('edit.article', ['id' => base64_encode($data->id), 'name' => base64_encode($data->title)])}}" class="icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><span class="fas fa-pen fa"></span></a>
                                    <a class="icon delete-article" data-id="{{$data->id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><span class="flaticon-bin"></span></a>
                                    <div class="switch-style1">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input statusValue" type="checkbox" data-id="{{$data->id}}" value="{{$data->status == 'pending' ? '0' : '1'}}" {{$data->status == 'pending' ? '' : 'checked'}}>

                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <style>
                    #loadMoreTrigger {
                        height: 1px;
                    }
                </style>

                <div id="loadMoreTrigger"></div>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        var input, filter, table, rows, title, i, txtValue;
        input = document.getElementById('searchInput');
        filter = input.value.toUpperCase();
        table = document.getElementById('tableBody');
        rows = table.getElementsByTagName('tr');

        for (i = 0; i < rows.length; i++) {
            title = rows[i].getElementsByTagName('th')[0].textContent || rows[i].getElementsByTagName('th')[0].innerText;
            if (title.toUpperCase().indexOf(filter) > -1) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        let rows = document.querySelectorAll('#tableBody tr');
        let visibleRowCount = 20;


        for (let i = visibleRowCount; i < rows.length; i++) {
            rows[i].style.display = 'none';
        }


        function showMoreRows() {
            const nextRowCount = visibleRowCount + 15;
            for (let i = visibleRowCount; i < nextRowCount && i < rows.length; i++) {
                rows[i].style.display = '';
            }
            visibleRowCount = nextRowCount;
        }


        const loadMoreTrigger = document.getElementById('loadMoreTrigger');
        const observer = new IntersectionObserver(entries => {
            if (entries[0].isIntersecting) {
                showMoreRows();
            }
        });

        observer.observe(loadMoreTrigger);

    });





    document.querySelectorAll('.statusValue').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            var id = this.getAttribute('data-id');
            var statusVal = this.checked ? 'published' : 'pending';
            var row = $(this).closest('tr');
            var statusElement = row.find('.pending-style');
            var countElement = row.find('.pending-style');
            $.ajax({
                url: "{{route('manage.articleStatus')}}",
                type: "POST",
                data: {
                    id: id,
                    status: statusVal,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    //  console.log(response);
                    if (response.success) {
                        var count = statusVal == 'published' ? '2' : '1';
                        statusElement.text(statusVal);
                        countElement.removeClass('style1 style2');
                        countElement.addClass('style' + count);
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Status changed successfully!',
                            timer: 3000,
                            showConfirmButton: false
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Error:", error);
                }
            })
        });
    });

    $(document).on('click', '.delete-article', function() {
        var row = $(this).closest('tr');
        var id = $(this).data('id');
        Swal.fire({
            title: 'Confirm Deletion',
            text: "Are you sure you want to delete this Article ? This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{route('delete.article')}}",
                    type: "POST",
                    data: {
                        id: id,
                        "_token": "{{csrf_token()}}"
                    },

                    success: function(response) {

                        //console.log(response);
                        if (response.success) {

                            row.remove();
                            Swal.fire(
                                'Deleted!',
                                'Your property has been deleted.',
                                'success'
                            );

                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("Error:", error);
                    }
                });
            }
        })
    })
</script>






@endsection