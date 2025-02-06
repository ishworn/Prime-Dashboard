@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<style>
    .form-container {
        max-width: 100%;
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
    @media (max-width: 768px) {
        th,
        td {
            padding: 8px;
            font-size: 14px;
        }
        .box-content {
            padding: 10px;
        }
        .add-row-button {
            font-size: 14px;
            padding: 8px 16px;
        }
    }
</style>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
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
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script>
    function submitForm() {
        const formData = new FormData(document.getElementById('myForm'));
        // Create a simplified 'boxes' array to store only box numbers and sender_id
        const simplifiedBoxes = boxes.map((boxId, index) => {
            return {
                box_number: ` ${index + 1}`, // You can customize this format
            };
        });
        // Append the simplified box data to the FormData object
        formData.append('boxes', JSON.stringify(simplifiedBoxes));
        // Submit the form with the simplified box data
        fetch('/submit', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                console.log('Form submitted successfully:', data);
            })
            .catch(error => {
                console.error('Error submitting form:', error);
            });
    }
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            document.querySelectorAll('.form-section').forEach(section => {
                section.style.display = 'none';
            });
            document.getElementById(e.target.dataset.target).style.display = 'block';
            link.parentElement.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
            link.classList.add('active');
        });
    });
    // Array to store box IDs
    let boxes = [];
    // Function to add a new box///
    function addBox() {
        const boxId = Date.now().toString(); // Unique ID for each box
        boxes.push(boxId);
        const boxDiv = document.createElement('div');
        boxDiv.className = 'box-section';
        boxDiv.dataset.boxId = boxId;
        boxDiv.innerHTML = `
        <div class="box-header">
            <h4><span class="box-number">Box ${boxes.length}</span></h4>
            <div>
                <button type="button" class="minimize-button" onclick="toggleMinimize(this)">-</button>
                <button type="button" class="delete-box-button" onclick="deleteBox('${boxId}')">×</button>
            </div>
        </div>
        <div class="box-content">
         <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Item</th>
                        <th>HS Code</th>
                        <th>Quantity</th>
                        <th>Unit Rate</th>
                        <th>Amount</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            </div>
            <button type="button" class="add-row-button" onclick="addRow('${boxId}')">Add Item</button>
        </div>
    `;
        document.getElementById('boxContainer').appendChild(boxDiv);
        addRow(boxId); // Add the first row to the new box
        updateBoxNumbers();
    }
    function deleteBox(boxId) {
        boxes = boxes.filter(id => id !== boxId);
        document.querySelector(`[data-box-id="${boxId}"]`).remove();
        updateBoxNumbers();
    }
    function updateBoxNumbers() {
        document.querySelectorAll('.box-section').forEach((box, index) => {
            const boxNumberSpan = box.querySelector('.box-number');
            if (boxNumberSpan) {
                boxNumberSpan.textContent = `Box ${index + 1}`;
            }
            // Update all input names in this box
            const boxIndex = index;
            box.querySelectorAll('input').forEach(input => {
                const name = input.name;
                if (name.includes('boxes[OLD_INDEX]')) {
                    input.name = name.replace('boxes[OLD_INDEX]', `boxes[${boxIndex}]`);
                }
            });
        });
    }
    function addRow(boxId) {
        const box = document.querySelector(`[data-box-id="${boxId}"]`);
        const tbody = box.querySelector('tbody');
        const rows = tbody.querySelectorAll('tr');
        const rowIndex = rows.length;
        const row = document.createElement('tr');
        row.dataset.rowIndex = rowIndex;
        row.innerHTML = `
         <td class="d-none d-md-table-cell">${rowIndex + 1}</td> <!-- Hide on mobile -->
        <td><input type="text" name="boxes[${boxId}][items][${rowIndex}][item]" required class="form-control"></td>
        <td><input type="text" name="boxes[${boxId}][items][${rowIndex}][hs_code]" class="form-control"></td>
        <td><input type="number" name="boxes[${boxId}][items][${rowIndex}][quantity]" required class="form-control"></td>
        <td><input type="number" name="boxes[${boxId}][items][${rowIndex}][unit_rate]" required class="form-control"></td>
        <td><input type="number" name="boxes[${boxId}][items][${rowIndex}][amount]" readonly class="form-control"></td>
        <td><button type="button" class="delete-row-button btn btn-danger" onclick="deleteRow(this)">×</button></td>
           
    `;
        // Add calculation logic
        const quantityInput = row.querySelector('input[name*="quantity"]');
        const unitRateInput = row.querySelector('input[name*="unit_rate"]');
        const amountInput = row.querySelector('input[name*="amount"]');
        const calculateAmount = () => {
            const quantity = parseFloat(quantityInput.value) || 0;
            const unitRate = parseFloat(unitRateInput.value) || 0;
            amountInput.value = (quantity * unitRate).toFixed(2);
        };
        quantityInput.addEventListener('input', calculateAmount);
        unitRateInput.addEventListener('input', calculateAmount);
        tbody.appendChild(row);
        updateRowNumbers(box);
    }
    function deleteRow(button) {
        const row = button.closest('tr');
        const tbody = row.parentElement;
        row.remove();
        updateRowNumbers(tbody.closest('.box-section'));
    }
    function updateRowNumbers(box) {
        const tbody = box.querySelector('tbody');
        tbody.querySelectorAll('tr').forEach((row, index) => {
            row.querySelector('td:first-child').textContent = index + 1;
            // Update all input names in this row
            const boxIndex = Array.from(box.parentElement.children).indexOf(box);
            row.querySelectorAll('input').forEach(input => {
                const name = input.name;
                input.name = name
                    .replace(/boxes\[\d+\]/g, `boxes[${boxIndex}]`)
                    .replace(/items\[\d+\]/g, `items[${index}]`);
            });
        });
    }
    function toggleMinimize(button) {
        const content = button.closest('.box-header').nextElementSibling;
        content.style.display = content.style.display === 'none' ? 'block' : 'none';
        button.textContent = content.style.display === 'none' ? '+' : '-';
    }
</script>

@endsection