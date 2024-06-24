<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Managy.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <link rel="manifest" href="<?= base_url("/assets/manifest.json") ?>">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #FCFCFC;
        }

        .content-container {
            max-height: calc(80vh - 4rem);
            /* Mengatur tinggi maksimum kontainer */
            overflow-y: auto;
            /* Menambah scroll bar vertikal apabila konten melebihi ketinggian maksimum */
        }

        /* Trik untuk menyembunyikan scrollbar tetapi tetap memungkinkan scroll */
        .content-container::-webkit-scrollbar {
            width: 0;
            height: 0;
        }

        .font-12 {
            font-size: 12px;
        }

        .font-15 {
            font-size: 15px;
        }

        .imgicon {
            max-width: 40px;
            /* Sesuaikan dengan ukuran yang diinginkan */
            height: auto;
        }

        .truncate-2 {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
            -webkit-line-clamp: 2;
            /* number of lines to show */
        }


        @media print {
            .modal-footer {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container my-2">
        <h3 class="m-0 fw-bold">Managy.</h3>
        <div class="row m-0">

            <div class="col-9 mt-2">
                <!-- statistik -->
                <div class="row me-2">
                    <div class="col me-2 py-3 border rounded-3 bg-warning text-white">
                        <div class="row">
                            <div class="col mx-0 p-0 text-end my-2">
                                <i class="bi bi-clock-history fs-2"></i>
                            </div>
                            <div class="col-6 ps-0 pe-3 mx-4">
                                <span class="fs-5">Pending</span>
                                <h3 class="fw-bold" id="pending-count"></h3>
                            </div>
                        </div>
                    </div>

                    <div class="col mx-2 p-3 border rounded-3 bg-success text-white">
                        <div class="row">
                            <div class="col mx-0 p-0 text-end my-2">
                                <i class="bi bi-check-circle fs-2"></i>
                            </div>
                            <div class="col-6 ps-0 pe-3 mx-4">
                                <span class="fs-5">Ready</span>
                                <h3 class="fw-bold" id="ready-count"></h3>
                            </div>
                        </div>
                    </div>

                    <div class="col ms-2 p-3 border rounded-3 bg-primary text-white">
                        <div class="row">
                            <div class="col mx-0 p-0 text-end my-2">
                                <i class="bi bi-clipboard-check fs-2"></i>
                            </div>
                            <div class="col-6 ps-0 pe-3 mx-4">
                                <span class="fs-5">Completed</span>
                                <h3 class="fw-bold" id="completed-count"></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- customer -->
                <div class="row my-3">
                    <span class="fs-5" style="margin-left: -10px;">Customer</span>
                </div>
                <!-- search and add -->
                <div class="row me-2">
                    <div class="col" style="margin-left: -10px;">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" id="search" class="form-control rounded-end-3 border-start-0 px-0" placeholder="Search" oninput="searchTransactions()">
                        </div>
                    </div>
                    <div id="startScan" onclick="openAddModal()" style="cursor: pointer;" class="col-2 border bg-success-subtle rounded-3 me-1 d-flex justify-content-center align-items-center">
                        <span class="fs-4">+</span>
                    </div>
                </div>

                <!-- tajuk -->
                <div class="row mt-3 ms-1 text-secondary" style="margin-left: -10px;">
                    <div class="col-1 m-0 p-0">

                    </div>
                    <div class="col-2">
                        ID/Laptop
                    </div>
                    <div class="col-2">
                        Customer
                    </div>
                    <div class="col-2">
                        Date
                    </div>
                    <div class="col-2 m-0 p-0">
                        Status
                    </div>
                    <div class="col-2 m-0 p-0"">
                        Problem
                    </div>

                </div>
                <!-- transaction -->
                <div style=" margin-left: -10px;" class="transactions-group">

                        <!-- transaction -->


                    </div>



                </div>

                <!-- ready to pikup -->
                <div class="col-3 bg-white border rounded-5" style="height: 90vh; ">
                    <div class="container mt-4 ">
                        <div class="text-center">
                            <span>Ready to Pickup</span>
                            <div class="input-group mt-4">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" id="searchReady" class="form-control rounded-end-3 border-start-0 px-0" placeholder="Search" oninput="searchReadyTransactions()">
                            </div>
                        </div>
                        <!-- transactions -->
                        <div class="content-container transactions-ready-group">

                        </div>


                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Add -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addItem" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Perkhidmatan Servis Komputer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group border border-dark rounded-3 p-2">
                            <label class="">ID</label>
                            <input class="form-control" style="border: none;" id="idNumber" placeholder="" readonly>
                        </div>
                        <div class="form-group border border-dark rounded-3 p-2 mt-2">
                            <label class="">Nama</label>
                            <input class="form-control" style="border: none;" id="nama" placeholder="">
                        </div>
                        <div class="form-group border border-dark rounded-3 p-2 mt-2">
                            <label for="description">No Telefon</label>
                            <input type="text" class="form-control" id="noTelefon" style="border: none;">
                        </div>
                        <div class="form-group border border-dark rounded-3 p-2 mt-2">
                            <label for="description">Model</label>
                            <input type="text" class="form-control" id="model" style="border: none;">
                        </div>
                        <div class="form-group border border-dark rounded-3 p-2 mt-2">
                            <label for="description">Masalah</label>
                            <input type="text" class="form-control" id="masalah" style="border: none;">
                        </div>
                        <div class="form-group border border-dark rounded-3 p-2 mt-2">
                            <label for="description">Tarikh</label>
                            <input type="date" class="form-control" id="tarikh" style="border: none;">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <div class="d-flex flex-column flex-grow-1 m-1">
                            <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">CANCEL</button>
                        </div>
                        <div class="d-flex flex-column flex-grow-1 m-1">
                            <button class="btn w-100 btn-primary" id="saveProduct" onclick="add()"><span class="text-white">ADD</span></button>
                        </div>
                        <div class="d-flex flex-column flex-grow-1 m-1">
                            <button class="btn w-100 btn-primary" onclick="printAndAdd()"><span class="text-white">PRINT + ADD</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editItem" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Servis Komputer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group border border-dark rounded-3 p-2">
                            <label class="">ID</label>
                            <input class="form-control" style="border: none;" id="editIdNumber" placeholder="" readonly>
                        </div>
                        <div class="form-group border border-dark rounded-3 p-2 mt-2">
                            <label class="">Nama</label>
                            <input class="form-control" style="border: none;" id="editNama" placeholder="">
                        </div>
                        <div class="form-group border border-dark rounded-3 p-2 mt-2">
                            <label for="description">No Telefon</label>
                            <input type="text" class="form-control" id="editNoTelefon" style="border: none;">
                        </div>
                        <div class="form-group border border-dark rounded-3 p-2 mt-2">
                            <label for="description">Model</label>
                            <input type="text" class="form-control" id="editModel" style="border: none;">
                        </div>
                        <div class="form-group border border-dark rounded-3 p-2 mt-2">
                            <label for="description">Masalah</label>
                            <input type="text" class="form-control" id="editMasalah" style="border: none;">
                        </div>
                        <div class="form-group border border-dark rounded-3 p-2 mt-2">
                            <label for="description">Tarikh</label>
                            <input type="date" class="form-control" id="editTarikh" style="border: none;">
                        </div>
                        <div class="form-group border border-dark rounded-3 p-2 mt-2">
                            <label for="description">Status</label>
                            <select class="form-control" id="editStatus" style="border: none;">
                                <option value="Pending">Pending</option>
                                <option value="Ready">Ready</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <div class="d-flex flex-column flex-grow-1 m-1">
                            <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">CANCEL</button>
                        </div>
                        <div class="d-flex flex-column flex-grow-1 m-1">
                            <button class="btn w-100 btn-primary" id="updateProduct" onclick="update()"><span class="text-white">SAVE</span></button>
                        </div>
                        <div class="d-flex flex-column flex-grow-1 m-1">
                            <button class="btn w-100 btn-primary" onclick="printModalData()"><span class="text-white">PRINT</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

        <script>
            function openAddModal() {
                $('#addModal').modal('show');
                getNextId();
                setTodayDate();
            }

            $('#addModal').on('hidden.bs.modal', function() {
                $(this).find('input').val('');
                $(this).find('select').val(''); // jika ada elemen select
            });

            function generateNextId(lastId) {
                const prefix = 'ID-';
                // Ambil bagian numerik dari ID
                const lastIdNumber = parseInt(lastId.replace(prefix, ''), 10);
                // Pastikan lastIdNumber valid sebelum menambahkan 1
                const nextIdNumber = isNaN(lastIdNumber) ? 1 : lastIdNumber + 1;
                return `${prefix}${nextIdNumber}`;
            }


            function getNextId() {
                $.ajax({
                    url: '<?php echo base_url('main/getLastId'); ?>',
                    method: "GET",
                    dataType: 'json',
                    success: function(data) {
                        console.log('lastID : ' + data.id);
                        const lastId = data && data.id ? data.id : 'ID-0';
                        const nextId = generateNextId(lastId);
                        $('#idNumber').val(nextId);
                    },
                    error: function(xhr, status, error) {
                        console.error("An error occurred: " + status + " " + error);
                        $('#idNumber').val('ID-1'); // Default ID if there's an error
                    }
                });
            }


            function setTodayDate() {
                const today = new Date().toISOString().split('T')[0];
                document.getElementById('tarikh').value = today;
            }


            function add() {


                var idNumber = $('#idNumber').val();
                var nama = $('#nama').val();
                var noTelefon = $('#noTelefon').val();
                var model = $('#model').val();
                var masalah = $('#masalah').val();
                var tarikh = $('#tarikh').val();

                $.ajax({
                    url: '<?php echo base_url('main/add'); ?>',
                    type: "POST",
                    data: {
                        id: idNumber,
                        nama: nama,
                        noTelefon: noTelefon,
                        model: model,
                        masalah: masalah,
                        tarikh: tarikh
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status) {
                            $('#addModal').modal('hide');
                            alert('Data added successfully!');
                            getTransactions(); // Refresh the transaction list
                            getStatistic();
                        } else {
                            alert('Failed to add data!');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("An error occurred: " + status + " " + error);
                    }
                });
            }


            function editTransaction(item) {
                $('#editIdNumber').val(item.id);
                $('#editNama').val(item.customer_name);
                $('#editNoTelefon').val(item.customer_phone);
                $('#editModel').val(item.model);
                $('#editMasalah').val(item.problem);
                $('#editTarikh').val(item.date);
                $('#editStatus').val(item.status);
                $('#editModal').modal('show');
            }

            function update() {
                var idNumber = $('#editIdNumber').val();
                var nama = $('#editNama').val();
                var noTelefon = $('#editNoTelefon').val();
                var model = $('#editModel').val();
                var masalah = $('#editMasalah').val();
                var tarikh = $('#editTarikh').val();
                var status = $('#editStatus').val();

                $.ajax({
                    url: '<?php echo base_url('main/updateTransaction'); ?>',
                    type: "POST",
                    data: {
                        id: idNumber,
                        nama: nama,
                        noTelefon: noTelefon,
                        model: model,
                        masalah: masalah,
                        tarikh: tarikh,
                        status: status
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status) {
                            $('#editModal').modal('hide');
                            alert('Data updated successfully!');
                            getTransactions(); // Refresh the transaction list
                            getStatistic();
                            getReadyTransactions();
                        } else {
                            alert('Failed to update data!');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("An error occurred: " + status + " " + error);
                    }
                });
            }

            function getTransactions() {
                $.ajax({
                    url: '<?php echo base_url('main/getTransactions'); ?>',
                    method: "GET",
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        const list = $('.transactions-group');
                        list.empty();

                        if (data.length === 0) {
                            list.append('<p class="text-muted mt-5 text-center">No customer found</p>');
                        } else {
                            data.forEach(item => {
                                const listAssets = $(`
                            <div class="container border mt-3 rounded-4 bg-white" style="cursor: pointer;" onclick='editTransaction(${JSON.stringify(item)})'>
                                <div class="row p-3 d-flex align-items-center">
                                    <div class="col-1 m-0 p-0">
                                        <img src="" class="rounded-circle imgicon">
                                    </div>
                                    <div class="col-2">
                                        <span class="font-15 fw-bold" id="id_numberX">${item.id}</span><br>  
                                        <span class="font-15" id="modelX">${item.model}</span>
                                    </div>
                                    <div class="col-2">
                                        <span class="font-15 fw-bold" id="customer_nameX">${item.customer_name}</span><br>
                                        <span class="font-15" id="customer_phoneX">${item.customer_phone}</span>
                                    </div>
                                    <div class="col-2">
                                        <span class="font-15" id="tarikhX">${item.date}</span>
                                    </div>
                                    <div class="col-2">
                                        <span class="font-15" id="statusX">${item.status}</span>
                                    </div>
                                    <div class="col-2 truncate-2">
                                        <span class="font-15" id="masalahX">${item.problem}</span>
                                    </div>
                                    <div class="col-1 text-end">
                                        <i class="bi bi-caret-right-fill fs-3 text-success"></i>
                                    </div>
                                </div>
                            </div>
                        `);
                                list.append(listAssets);
                            });
                            // Setelah elemen-elemen ditambahkan, atur atribut src untuk elemen-elemen <img> dengan kelas 'imgicon'
                            setImageSources();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("An error occurred: " + status + " " + error);
                    }
                });
            }


            function getReadyTransactions() {
                $.ajax({
                    url: '<?php echo base_url('main/getReadyTransactions'); ?>',
                    method: "GET",
                    dataType: 'json',
                    data: {
                        status: 'Ready',
                    },
                    success: function(data) {
                        console.log(data);
                        const list = $('.transactions-ready-group');
                        list.empty();

                        if (data.length === 0) {
                            list.append('<p class="text-muted mt-5 text-center">No customer found</p>');
                        } else {
                            data.forEach(item => {
                                const listAssets = $(`
                        <div class="container border mt-3 rounded-3" style="cursor: pointer;" onclick='editTransaction(${JSON.stringify(item)})'>
                            <div class="row p-2">
                                <div class="col-2 m-0 p-0">
                                    <img src="" class="rounded-circle imgicon">
                                </div>
                                <div class="col">
                                    <div class="row m-0 p-0">
                                        <div class="col-6 m-0 p-0 text-truncate ">
                                            <span class="font-12" id="customer_nameY">${item.customer_name}</span>
                                        </div>
                                        <div class="col-1 m-0 p-0">
                                            <span class="font-12">|</span>
                                        </div>
                                        <div class="col-5 m-0 p-0 text-truncate">
                                            <span class="font-12" id="idY">${item.id}</span>
                                        </div>
                                    </div>
                                    <span class="font-12" id="customer_phoneY">${item.customer_phone}</span>
                                </div>
                            </div>
                        </div>
                        `);
                                list.append(listAssets);
                            });
                            // Setelah elemen-elemen ditambahkan, atur atribut src untuk elemen-elemen <img> dengan kelas 'imgicon'
                            setImageSources();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("An error occurred: " + status + " " + error);
                    }
                });
            }

            function setImageSources() {
                const iconFolder = '<?= base_url('/assets/icon/'); ?>';
                const iconCount = 6; // Misalnya ada 6 ikon
                const icons = [];

                // Menghasilkan array path ikon
                for (let i = 1; i <= iconCount; i++) {
                    icons.push(`${iconFolder}icon${i}.png`);
                }

                // Pilih semua elemen <img> dengan kelas 'imgicon'
                const imgElements = document.querySelectorAll('.imgicon');

                // Iterasi melalui elemen-elemen gambar dan set atribut src mereka
                imgElements.forEach((img, index) => {
                    // Pastikan kita tidak melebihi panjang array icons
                    if (index < icons.length) {
                        img.src = icons[index];
                    } else {
                        // Jika melebihi panjang array, ulangi dari awal
                        img.src = icons[index % icons.length];
                    }
                });
            }

            function getStatistic() {
                $.ajax({
                    url: '<?php echo base_url('main/getStatistic'); ?>',
                    method: "GET",
                    dataType: 'json',
                    success: function(data) {
                        $('#pending-count').text(data.Pending);
                        $('#ready-count').text(data.Ready);
                        $('#completed-count').text(data.Completed);
                    },
                    error: function(xhr, status, error) {
                        console.error("An error occurred: " + status + " " + error);
                    }
                });
            }

            function searchTransactions() {
                let search = document.getElementById('search').value.toLowerCase();

                $.ajax({
                    url: '<?php echo base_url('main/searchTransactions'); ?>',
                    method: "GET",
                    dataType: 'json',
                    data: {
                        search: search,
                    },
                    success: function(data) {
                        console.log(data);
                        const list = $('.transactions-group');
                        list.empty();

                        if (data.length === 0) {
                            list.append('<p class="text-muted mt-5 text-center">No customer found</p>');
                        } else {
                            data.forEach(item => {
                                const listAssets = $(`
                            <div class="container border mt-3 rounded-4 bg-white" style="cursor: pointer;" onclick='editTransaction(${JSON.stringify(item)})'>
                                <div class="row p-3 d-flex align-items-center">
                                    <div class="col-1 m-0 p-0">
                                        <img src="" class="rounded-circle imgicon">
                                    </div>
                                    <div class="col-2">
                                        <span class="font-15 fw-bold" id="id_numberX">${item.id}</span><br>  
                                        <span class="font-15" id="modelX">${item.model}</span>
                                    </div>
                                    <div class="col-2">
                                        <span class="font-15 fw-bold" id="customer_nameX">${item.customer_name}</span><br>
                                        <span class="font-15" id="customer_phoneX">${item.customer_phone}</span>
                                    </div>
                                    <div class="col-2">
                                        <span class="font-15" id="tarikhX">${item.date}</span>
                                    </div>
                                    <div class="col-2">
                                        <span class="font-15" id="statusX">${item.status}</span>
                                    </div>
                                    <div class="col-2 truncate-2">
                                        <span class="font-15" id="masalahX">${item.problem}</span>
                                    </div>
                                    <div class="col-1 text-end">
                                        <i class="bi bi-caret-right-fill fs-3 text-success"></i>
                                    </div>
                                </div>
                            </div>
                        `);
                                list.append(listAssets);
                            });
                            // Setelah elemen-elemen ditambahkan, atur atribut src untuk elemen-elemen <img> dengan kelas 'imgicon'
                            setImageSources();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("An error occurred: " + status + " " + error);
                    }
                });
            }

            function searchReadyTransactions() {
                let searchReady = document.getElementById('searchReady').value.toLowerCase();

                $.ajax({
                    url: '<?php echo base_url('main/searchReadyTransactions'); ?>',
                    method: "GET",
                    dataType: 'json',
                    data: {
                        search: searchReady,
                        status: 'Ready',
                    },
                    success: function(data) {
                        console.log(data);
                        const list = $('.transactions-ready-group');
                        list.empty();

                        if (data.length === 0) {
                            list.append('<p class="text-muted mt-5 text-center">No customer found</p>');
                        } else {
                            data.forEach(item => {
                                const listAssets = $(`
                    <div class="container border mt-3 rounded-3" style="cursor: pointer;" onclick='editTransaction(${JSON.stringify(item)})'>
                        <div class="row p-2">
                            <div class="col-2 m-0 p-0">
                                <img src="" class="rounded-circle imgicon">
                            </div>
                            <div class="col">
                                <div class="row m-0 p-0">
                                    <div class="col-6 m-0 p-0 text-truncate ">
                                        <span class="font-12" id="customer_nameY">${item.customer_name}</span>
                                    </div>
                                    <div class="col-1 m-0 p-0">
                                        <span class="font-12">|</span>
                                    </div>
                                    <div class="col-5 m-0 p-0 text-truncate">
                                        <span class="font-12" id="idY">${item.id}</span>
                                    </div>
                                </div>
                                <span class="font-12" id="customer_phoneY">${item.customer_phone}</span>
                            </div>
                        </div>
                    </div>
                    `);
                                list.append(listAssets);
                            });
                            // Setelah elemen-elemen ditambahkan, atur atribut src untuk elemen-elemen <img> dengan kelas 'imgicon'
                            setImageSources();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("An error occurred: " + status + " " + error);
                    }
                });
            }

            function printModalData() {

                // Salin nilai input ke dalam localStorage
                localStorage.setItem('printIdNumber', document.getElementById('editIdNumber').value);
                localStorage.setItem('printNama', document.getElementById('editNama').value);
                localStorage.setItem('printNoTelefon', document.getElementById('editNoTelefon').value);
                localStorage.setItem('printModel', document.getElementById('editModel').value);
                localStorage.setItem('printMasalah', document.getElementById('editMasalah').value);
                localStorage.setItem('printTarikh', document.getElementById('editTarikh').value);

                // Buka halaman cetak
                var printWindow = window.open('<?php echo base_url('main/print_page'); ?>', '_blank');

                // Tunggu hingga halaman cetak dimuat dan panggil window.print
                var interval = setInterval(function() {
                    if (printWindow.document.readyState === 'complete') {
                        clearInterval(interval);
                        printWindow.print();
                        printWindow.close();
                    }
                }, 500);
            }


            function printModalDataAdd() {
                // Salin nilai input ke dalam localStorage
                localStorage.setItem('printIdNumber', document.getElementById('idNumber').value);
                localStorage.setItem('printNama', document.getElementById('nama').value);
                localStorage.setItem('printNoTelefon', document.getElementById('noTelefon').value);
                localStorage.setItem('printModel', document.getElementById('model').value);
                localStorage.setItem('printMasalah', document.getElementById('masalah').value);
                localStorage.setItem('printTarikh', document.getElementById('tarikh').value);

                // Buka halaman cetak
                var printWindow = window.open('<?php echo base_url('main/print_page'); ?>', '_blank');

                // Tunggu hingga halaman cetak dimuat dan panggil window.print
                var interval = setInterval(function() {
                    if (printWindow.document.readyState === 'complete') {
                        clearInterval(interval);
                        printWindow.print();
                        printWindow.close();
                    }
                }, 500);
            }

            function printAndAdd() {
                add();
                printModalDataAdd();
            }
        </script>
        <script>
            $(document).ready(function() {
                getTransactions();
                getReadyTransactions();
                getStatistic();
            });
        </script>

</body>

</html>