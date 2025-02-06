@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }

    .form-container {
        max-width: 1200px;
        margin: auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .form-group input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
        padding: 10px 20px;
        border-radius: 4px;
    }

    .form-group input[type="submit"]:hover {
        background-color: #45a049;
    }

    .box-section {
        margin-top: 20px;
        border: 1px solid #ddd;
        padding: 15px;
        border-radius: 5px;
        background-color: #fff;
    }

    .box-section h3 {
        margin-bottom: 10px;
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    table,
    th,
    td {
        border: 1px solid #ddd;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .add-row-button,
    .add-box-button {
        margin-top: 10px;
        background-color: #008CBA;
        color: white;
        border: none;
        padding: 8px 16px;
        cursor: pointer;
        border-radius: 4px;
    }

    .add-row-button:hover,
    .add-box-button:hover {
        background-color: #007B9E;
    }

    .sender-receiver-container {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .sender-receiver-container>div {
        flex: 1;
        border: 1px solid #ddd;
        padding: 15px;
        border-radius: 5px;
        background-color: #fff;
    }

    .top-section {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .top-section>div {
        flex: 1;
    }

    .box-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .box-header button {
        margin-left: 10px;
    }

    .minimize-button,
    .delete-box-button,
    .delete-row-button {
        background-color: #ff4d4d;
        color: white;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 4px;
    }

    .minimize-button:hover,
    .delete-box-button:hover,
    .delete-row-button:hover {
        background-color: #cc0000;
    }
</style>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <div class="container-fluid">

                                <div class="collapse navbar-collapse" id="navbarNav">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#" id="senderLink">Sender</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#" id="receiverLink">Receiver</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#" id="boxLink">Box</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>




                        <div>



                            <form method="post" action="{{ route('customer.store') }}" id="senderForm" enctype="multipart/form-data">
                                @csrf
                                <h3>Sender Details</h3>
                                <div class="mb-3">
                                    <label for="senderName">Sender Name:</label>
                                    <input type="text" id="senderName" name="senderName" required>
                                </div>
                                <div class="mb-3">
                                    <label for="senderPhone">Sender Phone:</label>
                                    <input type="text" id="senderPhone" name="senderPhone" required>
                                </div>
                                <div class="mb-3">
                                    <label for="senderEmail">Sender Email:</label>
                                    <input type="email" id="senderEmail" name="senderEmail" required>
                                </div>
                                <div class="mb-3">
                                    <label for="senderAddress">Sender Address:</label>
                                    <input type="text" id="senderAddress" name="senderAddress" required>
                                </div>
                               







                            </form>
                            <form method="post" action="{{ route('customer.store') }}" id="receiverForm" enctype="multipart/form-data">
                                @csrf
                                <h3>Reciever Details</h3>
                                <div class="mb-3">
                                    <label for="receiverName">Receiver Name:</label>
                                    <input type="text" id="receiverName" name="receiverName" required>
                                </div>

                                <div class="mb-3">
                                    <label for="receiverPhone">Receiver Phone:</label>
                                    <input type="text" id="receiverPhone" name="receiverPhone" required>
                                </div>
                                <div class="mb-3">
                                    <label for="receiverEmail">Receiver Email:</label>
                                    <input type="email" id="receiverEmail" name="receiverEmail" required>
                                </div>
                                <div class="mb-3">
                                    <label for="receiverPostalcode">Postal Code:</label>
                                    <input id="receiverPostalcode" name="receiverPostalcode" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="receiverCountry">Country:</label>
                                    <input id="receiverCountry" name="receiverCountry" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="receiverAddress">Receiver Address:</label>
                                    <input id="receiverAddress" name="receiverAddress" required></textarea>
                                </div>


                            </form>




                        </div>


                        <form method="post" action="{{ route('customer.store') }}" id="boxForm" enctype="multipart/form-data">
                            @csrf

                            <div class="form-container">
                                <!-- Top Section -->
                                <div class="top-section">
                                    <div class="form-group">
                                        <label for="shipmentVia">Shipment Via:</label>
                                        <input type="text" id="shipmentVia" name="shipmentVia" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="actualWeight">Actual Weight:</label>
                                        <input type="text" id="actualWeight" name="actualWeight" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="invoiceDate">Invoice Date:</label>
                                        <input type="date" id="invoiceDate" name="invoiceDate" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Dimension">Dimension:</label>
                                        <input type="text" id="Dimension" name="Dimension" required>
                                    </div>
                                </div>
                            </div>



                            <!-- Add Box Button -->
                            <button type="button" class="add-box-button" onclick="addBox()">Add Box</button>

                            <!-- Box Details -->
                            <div id="boxDetails">
                                <!-- Box sections will be dynamically added here -->
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group">
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Add Customer">
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script>
    let boxCount = 0; // Global box counter

    function addBox() {
        const boxDetails = document.getElementById("boxDetails");
        const existingBoxes = boxDetails.getElementsByClassName("box-section").length;
        const nextBoxNumber = existingBoxes + 1;

        const boxDiv = document.createElement("div");
        boxDiv.className = "box-section";
        boxDiv.id = `box${nextBoxNumber}`;
        boxDiv.innerHTML = `
            <div class="box-header">
                <h3>Box ${nextBoxNumber}</h3>
                <div>
                    <button type="button" class="minimize-button" onclick="toggleMinimize(${nextBoxNumber})">Minimize</button>
                    <button type="button" class="delete-box-button" onclick="deleteBox(${nextBoxNumber})">Delete Box</button>
                </div>
            </div>
            <div class="box-content" id="box${nextBoxNumber}Content">
                <table id="box${nextBoxNumber}Table">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Description</th>
                            <th>HS Code</th>
                            <th>Quantity</th>
                            <th>Unit Rate (USD)</th>
                            <th>Amount (USD)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Rows will be dynamically added here -->
                    </tbody>
                </table>
                <button type="button" class="add-row-button" onclick="addRow(${nextBoxNumber})">Add Row</button>
            </div>
        `;
        boxDetails.appendChild(boxDiv);
        boxCount = nextBoxNumber;
    }

    function addRow(boxNumber) {
        const tableBody = document.querySelector(`#box${boxNumber}Table tbody`);
        const rowCount = tableBody.getElementsByTagName("tr").length;
        const newRow = document.createElement("tr");
        newRow.innerHTML = `
            <td>${rowCount + 1}</td>
            <td><input type="text" name="description" required></td>
            <td><input type="text" name="hscode"></td>
            <td><input type="number" name="quantity" required></td>
            <td><input type="number" step="0.01" name="unitRate" required></td>
            <td><input type="number" step="0.01" name="amount" readonly></td>
            <td><button type="button" class="delete-row-button" onclick="deleteRow(this, ${boxNumber})">Delete Row</button></td>
        `;
        tableBody.appendChild(newRow);

        const quantityInput = newRow.querySelector('input[name="quantity"]');
        const unitRateInput = newRow.querySelector('input[name="unitRate"]');
        const amountInput = newRow.querySelector('input[name="amount"]');

        quantityInput.addEventListener("input", calculateAmount);
        unitRateInput.addEventListener("input", calculateAmount);

        function calculateAmount() {
            const quantity = parseFloat(quantityInput.value) || 0;
            const unitRate = parseFloat(unitRateInput.value) || 0;
            amountInput.value = (quantity * unitRate).toFixed(2);
        }
    }

    function toggleMinimize(boxNumber) {
        const boxContent = document.getElementById(`box${boxNumber}Content`);
        const minimizeButton = document.querySelector(`#box${boxNumber} .minimize-button`);

        if (boxContent.style.display === "none") {
            boxContent.style.display = "block";
            minimizeButton.textContent = "Minimize";
        } else {
            boxContent.style.display = "none";
            minimizeButton.textContent = "Expand";
        }
    }

    function deleteBox(boxNumber) {
        const boxToDelete = document.getElementById(`box${boxNumber}`);
        if (boxToDelete) {
            boxToDelete.remove();
        }
    }

    function deleteRow(button, boxNumber) {
        const rowToDelete = button.closest('tr');
        if (rowToDelete) {
            rowToDelete.remove();
            updateRowSerialNumbers(boxNumber);
        }
    }

    function updateRowSerialNumbers(boxNumber) {
        const tableBody = document.querySelector(`#box${boxNumber}Table tbody`);
        const rows = tableBody.getElementsByTagName("tr");

        for (let i = 0; i < rows.length; i++) {
            rows[i].querySelector("td:first-child").textContent = i + 1;
        }
    }



















    document.addEventListener("DOMContentLoaded", function() {
        const senderLink = document.getElementById("senderLink");
        const receiverLink = document.getElementById("receiverLink");
        const boxLink = document.getElementById("boxLink");
        const senderForm = document.getElementById("senderForm");
        const receiverForm = document.getElementById("receiverForm");
        const boxForm = document.getElementById("boxForm");
        //   const sendButton = document.getElementById("sendButton");

        // Show Sender Form by default
        senderForm.style.display = "block";
        receiverForm.style.display = "none";
        boxForm.style.display = "none";

        // Switch to Sender Form
        senderLink.addEventListener("click", function(e) {
            e.preventDefault();
            senderForm.style.display = "block";
            receiverForm.style.display = "none";
            boxForm.style.display = "none";
        });

        // Switch to Receiver Form
        receiverLink.addEventListener("click", function(e) {
            e.preventDefault();
            senderForm.style.display = "none";
            receiverForm.style.display = "block";
            boxForm.style.display = "none";
        });

        //   Switch to Box Form
        boxLink.addEventListener("click", function(e) {
            e.preventDefault();
            senderForm.style.display = "none";
            receiverForm.style.display = "none";
            boxForm.style.display = "block";
        });

        // Handle Send Button Click
        sendButton.addEventListener("click", function() {
            let activeForm;
            if (senderForm.style.display === "block") {
                activeForm = senderForm;
            } else if (receiverForm.style.display === "block") {
                activeForm = receiverForm;
            } else if (boxForm.style.display === "block") {
                activeForm = boxForm;
            }

            if (activeForm) {
                activeForm.submit(); // Submit the active form
            }
        });
    });
</script>





















































































































</script>

@endsection