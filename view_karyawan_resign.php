<?php
    $getkar = mysqli_query($conn, "SELECT *,COUNT(*) as cekrow FROM worker_resign WHERE unix_id = '$_GET[id]'");
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
                        <!-- <div class="row"> -->

                            <!-- <div class="col-md-12 text-end"> -->
                                <!-- <button type="button" data-bs-toggle="modal" data-bs-target="#peringatan"
                                    class="btn btn-dark text-white fw-bold btn-xs waves-effect mb-1 waves-light"><i
                                        class="fe-alert-circle"></i> PERINGATAN</button> -->

                                <!-- <button type="button" data-bs-toggle="modal" data-bs-target="#editmulti"
                                    data-id="<-?=$s_id_worker?>"
                                    class="btn btn-primary text-white fw-bold btn-xs waves-effect mb-1 waves-light edit-multi-btn"                                    >
                                    <i class="fe-edit"></i> MULTI
                                </button>

                                <button type="button" data-bs-toggle="modal" data-bs-target="#modalmutasi"
                                    class="btn btn-warning text-white fw-bold btn-xs waves-effect mb-1 waves-light"><i
                                        class="fe-repeat"></i> MUTASI</button>
                                <a href="?ad=ad&id=<-?=$_GET['id'];?>" type="button"
                                    class="btn btn-info btn-xs waves-effect mb-1 waves-light fw-bold"><i
                                        class="mdi mdi-file-document-edit-outline"></i> EDIT</a> -->
                            <!-- </div> -->
                        <!-- </div> -->

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
                                                            .value); // Checklist sesuai data
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

                        <!-- <div id="modalmutasi" class="modal fade" tabindex="-1" role="dialog"
                            aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="fullWidthModalLabel">MUTASI <-?=$s['nama'];?>
                                            (<-?=$s['nip'];?>)</h4>
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
                                                            <-?php
                                                                    $getbag = mysqli_query($conn, "SELECT * FROM jobdesk order by grup ASC") or die(mysqli_error());
                                                                            while ($g = mysqli_fetch_array($getbag)) {
                                                                ?>
                                                            <option value="<-?php echo $g['idj'] ?>">
                                                                <-?php echo $g['nama_job'] ?>
                                                            </option>
                                                            <-?php } ?>
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
                        </div> -->

                        <!-- <-?php
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
                            ?> -->
                            
                        <!-- Batas atas Nama Karyawan -->
                        <div class="row border rounded  mt-2 pt-3">
                            <h5 class="text-uppercase border-bottom pb-2"><i class="mdi mdi-account me-1"></i>
                                <?=$s['nama'];?></h5>
                            
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
                                        <!-- <div class="m-2 mb-0 text-end">
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
                                        </div> -->
                                        <!-- <div id="gtfilesToUpload1"> -->
                                        <!-- </div> -->
                                            
                                            <div id="fotoResignTetap" class="text-center">
                                                <?php 
                                                // Menghasilkan alamat otomatis: http://localhost/personalia/
                                                $base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . "/personalia/";
                                                
                                                if(!empty($s_foto)): ?>
                                                    <img src="<?php echo $base_url . $s_foto; ?>" alt="Foto Karyawan" class="img-fluid rounded" style="max-width: 150px; height: auto;">
                                                <?php else: ?>
                                                    <img src="<?php echo $base_url; ?>assets/images/default.jpg" alt="No Photo" class="img-fluid rounded" style="max-width: 150px; height: auto;">
                                                <?php endif; ?>
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

                            <!-- <div>
                                <h5 class="text-uppercase border-bottom pb-2">DATA PERSONALIA</h5>
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
                                <h5 class="text-uppercase border-bottom pb-2 pt-2">DATA PRIBADI</h5>
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
                            </div> -->

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <!-- <ul class="nav nav-pills nav-fill navtab-bg">
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
                        </ul> -->
                <div class="tab-content">
                <div>
                                <h5 class="text-uppercase border-bottom pb-2">DATA PERSONALIA</h5>
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
                                    <div class="data-label">Tanggal Resign</div>
                                    <div class="data-value">:
                                        <strong><?php echo date('d F Y', strtotime($s["tgl_resign"])); ?></strong>
                                        
                                    </div>
                                </div>
                                <div class="data-row">
                                    <div class="data-label">Masa Kerja</div>
                                    <div class="data-value">:                                        
                                    <strong>
                                    <!-- kode lama  menghitung masa kerja  --> 
                                    <!--?php echo durasiKerjaResign($s['tgl_resmi'], $s['tgl_resign']); ?-->

                                    <!-- kode baru menghitung masa kerja -->
                                        <?php 
                                    // Menggunakan tgl_masuk jika tgl_resmi kosong
                                    $tgl_awal = !empty($s['tgl_resmi']) && $s['tgl_resmi'] != '-' ? $s['tgl_resmi'] : $s['tgl_masuk'];

                                    $date_awal = new DateTime($tgl_awal);
                                    $date_resign = new DateTime($s['tgl_resign']);

                                    // Hitung selisih secara otomatis dan akurat
                                    $diff = $date_awal->diff($date_resign);

                                    echo $diff->y . " tahun, " . $diff->m . " bulan, " . $diff->d . " hari";
                                    ?>

                                    </strong>
                                    </div>
                                </div>
                                <div class="data-row">
                                    <div class="data-label">Alasan Resign</div>
                                    <div class="data-value">: <strong><?= $s['ket_resign']; ?></strong></div>
                                </div>
                                <h5 class="text-uppercase border-bottom pb-2 pt-2">DATA PRIBADI</h5>
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
</div>
</div>
</div>
</div>

<?php } else {
        echo "";
}



?>


<script>
document.getElementById('checkAll3').onclick = function() {
    var checkboxes = document.querySelectorAll('.checkItem3');
    for (var checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
};

document.getElementById('editSelectedBtn3').addEventListener('click', function() {
    const selectedIds = [];
    const checkboxes = document.querySelectorAll('.checkItem3:checked');

    checkboxes.forEach(checkbox => {
        selectedIds.push(checkbox.value);
    });

    if (selectedIds.length > 0) {
        document.getElementById('editIds3').value = selectedIds;
        $('#editModal3').modal('show');
    } else {
        alert('Silakan pilih setidaknya satu data untuk diedit.');
    }
});

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
                                        <label class="form-check-label" for="customSwitch1">Sudah Masuk</label>
                                    </div>
                                    <div class="invalid-feedback">Harus di isi</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-1">
                                    <label class="form-label">Keterangan Lahir</label>
                                    <div class="form-check form-switch mt-1">
                                        <input type="hidden" name="pcm" value="0">
                                        <input type="hidden" name="ket" value="">
                                        <input type="checkbox" name="pcm" class="form-check-input" id="customSwitch2" value="PCM">
                                        <label class="form-check-label" for="customSwitch2">Sudah Lahir</label>
                                    </div>
                                    <div class="invalid-feedback">Harus di isi</div>
                                </div>
                            </div>
                              <div class="col-md-12">
                            <div class="mt-2">
                                <label class="form-label">No Surat Cuti</label>                                                                
                                <input type="text" class="form-control" placeholder="" name="nosurat">
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