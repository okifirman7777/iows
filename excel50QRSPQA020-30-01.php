
<?php


include '../config/hwkonek.php';
header('Content-type: application/excel');
$filename = 'report50batang.xls';
header('Content-Disposition: attachment; filename='.$filename);
$filbrand="";
$filkel="";
$filscan="";
if (isset($_GET['f-tiwva01'])) {
    $tglfil = $_GET['f-tiwva01'];
    $tglfrom = $_GET['f-tiwva01'];
    $tglto = $_GET['f-tig-to'];

    // --- MENGHITUNG MINGGU ---
    $minggu_ke = date('W', strtotime($tglfil));

    // $tglfilter = date('Ymd', strtotime($tglfil));   
    $tgljudul = date('d M Y', strtotime($tglfil));  
    $brand= $_GET['s-brand'];
    $kel= $_GET['s-kel'];
    $scan= $_GET['s-scanke'];
    if (isset($_GET['s-brand']) and isset($_GET['s-kel']) and isset($_GET['s-scanke'])) {
    if($brand<>""){
        $filbrand = " and brand='$brand'";
        }else{
            $filbrand = "";
        }
    if($scan<>""){
            $filscan = " and scan_ke='$scan'";
    }else{
            $filscan= "";
    }
    if($kel<>""){
        $filkel = " and group_giling='$kel'";
    }else{
            $filkel= "";
    }
}
} else {
    $tgljudul = date('d-M-Y');
    $tglfilter = date('Ymd');
    $tglfrom = date('Y-m-d');
    $tglto = date('Y-m-d');

    // --- NILAI DEFAULT JIKA TANGGAL KOSONG ---
    $minggu_ke = date('W');
}
?>

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title-center" >Monitoring Berat In Process (Production Cell) <i>
                <div class="page-title-left">
                   
                        <li >Lokasi : TPO NGORO</li>
                        <!-- <li >Minggu Ke : .... </li> -->
                        <li>Minggu Ke : <?php echo $minggu_ke; ?></li>
                        <li >Brand : <?php echo $brand ?></li>
                        <li >Tahun  : <?php echo date('Y', strtotime($tglfil)); ?></li>
                        <li >Kode Report  : QRSPQA020-30-01 (50 Batang)</li>
                       
                  
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="row mb-2">
                    <div class="col-lg-12">
                      
                    </div>
           
                </div>
            <div id="container">
            <div class="table-responsive table-height">
            <table  class="table table-bordered table-striped table-hover table-sticky" border="1">

                    <thead class="thead-light">
                        <tr>
                            <th rowspan="2" class="align-middle" style="width:1%">NO</th>
                            <!-- <th rowspan="2" class="align-middle">Nama (ID)</th> -->
                            <th rowspan="2" class="align-middle text-center" style="width:2%">Kelompok</th>
                            <?php
                            if (isset($_GET['f-tiwva01'])) {
                               $qe1=date_create($_GET['f-tiwva01']);
                               date_add($qe1,date_interval_create_from_date_string("0 days"));
                               $qe1=date_format($qe1,"Y-m-d");
                               $qe2=date_create($_GET['f-tiwva01']);
                               date_add($qe2,date_interval_create_from_date_string("1 days"));
                               $qe2=date_format($qe2,"Y-m-d");
                               $qe3=date_create($_GET['f-tiwva01']);
                               date_add($qe3,date_interval_create_from_date_string("2 days"));
                               $qe3=date_format($qe3,"Y-m-d");
                               $qe4=date_create($_GET['f-tiwva01']);
                               date_add($qe4,date_interval_create_from_date_string("3 days"));
                               $qe4=date_format($qe4,"Y-m-d");
                               $qe5=date_create($_GET['f-tiwva01']);
                               date_add($qe5,date_interval_create_from_date_string("4 days"));
                               $qe5=date_format($qe5,"Y-m-d");
                               $qe6=date_create($_GET['f-tiwva01']);
                               date_add($qe6,date_interval_create_from_date_string("5 days"));
                               $qe6=date_format($qe6,"Y-m-d");
                               $qe7=date_create($_GET['f-tiwva01']);
                               date_add($qe7,date_interval_create_from_date_string("6 days"));
                               $qe7=date_format($qe7,"Y-m-d");
                               
                            }else{
                                $qe1=date_create(date('Y-m-d'));
                                date_add($qe1,date_interval_create_from_date_string("0 days"));
                                $qe1=date_format($qe1,"Y-m-d");
                                $qe2=date_create(date('Y-m-d'));
                                date_add($qe2,date_interval_create_from_date_string("1 days"));
                                $qe2=date_format($qe2,"Y-m-d");
                                $qe3=date_create(date('Y-m-d'));
                                date_add($qe3,date_interval_create_from_date_string("2 days"));
                                $qe3=date_format($qe3,"Y-m-d");
                                $qe4=date_create(date('Y-m-d'));
                                date_add($qe4,date_interval_create_from_date_string("3 days"));
                                $qe4=date_format($qe4,"Y-m-d");
                                $qe5=date_create(date('Y-m-d'));
                                date_add($qe5,date_interval_create_from_date_string("4 days"));
                               $qe5=date_format($qe5,"Y-m-d");
                                $qe6=date_create(date('Y-m-d'));
                                date_add($qe6,date_interval_create_from_date_string("5 days"));
                               $qe6=date_format($qe6,"Y-m-d");
                            }
                             $x = 7; 
                            // for ($x = 1; $x <= 7; $x++) { 
                                ?>
                           
                            <th colspan="6" class="text-center"><?php 
                            $hariIni = new DateTime($qe1);
                            $hariBahasaIndonesia = hariIndo($hariIni->format('l')); 
                            # lokalisasi tidak berpengaruh
                            echo $hariBahasaIndonesia." ".date('d m Y', strtotime($qe1));?></th>
                            <th colspan="6" class="text-center"><?php 
                            $hariIni = new DateTime($qe2);
                            $hariBahasaIndonesia = hariIndo($hariIni->format('l')); 
                            # lokalisasi tidak berpengaruh
                            echo $hariBahasaIndonesia." ".date('d m Y', strtotime($qe2));?></th>
                            <th colspan="6" class="text-center"><?php 
                            $hariIni = new DateTime($qe3);
                            $hariBahasaIndonesia = hariIndo($hariIni->format('l')); 
                            # lokalisasi tidak berpengaruh
                            echo $hariBahasaIndonesia." ".date('d m Y', strtotime($qe3));?></th>
                            <th colspan="6" class="text-center"><?php 
                            $hariIni = new DateTime($qe4);
                            $hariBahasaIndonesia = hariIndo($hariIni->format('l')); 
                            # lokalisasi tidak berpengaruh
                            echo $hariBahasaIndonesia." ".date('d m Y', strtotime($qe4));?></th>
                            <th colspan="6" class="text-center"><?php 
                            $hariIni = new DateTime($qe5);
                            $hariBahasaIndonesia = hariIndo($hariIni->format('l')); 
                            # lokalisasi tidak berpengaruh
                            echo $hariBahasaIndonesia." ".date('d m Y', strtotime($qe5));?></th>
                            <th colspan="6" class="text-center"><?php 
                            $hariIni = new DateTime($qe6);
                            $hariBahasaIndonesia = hariIndo($hariIni->format('l')); 
                            # lokalisasi tidak berpengaruh
                            echo $hariBahasaIndonesia." ".date('d m Y', strtotime($qe6));?></th>
                            <th colspan="6" class="text-center">Total</th>
                         

                          
                        </tr>
                       
                        <tr>
                        <?php
                             $x=1;
                            //  for ($x = 1; $x <= 7; $x++) { ?>
                            <th class="text-center">RB</th>
                            <th class="text-center">SB</th>
                            <th class="text-center">A</th>
                            <th class="text-center">SR</th>
                            <th class="text-center">RR</th>
                            <th class="text-center">Reject</th>
                            <th class="text-center">RB</th>
                            <th class="text-center">SB</th>
                            <th class="text-center">A</th>
                            <th class="text-center">SR</th>
                            <th class="text-center">RR</th>
                            <th class="text-center">Reject</th>
                            <th class="text-center">RB</th>
                            <th class="text-center">SB</th>
                            <th class="text-center">A</th>
                            <th class="text-center">SR</th>
                            <th class="text-center">RR</th>
                            <th class="text-center">Reject</th>
                            <th class="text-center">RB</th>
                            <th class="text-center">SB</th>
                            <th class="text-center">A</th>
                            <th class="text-center">SR</th>
                            <th class="text-center">RR</th>
                            <th class="text-center">Reject</th>
                            <th class="text-center">RB</th>
                            <th class="text-center">SB</th>
                            <th class="text-center">A</th>
                            <th class="text-center">SR</th>
                            <th class="text-center">RR</th>
                            <th class="text-center">Reject</th>
                            <th class="text-center">RB</th>
                            <th class="text-center">SB</th>
                            <th class="text-center">A</th>
                            <th class="text-center">SR</th>
                            <th class="text-center">RR</th>
                            <th class="text-center">Reject</th>
                            <th class="text-center">Total Reject</th>
                          
                         
                        </tr>
                       

                    </thead>
                   
                             
                        <tbody class="table-sm">

                            <?php
                            
                            $hasil_cart = mysqli_query($conn, "SELECT id_giling,nama_giling, nama_timbang, group_giling,
                            count(id_giling) as totproduksi,
                            SUM(qty_afkir) as totafkir,
                            SUM(criteria = 'SB') as sb,
                            SUM(criteria = 'OB') as ob,
                            SUM(criteria = 'N') as cn,
                            SUM(criteria = 'OR') as cor,
                            SUM(criteria = 'SR') as sr,
                            SUM(CASE When criteria='SB' Then qty_afkir Else 0 End ) as asb,
                            SUM(CASE When criteria='OB' Then qty_afkir Else 0 End ) as aob,                            
                            SUM(CASE When criteria='N' Then qty_afkir Else 0 End ) as acn,
                            SUM(CASE When criteria='OR' Then qty_afkir Else 0 End ) as acor,
                            SUM(CASE When criteria='SR' Then qty_afkir Else 0 End ) as asr                      
                            
                            FROM cart_timbang_hasil_acc
                            WHERE DATE(tgl_ditimbang) between  '$tglfrom' and '$tglto'  $filbrand $filkel $filscan
                            GROUP BY group_giling
                            order by group_giling asc");
                                
                            $alltotreject=0;

                            $totRB1=0;
                            $totRB2=0;
                            $totRB3=0;
                            $totRB4=0;
                            $totRB5=0;
                            $totRB6=0;

                            $totSB1=0;
                            $totSB2=0;
                            $totSB3=0;
                            $totSB4=0;
                            $totSB5=0;
                            $totSB6=0;

                            $totA1=0;
                            $totA2=0;
                            $totA3=0;
                            $totA4=0;
                            $totA5=0;
                            $totA6=0;

                            $totSR1=0;
                            $totSR2=0;
                            $totSR3=0;
                            $totSR4=0;
                            $totSR5=0;
                            $totSR6=0;

                            $totRR1=0;
                            $totRR2=0;
                            $totRR3=0;
                            $totRR4=0;
                            $totRR5=0;
                            $totRR6=0;

                            $totreject1=0;
                            $totreject2=0;
                            $totreject3=0;
                            $totreject4=0;
                            $totreject5=0;
                            $totreject6=0;
                            $no = 1;                            
                            while ($p = mysqli_fetch_array($hasil_cart)) {
                                $totreject=0;
                                $totafkir = $p['totafkir'];
                                $totprod = $p['totproduksi'];
                                $crit_sb = $p['sb'];
                                $crit_ob = $p['ob'];
                                $crit_n = $p['cn'];
                                $crit_or = $p['cor'];
                                $crit_sr = $p['sr'];
                                $afk_sb = $p['asb'];
                                $afk_ob = $p['aob'];
                                $afk_n = $p['acn'];
                                $afk_or = $p['acor'];
                                $afk_sr = $p['asr'];
                                $keloop=$p['group_giling'];
                                
                                
                                if ($totprod == "") {
                                    $totprod = 1;
                                }
                                
                            ?>
                                <tr>

                                    <td class="text-center">
                                        <?php echo $no++ ?>
                                    </td>
                                    <!-- <td>
                                    <a href="index.php?f-idgil=<?php echo $p['id_giling'] ?>&f-idgil-form=<?php echo $tglfrom ?>&f-idgil-to=<?php echo $tglto ?>">
                                        <?php echo $p['nama_giling'] ?> (<?php echo $p['id_giling'] ?>)</a>
                                    </td> -->
                                    <td class="text-center">
                                     <?php echo $p['group_giling'] ?>
                                    </td>
                              
                                    <!-- 1 -->
                                    <?php
                            
                            $hasil_cart1 = mysqli_query($conn, "SELECT id_giling,nama_giling, nama_timbang, group_giling,
                            count(id_giling) as totproduksi,
                            SUM(qty_afkir) as totafkir,
                            SUM(criteria = 'SB') as sb,
                            SUM(criteria = 'OB') as ob,
                            SUM(criteria = 'N') as cn,
                            SUM(criteria = 'OR') as cor,
                            SUM(criteria = 'SR') as sr,
                            SUM(CASE When criteria='SB' Then qty_afkir Else 0 End ) as asb,
                            SUM(CASE When criteria='OB' Then qty_afkir Else 0 End ) as aob,                            
                            SUM(CASE When criteria='N' Then qty_batang Else 0 End ) as acn,
                            SUM(CASE When criteria='OR' Then qty_afkir Else 0 End ) as acor,
                            SUM(CASE When criteria='SR' Then qty_afkir Else 0 End ) as asr                      
                            
                            FROM cart_timbang_hasil_acc
                            WHERE DATE(tgl_ditimbang) = '$qe1'  $filbrand and group_giling='$keloop'
                            GROUP BY group_giling
                            order by group_giling asc");


                            $no1 = 1;   
                            $afk_sb1 = "0";
                            $afk_ob1 = "0";
                            $afk_n1 = "0";
                            $afk_or1 = "0";
                            $afk_sr1 = "0"; 
                            $totafkir1 = "0";                        
                            while ($p1 = mysqli_fetch_array($hasil_cart1)) {
                                $totafkir1 = $p1['totafkir'];
                                $totprod1 = $p1['totproduksi'];
                                $crit_sb1 = $p1['sb'];
                                $crit_ob1= $p1['ob'];
                                $crit_n1 = $p1['cn'];
                                $crit_or1 = $p1['cor'];
                                $crit_sr1 = $p1['sr'];
                                $afk_sb1 = $p1['asb'];
                                $afk_ob1 = $p1['aob'];
                                $afk_n1 = $p1['acn'];
                                $afk_or1 = $p1['acor'];
                                $afk_sr1 = $p1['asr'];


                                
                                if ($totprod1 == "") {
                                    $totprod1 = 1;
                                }
                                
                                
                            ?>
                             <?php } ?>
                                    <td class="text-center">
                                        <?php echo $afk_sb1 ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $afk_ob1 ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $afk_n1 ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $afk_or1 ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $afk_sr1 ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $totafkir1 ?>
                                    </td>
                               
                                    <!-- 2 -->
                                    <?php
                             $afk_sb2 = "0";
                             $afk_ob2 = "0";
                             $afk_n2 = "0";
                             $afk_or2 = "0";
                             $afk_sr2 = "0"; 
                             $totafkir2 = "0"; 
                            $hasil_cart2 = mysqli_query($conn, "SELECT id_giling,nama_giling, nama_timbang, group_giling,
                            count(id_giling) as totproduksi,
                            SUM(qty_afkir) as totafkir,
                            SUM(criteria = 'SB') as sb,
                            SUM(criteria = 'OB') as ob,
                            SUM(criteria = 'N') as cn,
                            SUM(criteria = 'OR') as cor,
                            SUM(criteria = 'SR') as sr,
                            SUM(CASE When criteria='SB' Then qty_afkir Else 0 End ) as asb,
                            SUM(CASE When criteria='OB' Then qty_afkir Else 0 End ) as aob,                            
                            SUM(CASE When criteria='N' Then qty_batang Else 0 End ) as acn,
                            SUM(CASE When criteria='OR' Then qty_afkir Else 0 End ) as acor,
                            SUM(CASE When criteria='SR' Then qty_afkir Else 0 End ) as asr                      
                            
                            FROM cart_timbang_hasil_acc
                            WHERE DATE(tgl_ditimbang) = '$qe2'  $filbrand and group_giling='$keloop'
                            GROUP BY group_giling
                            order by group_giling asc");


                            $no1 = 1;                            
                            while ($p2 = mysqli_fetch_array($hasil_cart2)) {
                                $totafkir2 = $p2['totafkir'];
                                $totprod2 = $p2['totproduksi'];
                                $crit_sb2 = $p2['sb'];
                                $crit_ob2= $p2['ob'];
                                $crit_n2 = $p2['cn'];
                                $crit_or2 = $p2['cor'];
                                $crit_sr2 = $p2['sr'];
                                $afk_sb2 = $p2['asb'];
                                $afk_ob2 = $p2['aob'];
                                $afk_n2 = $p2['acn'];
                                $afk_or2 = $p2['acor'];
                                $afk_sr2 = $p2['asr'];


                                
                                if ($totprod2 == "") {
                                    $totprod2 = 1;
                                }
                                
                            ?>
                             <?php } ?>
                                    <td class="text-center">
                                        <?php echo $afk_sb2 ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $afk_ob2 ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $afk_n2 ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $afk_or2 ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $afk_sr2 ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $totafkir2 ?>
                                    </td>
                               
                                    <!-- 3 -->
                                    <?php
                              $afk_sb3 = "0";
                              $afk_ob3 = "0";
                              $afk_n3 = "0";
                              $afk_or3 = "0";
                              $afk_sr3 = "0"; 
                              $totafkir3 = "0"; 
                            $hasil_cart3 = mysqli_query($conn, "SELECT id_giling,nama_giling, nama_timbang, group_giling,
                            count(id_giling) as totproduksi,
                            SUM(qty_afkir) as totafkir,
                            SUM(criteria = 'SB') as sb,
                            SUM(criteria = 'OB') as ob,
                            SUM(criteria = 'N') as cn,
                            SUM(criteria = 'OR') as cor,
                            SUM(criteria = 'SR') as sr,
                            SUM(CASE When criteria='SB' Then qty_afkir Else 0 End ) as asb,
                            SUM(CASE When criteria='OB' Then qty_afkir Else 0 End ) as aob,                            
                            SUM(CASE When criteria='N' Then qty_batang Else 0 End ) as acn,
                            SUM(CASE When criteria='OR' Then qty_afkir Else 0 End ) as acor,
                            SUM(CASE When criteria='SR' Then qty_afkir Else 0 End ) as asr                      
                            
                            FROM cart_timbang_hasil_acc
                            WHERE DATE(tgl_ditimbang) = '$qe3'  $filbrand and group_giling='$keloop'
                            GROUP BY group_giling
                            order by group_giling asc");


                            $no1 = 1;                            
                            while ($p3 = mysqli_fetch_array($hasil_cart3)) {
                                $totafkir3 = $p3['totafkir'];
                                $totprod3 = $p3['totproduksi'];
                                $crit_sb3 = $p3['sb'];
                                $crit_ob3= $p3['ob'];
                                $crit_n3 = $p3['cn'];
                                $crit_or3 = $p3['cor'];
                                $crit_sr3 = $p3['sr'];
                                $afk_sb3 = $p3['asb'];
                                $afk_ob3 = $p3['aob'];
                                $afk_n3 = $p3['acn'];
                                $afk_or3 = $p3['acor'];
                                $afk_sr3 = $p3['asr'];


                                
                                if ($totprod3 == "") {
                                    $totprod3 = 1;
                                }
                                
                            ?>
                             <?php } ?>
                                    <td class="text-center">
                                        <?php echo $afk_sb3 ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $afk_ob3 ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $afk_n3 ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $afk_or3 ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $afk_sr3 ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $totafkir3 ?>
                                    </td>
                               
                                    <!-- 4 -->
                                    <?php
                              $afk_sb4 = "0";
                              $afk_ob4 = "0";
                              $afk_n4 = "0";
                              $afk_or4 = "0";
                              $afk_sr4 = "0"; 
                              $totafkir4 = "0"; 
                            $hasil_cart4 = mysqli_query($conn, "SELECT id_giling,nama_giling, nama_timbang, group_giling,
                            count(id_giling) as totproduksi,
                            SUM(qty_afkir) as totafkir,
                            SUM(criteria = 'SB') as sb,
                            SUM(criteria = 'OB') as ob,
                            SUM(criteria = 'N') as cn,
                            SUM(criteria = 'OR') as cor,
                            SUM(criteria = 'SR') as sr,
                            SUM(CASE When criteria='SB' Then qty_afkir Else 0 End ) as asb,
                            SUM(CASE When criteria='OB' Then qty_afkir Else 0 End ) as aob,                            
                            SUM(CASE When criteria='N' Then qty_batang Else 0 End ) as acn,
                            SUM(CASE When criteria='OR' Then qty_afkir Else 0 End ) as acor,
                            SUM(CASE When criteria='SR' Then qty_afkir Else 0 End ) as asr                      
                            
                            FROM cart_timbang_hasil_acc
                            WHERE DATE(tgl_ditimbang) = '$qe4'  $filbrand and group_giling='$keloop'
                            GROUP BY group_giling
                            order by group_giling asc");


                            $no1 = 1;                            
                            while ($p4 = mysqli_fetch_array($hasil_cart4)) {
                                $totafkir4 = $p4['totafkir'];
                                $totprod4 = $p4['totproduksi'];
                                $crit_sb4 = $p4['sb'];
                                $crit_ob4= $p4['ob'];
                                $crit_n4 = $p4['cn'];
                                $crit_or4 = $p4['cor'];
                                $crit_sr4 = $p4['sr'];
                                $afk_sb4 = $p4['asb'];
                                $afk_ob4 = $p4['aob'];
                                $afk_n4 = $p4['acn'];
                                $afk_or4 = $p4['acor'];
                                $afk_sr4 = $p4['asr'];


                                
                                if ($totprod4 == "") {
                                    $totprod4 = 1;
                                }
                                
                            ?>
                              <?php } ?>
                                    <td class="text-center">
                                        <?php echo $afk_sb4 ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $afk_ob4 ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $afk_n4 ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $afk_or4 ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $afk_sr4 ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $totafkir4 ?>
                                    </td>
                              
                                    <!-- 5 -->
                                    <?php
                             $afk_sb5 = "0";
                             $afk_ob5 = "0";
                             $afk_n5 = "0";
                             $afk_or5 = "0";
                             $afk_sr5 = "0"; 
                             $totafkir5 = "0"; 
                            $hasil_cart5 = mysqli_query($conn, "SELECT id_giling,nama_giling, nama_timbang, group_giling,
                            count(id_giling) as totproduksi,
                            SUM(qty_afkir) as totafkir,
                            SUM(criteria = 'SB') as sb,
                            SUM(criteria = 'OB') as ob,
                            SUM(criteria = 'N') as cn,
                            SUM(criteria = 'OR') as cor,
                            SUM(criteria = 'SR') as sr,
                            SUM(CASE When criteria='SB' Then qty_afkir Else 0 End ) as asb,
                            SUM(CASE When criteria='OB' Then qty_afkir Else 0 End ) as aob,                            
                            SUM(CASE When criteria='N' Then qty_batang Else 0 End ) as acn,
                            SUM(CASE When criteria='OR' Then qty_afkir Else 0 End ) as acor,
                            SUM(CASE When criteria='SR' Then qty_afkir Else 0 End ) as asr                      
                            
                            FROM cart_timbang_hasil_acc
                            WHERE DATE(tgl_ditimbang) = '$qe5'  $filbrand and group_giling='$keloop'
                            GROUP BY group_giling
                            order by group_giling asc");


                            $no1 = 1;                            
                            while ($p5 = mysqli_fetch_array($hasil_cart5)) {
                                $totafkir5 = $p5['totafkir'];
                                $totprod5 = $p5['totproduksi'];
                                $crit_sb5 = $p5['sb'];
                                $crit_ob5= $p5['ob'];
                                $crit_n5 = $p5['cn'];
                                $crit_or5 = $p5['cor'];
                                $crit_sr5 = $p5['sr'];
                                $afk_sb5 = $p5['asb'];
                                $afk_ob5 = $p5['aob'];
                                $afk_n5 = $p5['acn'];
                                $afk_or5 = $p5['acor'];
                                $afk_sr5 = $p5['asr'];


                                
                                if ($totprod5 == "") {
                                    $totprod5 = 1;
                                }
                                
                            ?>
                             <?php } ?>
                                    <td class="text-center">
                                        <?php echo $afk_sb5 ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $afk_ob5 ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $afk_n5 ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $afk_or5 ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $afk_sr5 ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $totafkir5 ?>
                                    </td>
                               
                                    <!-- 6 -->
                                    <?php
                             $afk_sb6 = "0";
                             $afk_ob6 = "0";
                             $afk_n6 = "0";
                             $afk_or6 = "0";
                             $afk_sr6 = "0"; 
                             $totafkir6 = "0"; 
                            $hasil_cart6 = mysqli_query($conn, "SELECT id_giling,nama_giling, nama_timbang, group_giling,
                            count(id_giling) as totproduksi,
                            SUM(qty_afkir) as totafkir,
                            SUM(criteria = 'SB') as sb,
                            SUM(criteria = 'OB') as ob,
                            SUM(criteria = 'N') as cn,
                            SUM(criteria = 'OR') as cor,
                            SUM(criteria = 'SR') as sr,
                            SUM(CASE When criteria='SB' Then qty_afkir Else 0 End ) as asb,
                            SUM(CASE When criteria='OB' Then qty_afkir Else 0 End ) as aob,                            
                            SUM(CASE When criteria='N' Then qty_batang Else 0 End ) as acn,
                            SUM(CASE When criteria='OR' Then qty_afkir Else 0 End ) as acor,
                            SUM(CASE When criteria='SR' Then qty_afkir Else 0 End ) as asr                      
                            
                            FROM cart_timbang_hasil_acc
                            WHERE DATE(tgl_ditimbang) = '$qe6'  $filbrand and group_giling='$keloop'
                            GROUP BY group_giling
                            order by group_giling asc");


                            $no1 = 1;                            
                            while ($p6 = mysqli_fetch_array($hasil_cart6)) {
                                $totafkir6 = $p6['totafkir'];
                                $totprod6 = $p6['totproduksi'];
                                $crit_sb6 = $p6['sb'];
                                $crit_ob6= $p6['ob'];
                                $crit_n6 = $p6['cn'];
                                $crit_or6 = $p6['cor'];
                                $crit_sr6 = $p6['sr'];
                                $afk_sb6 = $p6['asb'];
                                $afk_ob6 = $p6['aob'];
                                $afk_n6 = $p6['acn'];
                                $afk_or6 = $p6['acor'];
                                $afk_sr6 = $p6['asr'];


                                
                                if ($totprod6 == "") {
                                    $totprod6 = 1;
                                }
                                
                            ?>
                             <?php } ?>
                                    <td class="text-center">
                                        <?php echo $afk_sb6 ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $afk_ob6 ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $afk_n6 ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $afk_or6 ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $afk_sr6 ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $totafkir6 ?>
                                    </td>
                                    <?php 


                                $totRB1=$totRB1+$afk_sb1;
                                $totRB2=$totRB2+$afk_sb2;
                                $totRB3=$totRB3+$afk_sb3;
                                $totRB4=$totRB4+$afk_sb4;
                                $totRB5=$totRB5+$afk_sb5;
                                $totRB6=$totRB6+$afk_sb6;

                                $totSB1=$totSB1+$afk_ob1;
                                $totSB2=$totSB2+$afk_ob2;
                                $totSB3=$totSB3+$afk_ob3;
                                $totSB4=$totSB4+$afk_ob4;
                                $totSB5=$totSB5+$afk_ob5;
                                $totSB6=$totSB6+$afk_ob6;

                                 $totA1=$totA1+$afk_n1;
                                 $totA2=$totA2+$afk_n2;
                                 $totA3=$totA3+$afk_n3;
                                 $totA4=$totA4+$afk_n4;
                                 $totA5=$totA5+$afk_n5;
                                 $totA6=$totA6+$afk_n6;

                             $totSR1=$totSR1+$afk_or1;
                             $totSR2=$totSR2+$afk_or2;
                             $totSR3=$totSR3+$afk_or3;
                             $totSR4=$totSR4+$afk_or4;
                             $totSR5=$totSR5+$afk_or5;
                             $totSR6=$totSR6+$afk_or6;

                            $totRR1=$totRR1+$afk_sr1;
                            $totRR2=$totRR2+$afk_sr2;
                            $totRR3=$totRR3+$afk_sr3;
                            $totRR4=$totRR4+$afk_sr4;
                            $totRR5=$totRR5+$afk_sr5;
                            $totRR6=$totRR6+$afk_sr6;

                            $totreject1=$totreject1+$totafkir1;
                            $totreject2=$totreject2+$totafkir2;
                            $totreject3=$totreject3+$totafkir3;
                            $totreject4=$totreject4+$totafkir4;
                            $totreject5=$totreject5+$totafkir5;
                            $totreject6=$totreject6+$totafkir6;

                            $totreject=$totreject+$totafkir1+$totafkir2+$totafkir3+$totafkir4+$totafkir5+$totafkir6;
                          ?>
                                    <td class="text-center">
                                        <?php echo $totreject ?>
                                    </td>  
                                </tr>
                            <?php 
                            $alltotreject=$alltotreject+$totafkir1+$totafkir2+$totafkir3+$totafkir4+$totafkir5+$totafkir6;
                        }  ?>
                        </tbody>
                        <tfooter class="tfoot-light">
                      
                        <tr>
                        <th class="text-center">Grand Total</th>
                            <th class="text-center"></th>
                        <th class="text-center"><?php echo $totRB1 ?></th>
                            <th class="text-center"><?php echo $totSB1 ?></th>
                            <th class="text-center"><?php echo $totA1 ?></th>
                            <th class="text-center"><?php echo $totSR1 ?></th>
                            <th class="text-center"><?php echo $totRR1 ?></th>
                            <th class="text-center"><?php echo $totreject1 ?></th>
                            <th class="text-center"><?php echo $totRB2 ?></th>
                            <th class="text-center"><?php echo $totSB2 ?></th>
                            <th class="text-center"><?php echo $totA2 ?></th>
                            <th class="text-center"><?php echo $totSR2 ?></th>
                            <th class="text-center"><?php echo $totRR2 ?></th>
                            <th class="text-center"><?php echo $totreject2 ?></th>
                            <th class="text-center"><?php echo $totRB3 ?></th>
                            <th class="text-center"><?php echo $totSB3 ?></th>
                            <th class="text-center"><?php echo $totA3 ?></th>
                            <th class="text-center"><?php echo $totSR3 ?></th>
                            <th class="text-center"><?php echo $totRR3 ?></th>
                            <th class="text-center"><?php echo $totreject3 ?></th>
                            <th class="text-center"><?php echo $totRB4 ?></th>
                            <th class="text-center"><?php echo $totSB4 ?></th>
                            <th class="text-center"><?php echo $totA4 ?></th>
                            <th class="text-center"><?php echo $totSR4 ?></th>
                            <th class="text-center"><?php echo $totRR4 ?></th>
                            <th class="text-center"><?php echo $totreject4 ?></th>
                            <th class="text-center"><?php echo $totRB5 ?></th>
                            <th class="text-center"><?php echo $totSB5 ?></th>
                            <th class="text-center"><?php echo $totA5 ?></th>
                            <th class="text-center"><?php echo $totSR5 ?></th>
                            <th class="text-center"><?php echo $totRR5 ?></th>
                            <th class="text-center"><?php echo $totreject5 ?></th>
                            <th class="text-center"><?php echo $totRB1 ?></th>
                            <th class="text-center"><?php echo $totSB6 ?></th>
                            <th class="text-center"><?php echo $totA6 ?></th>
                            <th class="text-center"><?php echo $totSR6 ?></th>
                            <th class="text-center"><?php echo $totRR6 ?></th>
                            <th class="text-center"><?php echo $totreject6 ?></th>
                            <th class="text-center"> <?php echo $alltotreject ?></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                            </div>
            </div>
        </div><!-- end col -->
    </div><!-- end row -->
</div> <!-- container -->
<div class="row">
        <div class="col-12">
            
                <h5 class="page-title-center" >Remark <i>
                
                   
                <h6 > RR : Reject Ringan <br>
                        SR : Select Ringan <br>
                        A : Accept <br>
                        SB : Select Berat<br>
                        RB : Reject Berat <br>
                        Kriteria berat mengacu pada PLM  <br>
                        (-) : tanda (-) dilakukan namun tidak ada temuan <br>
                        (N/A) : tanda (N/A) tidak ada proses pengecekan (proses berhenti)<br>
                        </i>    
                  
                </div>
         
        </div>
    </div>
<?php

function hariIndo ($hariInggris) {
  switch ($hariInggris) {
    case 'Sunday':
      return 'Minggu';
    case 'Monday':
      return 'Senin';
    case 'Tuesday':
      return 'Selasa';
    case 'Wednesday':
      return 'Rabu';
    case 'Thursday':
      return 'Kamis';
    case 'Friday':
      return 'Jumat';
    case 'Saturday':
      return 'Sabtu';
    default:
      return 'hari tidak valid';
  }
}