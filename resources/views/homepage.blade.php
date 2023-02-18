<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Document</title>
</head>
<body class="">
<nav class="navbar bg-body-tertiary">
    <div class="container-fluid">
        <h1 class="container bg-primary-subtle my-5 p-4 border border-primary rounded text-center">Meksiko's Employee Manager</h1>
    </div>
</nav>
<div class="container text-center">
    <div class="row col-20 align-items-center">
        <div class="col p-3 bg-info bg-opacity-10 border border-info rounded bg-black-subtle  m-5">
            <table class="table">
                <form method="post" action="{{ url('/') }}"  class="d-flex" role="search">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search">
                        </div>
                        <div class="col col-1">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </div>
                        <div class="col col-2">
                            <button type="button" class="btn btn-outline-success addEmployeeButton" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                                Add Employee
                            </button>
                        </div>
                    </div>
                </form>
                <thead>
                <tr>
                    <th class="align-items-center col-5">Name</th>
                    <th class="align-items-center">Age</th>
                    <th class="align-items-center col-5">Address</th>
                    <th class="align-items-center">Phone Number</th>
                    <th class="align-items-center col-8"></th>
                    <th class="align-items-center col-8"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($karyawan as $kar)
                    <tr>
                        <td class="text-start">{{ $kar->KaryawanName }}</td>
                        <td>{{ $kar->KaryawanAge }}</td>
                        <td>{{ $kar->KaryawanAddress }}</td>
                        <td>{{ $kar->KaryawanPhoneNo }}</td>

                        <td class="col-sm-2 text-center">
                            <button type="button" value="{{$kar->id}}~{{ $kar->KaryawanName }}~{{ $kar->KaryawanAge }}~{{ $kar->KaryawanAddress }}~{{ $kar->KaryawanPhoneNo }}" class="btn btn-outline-info updateButton" data-bs-toggle="modal" data-bs-target="#updateEmployeeModal">
                                Update
                            </button>
                        </td>
                        <td class="col-sm-2 text-center">
                            <button type="button" value="{{$kar->id}}" class="btn btn-outline-danger deleteButton" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                                Delete
                            </button>
                        </td>
                @endforeach
                </tbody>

            </table>
            {{ $karyawan->links() }}
        </div>
    </div>
</div>
<div class="modal" id="addEmployeeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="">Add New Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ url('addEmployee') }}" class="my-3">
                <div class="modal-body">
                    <div class="col ">
                        @csrf
                        <div class="mb-3">
                            <label for="employee-address" class="form-label text-start">Employee Name</label>
                            <input type="text" class="form-control border border-dark border-1" name="EmployeeName"
                                   placeholder="Enter employee's name">
                        </div>
                        <div class="mb-3">
                            <label for="employee-age" class="form-label">Employee Age</label>
                            <input type="number" class="form-control border border-dark border-1" name="EmployeeAge"
                                   placeholder="Enter employee's age">
                        </div>
                        <div class="mb-3">
                            <label for="employee-address" class="form-label">Employee Address</label>
                            <input type="text" class="form-control border border-dark border-1" name="EmployeeAddress"
                                   placeholder="Enter employee's address">
                        </div>
                        <div class="mb-3">
                            <label for="employee-phone-number" class="form-label">Employee Phone Number</label>
                            <input type="text" class="form-control border border-dark border-1" name="EmployeePhoneNumber"
                                   placeholder="Enter employee's phone number">
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-primary addEmployeeError" role="alert">
                                {{ $errors->first() }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="updateEmployeeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="">Update Employee's Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ url('updateEmployee') }}" class="my-3">
                <div class="modal-body">
                    <div class="col ">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" id="updateEmployeeId" name="EmployeeId">
                            <label for="employee-address" class="form-label text-start">Employee Name</label>
                            <input type="text" id="updateEmployeeName" class="form-control border border-dark border-1" name="EmployeeName"
                                   placeholder="Enter employee's name">
                        </div>
                        <div class="mb-3">
                            <label for="employee-age" class="form-label">Employee Age</label>
                            <input type="number" id="updateEmployeeAge" class="form-control border border-dark border-1" name="EmployeeAge"
                                   placeholder="Enter employee's age">
                        </div>
                        <div class="mb-3">
                            <label for="employee-address" class="form-label">Employee Address</label>
                            <input type="text" id="updateEmployeeAddress" class="form-control border border-dark border-1" name="EmployeeAddress"
                                   placeholder="Enter employee's address">
                        </div>
                        <div class="mb-3">
                            <label for="employee-phone-number" class="form-label">Employee Phone Number</label>
                            <input type="text" id="updateEmployeePhoneNumber" class="form-control border border-dark border-1" name="EmployeePhoneNumber"
                                   placeholder="Enter employee's phone number">
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-primary updateEmployeeError" role="alert">
                                {{ $errors->first() }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="confirmDeleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ url('/delete') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this employee's data?</p>
                    <input type="hidden" id="deleteEmployeeId" name="EmployeeId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>




<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
@if ($errors->any())
    <script type="text/javascript">
        $( document ).ready(function() {
            if({{ $errors->has('status') }}){
                $('#addEmployeeModal').modal('show');
            }
            else {
                $('#updateEmployeeModal').modal('show');
            }
        });
    </script>
@endif
<script>
    $(document).ready(function() {
        $('.addEmployeeButton').click(function(e) {
            e.preventDefault();
            $('.addEmployeeError').hide();
        });
        $('.updateButton').click(function(e) {
            e.preventDefault();
            $('.updateEmployeeError').hide();
        });
        $(".deleteButton").click(function(e) {
            e.preventDefault();
            $("#deleteEmployeeId").val($(this).val());
        });
        $(".updateButton").click(function(e) {
            e.preventDefault();

            var values = $(this).val().toString().split("~");
            $("#updateEmployeeId").val(values[0]);
            $("#updateEmployeeName").val(values[1]);
            $("#updateEmployeeAge").val(values[2]);
            $("#updateEmployeeAddress").val(values[3]);
            $("#updateEmployeePhoneNumber").val(values[4]);
        });
    });
</script>
</body>
</html>
