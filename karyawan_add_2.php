<?php
    $getkar = mysqli_query($conn, "SELECT *,COUNT(*) as cekrow FROM worker WHERE unix_id = '$_GET[id]'");
    $s = mysqli_fetch_array($getkar);
    $s_id_worker = $s['id_worker'];   
    
    $s_foto = $s['foto'];
if ($s['cekrow'] > 0){
?>
<div class="content p-2 pt-2 pb-5">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 col-xl-4">
                <div class="card">
                    <div class="card-body" id="updoc">
                        <div class="row">

                            <div class="col-md-12 text-end">
                                <!-- <button type="button" data-bs-toggle="modal" data-bs-target="#peringatan"
                                    class="btn btn-dark text-white fw-bold btn-xs waves-effect mb-1 waves-light"><i
                                        class="fe-alert-circle"></i> PERINGATAN</button> -->

                                <button type="button" data-bs-toggle="modal" data-bs-target="#editmulti"
                                    data-id="<?=$s_id_worker?>"
                                    class="btn btn-primary text-white fw-bold btn-xs waves-effect mb-1 waves-light edit-multi-btn">
                                    <i class="fe-edit"></i> MULTI
                                </button>

                                <button type="button" data-bs-toggle="modal" data-bs-target="#modalmutasi"
                                    class="btn btn-warning text-white fw-bold btn-xs waves-effect mb-1 waves-light"><i
                                        class="fe-repeat"></i> MUTASI</button>
                                <a href="?ad=ad&id=<?=$_GET['id'];?>" type="button"
                                    class="btn btn-info btn-xs waves-effect mb-1 waves-light fw-bold"><i
                                        class="mdi mdi-file-document-edit-outline"></i> EDIT</a>
                            </div>
                        </div>

                        <div id="editmulti" class="modal fade" tabindex="-1" role="dialog"
                            aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="fullWidthModalLabel">EDIT MULTI USER</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="" method="POST" class="needs-validation" novalidate>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-1">
                                                        <label class="form-label">Multi User</label>
                                                        <div class="form-check form-switch mt-1">
                                                            <input type="hidden" name="multi" value="TIDAK">
                                                            <input type="checkbox" name="multi" class="form-check-input"
                                                                id="customSwitch1" value="YA">
                                                            <label class="form-check-label"
                                                                for="customSwitch1">YA</label>
                                                        </div>
                                                        <div class="invalid-feedback">Harus di isi</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Checkbox tambahan, awalnya tersembunyi -->
                                            <div id="additionalCheckboxes" style="display: none; margin-top: 15px;">
                                                <label class="form-label">Pilih Checklist</label>
                                                <div
                                                    style="display: flex; gap: 15px; flex-wrap: wrap; margin-top: 10px;">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="options[]" value="GL"
                                                            class="form-check-input" id="optionGL">
                                                        <label class="form-check-label" for="optionGL">GL</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" name="options[]" value="PC"
                                                            class="form-check-input" id="optionPC">
                                                        <label class="form-check-label" for="optionPC">PC</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" name="options[]" value="KMS"
                                                            class="form-check-input" id="optionKMS">
                                                        <label class="form-check-label" for="optionKMS">KMS</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" name="options[]" value="PACK"
                                                            class="form-check-input" id="optionPACK">
                                                        <label class="form-check-label" for="optionPACK">PACK</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" name="options[]" value="BDL"
                                                            class="form-check-input" id="optionBDL">
                                                        <label class="form-check-label" for="optionBDL">BDL</label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="pmulti"
                                                class="btn btn-primary text-white fw-bold">EDIT MULTI</button>
                                        </div>
                                    </form>

                                    <script>
                                    document.querySelectorAll('.edit-multi-btn').forEach(button => {
                                        button.addEventListener('click', function() {
                                            const id = this.getAttribute('data-id');

                                            fetch('?user=gtm', {
                                                    method: 'POST',
                                                    headers: {
                                                        'Content-Type': 'application/x-www-form-urlencoded'
                                                    },
                                                    body: `id=${id}`
                                                })
                                                .then(response => response.json())
                                                .then(data => {
                                                    const multiCheckbox = document.getElementById(
                                                        'customSwitch1');
                                                    const additionalCheckboxes = document
                                                        .getElementById('additionalCheckboxes');

                                                    // Atur checkbox utama
                                                    multiCheckbox.checked = data.multi === 'YA';
                                                    additionalCheckboxes.style.display = data
                                                        .multi === 'YA' ? 'block' : 'none';

                                                    // Checklist tambahan
                                                    document.querySelectorAll(
                                                        '#additionalCheckboxes .form-check-input'
                                                        ).forEach(checkbox => {
                                                        checkbox.checked = data.options
                                                            .includes(checkbox
                                                            .value
                                                        ); // Checklist sesuai data
                                                    });

                                                    // Tambahkan event listener ke checkbox utama
                                                    multiCheckbox.addEventListener('change',
                                                        function() {
                                                            if (this.checked) {
                                                                additionalCheckboxes.style
                                                                    .display =
                                                                    'block'; // Tampilkan checklist tambahan
                                                            } else {
                                                                additionalCheckboxes.style
                                                                    .display =
                                                                    'none'; // Sembunyikan checklist tambahan

                                                                // Hapus centang semua checklist tambahan
                                                                document.querySelectorAll(
                                                                    '#additionalCheckboxes .form-check-input'
                                                                    ).forEach(checkbox => {
                                                                    checkbox.checked =
                                                                        false;
                                                                });
                                                            }
                                                        });
                                                })
                                                .catch(error => console.error('Gagal mengambil data:',
                                                    error));
                                        });
                                    });
                                    </script>

                                </div>
                            </div>
                        </div>


                        <?php
                            if (isset($_POST['multi'])) {     
                                $multiUser = isset($_POST['multi']) ? $_POST['multi'] : 'TIDAK';

                                if ($multiUser == 'TIDAK'){
                                    $options = "";
                                }else{
                                    $options = isset($_POST['options']) ? implode(',', $_POST['options']) : null;
                                }

                                $updat  = mysqli_query($conn, "UPDATE worker SET     
                                multi = '$multiUser',
                                multi_des = '$options'                             
                                WHERE id_worker = '$s_id_worker'");
                                        if ($updat){                      
                                            $admulti =  mysqli_query($conn, "INSERT INTO worker_multi
                                            (unix_id,multi,multi_des)
                                            values ('$s[unix_id]','$multiUser','$options')");
                                            
                                            echo "<script type='text/javascript'>
                                            window.onload = function () {
                                                Swal.fire({
                                                    type: 'success',
                                                    title: 'EDIT MULTI BERHASIL',
                                                    icon: 'success',
                                                    text: 'Data karyawan berhasil di edit',                                            
                                                }).then(function () {
                                                    window.location.href = window.location.href;
                                                });  
                                            };
                                            </script>";
                                        }else{                 
                                            echo "<script type='text/javascript'>
                                            window.onload = function () {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'ERROR CODE #6238',
                                                    text: 'GAGAL UPDATE DATA, HUBUNGI ADMIN',                
                                                }).then(function () {
                                                    window.location.href = window.location.href;
                                                });            
                                            };
                                            </script>";
                                        }
                            }

                            ?>

                        <div id="modalmutasi" class="modal fade" tabindex="-1" role="dialog"
                            aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="fullWidthModalLabel">MUTASI <?=$s['nama'];?>
                                            (<?=$s['nip'];?>)</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="" method="POST" class="needs-validation" novalidate>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Tanggal Mutasi </label>
                                                        <input type="date" class="form-control" name="tglmutasi"
                                                            id="tglmutasi" required>
                                                        <div class="invalid-feedback">
                                                            Harus di isi
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Bagian <span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-select" id="getbag" name="idbag" required>
                                                            <option value="">Pilih Bagian</option>
                                                            <?php
                                                                    $getbag = mysqli_query($conn, "SELECT * FROM jobdesk order by grup ASC") or die(mysqli_error());
                                                                            while ($g = mysqli_fetch_array($getbag)) {
                                                                ?>
                                                            <option value="<?php echo $g['idj'] ?>">
                                                                <?php echo $g['nama_job'] ?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Harus di isi
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Tingkatan <span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-select" id="data_tingkatan" name="tingkatan"
                                                            required>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Harus di isi
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Kelompok <span
                                                                class="text-danger">*</span></label>
                                                        <div id="kelompok-container">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-2">
                                                        <label class="form-label">Urutan <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="nourut"
                                                            id="nourut" required>
                                                        <div id="invalid-nip"></div>
                                                        <div class="invalid-feedback">
                                                            Harus di isi
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="pmutasi"
                                                class="btn btn-warning text-white fw-bold">MUTASI</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                        <?php
                            if (isset($_POST['pmutasi'])) {     

                                $tglmutasi = $_POST['tglmutasi'];      
                                $idbag = $_POST['idbag'];           
                                $idting = $_POST['tingkatan'];
                                $geting = mysqli_query($conn, "SELECT * FROM tingkatan WHERE idt = '$idting'");     
                                $gt = mysqli_fetch_array($geting);
                            
                                $id_job = $gt['id_job'];
                                $job = addslashes($gt['job']);
                                $tingkatan = $gt['tingkatan'];
                                $kode_job = $gt['kode_job'];
                                
                                $kelompok = substr("00{$_POST['kelompok']}", -2);        
                                $nourut = substr("00{$_POST['nourut']}", -2);    
                                
                                $cekom = mysqli_query($conn, "SELECT kelompok, COUNT(*) as cekelom FROM kelompok WHERE kode_job = '$kode_job' AND kode_kelompok = '$kelompok'");     
                                $k = mysqli_fetch_array($cekom);
                            
                                if ($k['cekelom'] > 0) {
                                    $nokelompok = $kelompok;
                                    $ketkelompok =  addslashes($k['kelompok']);
                                }else{
                                    $nokelompok = $kelompok;
                                    $ketkelompok =  $kelompok;
                                }
                            
                                $nip = $kode_job.".".$kelompok.".".$nourut;            
                            
                                $cmutasi =  mysqli_query($conn, "INSERT INTO worker_mutasi
                                (unix_id,nik,nip_lama,nip,nama,bagian,tingkatan,kelompok,tanggal_mutasi)
                                values ('$s[unix_id]','$s[nik]','$s[nip]','$nip','$s[nama]','$job','$tingkatan','$kelompok','$tglmutasi')");
                            
                            if ($cmutasi){                            
                                $updat  = mysqli_query($conn, "UPDATE worker SET     
                                nip = '$nip',
                                id_job = '$idbag',
                                jobdesk = '$job',
                                id_tingkatan = '$idting',
                                tingkatan = '$tingkatan',
                                kode_tingkatan = '$kode_job',
                                kelompok = '$nokelompok',
                                ket_kelompok = '$ketkelompok'
                                WHERE id_worker = '$s_id_worker'");
                                        if ($updat){                            
                                            echo "<script type='text/javascript'>
                                            window.onload = function () {
                                                Swal.fire({
                                                    type: 'success',
                                                    title: 'MUTASI BERHASIL',
                                                    icon: 'success',
                                                    text: 'Data karyawan berhasil dimutasi',                                            
                                                }).then(function () {
                                                    window.location.href = window.location.href;
                                                });  
                                            };
                                            </script>";
                                        }else{                 
                                            echo "<script type='text/javascript'>
                                            window.onload = function () {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'ERROR CODE #6233',
                                                    text: 'GAGAL UPDATE DATA, HUBUNGI ADMIN',                
                                                }).then(function () {
                                                    window.location.href = window.location.href;
                                                });            
                                            };
                                            </script>";
                                        }
                                    }else{
                                        echo "<script type='text/javascript'>
                                        window.onload = function () {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'ERROR CODE #6232',
                                                text: 'GAGAL UPDATE DATA, HUBUNGI ADMIN',                
                                            }).then(function () {
                                                window.location.href = window.location.href;
                                            });            
                                        };
                                        </script>";
                                    }                            
                            }
                            ?>

                        <div class="row border rounded  mt-2 pt-3">
                            <h3 class="text-uppercase border-bottom pb-2"><i class="mdi mdi-account me-1"></i>
                                <?=$s['nama'];?></h3>
                            
                            <div class="col-md-8">
                                <p class="">NIP : <strong><?=$s['nip'];?></strong><br>
                                    NIK : <strong><?=$s['nik'];?></strong></p>
                                <div class="text-start pt-2 border-top">

                                    <p class="mb-1 font-16">Bagian :
                                        <br><strong><?=$s['jobdesk'];?></strong>
                                    </p>
                                    <p class="mb-1 font-16">Tingkatan :
                                        <br><strong><?php
                                        if($s['id_job']== '6'){
                                            echo $s['ket_kelompok'];
                                        }else{
                                            echo $s['tingkatan'];
                                        };?></strong>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <input type="file" name="filesToUpload1" id="filesToUpload1" class="form-control mb-3"
                                    accept=".jpg, .jpeg" style="display: none;">
                                <input type="hidden" name="getidkar" id="getidkar" class="form-control mb-0"
                                    value="<?=$_GET['id']?>">
                                <div class="filter-item">
                                    <div class="gal-box">
                                        <div class="m-2 mb-0 text-end">
                                            <label for="filesToUpload1" type="button"
                                                class="btn btn-danger waves-effect waves-light btn-xs fw-bold">UPLOAD
                                                <i class="fe-corner-right-down me-1"></i></label>
                                            <div class="progress mt-2" id="prgfilesToUpload1" style="display: none;">
                                                <div id="pbfilesToUpload1"
                                                    class="progress-bar progress-bar-striped progress-bar-animated fw-bold"
                                                    role="pbfilesToUpload1" style="width: 0%;" aria-valuenow="0"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                    Proses Upload</div>
                                            </div>
                                        </div>
                                        <div id="gtfilesToUpload1">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <style>
                            .data-row {
                                display: flex;
                                margin-bottom: 10px;
                                font-size: 13px;
                            }

                            .data-label {
                                font-weight: bold;
                                font-size: 16px;
                                width: 200px;
                                /* Sesuaikan lebar agar tanda ':' sejajar */
                            }

                            .data-value {
                                flex: 1;
                                font-weight: bold;
                                font-size: 16px;
                                /* Ambil sisa ruang */
                            }
                            </style>

                            <div>
                                <h4 class="text-uppercase border-bottom pb-2">DATA PERSONALIA</h4>
                                <div class="data-row">
                                    <div class="data-label">NIK</div>
                                    <div class="data-value">: <strong><?= $s['nik']; ?></strong></div>
                                </div>

                                <div class="data-row">
                                    <div class="data-label">NPWP</div>
                                    <div class="data-value">: <strong><?= $s['npwp']; ?></strong></div>
                                </div>
                                <div class="data-row">
                                    <div class="data-label">NIP</div>
                                    <div class="data-value">: <strong><?= $s['nip']; ?></strong></div>
                                </div>
                                <div class="data-row">
                                    <div class="data-label">Bagian</div>
                                    <div class="data-value">: <strong><?=$s['jobdesk'];?> <?php
                                        if($s['id_job']== '6'){
                                            echo $s['ket_kelompok'];
                                        }else{
                                            echo $s['tingkatan'];
                                        };?></strong></div>
                                </div>
                                <div class="data-row">
                                    <div class="data-label">Kategori Multi</div>
                                    <div class="data-value">: <strong><?=$s['multi']; ?></strong></div>
                                </div>
                                <div class="data-row">
                                    <div class="data-label">Ket Multi</div>
                                    <div class="data-value">: <strong><?=$s['multi_des']; ?></strong></div>
                                </div>
                                <div class="data-row">
                                    <div class="data-label">Tanggal Masuk</div>
                                    <div class="data-value">: <strong><?= blnIndo($s['tgl_masuk']); ?></strong></div>
                                </div>
                                <div class="data-row">
                                    <div class="data-label">Tanggal Resmi</div>
                                    <div class="data-value">:
                                        <strong><?= $s['tgl_resmi'] ? blnIndo($s['tgl_resmi']) : '-'; ?></strong>
                                    </div>
                                </div>
                                <div class="data-row">
                                    <div class="data-label">Masa Kerja</div>
                                    <div class="data-value">:
                                        <strong><?= $s['masa_kerja'] ? durasiKerja($s['tgl_resmi']) : '-'; ?></strong>
                                    </div>
                                </div>
                                <div class="data-row ">
                                    
                                </div>
                                <h4 class="text-uppercase border-bottom pb-2 pt-2">DATA PRIBADI</h4>
                                <div class="data-row">
                                    <div class="data-label">Nama Lengkap</div>
                                    <div class="data-value">: <strong><?= $s['nama']; ?></strong></div>
                                </div>
                                <div class="data-row">
                                    <div class="data-label">KK</div>
                                    <div class="data-value">: <strong><?= $s['kk']; ?></strong></div>
                                </div>
                                <div class="data-row">
                                    <div class="data-label">KTP</div>
                                    <div class="data-value">: <strong><?= $s['ktp']; ?></strong></div>
                                </div>
                                <div class="data-row">
                                    <div class="data-label">Kota Lahir</div>
                                    <div class="data-value">: <strong><?= $s['kota_lahir']; ?></strong></div>
                                </div>
                                <div class="data-row">
                                    <div class="data-label">Tanggal Lahir</div>
                                    <div class="data-value">: <strong><?= tglIndo($s['tgl_lahir']); ?></strong></div>
                                </div>
                                <div class="data-row">
                                    <div class="data-label">Usia</div>
                                    <div class="data-value">: <strong><?= hitungUsia($s['tgl_lahir']); ?> Tahun</strong>
                                    </div>
                                </div>
                                <div class="data-row">
                                    <div class="data-label">Telp</div>
                                    <div class="data-value">: <strong><?= $s['telp']; ?></strong></div>
                                </div>
                                <div class="data-row">
                                    <div class="data-label">Pendidikan Terakhir</div>
                                    <div class="data-value">: <strong><?= $s['pendidikan_terakhir']; ?></strong></div>
                                </div>
                                <div class="data-row">
                                    <div class="data-label">Tahun Lulus</div>
                                    <div class="data-value">: <strong><?= $s['tahun_lulus']; ?></strong></div>
                                </div>
                                <div class="data-row">
                                    <div class="data-label">Jenis Kelamin</div>
                                    <div class="data-value">: <strong><?= $s['jenis_kelamin']; ?></strong></div>
                                </div>
                                <div class="data-row">
                                    <div class="data-label">Golongan Darah</div>
                                    <div class="data-value">: <strong><?= $s['gol_darah']; ?></strong></div>
                                </div>
                                <div class="data-row">
                                    <div class="data-label">Agama</div>
                                    <div class="data-value">: <strong><?= $s['agama']; ?></strong></div>
                                </div>
                                <div class="data-row">
                                    <div class="data-label">Status</div>
                                    <div class="data-value">: <strong><?= $s['status']; ?></strong></div>
                                </div>
                                <div class="data-row">
                                    <div class="data-label">Alamat</div>
                                    <div class="data-value">: <strong>
                                            <?= $s['jln']; ?> RT: <?= $s['rt']; ?> / RW: <?= $s['rw']; ?>,
                                            <?= $s['desa']; ?>, <?= $s['kecamatan']; ?>,
                                            <?= $s['kota']; ?>, <?= $s['prov']; ?> (<?= $s['kodepos']; ?>)
                                        </strong></div>
                                </div>
                                <div class="data-row">
                                    <div class="data-label">Upah</div>
                                    <div class="data-value">: <strong><?= number_format($s['upah']); ?></strong></div>
                                </div>
                                <div class="data-row">
                                    <div class="data-label">SK</div>
                                    <div class="data-value">: <strong><?= $s['sk']; ?></strong></div>
                                </div>
                                <div class="data-row">
                                    <div class="data-label">BPJS Kesehatan</div>
                                    <div class="data-value">: <strong><?= $s['bpjs_kesehatan']; ?></strong></div>
                                </div>
                                <div class="data-row">
                                    <div class="data-label">BPJS Ketenagakerjaan</div>
                                    <div class="data-value">: <strong><?= $s['bpjs_ketenagakerjaan']; ?></strong></div>
                                </div>
                                <div class="data-row">
                                    <div class="data-label">Ibu Kandung</div>
                                    <div class="data-value">: <strong><?= $s['ibu_kandung']; ?></strong></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills nav-fill navtab-bg">
                            <li class="nav-item">
                                <a href="?ad=akd&id=<?=$_GET['id'];?>" aria-expanded="false"
                                    class="nav-link <?php if (!isset($_GET['dk'])) echo 'active'; ?>">
                                    Data Keluarga
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="?ad=akd&id=<?=$_GET['id'];?>&dk=1" aria-expanded="true"
                                    class="nav-link <?php if (isset($_GET['dk']) && $_GET['dk'] == '1') echo 'active'; ?>">
                                    Mutasi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="?ad=akd&id=<?=$_GET['id'];?>&dk=2" aria-expanded="false"
                                    class="nav-link <?php if (isset($_GET['dk']) && $_GET['dk'] == '2') echo 'active'; ?>">
                                    Absensi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="?ad=akd&id=<?=$_GET['id'];?>&dk=3" aria-expanded="false"
                                    class="nav-link <?php if (isset($_GET['dk']) && $_GET['dk'] == '3') echo 'active'; ?>">
                                    Medis
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="?ad=akd&id=<?=$_GET['id'];?>&dk=5" aria-expanded="false"
                                    class="nav-link <?php if (isset($_GET['dk']) && $_GET['dk'] == '5') echo 'active'; ?>">
                                    Peringatan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="?ad=akd&id=<?=$_GET['id'];?>&dk=6" aria-expanded="false"
                                    class="nav-link <?php if (isset($_GET['dk']) && $_GET['dk'] == '6') echo 'active'; ?>">
                                    Resign
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane <?php if (!isset($_GET['dk'])) echo 'show active'; ?>">
                                <div class="row justify-content-between">
                                    <div class="col-md-6 my-auto">
                                        <h5 class="text-uppercase"><i class="mdi mdi-cards-variant me-1"></i>
                                            Detail Data Keluarga</h5>
                                    </div>
                                    <div class="col-md-6 text-end my-auto">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#full-width-modal"
                                            class=" mb-3 mt-0 btn btn-danger waves-effect waves-light mt-1 fw-bold">ADD
                                            DATA KELUARGA <i class="fe-corner-right-down me-1"></i></button>
                                    </div>
                                </div>
                                <div id="full-width-modal" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="fullWidthModalLabel">Add Data Keluarga</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="keluargaForm" class="needs-validation" novalidate>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <input type="hidden" value="<?=$_GET['id'];?>"
                                                                    class="form-control" name="id_kar" required>
                                                                <label class="form-label">Nama Lengkap Keluarga<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="NAMA LENGKAP"
                                                                    onBlur="javascript:{this.value = this.value.toUpperCase(); }"
                                                                    name="namakel" required>
                                                                <div class="invalid-feedback">
                                                                    Harus di isi
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">No. KTP Keluarga <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="number" class="form-control"
                                                                    placeholder="340**********" name="ktp" required>
                                                                <div class="invalid-feedback">
                                                                    Harus di isi
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Status<span
                                                                        class="text-danger">*</span></label>
                                                                <select class="form-select" name="statushub" required>
                                                                    <option value="">Pilih Status</option>
                                                                    <option value="SUAMI">SUAMI</option>
                                                                    <option value="ISTRI">ISTRI</option>
                                                                    <option value="ANAK">ANAK</option>
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    Harus di pilih
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Kota Lahir<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" name="kotalahir"
                                                                    placeholder="KOTA LAHIR" required>
                                                                <div class="invalid-feedback">
                                                                    Harus di isi
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Tanggal Lahir<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="date" class="form-control" name="tgl_lahir"
                                                                    required>
                                                                <div class="invalid-feedback">
                                                                    Harus di isi
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label class="form-label">Alamat<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" name="alamat"
                                                                    required>
                                                                <div class="invalid-feedback">
                                                                    Harus di isi
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="updatedata" class="btn btn-primary">ADD
                                                    DATA</button>
                                            </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table mb-0 table-sm table-bordered">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Lengkap</th>
                                                <th>KTP</th>
                                                <th>Status</th>
                                                <th>Kota Lahir</th>
                                                <th>Tgl Lahir</th>
                                                <th>Alamat</th>
                                                <th class="text-center">Act</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $getkel = mysqli_query($conn, "SELECT * FROM worker_kel WHERE unix_id = '$_GET[id]'
                                                order by id DESC");
                                                $no = 1;
                                                while ($b = mysqli_fetch_array($getkel)) { ?>
                                            <tr>
                                                <th scope="row"><?=$no++?></th>
                                                <td><?=$b['nama_kel'];?></td>
                                                <td><?=$b['ktp_kel'];?></td>
                                                <td><?=$b['status_kel'];?></td>
                                                <td><?=$b['kota_lahir'];?></td>
                                                <td><?=tglIndo($b['tgl_lahir_kel']);?></td>
                                                <td><?=$b['alamat_kel'];?></td>
                                                <td class="text-center">
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#editkel<?=$b['id'];?>"
                                                        class="btn btn-info btn-xs waves-effect waves-light"><i
                                                            class="fe-edit"></i></button>
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#delkel<?=$b['id'];?>"
                                                        class="btn btn-danger btn-xs waves-effect waves-light"><i
                                                            class="fe-trash-2"></i></button>
                                                </td>
                                            </tr>

                                            <div id="delkel<?=$b['id'];?>" class="modal fade" tabindex="-1"
                                                role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content modal-filled bg-danger">
                                                        <div class="modal-body p-4">
                                                            <div class="text-center">
                                                                <i class="fas fa-trash-alt h1 text-white"></i>
                                                                <h4 class="mt-2 text-white">Hapus Data!</h4>
                                                                <p class="mt-3 text-white">Yakin ingin Menghapus Data
                                                                    <?=$b['nama_kel'];?></p>
                                                                <form action="" method="POST">
                                                                    <input type="hidden" value="<?=$b['id'];?>"
                                                                        class="form-control" name="idkel" required>
                                                                    <button type="submit" name="delkel"
                                                                        class="btn btn-dark my-2"
                                                                        data-bs-dismiss="modal">YA</button>
                                                                    <button type="button" class="btn btn-light my-2"
                                                                        data-bs-dismiss="modal">TIDAK</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->

                                            <div id="editkel<?=$b['id'];?>" class="modal fade" tabindex="-1"
                                                role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="fullWidthModalLabel">Edit Data
                                                                Keluarga</h4>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="" method="POST">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="mb-3">
                                                                            <input type="hidden" value="<?=$b['id'];?>"
                                                                                class="form-control" name="idkel"
                                                                                required>
                                                                            <label class="form-label">Nama Lengkap
                                                                                Keluarga<span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control"
                                                                                value="<?=$b['nama_kel'];?>"
                                                                                onBlur="javascript:{this.value = this.value.toUpperCase(); }"
                                                                                name="namakel" required>
                                                                            <div class="invalid-feedback">
                                                                                Harus di isi
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">No. KTP Keluarga
                                                                                <span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="number" class="form-control"
                                                                                placeholder="340**********" name="ktp"
                                                                                value="<?=$b['ktp_kel'];?>" required>
                                                                            <div class="invalid-feedback">
                                                                                Harus di isi
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Status<span
                                                                                    class="text-danger">*</span></label>
                                                                            <select class="form-select" name="statushub"
                                                                                required>
                                                                                <option value="<?=$b['status_kel'];?>">
                                                                                    <?=$b['status_kel'];?></option>
                                                                                <option value="SUAMI">SUAMI</option>
                                                                                <option value="ISTRI">ISTRI</option>
                                                                                <option value="ANAK">ANAK</option>
                                                                            </select>

                                                                            <div class="invalid-feedback">
                                                                                Harus di pilih
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Kota Lahir<span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control"
                                                                                name="kotalahir"
                                                                                value="<?=$b['kota_lahir'];?>"
                                                                                placeholder="KOTA LAHIR" required>
                                                                            <div class="invalid-feedback">
                                                                                Harus di isi
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Tanggal Lahir<span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="date" class="form-control"
                                                                                name="tgl_lahir"
                                                                                value="<?=$b['tgl_lahir_kel'];?>"
                                                                                required>
                                                                            <div class="invalid-feedback">
                                                                                Harus di isi
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Alamat<span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control"
                                                                                name="alamat"
                                                                                value="<?=$b['alamat_kel'];?>" required>
                                                                            <div class="invalid-feedback">
                                                                                Harus di isi
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" name="editkel"
                                                                class="btn btn-primary">EDIT
                                                                DATA</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php
                                  if (isset($_POST['delkel'])) {
                                    $idkel = $_POST['idkel'];

                                    $getdaf = mysqli_query($conn, "SELECT * FROM worker_kel WHERE id = '$idkel'");
                                    $s = mysqli_fetch_array($getdaf);

                                    $insertdec = mysqli_query($conn, "INSERT INTO worker_kel_del (id,id_worker,unix_id,nik,nama,ktp,
                                    nama_kel, ktp_kel, status_kel,alamat_kel,kota_lahir,tgl_lahir_kel,add_by,nama_by)
                                            VALUES ('$idkel','$s[id_worker]', '$s[unix_id]', '$s[nik]', '$s[nama]', '$s[ktp]',
                                            '$s[nama_kel]','$s[ktp_kel]','$s[status_kel]','$s[alamat_kel]','$s[kota_lahir]','$s[tgl_lahir_kel]','$iduser','$namausr')");
                                
                                        if ($insertdec) {
                                            mysqli_query($conn, "DELETE FROM worker_kel WHERE id = '$idkel'");
                                            echo "<script type='text/javascript'>
                                                        window.onload = function () { Swal.fire({
                                                                title: 'Good job!',
                                                                text: 'Data Keluarga Karyawan Berhasil Di Hapus',
                                                                icon: 'success',
                                                                customClass: {
                                                                    confirmButton: 'btn btn-primary'
                                                                },
                                                                buttonsStyling: false
                                                            }).then(function () {
                                                                window.location.href = window.location.href;
                                                            })
                                                        };
                                                </script>";
                                            }else{            
                                                echo "<script type='text/javascript'>
                                                window.onload = function () { Swal.fire({
                                                title: 'Error Code #535 !',
                                                text: 'Gagal Hapus Keluarga Karyawan, Hubungi Admin',
                                                icon: 'error',
                                                customClass: {
                                                    confirmButton: 'btn btn-primary'
                                                },
                                                    buttonsStyling: !1
                                                })};
                                                </script>";
                                            }

                                    }
                                  
                                    if (isset($_POST['editkel'])) {     
                                        $idkel = $_POST['idkel'];
                                        $namakel = addslashes($_POST['namakel']);
                                        $ktp = $_POST['ktp'];
                                        $statushub = $_POST['statushub'];
                                        $tgl_lahir = $_POST['tgl_lahir'];
                                        $alamat = addslashes($_POST['alamat']);
                                        $kotalahir = $_POST['kotalahir'];
                                    
                                    
                                        $updat  = mysqli_query($conn, "UPDATE worker_kel SET
                                        nama_kel = '$namakel',
                                        ktp_kel = '$ktp',
                                        status_kel = '$statushub',
                                        alamat_kel = '$alamat',
                                        kota_lahir = '$kotalahir',
                                        tgl_lahir_kel = '$tgl_lahir'
                                        WHERE id = '$idkel'");

                                        if ($updat){
                                            echo "<script type='text/javascript'>
                                            window.onload = function () {
                                                Swal.fire({
                                                    type: 'success',
                                                    title: 'UPDATE DATA BERHASIL',
                                                    icon: 'success',
                                                    text: 'Data Keluarga Karyawan Berhasil di Update',                                            
                                                }).then(function () {
                                                    window.location.href = window.location.href;
                                                });  
                                            };
                                            </script>";
                                        }else{               
                                            echo "<script type='text/javascript'>
                                            window.onload = function () {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'ERROR CODE #9232',
                                                    text: 'GAGAL UPDATE DATA, HUBUNGI ADMIN',                
                                                }).then(function () {
                                                    window.location.href = window.location.href;
                                                });            
                                            };
                                            </script>";
                                        }

                                    }
                                    ?>
                            <div
                                class="tab-pane <?php if (isset($_GET['dk']) && $_GET['dk'] == '1') echo 'show active'; ?>">
                                <div class="table-responsive">
                                    <table class="table mb-0 table-sm table-bordered">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Tgl Mutasi</th>
                                                <th>NIP SBLM</th>
                                                <th>NIP BARU</th>
                                                <th>Bagian</th>
                                                <th>Tingkatan</th>
                                                <th>G</th>
                                                <th>Tgl Action</th>
                                                <th class="text-center">Act</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $getmut = mysqli_query($conn, "SELECT * FROM worker_mutasi WHERE unix_id = '$s[unix_id]' order by idm ASC");
                                            $no = 1;
                                            while ($g = mysqli_fetch_array($getmut)) { ?>
                                            <tr>
                                                <th scope="row"><?=$no++?></th>
                                                <td><?=tglIndo($g['tanggal_mutasi']);?></td>
                                                <td><?=$g['nip_lama'];?></td>
                                                <td><?=$g['nip'];?></td>
                                                <td><?=$g['bagian'];?></td>
                                                <td><?=$g['tingkatan'];?></td>
                                                <td><?=$g['kelompok'];?></td>

                                                <td><?=tgljamIndo($g['date_create']);?></td>
                                                <td class="text-center">
                                                    
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#delmut<?=$g['idm'];?>"
                                                        class="btn btn-danger btn-xs waves-effect waves-light"><i
                                                            class="fe-trash-2"></i></button>
                                                </td>
                                            </tr>


                                            <div id="delmut<?=$g['idm'];?>" class="modal fade" tabindex="-1"
                                                role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content modal-filled bg-danger">
                                                        <div class="modal-body p-4">
                                                            <div class="text-center">
                                                                <i class="fas fa-trash-alt h1 text-white"></i>
                                                                <h4 class="mt-2 text-white">Hapus Data!</h4>
                                                                <p class="mt-3 text-white">Yakin ingin Menghapus Data 
                                                                    Mutasi Tanggal : 
                                                                <?=tglIndo($g['tanggal_mutasi']);?></p>
                                                                <form action="" method="POST">
                                                                    <input type="hidden" value="<?=$g['idm'];?>"
                                                                        class="form-control" name="idmut" required>
                                                                    <button type="submit" name="delmut"
                                                                        class="btn btn-dark my-2"
                                                                        data-bs-dismiss="modal">YA</button>
                                                                    <button type="button" class="btn btn-light my-2"
                                                                        data-bs-dismiss="modal">TIDAK</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->

                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <?php
                                  if (isset($_POST['delmut'])) {
                                    $idmut = $_POST['idmut'];

                                    $delmutasi = mysqli_query($conn, "DELETE FROM worker_mutasi WHERE idm = '$idmut'");
                                    if ($delmutasi) {
                                       
                                        echo "<script type='text/javascript'>
                                                    window.onload = function () { Swal.fire({
                                                            title: 'Good job!',
                                                            text: 'Data Mutasi Karyawan Berhasil Di Hapus',
                                                            icon: 'success',
                                                            customClass: {
                                                                confirmButton: 'btn btn-primary'
                                                            },
                                                            buttonsStyling: false
                                                        }).then(function () {
                                                            window.location.href = window.location.href;
                                                        })
                                                    };
                                            </script>";
                                        }else{            
                                            echo "<script type='text/javascript'>
                                            window.onload = function () { Swal.fire({
                                            title: 'Error Code #935 !',
                                            text: 'Gagal Hapus Mutasi Karyawan, Hubungi Admin',
                                            icon: 'error',
                                            customClass: {
                                                confirmButton: 'btn btn-primary'
                                            },
                                                buttonsStyling: !1
                                            })};
                                            </script>";
                                        }

                                  }

                            ?>
                            <div
                                class="tab-pane <?php if (isset($_GET['dk']) && $_GET['dk'] == '2') echo 'show active'; ?>">
                                <table class="table table-striped table-bordered table-sm">
                                    <thead class="table-light table-sm">
                                        <tr>
                                            <th>#</th>
                                            <th>NIP</th>
                                            <th>Tgl Absen</th>
                                            <th style="width:150px">Keterangan</th>
                                            <th class="text-center">Act</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $getmut = mysqli_query($conn, "SELECT nip, pcm, sm,
                                        DATE_FORMAT(tgl_absen, '%Y') AS bulan, jenis_absensi,
                                        MIN(tgl_absen) AS tgl_awal,
                                        MAX(tgl_absen) AS tgl_akhir
                                        FROM worker_absensi
                                        WHERE nik = '$s[nik]'
                                        GROUP BY bulan, jenis_absensi, pcm, sm
                                        ORDER BY tgl_absen DESC;");
                                        
                                        $no = 1;
                                        while ($g = mysqli_fetch_array($getmut)) { ?>
                                        <tr>
                                            <th class="p-1" scope="row"><?=$no++?></th>
                                            <td class="p-1"><?=$g['nip'];?></td>
                                            <td class="p-1"><?=blnIndo($g['tgl_awal']);?> -
                                                <?=blnIndo($g['tgl_akhir']);?></td>

                                            <?php
                                                    $textabsen = '';
                                                    if ($g['jenis_absensi'] == "i" || $g['jenis_absensi'] == "I") {
                                                        $textabsen = "<td  p-1'><span class='badge bg-info'>i</span></td>";
                                                    } elseif ($g['jenis_absensi'] == "s" || $g['jenis_absensi'] == "S") {
                                                        $textabsen = "<td  p-1'><span class='badge bg-warning'>S</span></td>";
                                                    } elseif ($g['jenis_absensi'] == "a" || $g['jenis_absensi'] == "A") {
                                                        $textabsen = "<td  p-1'><span class='badge bg-danger'>A</span></td>";
                                                    } elseif ($g['jenis_absensi'] == "cm" || $g['jenis_absensi'] == "CM") {
                                                        // Menampilkan CM, PCM, dan SM di dalam satu <td>
                                                        $textabsen = "<td  p-1'>";
                                                        $textabsen .= "<span class='badge bg-primary'>CM</span>";
                                                        
                                                        if ($g['pcm'] == "PCM") {
                                                            $textabsen .= " <span class='badge bg-info'>PCM</span>";
                                                        }
                                                        if ($g['sm'] == "SM") {
                                                            $textabsen .= " <span class='badge bg-success'>SM</span>";
                                                        }
                                                        
                                                        $textabsen .= "</td>";
                                                    } else {
                                                        $textabsen = "<td  p-1'><span class='badge bg-dark'>".$g['jenis_absensi']."</span></td>";
                                                    }

                                                    echo $textabsen;
                                                ?>

                                            <td class="text-center p-1">
                                                <a href="?ad=akd&id=<?=$_GET['id'];?>&dk=4&gb=<?=$g['bulan'];?>&ja=<?=$g['jenis_absensi'];?>"
                                                    type="button"
                                                    class="btn btn-primary btn-xs waves-effect waves-light">Lihat</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div
                                class="tab-pane <?php if (isset($_GET['dk']) && $_GET['dk'] == '4') echo 'show active'; ?>">
                                <div class="row justify-content-between">
                                    <div class="col-md-6 my-auto">
                                        <h5 class="text-uppercase"><i class="mdi mdi-cards-variant me-1"></i>
                                            Detail Absensi <?php echo $_GET['gb']; ?></h5>
                                    </div>
                                    <div class="col-md-6 text-end my-auto">
                                        <a href="?ad=akd&id=<?=$_GET['id'];?>&dk=2" type="button"
                                            class="mb-1 mt-0 btn btn-dark btn-sm waves-effect waves-light mt-1 fw-bold">
                                            <i class="fe-arrow-left me-1"></i> Kembali</a>
                                    </div>
                                </div>
                                <form action="" method="POST">
                                    <button type="submit" name="deleteSelected" class="btn btn-danger btn-xs"
                                        onclick="return confirm('Apakah kamu yakin ingin menghapus data yang terpilih?')">Hapus
                                        Terpilih</button>

                                    <button type="button" id="editSelectedBtn" class="btn btn-info btn-xs">Edit
                                        Terpilih</button>
                                    <table class="table table-striped table-bordered table-sm">
                                        <thead class="table-light table-sm">
                                            <tr>
                                                <th><input type="checkbox" id="checkAll"></th>
                                                <th>#</th>
                                                <th>NIP</th>
                                                <th>Tgl Absen</th>
                                                <th>Jenis Absensi</th>
                                                <th>No Surat</th>
                                                <th>Keterangan</th>
                                                <!-- <th class="text-center">Act</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $getmut = mysqli_query($conn, "SELECT * FROM worker_absensi WHERE nik = '$s[nik]' 
                                             AND DATE_FORMAT(tgl_absen, '%Y') = '$_GET[gb]'
                                             AND jenis_absensi = '$_GET[ja]'
                                             order by tgl_absen ASC");
                                            $no = 1;
                                            while ($g = mysqli_fetch_array($getmut)) { 
                                                $getnosurat = $g['no_surat'];
                                                $getketerangan = $g['ket'];
                                                ?>
                                            <tr>
                                                <td><input type="checkbox" class="checkItem" name="data_ids[]"
                                                        value="<?=$g['ida'];?>">
                                                </td>

                                                <th class="p-1" scope="row"><?=$no++?></th>
                                                <td class="p-1"><?=$g['nip'];?></td>
                                                <td class="p-1"><?=blnIndo($g['tgl_absen']);?></td>
                                                <?php
                                                if ($g['jenis_absensi'] == "i" || $g['jenis_absensi'] == "I") {
                                                    $textabsen = "<td  p-1'><span class='badge bg-info'>i</span></td>";
                                                } elseif ($g['jenis_absensi'] == "s" || $g['jenis_absensi'] == "S") {
                                                    $textabsen = "<td  p-1'><span class='badge bg-warning'>S</span></td>";
                                                } elseif ($g['jenis_absensi'] == "a" || $g['jenis_absensi'] == "A") {
                                                    $textabsen = "<td  p-1'><span class='badge bg-danger'>A</span></td>";
                                                } elseif ($g['jenis_absensi'] == "cm" || $g['jenis_absensi'] == "CM") {
                                                    $textabsen = "<td  p-1'>";
                                                    $textabsen .= "<span class='badge bg-primary'>CM</span>";
                                                    
                                                    if ($g['pcm'] == "PCM") {
                                                        $textabsen .= " <span class='badge bg-info'>PCM</span>";
                                                    }
                                                    if ($g['sm'] == "SM") {
                                                        $textabsen .= " <span class='badge bg-success'>SM</span>";
                                                    }
                                                    
                                                    $textabsen .= "</td>";
                                                } else{
                                                    $textabsen = "<td  p-1'><span class='badge bg-dark'>".$g['jenis_absensi'];".</span></td>";
                                                }                                              
                                                echo $textabsen;?>
                                                <!-- <td class="text-center p-1">
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#editab<?=$g['ida'];?>"
                                                        class="btn btn-info btn-xs waves-effect waves-light"><i
                                                            class="fe-edit"></i></button>
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#delab<?=$g['ida'];?>"
                                                        class="btn btn-danger btn-xs waves-effect waves-light"><i
                                                            class="fe-trash-2"></i></button>
                                                </td> -->
                                                <td class="p-1"><?=$g['no_surat'];?></td>
                                                <td class="p-1"><?=$g['ket'];?></td>
                                            </tr>

                                            <div id="editab<?=$g['ida'];?>" class="modal fade" tabindex="-1"
                                                role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="fullWidthModalLabel">Edit
                                                                Absensi
                                                            </h4>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="" method="POST">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <input type="hidden" value="<?=$g['ida'];?>"
                                                                                class="form-control" name="idab"
                                                                                required>
                                                                            <label class="form-label">Tanggal
                                                                                Abensi<span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="text"
                                                                                class="form-control bg-light"
                                                                                value="<?=blnIndo($g['tgl_absen']);?>"
                                                                                readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Keterangan<span
                                                                                    class="text-danger">*</span></label>
                                                                            <select class="form-select" name="jnsabsen"
                                                                                id="jnsabsen" required>
                                                                                <option
                                                                                    value="<?=$g['jenis_absensi'];?>">
                                                                                    <?=$g['jenis_absensi'];?></option>
                                                                                <option value="I">I</option>
                                                                                <option value="S">S</option>
                                                                                <option value="A">A</option>
                                                                                <option value="CM">CM</option>
                                                                            </select>
                                                                            <div class="invalid-feedback">
                                                                                Harus di isi
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <?php if ($g['jenis_absensi'] == "cm" || $g['jenis_absensi'] == "CM"){ ?>

                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="mb-1"><label
                                                                                    class="form-label">Keterangan
                                                                                    Masuk</label>
                                                                                <div
                                                                                    class="form-check form-switch mt-1">
                                                                                    <input type="hidden" name="sm"
                                                                                        value="0"><input type="checkbox"
                                                                                        name="sm"
                                                                                        class="form-check-input"
                                                                                        id="customSwitch1" value="SM"
                                                                                        <?php if ($g['sm'] == "SM"){echo "checked";} ?>><label
                                                                                        class="form-check-label"
                                                                                        for="customSwitch1">Sudah
                                                                                        Masuk</label>
                                                                                </div>
                                                                                <div class="invalid-feedback">Harus di
                                                                                    isi
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="mb-1"><label
                                                                                    class="form-label">Keterangan Lahir
                                                                                    <span></label>
                                                                                <div
                                                                                    class="form-check form-switch mt-1">
                                                                                    <input type="hidden" name="pcm"
                                                                                        value="0"><input type="hidden"
                                                                                        name="ket"
                                                                                        value="<?=$g['ket'];?>"><input
                                                                                        type="checkbox" name="pcm"
                                                                                        <?php if ($g['pcm'] == "PCM"){echo "checked";} ?>
                                                                                        class="form-check-input"
                                                                                        id="customSwitch1"
                                                                                        value="PCM"><label
                                                                                        class="form-check-label"
                                                                                        for="customSwitch1">Sudah
                                                                                        Lahir</label>
                                                                                </div>
                                                                                <div class="invalid-feedback">Harus di
                                                                                    isi
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php } else {?>
                                                                    <div class="col-md-12">
                                                                        <div class="mb-1"><label
                                                                                class="form-label">Keterangan</label><input
                                                                                type="hidden" name="sm" value="0"><input
                                                                                type="hidden" name="pcm"
                                                                                value="0"><input type="text"
                                                                                class="form-control" placeholder=""
                                                                                name="ket" id="ket">
                                                                            <div class="invalid-feedback">Harus di isi
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php } ?>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" name="editab"
                                                                class="btn btn-primary">EDIT
                                                                DATA</button>
                                                        </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div id="delab<?=$g['ida'];?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content modal-filled bg-danger">
                                <div class="modal-body p-4">
                                    <div class="text-center">
                                        <i class="fas fa-trash-alt h1 text-white"></i>
                                        <h4 class="mt-2 text-white">Hapus Data!</h4>
                                        <p class="mt-3 text-white">Yakin ingin Menghapus Absensi
                                            <br>
                                            <?=blnIndo($g['tgl_absen']);?>
                                        </p>
                                        <form action="" method="POST">
                                            <input type="hidden" value="<?=$g['ida'];?>" class="form-control"
                                                name="idab" required>
                                            <button type="submit" name="delab" class="btn btn-dark my-2"
                                                data-bs-dismiss="modal">YA</button>
                                            <button type="button" class="btn btn-light my-2"
                                                data-bs-dismiss="modal">TIDAK</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    </tbody>
                    </table>
                    </form>
                    <?php
                        if (isset($_POST['editab'])) {     
                                $idab = $_POST['idab'];
                                $jenisab = addslashes($_POST['jnsabsen']);
                                $sm = addslashes($_POST['sm']);
                                $pcm = addslashes($_POST['pcm']);
                                $ket = addslashes($_POST['ket']);
                            
                                $updat  = mysqli_query($conn, "UPDATE worker_absensi SET                                    
                                jenis_absensi = '$jenisab',
                                pcm = '$pcm',
                                sm = '$sm',
                                ket = '$ket'
                                    WHERE ida = '$idab'");

                                if ($updat){
                                    echo "<script type='text/javascript'>
                                    window.onload = function () {
                                        Swal.fire({
                                            type: 'success',
                                            title: 'UPDATE DATA BERHASIL',
                                            icon: 'success',
                                            text: 'Data Absensi Berhasil di Update',                                            
                                        }).then(function () {
                                            window.location.href = window.location.href;
                                        });  
                                    };
                                    </script>";
                                }else{               
                                    echo "<script type='text/javascript'>
                                    window.onload = function () {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'ERROR CODE #3232',
                                            text: 'GAGAL UPDATE DATA, HUBUNGI ADMIN',                
                                        }).then(function () {
                                            window.location.href = window.location.href;
                                        });            
                                    };
                                    </script>";
                                }

                            }

                        if (isset($_POST['delab'])) {     

                            $idab = $_POST['idab'];
                            $getdaf = mysqli_query($conn, "SELECT * FROM worker_absensi WHERE ida = '" . mysqli_real_escape_string($conn, $idab) . "'");
                            $s = mysqli_fetch_array($getdaf);                                    
                            
                            if ($s) {                                            
                                $insertdec = mysqli_query($conn, "INSERT INTO worker_absensi_del 
                                    (ida, nik, nip, nama, id_job, jobdesk, id_tingkatan, tingkatan, kode_tingkatan, kelompok, ket_kelompok, jenis_absensi,pcm,sm, tgl_absen, add_by, nama_by, via) 
                                    VALUES 
                                    ('" . mysqli_real_escape_string($conn, $s['ida']) . "', 
                                        '" . mysqli_real_escape_string($conn, $s['nik']) . "', 
                                        '" . mysqli_real_escape_string($conn, $s['nip']) . "', 
                                        '" . mysqli_real_escape_string($conn, $s['nama']) . "', 
                                        '" . mysqli_real_escape_string($conn, $s['id_job']) . "',
                                        '" . mysqli_real_escape_string($conn, $s['jobdesk']) . "', 
                                        '" . mysqli_real_escape_string($conn, $s['id_tingkatan']) . "',
                                        '" . mysqli_real_escape_string($conn, $s['tingkatan']) . "',   
                                        '" . mysqli_real_escape_string($conn, $s['kode_tingkatan']) . "',
                                        '" . mysqli_real_escape_string($conn, $s['kelompok']) . "',      
                                        '" . mysqli_real_escape_string($conn, $s['ket_kelompok']) . "',  
                                        '" . mysqli_real_escape_string($conn, $s['jenis_absensi']) . "', 
                                        '" . mysqli_real_escape_string($conn, $s['pcm']) . "', 
                                        '" . mysqli_real_escape_string($conn, $s['sm']) . "', 
                                        '" . mysqli_real_escape_string($conn, $s['tgl_absen']) . "',     
                                        '" . mysqli_real_escape_string($conn, $iduser) . "',             
                                        '" . mysqli_real_escape_string($conn, $namausr) . "',            
                                        'via detail Karyawan')");                                                   
                            
                            
                                if ($insertdec) {
                                    mysqli_query($conn, "DELETE FROM worker_absensi WHERE ida = '$idab'");
                                    echo "<script type='text/javascript'>
                                                window.onload = function () { Swal.fire({
                                                        title: 'Good job!',
                                                        text: 'Data Absensi Karyawan Berhasil Di Hapus',
                                                        icon: 'success',
                                                        customClass: {
                                                            confirmButton: 'btn btn-primary'
                                                        },
                                                        buttonsStyling: false
                                                    }).then(function () {
                                                        window.location.href = window.location.href;
                                                    })
                                                };
                                        </script>";
                                    }else{            
                                        echo "<script type='text/javascript'>
                                        window.onload = function () { Swal.fire({
                                        title: 'Error Code #5355,
                                        text: 'Gagal Hapus Keluarga Karyawan, Hubungi Admin',
                                        icon: 'error',
                                        customClass: {
                                            confirmButton: 'btn btn-primary'
                                        },
                                            buttonsStyling: !1
                                        })};
                                        </script>";
                                    }                                           
                                
                            } else {
                                echo "Data dengan ida = $idab tidak ditemukan di worker_absensi";
                            }
                        }
                        
                    
                        if (isset($_POST['deleteSelected'])) {
                            if (!empty($_POST['data_ids'])) {                                        
                                $data_ids = $_POST['data_ids'];                                               
                                foreach ($data_ids as $ida) {                                
                                    $insertdec = mysqli_query($conn, "
                                        INSERT INTO worker_absensi_del 
                                        (ida, nik, nip, nama, id_job, jobdesk, id_tingkatan, tingkatan, kode_tingkatan, kelompok, ket_kelompok, jenis_absensi, pcm, sm, tgl_absen, add_by, nama_by, via) 
                                        SELECT ida, nik, nip, nama, id_job, jobdesk, id_tingkatan, tingkatan, kode_tingkatan, kelompok, ket_kelompok, jenis_absensi, pcm, sm, tgl_absen, '$iduser', '$namausr', 'via detail Karyawan'
                                        FROM worker_absensi
                                        WHERE ida = '".mysqli_real_escape_string($conn, $ida)."'");
                                    
                                    if ($insertdec) {
                                        $delete = mysqli_query($conn, "DELETE FROM worker_absensi WHERE ida = '".mysqli_real_escape_string($conn, $ida)."'");                                                
                                        if (!$delete) {
                                            echo "<script type='text/javascript'>
                                            window.onload = function () { Swal.fire({
                                            title: 'Error Code #3357,
                                            text: 'Gagal Hapus Keluarga Karyawan, Hubungi Admin',
                                            icon: 'error',
                                            customClass: {
                                                confirmButton: 'btn btn-primary'
                                            },
                                                buttonsStyling: !1
                                            })};
                                            </script>";
                                        }
                                    } else {
                                        echo "<script type='text/javascript'>
                                        window.onload = function () { Swal.fire({
                                        title: 'Error Code #3356,
                                        text: 'Gagal Hapus Keluarga Karyawan, Hubungi Admin',
                                        icon: 'error',
                                        customClass: {
                                            confirmButton: 'btn btn-primary'
                                        },
                                            buttonsStyling: !1
                                        })};
                                        </script>";
                                    }
                                }
                        
                                echo "<script type='text/javascript'>
                                window.onload = function () { Swal.fire({
                                        title: 'Good job!',
                                        text: 'Data Absensi Karyawan Berhasil Di Hapus',
                                        icon: 'success',
                                        customClass: {
                                            confirmButton: 'btn btn-primary'
                                        },
                                        buttonsStyling: false
                                    }).then(function () {
                                        window.location.href = window.location.href;
                                    })
                                };
                                </script>";
                            } else {
                                echo "<script type='text/javascript'>
                                window.onload = function () { Swal.fire({
                                title: 'Error Code #3355,
                                text: 'Gagal Hapus Keluarga Karyawan, Hubungi Admin',
                                icon: 'error',
                                customClass: {
                                    confirmButton: 'btn btn-primary'
                                },
                                    buttonsStyling: !1
                                })};
                                </script>";
                            }
                        }                                
                    ?>
                </div>

                <div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="fullWidthModalLabel">Edit Absensi
                                </h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST">
                                    <input type="hidden" name="ids[]" id="editIds">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Jenis Absensi<span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select" name="jnsabsen" id="jnsabsen" required>
                                                    <option value="">Pilih Jenis</option>
                                                    <option value="I">I</option>
                                                    <option value="S">S</option>
                                                    <option value="A">A</option>
                                                    <option value="CM">CM</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Harus di isi
                                                </div>
                                            </div>
                                        </div>
                                        <div id="getket">
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="editcheck" class="btn btn-primary">EDIT
                                    DATA</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <?php
                if (isset($_POST['editcheck'])) { 
                    if (!empty($_POST['ids'])) {                           
                        $data_ids = $_POST['ids'];
                        $sm =  $_POST['sm'];
                        $pcm =  $_POST['pcm'];
                        $nosurat = $_POST['nosurat'];
                        $ket =  addslashes($_POST['ket']);
                        if (is_array($data_ids)) {
                            $idsArray = explode(',', $data_ids[0]);
                        } else {
                            die("Data tidak valid.");
                        }
                        
                        $jnsabsen = $_POST['jnsabsen'];
                        
                        foreach ($idsArray as $ida) {
                            $update = mysqli_query($conn, "
                                UPDATE worker_absensi 
                                SET jenis_absensi = '".mysqli_real_escape_string($conn, $jnsabsen)."',
                                sm = '".mysqli_real_escape_string($conn, $sm)."',
                                pcm = '".mysqli_real_escape_string($conn, $pcm)."',
                                ket = '".mysqli_real_escape_string($conn, $ket)."',
                                no_surat = '".mysqli_real_escape_string($conn, $nosurat)."'
                                WHERE ida = '".mysqli_real_escape_string($conn, trim($ida))."' 
                            ");
                        
                            if (!$update) {
                                echo "<script type='text/javascript'>
                                window.onload = function () { Swal.fire({
                                    title: 'Error Code #3357',
                                    text: 'Gagal Edit Absensi Karyawan, Hubungi Admin',
                                    icon: 'error',
                                    customClass: {
                                        confirmButton: 'btn btn-primary'
                                    },
                                    buttonsStyling: false
                                })};
                                </script>";
                                break;
                            }
                        }
                        
                        echo "<script type='text/javascript'>
                        window.onload = function () { Swal.fire({
                                title: 'Good job!',
                                text: 'Data Absensi Karyawan Berhasil Di Edit',
                                icon: 'success',
                                customClass: {
                                    confirmButton: 'btn btn-primary'
                                },
                                buttonsStyling: false
                            }).then(function () {
                                window.location.href = window.location.href;
                            })
                        };
                        </script>";                
                    } else {
                        echo "<script type='text/javascript'>
                        window.onload = function () { Swal.fire({
                        title: 'Error Code #3355,
                        text: 'Gagal Hapus Keluarga Karyawan, Hubungi Admin',
                        icon: 'error',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        },
                            buttonsStyling: !1
                        })};
                        </script>";
                    }
                }
                ?>
                <div class="tab-pane <?php if (isset($_GET['dk']) && $_GET['dk'] == '3') echo 'show active'; ?>">
                    <form action="" method="POST">
                        <!-- <button type="submit" name="delMedis" class="btn btn-danger btn-xs"
                            onclick="return confirm('Apakah kamu yakin ingin menghapus data yang terpilih?')">Hapus
                            Terpilih</button>
                        <button type="button" id="editSelectedBtn3" class="btn btn-info btn-xs">Edit
                            Terpilih</button> -->
                        <table class="table table-striped table-bordered dt-responsive nowrap w-100 table-sm">
                            <thead>
                                <tr>
                                    <!-- <th><input type="checkbox" id="checkAll3"></th> -->
                                    <th>Diagnosa</th>
                                    <th>Tempat Rawat</th>
                                    <th>Ket</th>
                                    <th>Status</th>
                                    <th>Faskes</th>
                                    <th>Tanggal Sakit</th>
                                    <th>Act</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $getkel = mysqli_query($conn, "SELECT * FROM worker_medis WHERE nik = '$s[nik]' order by tgl_sakit ASC");                                
                                while ($b = mysqli_fetch_array($getkel)) { ?>
                                <tr>
                                    <!-- <td><input type="checkbox" class="checkItem3" name="data_mds[]" value="<?=$b['id'];?>"> </td> -->
                                    <td><?=$b['diagnosa'];?></td>
                                    <td><?=$b['tempat_rawat'];?></td>
                                    <td><?=$b['ket'];?></td>
                                    <td>
                                        <span class="badge bg-<?php 
                                        if($b['status'] == 'BELUM SEMBUH'){echo "danger";
                                        }else if ($b['status'] == 'EVALUASI'){echo "info";
                                        }else{echo"success";}?>">
                                        <?=$b['status'];?>
                                        </span>
                                    </td>
                                    <td><?=$b['faskes'];?></td>
                                    <td><?=tglIndo($b['tgl_sakit']);?></td>
                                    <td>
                                        <button type="button"
                                            class="btn btn-info btn-xs waves-effect waves-light btnEditMedis"
                                            data-id="<?= $b['id']; ?>"
                                            data-diagnosa="<?= htmlspecialchars($b['diagnosa']); ?>"
                                            data-tempat="<?= htmlspecialchars($b['tempat_rawat']); ?>"
                                            data-faskes="<?= $b['faskes']; ?>"
                                            data-ket="<?= htmlspecialchars($b['ket']); ?>"
                                            data-status="<?= $b['status']; ?>"
                                            data-tanggalsakit="<?= $b['tgl_sakit']; ?>"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editmedis">
                                            <i class="fe-edit"></i>
                                        </button>
                                        <button type="button"
                                        class="btn btn-danger btn-xs waves-effect waves-light btnDelMedis"
                                        data-id="<?=$b['id'];?>"
                                        data-bs-toggle="modal"
                                        data-bs-target="#delmedis">
                                        <i class="fe-trash-2"></i>
                                    </button>

                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </form>                   
                    <div id="delmedis" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content modal-filled bg-danger">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="fas fa-trash-alt h1 text-white"></i>
                    <h4 class="mt-2 text-white">Hapus Data!</h4>
                    <p class="mt-3 text-white">Yakin ingin menghapus data medis ini?</p>
                    <form action="" method="POST">
                        <input type="hidden" name="idper" id="delMedisId" required>
                        <button type="submit" name="delmedis" class="btn btn-dark my-2">YA</button>
                        <button type="button" class="btn btn-light my-2" data-bs-dismiss="modal">TIDAK</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

        <div id="editmedis" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="" method="POST">
                        <div class="modal-header">
                            <h4 class="modal-title" id="fullWidthModalLabel">Update Medis</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="ids[]" id="editIds3">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label">Diagnosa<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="diagnosa" id="editDiagnosa" required>
                                        <div class="invalid-feedback">Harus di isi</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label">Tempat Rawat<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="tempat" id="editTempat" required>
                                        <div class="invalid-feedback">Harus di isi</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label">Faskes<span class="text-danger">*</span></label>
                                        <select class="form-select" name="faskes" id="editFaskes" required>
                                            <option value="">Pilih Faskes</option>
                                            <option value="Y">Y</option>
                                            <option value="N">N</option>
                                        </select>
                                        <div class="invalid-feedback">Harus di isi</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label">Tanggal Sakit<span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="tglsakit" id="edittglsakit" required>
                                        <div class="invalid-feedback">Harus di isi</div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="mb-2">
                                        <label class="form-label">Keterangan</label>
                                        <input type="text" class="form-control" name="ket" id="editKet">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label">Status</label>
                                        <select class="form-select" name="stat" id="editStatus">
                                            <option value="-">Pilih Status</option>
                                            <option value="BELUM SEMBUH">BELUM SEMBUH</option>
                                            <option value="EVALUASI">EVALUASI</option>
                                            <option value="SEMBUH">SEMBUH</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end modal-body -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="editmds" class="btn btn-primary">EDIT DATA</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

            <script>
            document.addEventListener('DOMContentLoaded', function () {
                const editButtons = document.querySelectorAll('.btnEditMedis');

                editButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        // Ambil data dari tombol
                        const id = this.getAttribute('data-id');
                        const diagnosa = this.getAttribute('data-diagnosa');
                        const tempat = this.getAttribute('data-tempat');
                        const faskes = this.getAttribute('data-faskes');
                        const tglsakit = this.getAttribute('data-tanggalsakit');
                        const ket = this.getAttribute('data-ket');
                        const status = this.getAttribute('data-status');

                        // Isi form di modal
                        document.getElementById('editIds3').value = id;
                        document.getElementById('editDiagnosa').value = diagnosa;
                        document.getElementById('editTempat').value = tempat;
                        document.getElementById('editFaskes').value = faskes;
                        document.getElementById('edittglsakit').value = tglsakit;
                        document.getElementById('editKet').value = ket;
                        document.getElementById('editStatus').value = status;
                    });
                });
            });


            document.addEventListener("DOMContentLoaded", function () {
                const delButtons = document.querySelectorAll(".btnDelMedis");
                const delMedisIdInput = document.getElementById("delMedisId");

                delButtons.forEach(function (btn) {
                    btn.addEventListener("click", function () {
                        const id = this.getAttribute("data-id");
                        delMedisIdInput.value = id;
                    });
                });
            });

            </script>
                    <?php                                                            
                        if (isset($_POST['delmedis'])) {
                            $id = mysqli_real_escape_string($conn, $_POST['idper']);
                        
                            $hapus = mysqli_query($conn, "DELETE FROM worker_medis WHERE id = '$id'");
                        
                            if ($hapus) {
                                echo "<script type='text/javascript'>
                                window.onload = function () { Swal.fire({
                                        title: 'Good job!',
                                        text: 'Data Medis Karyawan Berhasil Di Hapus',
                                        icon: 'success',
                                        customClass: {
                                            confirmButton: 'btn btn-primary'
                                        },
                                        buttonsStyling: false
                                    }).then(function () {
                                        window.location.href = window.location.href;
                                    })
                                };
                                </script>";  
                            } else {
                                echo "<script>
                                    alert('Gagal menghapus data medis!');
                                </script>";
                            }
                        }
                        
                        
                    

                    
                        if (isset($_POST['editmds'])) {
                            // Ambil dan sanitasi data dari form
                            $ida      = isset($_POST['ids'][0]) ? trim($_POST['ids'][0]) : '';
                            $diagnosa = mysqli_real_escape_string($conn, $_POST['diagnosa']);
                            $tempat   = mysqli_real_escape_string($conn, $_POST['tempat']);
                            $faskes   = mysqli_real_escape_string($conn, $_POST['faskes']);
                            $tglsakit = mysqli_real_escape_string($conn, $_POST['tglsakit']);
                            $ket      = mysqli_real_escape_string($conn, $_POST['ket']);
                            $stat     = mysqli_real_escape_string($conn, $_POST['stat']);

                            // Validasi ID
                            if (!empty($ida)) {
                                $update = mysqli_query($conn, "
                                    UPDATE worker_medis
                                    SET diagnosa = '$diagnosa',
                                        tempat_rawat = '$tempat',
                                        faskes = '$faskes',
                                        tgl_sakit = '$tglsakit',
                                        ket = '$ket',
                                        status = '$stat'
                                    WHERE id = '".mysqli_real_escape_string($conn, $ida)."'
                                ");

                                if ($update) {
                                    echo "<script type='text/javascript'>
                                                        window.onload = function () { Swal.fire({
                                                                title: 'Good job!',
                                                                text: 'Data Medis Karyawan Berhasil Di Edit',
                                                                icon: 'success',
                                                                customClass: {
                                                                    confirmButton: 'btn btn-primary'
                                                                },
                                                                buttonsStyling: false
                                                            }).then(function () {
                                                                window.location.href = window.location.href;
                                                            })
                                                        };
                                                        </script>";    
                                } else {
                                    echo "<script type='text/javascript'>
                                    window.onload = function () { Swal.fire({
                                        title: 'Error Code #3357',
                                        text: 'Gagal Edit Medis Karyawan, Hubungi Admin',
                                        icon: 'error',
                                        customClass: {
                                            confirmButton: 'btn btn-primary'
                                        },
                                        buttonsStyling: false
                                    })};
                                    </script>";
                                }
                            } else {
                                echo "<script type='text/javascript'>
                                window.onload = function () { Swal.fire({
                                    title: 'Error Code #3356',
                                    text: 'Gagal Edit Medis Karyawan, ID TIDAK DITEMUKAN Hubungi Admin',
                                    icon: 'error',
                                    customClass: {
                                        confirmButton: 'btn btn-primary'
                                    },
                                    buttonsStyling: false
                                })};
                                </script>";
                            }
                        }
                        ?>


                    <!-- <div id="editModal3" class="modal fade" tabindex="-1" role="dialog"
                        aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="fullWidthModalLabel">Update Medis
                                    </h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="POST">
                                        <input type="hidden" name="ids[]" id="editIds3">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-2">
                                                    <label class="form-label">Diagnosa<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="diagnosa" required>
                                                    <div class="invalid-feedback">
                                                        Harus di isi
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-2">
                                                    <label class="form-label">Tempat Rawat<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="tempat" required>
                                                    <div class="invalid-feedback">
                                                        Harus di isi
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-2">
                                                    <label class="form-label">Faskes<span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-select" name="faskes" required>
                                                        <option value="">Pilih Faskes</option>
                                                        <option value="Y">Y</option>
                                                        <option value="N">N</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Harus di isi
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-2">
                                                    <label class="form-label">Keterangan</label>
                                                    <input type="text" class="form-control" name="ket">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-2">
                                                    <label class="form-label">Status</label>
                                                    <select class="form-select" name="stat">
                                                        <option value="-">Pilih Status</option>
                                                        <option value="BELUM SEMBUH">BELUM SEMBUH</option>
                                                        <option value="EVALUASI">EVALUASI</option>
                                                        <option value="SEMBUH">SEMBUH</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="editmds" class="btn btn-primary">EDIT
                                        DATA</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <?php
                            if (isset($_POST['delMedis'])) {     
                                if (!empty($_POST['data_mds'])) {                                        
                                    $data_ids = $_POST['data_mds'];                                               
                                    foreach ($data_ids as $ida) {                                
                                        $insertdec = mysqli_query($conn, "
                                            INSERT INTO worker_medis_del SELECT * FROM worker_medis
                                            WHERE id = '".mysqli_real_escape_string($conn, $ida)."'");
                                        
                                        if ($insertdec) {
                                            $delete = mysqli_query($conn, "DELETE FROM worker_medis WHERE id = '".mysqli_real_escape_string($conn, $ida)."'");                                                
                                            if (!$delete) {
                                                echo "<script type='text/javascript'>
                                                window.onload = function () { Swal.fire({
                                                title: 'Error Code #3357,
                                                text: 'Gagal Hapus Medis Karyawan, Hubungi Admin',
                                                icon: 'error',
                                                customClass: {
                                                    confirmButton: 'btn btn-primary'
                                                },
                                                    buttonsStyling: !1
                                                })};
                                                </script>";
                                            }
                                        } else {
                                            echo "<script type='text/javascript'>
                                            window.onload = function () { Swal.fire({
                                            title: 'Error Code #3356,
                                            text: 'Gagal Hapus Medis Karyawan, Hubungi Admin',
                                            icon: 'error',
                                            customClass: {
                                                confirmButton: 'btn btn-primary'
                                            },
                                                buttonsStyling: !1
                                            })};
                                            </script>";
                                        }
                                    }
                            
                                    echo "<script type='text/javascript'>
                                    window.onload = function () { Swal.fire({
                                            title: 'Good job!',
                                            text: 'Data Medis Karyawan Berhasil Di Hapus',
                                            icon: 'success',
                                            customClass: {
                                                confirmButton: 'btn btn-primary'
                                            },
                                            buttonsStyling: false
                                        }).then(function () {
                                            window.location.href = window.location.href;
                                        })
                                    };
                                    </script>";
                                } else {
                                    echo "<script type='text/javascript'>
                                    window.onload = function () { Swal.fire({
                                    title: 'Error Code #3355,
                                    text: 'Gagal Hapus Medis Karyawan, Hubungi Admin',
                                    icon: 'error',
                                    customClass: {
                                        confirmButton: 'btn btn-primary'
                                    },
                                        buttonsStyling: !1
                                    })};
                                    </script>";
                                }
                            }

                           if (isset($_POST['editmds'])) {
                            if (!empty($_POST['ids'])) {                           
                                $data_ids = $_POST['ids'];
                                $diagnosa =  $_POST['diagnosa'];
                                $tempat =  $_POST['tempat'];
                                $faskes = $_POST['faskes'];
                                $tglsakit = $_POST['tglsakit'];
                                $stat = $_POST['stat'];
                                $ket =  addslashes($_POST['ket']);

                                if (is_array($data_ids)) {
                                    $idsArray = explode(',', $data_ids[0]);
                                } else {
                                    die("Data tidak valid.");
                                }
                                
                                
                                
                                foreach ($idsArray as $ida) {
                                    $update = mysqli_query($conn, "
                                        UPDATE worker_medis
                                        SET diagnosa = '".mysqli_real_escape_string($conn, $diagnosa)."',
                                        tempat_rawat = '".mysqli_real_escape_string($conn, $tempat)."',
                                        faskes = '".mysqli_real_escape_string($conn, $faskes)."',
                                        ket = '".mysqli_real_escape_string($conn, $ket)."',
                                        status = '".mysqli_real_escape_string($conn, $stat)."'
                                        WHERE id = '".mysqli_real_escape_string($conn, trim($ida))."' 
                                    ");
                                
                                    if (!$update) {
                                        echo "<script type='text/javascript'>
                                        window.onload = function () { Swal.fire({
                                            title: 'Error Code #3357',
                                            text: 'Gagal Edit Medis Karyawan, Hubungi Admin',
                                            icon: 'error',
                                            customClass: {
                                                confirmButton: 'btn btn-primary'
                                            },
                                            buttonsStyling: false
                                        })};
                                        </script>";
                                        break;
                                    }
                                }
                                
                                echo "<script type='text/javascript'>
                                window.onload = function () { Swal.fire({
                                        title: 'Good job!',
                                        text: 'Data Medis Karyawan Berhasil Di Edit',
                                        icon: 'success',
                                        customClass: {
                                            confirmButton: 'btn btn-primary'
                                        },
                                        buttonsStyling: false
                                    }).then(function () {
                                        window.location.href = window.location.href;
                                    })
                                };
                                </script>";                
                            } else {
                                echo "<script type='text/javascript'>
                                window.onload = function () { Swal.fire({
                                title: 'Error Code #3355,
                                text: 'Gagal Edis Medis Karyawan, Hubungi Admin',
                                icon: 'error',
                                customClass: {
                                    confirmButton: 'btn btn-primary'
                                },
                                    buttonsStyling: !1
                                })};
                                </script>";
                            }

                           }
                        ?> -->

                    <?php
                        if (isset($_GET['idl'])) {     
                            $codemedis = $_GET['idl'];
                            $insmedis = mysqli_query($conn, "INSERT INTO worker_medis_del SELECT * FROM worker_medis WHERE code_medis = '$codemedis'");                                                               
                            if ($insmedis){
                                mysqli_query($conn, "DELETE FROM worker_medis WHERE code_medis = '$codemedis' "); 

                                echo "<script type='text/javascript'>
                                window.onload = function () { Swal.fire({
                                        title: 'Good job!',
                                        text: 'Data medis berhasil di hapus !!!',
                                        icon: 'success',
                                        customClass: {
                                            confirmButton: 'btn btn-primary'
                                        },
                                        buttonsStyling: false
                                    }).then(function () {
                                        window.history.back();            
                                    })
                                };
                                </script>";       
                            }else{
                                echo "<script type='text/javascript'>
                                window.onload = function () { Swal.fire({
                                    title: 'Error Code #1357',
                                    text: 'Gagal Hapus medis Karyawan, Hubungi Admin',
                                    icon: 'error',
                                    customClass: {
                                        confirmButton: 'btn btn-primary'
                                    },
                                    buttonsStyling: false
                                })};
                                </script>";

                            }

                    
                        }
                    ?>
                </div>


                <div class="tab-pane <?php if (isset($_GET['dk']) && $_GET['dk'] == '5') echo 'show active'; ?>">
                    <table class="table table-striped table-bordered dt-responsive nowrap w-100 table-sm">
                        <thead class="table-danger">
                            <tr>
                                <th>Tanggal Peringatan</th>
                                <th>Ket</th>
                                <th>Level SP</th>
                                <th class="text-center">ACT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $getkel = mysqli_query($conn, "SELECT * FROM worker_peringatan WHERE unix_id = '$s[unix_id]' order by id DESC LIMIT 100");                                
                                while ($b = mysqli_fetch_array($getkel)) { ?>
                            <tr>
                                <td><?=tglindo($b['tgl_peringatan']);?></td>
                                <td><?=$b['ket'];?></td>
                                <td><?=$b['level_sp'];?></td>
                                <td class="text-center">
                                    <!-- <button type="button" data-bs-toggle="modal" data-bs-target="#editper<?=$b['id'];?>"
                                        class="btn btn-info btn-xs waves-effect waves-light"><i
                                            class="fe-edit"></i></button> -->
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#dekper<?=$b['id'];?>"
                                        class="btn btn-danger btn-xs waves-effect waves-light"><i
                                            class="fe-trash-2"></i></button>
                                </td>
                            </tr>

                            <div id="dekper<?=$b['id'];?>" class="modal fade" tabindex="-1" role="dialog"
                                aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content modal-filled bg-danger">
                                        <div class="modal-body p-4">
                                            <div class="text-center">
                                                <i class="fas fa-trash-alt h1 text-white"></i>
                                                <h4 class="mt-2 text-white">Hapus Data!</h4>
                                                <p class="mt-3 text-white">Yakin ingin Menghapus Data
                                                    Peringatan !!!</p>
                                                <form action="" method="POST">
                                                    <input type="hidden" value="<?=$b['id'];?>" class="form-control"
                                                        name="idper" required>
                                                    <button type="submit" name="dekper" class="btn btn-dark my-2"
                                                        data-bs-dismiss="modal">YA</button>
                                                    <button type="button" class="btn btn-light my-2"
                                                        data-bs-dismiss="modal">TIDAK</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->

                            <!-- <div id="editper<?=$b['id'];?>" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="fullWidthModalLabel">Edit Data
                                                Keluarga</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="POST">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <input type="hidden" value="<?=$b['id'];?>"
                                                                class="form-control" name="idkel" required>
                                                            <label class="form-label">Nama Lengkap
                                                                Keluarga<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                value="<?=$b['nama_kel'];?>"
                                                                onBlur="javascript:{this.value = this.value.toUpperCase(); }"
                                                                name="namakel" required>
                                                            <div class="invalid-feedback">
                                                                Harus di isi
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">No. KTP Keluarga
                                                                <span class="text-danger">*</span></label>
                                                            <input type="number" class="form-control"
                                                                placeholder="340**********" name="ktp"
                                                                value="<?=$b['ktp_kel'];?>" required>
                                                            <div class="invalid-feedback">
                                                                Harus di isi
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Status<span
                                                                    class="text-danger">*</span></label>
                                                            <select class="form-select" name="statushub" required>
                                                                <option value="<?=$b['status_kel'];?>">
                                                                    <?=$b['status_kel'];?></option>
                                                                <option value="SUAMI">SUAMI</option>
                                                                <option value="ISTRI">ISTRI</option>
                                                                <option value="ANAK">ANAK</option>
                                                            </select>

                                                            <div class="invalid-feedback">
                                                                Harus di pilih
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Kota Lahir<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="kotalahir"
                                                                value="<?=$b['kota_lahir'];?>" placeholder="KOTA LAHIR"
                                                                required>
                                                            <div class="invalid-feedback">
                                                                Harus di isi
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Tanggal Lahir<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="date" class="form-control" name="tgl_lahir"
                                                                value="<?=$b['tgl_lahir_kel'];?>" required>
                                                            <div class="invalid-feedback">
                                                                Harus di isi
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Alamat<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="alamat"
                                                                value="<?=$b['alamat_kel'];?>" required>
                                                            <div class="invalid-feedback">
                                                                Harus di isi
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="editkel" class="btn btn-primary">EDIT
                                                DATA</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div> -->
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php
if (isset($_POST['dekper'])) {     
    $idper = $_POST['idper'];
    $insmedis = mysqli_query($conn, "INSERT INTO worker_peringatan_del SELECT * FROM worker_peringatan WHERE id = '$idper'");                                                               
    if ($insmedis){
        mysqli_query($conn, "DELETE FROM worker_peringatan WHERE id = '$idper' "); 

        echo "<script type='text/javascript'>
        window.onload = function () { Swal.fire({
                title: 'Good job!',
                text: 'Data peringatan berhasil di hapus !!!',
                icon: 'success',
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            }).then(function () {
                window.history.back();            
            })
        };
        </script>";       
    }else{
        echo "<script type='text/javascript'>
        window.onload = function () { Swal.fire({
            title: 'Error Code #5357',
            text: 'Gagal Hapus Peringatan Karyawan, Hubungi Admin',
            icon: 'error',
            customClass: {
                confirmButton: 'btn btn-primary'
            },
            buttonsStyling: false
        })};
        </script>";

    }


}
?>

<div class="tab-pane <?php if (isset($_GET['dk']) && $_GET['dk'] == '6') echo 'show active'; ?>">
                    <table class="table table-striped table-bordered dt-responsive nowrap w-100 table-sm">
                        <thead class="table-danger">
                            <tr>
                                <th>Tanggal Peringatan</th>
                                <th>Ket</th>                             
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $getkel = mysqli_query($conn, "SELECT * FROM worker_resign WHERE unix_id = '$s[unix_id]' order by id DESC LIMIT 100");                                
                                while ($b = mysqli_fetch_array($getkel)) { ?>
                            <tr>
                                <td><?php echo date('d F Y', strtotime($b["tgl_resign"])); ?></td>
                                <td><?=$b['ket_resign'];?></td>                                                                
                            </tr>

                            
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

<?php } else {
        echo "";
}



?>


<script>
// document.getElementById('checkAll3').onclick = function() {
//     var checkboxes = document.querySelectorAll('.checkItem3');
//     for (var checkbox of checkboxes) {
//         checkbox.checked = this.checked;
//     }
// };

// document.getElementById('editSelectedBtn3').addEventListener('click', function() {
//     const selectedIds = [];
//     const checkboxes = document.querySelectorAll('.checkItem3:checked');

//     checkboxes.forEach(checkbox => {
//         selectedIds.push(checkbox.value);
//     });

//     if (selectedIds.length > 0) {
//         document.getElementById('editIds3').value = selectedIds;
//         $('#editModal3').modal('show');
//     } else {
//         alert('Silakan pilih setidaknya satu data untuk diedit.');
//     }
// });

document.getElementById('checkAll').onclick = function() {
    var checkboxes = document.querySelectorAll('.checkItem');
    for (var checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
};

// Edit Selected Button Handler
document.getElementById('editSelectedBtn').addEventListener('click', function() {
    const selectedIds = [];
    const checkboxes = document.querySelectorAll('.checkItem:checked');

    checkboxes.forEach(checkbox => {
        selectedIds.push(checkbox.value);
    });

    if (selectedIds.length > 0) {
        document.getElementById('editIds').value = selectedIds;
        $('#editModal').modal('show');
    } else {
        alert('Silakan pilih setidaknya satu data untuk diedit.');
    }
    document.querySelectorAll('select[name="jnsabsen"]').forEach(function(select) {
        select.addEventListener('change', function() {
            if (this.value === 'CM') {
                document.getElementById('getket').innerHTML = `
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-1">
                                    <label class="form-label">Keterangan Masuk</label>
                                    <div class="form-check form-switch mt-1">
                                        <input type="hidden" name="sm" value="0">
                                        <input type="checkbox" name="sm" class="form-check-input" id="customSwitch1" value="SM">
                                        <label class="form-check-label" for="customSwitch1">SM (Sudah Masuk)</label>
                                    </div>
                                    <div class="invalid-feedback">Harus di isi</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-1">
                                    <label class="form-label">Perubahan Cuti Melahirkan</label>
                                    <div class="form-check form-switch mt-1">
                                        <input type="hidden" name="pcm" value="0">
                                        <input type="hidden" name="ket" value="">
                                        <input type="checkbox" name="pcm" class="form-check-input" id="customSwitch2" value="PCM">
                                        <label class="form-check-label" for="customSwitch2">PCM</label>
                                    </div>
                                    <div class="invalid-feedback">Harus di isi</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mt-2">
                                    <label class="form-label">No Surat Cuti</label>                                                                
                                    <input type="text" class="form-control" value="<?=$getnosurat;?>" name="nosurat">
                                <div class="invalid-feedback">Harus di isi</div>
                            </div>
                            <div class="col-md-12">
                                <div class="mt-2">
                                    <label class="form-label">Keterangan</label> 
                                    <input type="text" class="form-control" value="<?=$getketerangan;?>" name="ket" id="ket"> 
                                <div class="invalid-feedback">Harus di isi</div>
                            </div>
                        </div>
                        </div>`;
            } else {
                document.getElementById('getket').innerHTML = `
                        <div class="col-md-12">
                            <div class="mb-1">
                                <label class="form-label">Keterangan</label>
                                <input type="hidden" name="sm" value="0">
                                <input type="hidden" name="pcm" value="0">
                                <input type="hidden" name="nosurat" value="">
                                <input type="text" class="form-control" placeholder="" name="ket" id="ket">
                                <div class="invalid-feedback">Harus di isi</div>
                            </div>
                        </div>`;
            }
        });
    });
});
</script>