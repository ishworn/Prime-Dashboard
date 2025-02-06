@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <form method="post" action="{{ route('customer.store') }}"  id="myForm" enctype="multipart/form-data">
                            @csrf
<div>
                            <!-- Navigation -->
                            <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
                                <div class="container-fluid">
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
                                    <input type="text" id= 'senderName' name="senderName" required>
                                </div>
                                <div class="form-group">
                                    <label>Sender Phone:</label>
                                    <input type="text"  id= 'senderPhone' name="senderPhone" required>
                                </div>
                                <div class="form-group">
                                    <label>Sender Email:</label>
                                    <input type="email"  id= 'senderEmail' name="senderEmail">
                                </div>
                                <div class="form-group">
                                    <label>Sender Address:</label>
                                    <input type="text"  id= 'senderAddress'  name="senderAddress" required>
                                </div>
                            </div>

                            <!-- Receiver Section -->
                            <div id="receiverForm" class="form-section" style="display:none;">
                                <h3>Receiver Details</h3>
                                <div class="form-group">
                                    <label>Receiver Name:</label>
                                    <input type="text" name="receiverName" required>
                                </div>
                                <div class="form-group">
                                    <label>Receiver Phone:</label>
                                    <input type="text" name="receiverPhone" required>
                                </div>
                                <div class="form-group">
                                    <label>Receiver Email:</label>
                                    <input type="email" name="receiverEmail">
                                </div>
                                <div class="form-group">
                                    <label>Postal Code:</label>
                                    <input type="text" name="receiverPostalcode">
                                </div>
                                <div class="form-group">
                                    <label>Country:</label>
                                    <input type="text" name="receiverCountry" required>
                                </div>
                                <div class="form-group">
                                    <label>Address:</label>
                                    <textarea name="receiverAddress" required></textarea>
                                </div>
                            </div>

                            <!-- Box Section -->
                            <div id="boxSection" class="form-section" style="display:none;">
                                <div class="top-section">
                                    <div class="form-group">
                                        <label>Shipment Via:</label>
                                        <input type="text" name="shipment_via" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Actual Weight (kg):</label>
                                        <input type="number" step="0.01" name="actual_weight" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Invoice Date:</label>
                                        <input type="date" name="invoice_date" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Dimension (LxWxH):</label>
                                        <input type="text" name="dimension" required>
                                    </div>
                                </div>

                                <div id="boxContainer"></div>
                                <button type="button" class="add-box-button" onclick="addBox()">Add Box</button>
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
            box_number: ` ${index + 1}`,  // You can customize this format
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
    const boxId = Date.now().toString();  // Unique ID for each box
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
            <td>${rowIndex + 1}</td>
            <td><input type="text" name="boxes[${boxId}][items][${rowIndex}][item]" required></td>
      
        <td><input type="text" name="boxes[${boxId}][items][${rowIndex}][hs_code]"></td>
        <td><input type="number" name="boxes[${boxId}][items][${rowIndex}][quantity]" required></td>
        <td><input type="number" name="boxes[${boxId}][items][${rowIndex}][unit_rate]" required></td>
        <td><input type="number" name="boxes[${boxId}][items][${rowIndex}][amount]" readonly></td>
        <td><button type="button" class="delete-row-button" onclick="deleteRow(this)">×</button></td>
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