@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Edit Customer Page </h4><br><br>



                        <form method="post" action="{{ route('customer.store') }}" id="myForm" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <!-- Navigation -->
                                <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
                                    <div class="container-fluid">
                                        <!-- Toggler Button for Mobile View -->
                                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                            <span class="navbar-toggler-icon"></span>
                                        </button>

                                        <div class="collapse navbar-collapse" id="navbarNav">
                                            <ul class="navbar-nav">
                                                <li class="nav-item">
                                                    <a class="nav-link active" href="#" data-target="senderForm">Sender</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#" data-target="receiverForm">Receiver</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#" data-target="boxSection">Boxes</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </nav>

                                <!-- Sender Section -->
                                <div id="senderForm" class="form-section">
                                    <h3>Sender Details</h3>
                                    <div class="form-group">
                                        <label>Sender Name:</label>
                                        <input type="text" id='senderName' name="senderName" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Sender Phone:</label>
                                        <input type="text" id='senderPhone' name="senderPhone" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Sender Email:</label>
                                        <input type="email" id='senderEmail' name="senderEmail">
                                    </div>
                                    <div class="form-group">
                                        <label>Sender Address:</label>
                                        <input type="text" id='senderAddress' name="senderAddress" required>
                                    </div>
                                </div>


                                <!-- Receiver Section -->
                                <div id="receiverForm" class="form-section" style="display:none;">
                                    <h3>Receiver Details</h3>
                                    <div class="row">
                                        <!-- Column 1 -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Receiver Name:</label>
                                                <input type="text" name="receiverName" required class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Receiver Phone:</label>
                                                <input type="text" name="receiverPhone" required class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Receiver Email:</label>
                                                <input type="email" name="receiverEmail" class="form-control">
                                            </div>

                                        </div>

                                        <!-- Column 2 -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Postal Code:</label>
                                                <input type="text" name="receiverPostalcode" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Country:</label>
                                                <input type="text" name="receiverCountry" required class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Address:</label>
                                                <textarea name="receiverAddress" required class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Box Section -->
                                <div id="boxSection" class="form-section" style="display:none;">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <!-- Shipment Via -->
                                            <div class="col-12 col-md-6 mb-3">
                                                <label for="shipment_via">Shipment Via:</label>
                                                <input type="text" name="shipment_via" class="form-control" required>
                                            </div>

                                            <!-- Actual Weight -->
                                            <div class="col-12 col-md-6 mb-3">
                                                <label for="actual_weight">Actual Weight (kg):</label>
                                                <input type="number" step="0.01" name="actual_weight" class="form-control" required>
                                            </div>

                                            <!-- Invoice Date -->
                                            <div class="col-12 col-md-6 mb-3">
                                                <label for="invoice_date">Invoice Date:</label>
                                                <input type="date" name="invoice_date" class="form-control" required>
                                            </div>

                                            <!-- Dimension -->
                                            <div class="col-12 col-md-6 mb-3">
                                                <label for="dimension">Dimension (LxWxH):</label>
                                                <input type="text" name="dimension" class="form-control" required>
                                            </div>
                                        </div>

                                        <!-- Box Container Section -->
                                        <div id="boxContainer" class="mt-4"></div>

                                        <!-- Add Box Button -->
                                        <div class="text-center">
                                            <button type="button" class="btn btn-primary  m-3" onclick="addBox()">Add Box</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group    navbar-light bg-light  mx-9  ">
                                <input type="submit" class="btn btn-info" value="Submit All Data">
                            </div>

                        </form>



































                    </div>
                </div>
            </div> <!-- end col -->
        </div>

        <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Customer">

    </div>
</div>
<!-- 
<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required : true,
                }, 
                 mobile_no: {
                    required : true,
                },
                 email: {
                    required : true,
                },
                 address: {
                    required : true,
                },
                 
            },
            messages :{
                name: {
                    required : 'Please Enter Your Name',
                },
                mobile_no: {
                    required : 'Please Enter Your Mobile Number',
                },
                email: {
                    required : 'Please Enter Your Email',
                },
                address: {
                    required : 'Please Enter Your Address',
                },
                 
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>


<script type="text/javascript">
    
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

</script> -->



@endsection