
<?php
$filbrand="";
$filkel="";
$filscan="";
$filmix="";
if (isset($_GET['f-tiwva02'])) {
    $tglfil = $_GET['f-tiwva02'];
    $tglfrom = $_GET['f-tiwva02'];
    $tglto = $_GET['f-tig-to'];

    // $tglfilter = date('Ymd', strtotime($tglfil));   
    $tgljudul = date('d M Y', strtotime($tglfil));  
    $brand= $_GET['s-brand'];
    $mix= $_GET['s-mix'];
    $kel= $_GET['s-kel'];
    $scan= $_GET['s-scanke'];
    if (isset($_GET['s-brand']) and isset($_GET['s-kel']) and isset($_GET['s-scanke'])) {
    if($brand<>""){
        $filbrand = " and b.brand='$brand'";
        }else{
            $filbrand = "";
        }
    if($scan<>""){
            $filscan = " and b.scan_ke='$scan'";
    }else{
            $filscan= "";
    }
    if($kel<>""){
        $filkel = " and b.group_giling='$kel'";
    }else{
            $filkel= "and b.group_giling='90'";
    }
    if($mix<>""){
        $filmix = " and b.mix='$mix'";
    }else{
        $filmix= "";
    }
}
} else {
    $tgljudul = date('d-M-Y');
    $tglfilter = date('Ymd');
    $tglfrom = date('Y-m-d');
    $tglto = date('Y-m-d');
     $filkel= "and b.group_giling='90'";
}
?>

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dasbor</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">QRSPQA020-30-01</a></li>
                        <!-- <li class="breadcrumb-item active">Transport List</li> -->
                    </ol>
                </div>
                <h4 class="page-title">Monitoring Berat In Process (Production Cell) 10 Batang/ <i
                        class="mdi mdi-calendar-month mr-1"></i><?php echo $tgljudul; ?></h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="row mb-2">
                    <div class="col-lg-12">
                        <div class="form-inline">
                            <form action="" method="GET" class="form-inline">
                                
                            <div class="form-group">
                                <select class="form-control mr-2"  name="s-kel" id="s-kel" onchange="brandchange(this.value)" required="">
                                    <option value="">KELOMPOK</option>
                                    <?php
                                $gr = mysqli_query($conn, "SELECT * FROM tools_prg WHERE nama_tool = 'JUMLAH GROUP WORKER' and brand='$brandhome'");     
                                $g = mysqli_fetch_array($gr);
                                for ($x = 1; $x <= $g['value_tool']; $x++) {?>
                           
                                    <option value="<?php echo $x?>"><?php echo $x?></option>
                                    <?php } ?>
                                        
                                    </select>
                                    
                                </div>
                                <div class="form-group">
                                <select class="form-control mr-2"  name="s-scanke" id="s-scanke" onchange="brandchange(this.value)">
                                    <option value="">SCAN KE</option>
                                    <?php
                             
                                for ($x = 1; $x <= 9; $x++) {?>
                           
                                    <option value="<?php echo $x?>"><?php echo $x?></option>
                                    <?php } ?>
                                        
                                    </select>
                                    
                                </div>
                           
                                <div class="form-group mr-2">
                                    <input class="form-control" id="example-date" type="date" name="f-tiwva02" oninvalid="this.setCustomValidity('pilih tanggal dulu')" oninput="setCustomValidity('')" required>
                                </div>
                                <div class="form-group ml-1 mr-2">
                                    <input class="form-control" id="example-date" type="date" name="f-tig-to"
                                        oninvalid="this.setCustomValidity('pilih tanggal dulu')"
                                        oninput="setCustomValidity('')" required>
                                </div>
                                
                                <div class="form-group">
                                <select class="form-control mr-2"  name="s-brand" id="s-brand" onchange="brandchange(this.value)" required> 
								 <option value="">PILIH BRAND</option>
								 <?php 
                                        $qp1 = mysqli_query($conn, "SELECT  * FROM brand ");
                                                                  
                                         while ($dp1 = mysqli_fetch_array($qp1)) {
                                           $brand = $dp1['kodebrand'];
										   $nmbrand = $dp1['namabrand']; 
										    ?>
                                           <option value="<?php echo $brand ?>" <?php if($brand==$brandhome) {echo "selected";}  ?>><?php echo $nmbrand ?></option>
											
                                        <?php }
                                       
                                       ?>
                                   
                                    </select>
                                    
                                </div>
                                <div class="form-group">
                                <select class="form-control mr-2"  name="s-mix" id="s-mix" onchange="brandchange(this.value)"> 
								 <option value="">PILIH MIX</option>
                                <option value="REGULAR" >REGULAR</option>
                                <option value="PREMIUM" >PREMIUM</option>
                                </select>
                                    
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-danger waves-effect waves-light mr-1"><i class="fe-filter mr-1"></i> Filter</button>
                                </div>
                                <div class="form-group">
                                    <!-- <button type="submit" class="btn btn-info waves-effect waves-light mr-1"><i class="fe-file-text mr-1"></i> Excel</button> -->
                                    <a href="../hwspv/excel10QRSPQA020-30-01.php?s-kel=<?php echo $kel ?>&s-scanke=<?php echo $scan ?>&f-tiwva02=<?php echo $tglfil ?>&f-tig-to=<?php echo $tglto ?>&s-brand=<?php echo $brand?>" class="btn btn-info waves-effect waves-light mr-1" role="button"><i class="fe-file-text mr-1"></i> Excel</a>
                                </div>
                               
                                <div class="form-group">
                                    <a href="index.php?tmg=isc-w"><button type="button"
                                            class="btn btn-success waves-effect waves-light mr-1"><i
                                                class="fe-refresh-ccw"></i></button><a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- <div class="col-lg-4">
                        <div class="text-lg-right mt-lg-0">
                             <a href="index.php?tmg=ps-w">
                                <button type="button" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-ballot mr-1"></i>Individu Pasok</button></a> -->
                            <!-- <a href="index.php?tmg=hs-w">
                                <button type="button" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-ballot mr-1"></i>Total Produksi</button></a>
                        </div> -->
                    <!-- </div>  -->
                </div>
            <div id="container">
            <div class="table-responsive table-height">
            <table  class="table table-bordered table-striped table-hover table-sticky">

                    <thead class="thead-light">
                        <tr>
                            <th rowspan="2" class="align-middle" style="width:1%">NO</th>
                            <!-- <th rowspan="2" class="align-middle">Nama (ID)</th> -->
                            <th rowspan="2" class="align-middle text-center" style="width:2%">Kelompok</th>
                            <th rowspan="2" class="align-middle text-center" style="width:2%">Gunting</th>
                            <th rowspan="2" class="align-middle text-center" style="width:2%">Giling</th>
                            <?php
                            if (isset($_GET['f-tiwva02'])) {
                               $qe1=date_create($_GET['f-tiwva02']);
                               date_add($qe1,date_interval_create_from_date_string("0 days"));
                               $qe1=date_format($qe1,"Y-m-d");
                               $qe2=date_create($_GET['f-tiwva02']);
                               date_add($qe2,date_interval_create_from_date_string("1 days"));
                               $qe2=date_format($qe2,"Y-m-d");
                               $qe3=date_create($_GET['f-tiwva02']);
                               date_add($qe3,date_interval_create_from_date_string("2 days"));
                               $qe3=date_format($qe3,"Y-m-d");
                               $qe4=date_create($_GET['f-tiwva02']);
                               date_add($qe4,date_interval_create_from_date_string("3 days"));
                               $qe4=date_format($qe4,"Y-m-d");
                               $qe5=date_create($_GET['f-tiwva02']);
                               date_add($qe5,date_interval_create_from_date_string("4 days"));
                               $qe5=date_format($qe5,"Y-m-d");
                               $qe6=date_create($_GET['f-tiwva02']);
                               date_add($qe6,date_interval_create_from_date_string("5 days"));
                               $qe6=date_format($qe6,"Y-m-d");
                               $qe7=date_create($_GET['f-tiwva02']);
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
                            <th colspan="1" class="text-center">Total</th>
                         

                          
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
                            
                            $hasil_cart = mysqli_query($conn, "SELECT b.id_giling,b.nama_giling,
                             a.nama_puscater, b.group_giling,a.id_puscater,
                            count(b.id_giling) as totproduksi,
                            sum(b.qty_afkir) as totafkir,
                            SUM(criteria = 'RB') as sb,
                            SUM(criteria = 'SB') as ob,
                            SUM(criteria = 'A') as cn,
                            SUM(criteria = 'SR') as cor,
                            SUM(criteria = 'RR') as sr, 
                           sum(CASE When b.criteria='RB' Then qty_afkir Else 0 End)  as asb,
                           sum(CASE When b.criteria='SB' Then qty_afkir Else 0 End ) as aob,                     
                           sum(CASE When b.criteria='A' Then qty_afkir Else 0 End ) as acn,
                           sum(CASE When b.criteria='SR' Then qty_afkir Else 0 End ) as acor,
                           sum(CASE When b.criteria='RR' Then qty_afkir Else 0 End ) as asr                      
                           FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                            WHERE DATE(b.tgl_scan) between  '$tglfrom' and '$tglto'  $filbrand $filkel $filscan $filmix
                         	GROUP by  b.id_giling
                            order by  a.id_puscater asc                   
                            
                         ");
                                
                            $alltotrejectx=0;
                            $alltotrejectv=0;
                            $alltotrejectz=0;
							
										$tota1x=0;
										$tota1v=0;
										$tota1z=0;
										
										$tota2x=0;
										$tota2v=0;
										$tota2z=0;
										
										$tota3x=0;
										$tota3v=0;
										$tota3z=0;
										
										$tota4x=0;
										$tota4v=0;
										$tota4z=0;
										
										$tota5x=0;
										$tota5v=0;
										$tota5z=0;
										
										$tota6x=0;
										$tota6v=0;
										$tota6z=0;
							
							$a1x=0;
							$a1v=0;
							$a1z=0;
							
							$a2x=0;
							$a2v=0;
							$a2z=0;
							
							$a3x=0;
							$a3v=0;
							$a3z=0;
							
							$a4x=0;
							$a4v=0;
							$a4z=0;
							
							$a5x=0;
							$a5v=0;
							$a5z=0;
							
							$a6x=0;
							$a6v=0;
							$a6z=0;
                            // 1
                            $totRB1x=0;
                            $totRB1z=0;
                            $totRB1v=0;

                            $totSB1x=0;
                            $totSB1z=0;
                            $totSB1v=0;

                            $totSR1x=0;
                            $totSR1z=0;
                            $totSR1v=0;

                            $totRR1x=0;
                            $totRR1z=0;
                            $totRR1v=0;
                            
                            $totrej1x=0;
                            $totrej1v=0;
                            $totrej1z=0;

                            $totREJEALL1x=0;
                            $totREJEALL1v=0;
                            $totREJEALL1z=0;
// 2
                            $totRB2x=0;
                            $totRB2z=0;
                            $totRB2v=0;

                            $totSB2x=0;
                            $totSB2z=0;
                            $totSB2v=0;

                            $totSR2x=0;
                            $totSR2z=0;
                            $totSR2v=0;

                            $totRR2x=0;
                            $totRR2z=0;
                            $totRR2v=0;
                            
                            $totrej2x=0;
                            $totrej2v=0;
                            $totrej2z=0;

                            $totREJEALL2x=0;
                            $totREJEALL2v=0;
                            $totREJEALL2z=0;
// 3
                            $totRB3x=0;
                            $totRB3z=0;
                            $totRB3v=0;

                            $totSB3x=0;
                            $totSB3z=0;
                            $totSB3v=0;

                            $totSR3x=0;
                            $totSR3z=0;
                            $totSR3v=0;

                            $totRR3x=0;
                            $totRR3z=0;
                            $totRR3v=0;
                            
                            $totrej3x=0;
                            $totrej3v=0;
                            $totrej3z=0;

                            $totREJEALL3x=0;
                            $totREJEALL3v=0;
                            $totREJEALL3z=0;
                            // 4
                            $totRB4x=0;
                            $totRB4z=0;
                            $totRB4v=0;

                            $totSB4x=0;
                            $totSB4z=0;
                            $totSB4v=0;

                            $totSR4x=0;
                            $totSR4z=0;
                            $totSR4v=0;

                            $totRR4x=0;
                            $totRR4z=0;
                            $totRR4v=0;
                            
                            $totrej4x=0;
                            $totrej4v=0;
                            $totrej4z=0;

                            $totREJEALL4x=0;
                            $totREJEALL4v=0;
                            $totREJEALL4z=0;

                            // 5
                            $totRB5x=0;
                            $totRB5z=0;
                            $totRB5v=0;

                            $totSB5x=0;
                            $totSB5z=0;
                            $totSB5v=0;

                            $totSR5x=0;
                            $totSR5z=0;
                            $totSR5v=0;

                            $totRR5x=0;
                            $totRR5z=0;
                            $totRR5v=0;
                            
                            $totrej5x=0;
                            $totrej5v=0;
                            $totrej5z=0;

                            $totREJEALL5x=0;
                            $totREJEALL5v=0;
                            $totREJEALL5z=0;

                            // 6
                            $totRB6x=0;
                            $totRB6z=0;
                            $totRB6v=0;

                            $totSB6x=0;
                            $totSB6z=0;
                            $totSB6v=0;

                            $totSR6x=0;
                            $totSR6z=0;
                            $totSR6v=0;

                            $totRR6x=0;
                            $totRR6z=0;
                            $totRR6v=0;
                            
                            $totrej6x=0;
                            $totrej6v=0;
                            $totrej6z=0;

                            $totREJEALL6x=0;
                            $totREJEALL6v=0;
                            $totREJEALL6z=0;

                            $totRB5x=0;
                            $totRB5z=0;
                            $totRB5v=0;

                            $totRB6x=0;
                            $totRB6z=0;
                            $totRB6v=0;

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
                                $idgiling=$p['id_giling'];
                                
                                
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
                                    <td class="text-center">
                                     <?php echo $p['nama_puscater']."(".$p['id_puscater'].")" ?> 
                                    </td>
                                    <td class="text-center">
                                    <?php echo $p['nama_giling']."(".$p['id_giling'].")"  ?> 
                                    </td>
                              
                                    <!-- 1 -->
                                    <?php
                            
                            $hasil_cart1 = mysqli_query($conn, "SELECT b.id_giling,b.nama_giling, a.nama_puscater, b.group_giling,
                            count(b.id_giling) as totproduksi,
                            sum(b.qty_afkir) as totafkir,
                            SUM(criteria = 'RB') as sb,
                            SUM(criteria = 'SB') as ob,
                            SUM(criteria = 'A') as cn,
                            SUM(criteria = 'SR') as cor,
                            SUM(criteria = 'RR') as sr,
                           sum(CASE When b.criteria='RB' Then qty_afkir Else 0 End)  as asb,
                           sum(CASE When b.criteria='SB' Then qty_afkir Else 0 End ) as aob,                     
                           sum(CASE When b.criteria='A' Then 10 Else 0 End ) as acn,
                           sum(CASE When b.criteria='SR' Then qty_afkir Else 0 End ) as acor,
                           sum(CASE When b.criteria='RR' Then qty_afkir Else 0 End ) as asr                      
                            
                           FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                            WHERE DATE(b.tgl_scan) = '$qe1'  $filbrand and b.id_giling='$idgiling' $filscan $filmix
                            GROUP by b.id_giling
                            order by b.group_giling,b.code_timbang,b.id_giling asc                   
                            
                            ");


                            $no1 = 1;   
                            $afk_sb1rbx = "0";
                            $afk_sb1rbv = "0";
                            $afk_sb1rbz = "0";
                            $afk_sb1sbx = "0";
                            $afk_sb1sbv = "0";
                            $afk_sb1sbz = "0";
                            $afk_sb1srx = "0";
                            $afk_sb1srv = "0";
                            $afk_sb1srz = "0";
                            $afk_sb1rrx = "0";
                            $afk_sb1rrv = "0";
                            $afk_sb1rrz = "0";
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
                                        <?php 
                                         $qp1 = mysqli_query($conn, "SELECT  scan_ke , SUM(qty_afkir) as afkir
                                         FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                          WHERE DATE(b.tgl_scan) = '$qe1'  $filbrand $filmix and id_giling='$idgiling' $filscan and b.criteria = 'RB' and  b.scan_ke in ('1','2','3')
                                          group by  scan_ke asc
                                          ");
                                                                   
                                          while ($dp1 = mysqli_fetch_array($qp1)) {
                                            $pasokke = $dp1['scan_ke'];
                                            $jumalhafkir = $dp1['afkir'];
                                            if ($pasokke==1){
                                                echo "X";
                                                $afk_sb1rbx=$afk_sb1rbx+$jumalhafkir;
                                                }
                                                if ($pasokke==2){
                                                    echo "V";
                                                    $afk_sb1rbv=$afk_sb1rbv+$jumalhafkir;
                                                    }
                                                if ($pasokke>=3){
                                                    echo "Z";
                                                    $afk_sb1rbz=$afk_sb1rbz+$jumalhafkir;
                                                }

                                          }
                                        
                                        ?>
                                    </td>
                                    <td class="text-center">
                                    <?php 
                                         $qp1 = mysqli_query($conn, "SELECT  scan_ke , SUM(qty_afkir) as afkir
                                         FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                          WHERE DATE(b.tgl_scan) = '$qe1'  $filbrand $filmix and id_giling='$idgiling' $filscan and b.criteria = 'SB' and  b.scan_ke in ('1','2','3')
                                          group by  scan_ke asc
                                          ");
                                                                   
                                          while ($dp1 = mysqli_fetch_array($qp1)) {
                                            $pasokke = $dp1['scan_ke'];
                                            $jumalhafkir = $dp1['afkir'];
                                            if ($pasokke==1){
                                                echo "X";
                                                $afk_sb1sbx=$afk_sb1sbx+$jumalhafkir;
                                                }
                                                if ($pasokke==2){
                                                    echo "V";
                                                    $afk_sb1sbv=$afk_sb1sbv+$jumalhafkir;
                                                    }
                                                if ($pasokke>=3){
                                                    echo "Z";
                                                    $afk_sb1sbz=$afk_sb1sbz+$jumalhafkir;
                                                }

                                          }
                                        
                                        ?>
                                    </td>
                                    <td class="text-center">
                                       <?php 
                                         $qp1 = mysqli_query($conn, "SELECT  scan_ke , (qty_afkir) as afkir,
										  sum(CASE When b.scan_ke = 1 and b.criteria = 'A'  Then 10 Else 0 End)  as scanke1,
                                          sum(CASE When b.scan_ke = 2 and b.criteria = 'A' Then 10 Else 0 End)  as scanke2,
                                          sum(CASE When b.scan_ke >= 3 and b.criteria = 'A' Then 10 Else 0 End)  as scanke3
                                         FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                          WHERE DATE(b.tgl_scan) = '$qe1'  $filbrand $filmix and id_giling='$idgiling' $filscan and b.criteria = 'A' and  b.scan_ke in ('1','2','3')
                                         
                                          ");
                                                               
                                          while ($dp1 = mysqli_fetch_array($qp1)) {
                                            $pasokke = $dp1['scan_ke'];
                                             $jumalhacx = $dp1['scanke1'];
											 $jumalhacv = $dp1['scanke2'];
											 $jumalhacz = $dp1['scanke3'];
                                          
                                               
                                                $a1x=$a1x+$jumalhacx;
												 echo "X=".$jumalhacx.'<br>';
                                                
                                               
                                                   
                                                    $a1v=$a1v+$jumalhacv;
													 echo "V=". $jumalhacv.'<br>';
                                                    
                                               
                                                    
                                                    $a1z=$a1z+$jumalhacz;
													echo "Z=".$jumalhacz.'<br>';
                                                

                                          }
                                        
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php 
                                        $qp1 = mysqli_query($conn, "SELECT  scan_ke , SUM(qty_afkir) as afkir
                                        FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                         WHERE DATE(b.tgl_scan) = '$qe1'  $filbrand $filmix and id_giling='$idgiling' $filscan and b.criteria = 'SR' and  b.scan_ke in ('1','2','3')
                                         group by  scan_ke asc
                                         ");
                                                                  
                                         while ($dp1 = mysqli_fetch_array($qp1)) {
                                           $pasokke = $dp1['scan_ke'];
                                           $jumalhafkir = $dp1['afkir'];
                                           if ($pasokke==1){
                                            echo "X";
                                            $afk_sb1srx=$afk_sb1srx+$jumalhafkir;
                                            }
                                            if ($pasokke==2){
                                                echo "V";
                                                $afk_sb1srv=$afk_sb1srv+$jumalhafkir;
                                                }
                                            if ($pasokke>=3){
                                                echo "Z";
                                                $afk_sb1srz=$afk_sb1srz+$jumalhafkir;
                                            }

                                         }
                                       
                                       ?>
                                    </td>
                                    <td class="text-center">
                                        <?php 
                                        $qp1 = mysqli_query($conn, "SELECT  scan_ke , SUM(qty_afkir) as afkir
                                        FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                         WHERE DATE(b.tgl_scan) = '$qe1'  $filbrand $filmix and id_giling='$idgiling' $filscan and b.criteria = 'RR' and  b.scan_ke in ('1','2','3')
                                         group by  scan_ke asc
                                         ");
                                                                  
                                         while ($dp1 = mysqli_fetch_array($qp1)) {
                                           $pasokke = $dp1['scan_ke'];
                                           $jumalhafkir = $dp1['afkir'];
                                           if ($pasokke==1){
                                            echo "X";
                                            $afk_sb1rrx=$afk_sb1rrx+$jumalhafkir;
                                            }
                                            if ($pasokke==2){
                                                echo "V";
                                                $afk_sb1rrv=$afk_sb1rrv+$jumalhafkir;
                                                }
                                            if ($pasokke>=3){
                                                echo "Z";
                                                $afk_sb1rrz=$afk_sb1rrz+$jumalhafkir;
                                            }

                                         }
                                       
                                       ?>
                                    </td>
                                    <td class="text-center">
                                    <?php 
                                        $qp1 = mysqli_query($conn, "SELECT  scan_ke ,
                                            sum(CASE When scan_ke = 1 Then qty_afkir Else 0 End)  as scanke1,
                                            sum(CASE When b.scan_ke = 2 Then qty_afkir Else 0 End)  as scanke2,
                                            sum(CASE When b.scan_ke >= 3 Then qty_afkir Else 0 End)  as scanke3,
                                         SUM(qty_afkir) as afkir
                                        FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                         WHERE DATE(b.tgl_scan) = '$qe1'  $filbrand $filmix and id_giling='$idgiling' $filscan  and  b.scan_ke in ('1','2','3')
                                          order by scan_ke asc 
                                         ");
                                                                  
                                         while ($dp1 = mysqli_fetch_array($qp1)) {
                                           $pasokke = $dp1['scan_ke'];
                                           $pasokke1 = $dp1['scanke1'];
                                           $pasokke2 = $dp1['scanke2'];
                                           $pasokke3 = $dp1['scanke3'];
                                           $jumalhafkir = $dp1['afkir'];
                                           if ($pasokke1<>0){
                                           echo "X = ".$pasokke1."<br>";
                                           $totrej1x=$totrej1x+$pasokke1;
                                           }
                                           if ( $pasokke2<>0){
                                               echo "V =".$pasokke2."<br>";
                                               $totrej1v=$totrej1v+$pasokke2;
                                               }
                                           if ($pasokke3<>0){
                                               echo "Z = ".$pasokke3;
                                               $totrej1z=$totrej1z+$pasokke3;
                                           }


                                         }
                                       
                                       ?>
                                    </td>
                               
                                    <!-- 2 -->
                                    <?php
                            
                            $hasil_cart2 = mysqli_query($conn, "SELECT b.id_giling,b.nama_giling, a.nama_puscater, b.group_giling,
                            count(b.id_giling) as totproduksi,
                            sum(b.qty_afkir) as totafkir,
                            SUM(criteria = 'RB') as sb,
                            SUM(criteria = 'SB') as ob,
                            SUM(criteria = 'A') as cn,
                            SUM(criteria = 'SR') as cor,
                            SUM(criteria = 'RR') as sr,
                           sum(CASE When b.criteria='RB' Then qty_afkir Else 0 End)  as asb,
                           sum(CASE When b.criteria='SB' Then qty_afkir Else 0 End ) as aob,                     
                           sum(CASE When b.criteria='A' Then 10 Else 0 End ) as acn,
                           sum(CASE When b.criteria='SR' Then qty_afkir Else 0 End ) as acor,
                           sum(CASE When b.criteria='RR' Then qty_afkir Else 0 End ) as asr                      
                            
                           FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                            WHERE DATE(b.tgl_scan) = '$qe2'  $filbrand $filmix and b.id_giling='$idgiling' $filscan
                            GROUP by b.id_giling
                            order by b.group_giling,b.code_timbang,b.id_giling asc                   
                            
                            ");


                            $no1 = 1;   
                            $afk_sb2rbx = "0";
                            $afk_sb2rbv = "0";
                            $afk_sb2rbz = "0";
                            $afk_sb2sbx = "0";
                            $afk_sb2sbv = "0";
                            $afk_sb2sbz = "0";
                            $afk_sb2srx = "0";
                            $afk_sb2srv = "0";
                            $afk_sb2srz = "0";
                            $afk_sb2rrx = "0";
                            $afk_sb2rrv = "0";
                            $afk_sb2rrz = "0";
                            $afk_sb2=0;
                            $afk_ob2 = "0";
                            $afk_n2= "0";
                            $afk_or2 = "0";
                            $afk_sr2 = "0"; 
                            $totafkir2 = "0";                        
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
                                        <?php 
                                         $qp2 = mysqli_query($conn, "SELECT  scan_ke , SUM(qty_afkir) as afkir
                                         FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                          WHERE DATE(b.tgl_scan) = '$qe2'  $filbrand  $filmix and id_giling='$idgiling' $filscan and b.criteria = 'RB'  and  b.scan_ke in ('1','2','3')
                                          group by  scan_ke asc
                                          ");
                                                                   
                                          while ($dp2 = mysqli_fetch_array($qp2)) {
                                            $pasokke = $dp2['scan_ke'];
                                            $jumalhafkir = $dp2['afkir'];
                                            if ($pasokke==1){
                                                echo "X";
                                                $afk_sb2rbx=$afk_sb2rbx+$jumalhafkir;
                                                }
                                                if ($pasokke==2){
                                                    echo "V";
                                                    $afk_sb2rbv=$afk_sb2rbv+$jumalhafkir;
                                                    }
                                                if ($pasokke>=3){
                                                    echo "Z";
                                                    $afk_sb2rbz=$afk_sb2rbz+$jumalhafkir;
                                                }

                                          }
                                        
                                        ?>
                                    </td>
                                    <td class="text-center">
                                    <?php 
                                         $qp2 = mysqli_query($conn, "SELECT  scan_ke , SUM(qty_afkir) as afkir
                                         FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                          WHERE DATE(b.tgl_scan) = '$qe2'  $filbrand $filmix and id_giling='$idgiling' $filscan and b.criteria = 'SB'  and  b.scan_ke in ('1','2','3')
                                          group by  scan_ke asc
                                          ");
                                                                   
                                          while ($dp2 = mysqli_fetch_array($qp2)) {
                                            $pasokke = $dp2['scan_ke'];
                                            $jumalhafkir = $dp2['afkir'];
                                            if ($pasokke==1){
                                                echo "X";
                                                $afk_sb2sbx=$afk_sb2sbx+$jumalhafkir;
                                                }
                                                if ($pasokke==2){
                                                    echo "V";
                                                    $afk_sb2sbv=$afk_sb2sbv+$jumalhafkir;
                                                    }
                                                if ($pasokke>=3){
                                                    echo "Z";
                                                    $afk_sb2sbz=$afk_sb2sbz+$jumalhafkir;
                                                }

                                          }
                                        
                                        ?>
                                    </td>
                                    <td class="text-center">
                                       <?php 
                                         
                                         $qp1 = mysqli_query($conn, "SELECT  scan_ke , (qty_afkir) as afkir,
										  sum(CASE When b.scan_ke = 1 and b.criteria = 'A'  Then 10 Else 0 End)  as scanke1,
                                          sum(CASE When b.scan_ke = 2 and b.criteria = 'A' Then 10 Else 0 End)  as scanke2,
                                          sum(CASE When b.scan_ke >= 3 and b.criteria = 'A' Then 10 Else 0 End)  as scanke3
                                         FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                          WHERE DATE(b.tgl_scan) = '$qe2'  $filbrand $filmix and id_giling='$idgiling' $filscan and b.criteria = 'A'  and  b.scan_ke in ('1','2','3')
                                         
                                          ");
                                                                   
                                        while ($dp1 = mysqli_fetch_array($qp1)) {
                                            $pasokke = $dp1['scan_ke'];
                                             $jumalhacx = $dp1['scanke1'];
											 $jumalhacv = $dp1['scanke2'];
											 $jumalhacz = $dp1['scanke3'];
                                          
                                               
                                                $a2x=$a2x+$jumalhacx;
												 echo "X=".$jumalhacx.'<br>';
                                                
                                               
                                                   
                                                    $a2v=$a2v+$jumalhacv;
													 echo "V=". $jumalhacv.'<br>';
                                                    
                                               
                                                    
                                                    $a2z=$a2z+$jumalhacz;
													echo "Z=".$jumalhacz.'<br>';
                                                

                                          }
                                        
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php 
                                        $qp2 = mysqli_query($conn, "SELECT  scan_ke , SUM(qty_afkir) as afkir
                                        FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                         WHERE DATE(b.tgl_scan) = '$qe2'  $filbrand $filmix and id_giling='$idgiling' $filscan and b.criteria = 'SR'  and  b.scan_ke in ('1','2','3')
                                         group by  scan_ke asc
                                         ");
                                                                  
                                         while ($dp2 = mysqli_fetch_array($qp2)) {
                                           $pasokke = $dp2['scan_ke'];
                                           $jumalhafkir = $dp2['afkir'];
                                           if ($pasokke==1){
                                            echo "X";
                                            $afk_sb2srx=$afk_sb2srx+$jumalhafkir;
                                            }
                                            if ($pasokke==2){
                                                echo "V";
                                                $afk_sb2srv=$afk_sb2srv+$jumalhafkir;
                                                }
                                            if ($pasokke>=3){
                                                echo "Z";
                                                $afk_sb2srz=$afk_sb2srz+$jumalhafkir;
                                            }

                                         }
                                       
                                       ?>
                                    </td>
                                    <td class="text-center">
                                        <?php 
                                        $qp2 = mysqli_query($conn, "SELECT  scan_ke , SUM(qty_afkir) as afkir
                                        FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                         WHERE DATE(b.tgl_scan) = '$qe2'  $filbrand $filmix and id_giling='$idgiling' $filscan and b.criteria = 'RR'  and  b.scan_ke in ('1','2','3')
                                         group by  scan_ke asc
                                         ");
                                                                  
                                         while ($dp2 = mysqli_fetch_array($qp2)) {
                                           $pasokke = $dp2['scan_ke'];
                                           $jumalhafkir = $dp2['afkir'];
                                           if ($pasokke==1){
                                            echo "X";
                                            $afk_sb2rrx=$afk_sb2rrx+$jumalhafkir;
                                            }
                                            if ($pasokke==2){
                                                echo "V";
                                                $afk_sb2rrv=$afk_sb2rrv+$jumalhafkir;
                                                }
                                            if ($pasokke>=3){
                                                echo "Z";
                                                $afk_sb2rrz=$afk_sb2rrz+$jumalhafkir;
                                            }

                                         }
                                       
                                       ?>
                                    </td>
                                    <td class="text-center">
                                    <?php 
                                        $qp2 = mysqli_query($conn, "SELECT  scan_ke ,
                                            sum(CASE When scan_ke = 1 Then qty_afkir Else 0 End)  as scanke1,
                                            sum(CASE When b.scan_ke = 2 Then qty_afkir Else 0 End)  as scanke2,
                                            sum(CASE When b.scan_ke >= 3 Then qty_afkir Else 0 End)  as scanke3,
                                         SUM(qty_afkir) as afkir
                                        FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                         WHERE DATE(b.tgl_scan) = '$qe2'  $filbrand $filmix and id_giling='$idgiling' $filscan  and  b.scan_ke in ('1','2','3')
                                          order by scan_ke asc 
                                         ");
                                                                  
                                         while ($dp2 = mysqli_fetch_array($qp2)) {
                                           $pasokke = $dp2['scan_ke'];
                                           $pasokke1 = $dp2['scanke1'];
                                           $pasokke2 = $dp2['scanke2'];
                                           $pasokke3 = $dp2['scanke3'];
                                           $jumalhafkir = $dp2['afkir'];
                                           if ($pasokke1<>0){
                                           echo "X = ".$pasokke1."<br>";
                                           $totrej2x=$totrej2x+$pasokke1;
                                           }
                                           if ( $pasokke2<>0){
                                               echo "V =".$pasokke2."<br>";
                                               $totrej2v=$totrej2v+$pasokke2;
                                               }
                                           if ($pasokke3<>0){
                                               echo "Z = ".$pasokke3;
                                               $totrej2z=$totrej2z+$pasokke3;
                                           }


                                         }
                                       
                                       ?>
                                    </td>
                               
                                    <!-- 3 -->
                                    <?php
                            
                            $hasil_cart3 = mysqli_query($conn, "SELECT b.id_giling,b.nama_giling, a.nama_puscater, b.group_giling,
                            count(b.id_giling) as totproduksi,
                            sum(b.qty_afkir) as totafkir,
                            SUM(criteria = 'RB') as sb,
                            SUM(criteria = 'SB') as ob,
                            SUM(criteria = 'A') as cn,
                            SUM(criteria = 'SR') as cor,
                            SUM(criteria = 'RR') as sr,
                           sum(CASE When b.criteria='RB' Then qty_afkir Else 0 End)  as asb,
                           sum(CASE When b.criteria='SB' Then qty_afkir Else 0 End ) as aob,                     
                           sum(CASE When b.criteria='A' Then 10 Else 0 End ) as acn,
                           sum(CASE When b.criteria='SR' Then qty_afkir Else 0 End ) as acor,
                           sum(CASE When b.criteria='RR' Then qty_afkir Else 0 End ) as asr                      
                            
                           FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                            WHERE DATE(b.tgl_scan) = '$qe3'  $filbrand $filmix and b.id_giling='$idgiling' $filscan
                            GROUP by b.id_giling
                            order by b.group_giling,b.code_timbang,b.id_giling asc                   
                            
                            ");


                            $no1 = 1;   
                            $afk_sb3rbx = "0";
                            $afk_sb3rbv = "0";
                            $afk_sb3rbz = "0";
                            $afk_sb3sbx = "0";
                            $afk_sb3sbv = "0";
                            $afk_sb3sbz = "0";
                            $afk_sb3srx = "0";
                            $afk_sb3srv = "0";
                            $afk_sb3srz = "0";
                            $afk_sb3rrx = "0";
                            $afk_sb3rrv = "0";
                            $afk_sb3rrz = "0";
                            $afk_sb3=0;
                            $afk_ob3 = "0";
                            $afk_n3= "0";
                            $afk_or3 = "0";
                            $afk_sr3 = "0"; 
                            $totafkir3 = "0";                        
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
                                        <?php 
                                         $qp3 = mysqli_query($conn, "SELECT  scan_ke , SUM(qty_afkir) as afkir
                                         FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                          WHERE DATE(b.tgl_scan) = '$qe3'  $filbrand $filmix and id_giling='$idgiling' $filscan and b.criteria = 'RB'  and  b.scan_ke in ('1','2','3')
                                          group by  scan_ke asc
                                          ");
                                                                   
                                          while ($dp3 = mysqli_fetch_array($qp3)) {
                                            $pasokke = $dp3['scan_ke'];
                                            $jumalhafkir = $dp3['afkir'];
                                            if ($pasokke==1){
                                                echo "X";
                                                $afk_sb3rbx=$afk_sb3rbx+$jumalhafkir;
                                                }
                                                if ($pasokke==2){
                                                    echo "V";
                                                    $afk_sb3rbv=$afk_sb3rbv+$jumalhafkir;
                                                    }
                                                if ($pasokke>=3){
                                                    echo "Z";
                                                    $afk_sb3rbz=$afk_sb3rbz+$jumalhafkir;
                                                }

                                          }
                                        
                                        ?>
                                    </td>
                                    <td class="text-center">
                                    <?php 
                                         $qp3 = mysqli_query($conn, "SELECT  scan_ke , SUM(qty_afkir) as afkir
                                         FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                          WHERE DATE(b.tgl_scan) = '$qe3'  $filbrand $filmix and id_giling='$idgiling' $filscan and b.criteria = 'SB'  and  b.scan_ke in ('1','2','3')
                                          group by  scan_ke asc
                                          ");
                                                                   
                                          while ($dp3 = mysqli_fetch_array($qp3)) {
                                            $pasokke = $dp3['scan_ke'];
                                            $jumalhafkir = $dp3['afkir'];
                                            if ($pasokke==1){
                                                echo "X";
                                                $afk_sb3sbx=$afk_sb3sbx+$jumalhafkir;
                                                }
                                                if ($pasokke==2){
                                                    echo "V";
                                                    $afk_sb3sbv=$afk_sb3sbv+$jumalhafkir;
                                                    }
                                                if ($pasokke>=3){
                                                    echo "Z";
                                                    $afk_sb3sbz=$afk_sb3sbz+$jumalhafkir;
                                                }

                                          }
                                        
                                        ?>
                                    </td>
                                    <td class="text-center">
                                         <?php 
                                          
                                         $qp1 = mysqli_query($conn, "SELECT  scan_ke , (qty_afkir) as afkir,
										  sum(CASE When b.scan_ke = 1 and b.criteria = 'A'  Then 10 Else 0 End)  as scanke1,
                                          sum(CASE When b.scan_ke = 2 and b.criteria = 'A' Then 10 Else 0 End)  as scanke2,
                                          sum(CASE When b.scan_ke >= 3 and b.criteria = 'A' Then 10 Else 0 End)  as scanke3
                                         FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                          WHERE DATE(b.tgl_scan) = '$qe3'  $filbrand $filmix and id_giling='$idgiling' $filscan and b.criteria = 'A'  and  b.scan_ke in ('1','2','3')
                                         
                                          ");
                                                                   
                                          while ($dp1 = mysqli_fetch_array($qp1)) {
                                            $pasokke = $dp1['scan_ke'];
                                             $jumalhacx = $dp1['scanke1'];
											 $jumalhacv = $dp1['scanke2'];
											 $jumalhacz = $dp1['scanke3'];
                                          
                                               
                                                $a3x=$a3x+$jumalhacx;
												 echo "X=".$jumalhacx.'<br>';
                                                
                                               
                                                   
                                                    $a3v=$a3v+$jumalhacv;
													 echo "V=". $jumalhacv.'<br>';
                                                    
                                               
                                                    
                                                    $a3z=$a3z+$jumalhacz;
													echo "Z=".$jumalhacz.'<br>';
                                                

                                          }
                                        
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php 
                                        $qp3 = mysqli_query($conn, "SELECT  scan_ke , SUM(qty_afkir) as afkir
                                        FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                         WHERE DATE(b.tgl_scan) = '$qe3'  $filbrand  $filmix and id_giling='$idgiling' $filscan and b.criteria = 'SR'  and  b.scan_ke in ('1','2','3')
                                         group by  scan_ke asc
                                         ");
                                                                  
                                         while ($dp3 = mysqli_fetch_array($qp3)) {
                                           $pasokke = $dp3['scan_ke'];
                                           $jumalhafkir = $dp3['afkir'];
                                           if ($pasokke==1){
                                            echo "X";
                                            $afk_sb3srx=$afk_sb3srx+$jumalhafkir;
                                            }
                                            if ($pasokke==2){
                                                echo "V";
                                                $afk_sb3srv=$afk_sb3srv+$jumalhafkir;
                                                }
                                            if ($pasokke>=3){
                                                echo "Z";
                                                $afk_sb3srz=$afk_sb3srz+$jumalhafkir;
                                            }

                                         }
                                       
                                       ?>
                                    </td>
                                    <td class="text-center">
                                        <?php 
                                        $qp3 = mysqli_query($conn, "SELECT  scan_ke , SUM(qty_afkir) as afkir
                                        FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                         WHERE DATE(b.tgl_scan) = '$qe3'  $filbrand $filmix and id_giling='$idgiling' $filscan and b.criteria = 'RR'  and  b.scan_ke in ('1','2','3')
                                         group by  scan_ke asc
                                         ");
                                                                  
                                         while ($dp3 = mysqli_fetch_array($qp3)) {
                                           $pasokke = $dp3['scan_ke'];
                                           $jumalhafkir = $dp3['afkir'];
                                           if ($pasokke==1){
                                            echo "X";
                                            $afk_sb3rrx=$afk_sb3rrx+$jumalhafkir;
                                            }
                                            if ($pasokke==2){
                                                echo "V";
                                                $afk_sb3rrv=$afk_sb3rrv+$jumalhafkir;
                                                }
                                            if ($pasokke>=3){
                                                echo "Z";
                                                $afk_sb3rrz=$afk_sb3rrz+$jumalhafkir;
                                            }

                                         }
                                       
                                       ?>
                                    </td>
                                    <td class="text-center">
                                    <?php 
                                        $qp3 = mysqli_query($conn, "SELECT  scan_ke ,
                                            sum(CASE When scan_ke = 1 Then qty_afkir Else 0 End)  as scanke1,
                                            sum(CASE When b.scan_ke = 2 Then qty_afkir Else 0 End)  as scanke2,
                                            sum(CASE When b.scan_ke >= 3 Then qty_afkir Else 0 End)  as scanke3,
                                         SUM(qty_afkir) as afkir
                                        FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                         WHERE DATE(b.tgl_scan) = '$qe3'  $filbrand $filmix and id_giling='$idgiling' $filscan   and  b.scan_ke in ('1','2','3')
                                          order by scan_ke asc 
                                         ");
                                                                  
                                         while ($dp3 = mysqli_fetch_array($qp3)) {
                                           $pasokke = $dp3['scan_ke'];
                                           $pasokke1 = $dp3['scanke1'];
                                           $pasokke2 = $dp3['scanke2'];
                                           $pasokke3 = $dp3['scanke3'];
                                           $jumalhafkir = $dp3['afkir'];
                                           if ($pasokke1<>0){
                                           echo "X = ".$pasokke1."<br>";
                                           $totrej3x=$totrej3x+$pasokke1;
                                           }
                                           if ( $pasokke2<>0){
                                               echo "V =".$pasokke2."<br>";
                                               $totrej3v=$totrej3v+$pasokke2;
                                               }
                                           if ($pasokke3<>0){
                                               echo "Z = ".$pasokke3;
                                               $totrej3z=$totrej3z+$pasokke3;
                                           }


                                         }
                                       
                                       ?>
                                    </td>
                               
                                    <!-- 4 -->
                                    <?php
                                $hasil_cart4 = mysqli_query($conn, "SELECT b.id_giling,b.nama_giling, a.nama_puscater, b.group_giling,
                                count(b.id_giling) as totproduksi,
                                sum(b.qty_afkir) as totafkir,
                                SUM(criteria = 'RB') as sb,
                                SUM(criteria = 'SB') as ob,
                                SUM(criteria = 'A') as cn,
                                SUM(criteria = 'SR') as cor,
                                SUM(criteria = 'RR') as sr,
                               sum(CASE When b.criteria='RB' Then qty_afkir Else 0 End)  as asb,
                               sum(CASE When b.criteria='SB' Then qty_afkir Else 0 End ) as aob,                     
                               sum(CASE When b.criteria='A' Then 10 Else 0 End ) as acn,
                               sum(CASE When b.criteria='SR' Then qty_afkir Else 0 End ) as acor,
                               sum(CASE When b.criteria='RR' Then qty_afkir Else 0 End ) as asr                      
                                
                               FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                WHERE DATE(b.tgl_scan) = '$qe4'  $filbrand $filmix and b.id_giling='$idgiling' $filscan
                                GROUP by b.id_giling
                                order by b.group_giling,b.code_timbang,b.id_giling asc                   
                                
                                ");
    
    
                                $no1 = 1;   
                                $afk_sb4rbx = "0";
                                $afk_sb4rbv = "0";
                                $afk_sb4rbz = "0";
                                $afk_sb4sbx = "0";
                                $afk_sb4sbv = "0";
                                $afk_sb4sbz = "0";
                                $afk_sb4srx = "0";
                                $afk_sb4srv = "0";
                                $afk_sb4srz = "0";
                                $afk_sb4rrx = "0";
                                $afk_sb4rrv = "0";
                                $afk_sb4rrz = "0";
                                $afk_sb4=0;
                                $afk_ob4 = "0";
                                $afk_n4= "0";
                                $afk_or4 = "0";
                                $afk_sr4 = "0"; 
                                $totafkir4 = "0";                        
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
                                            <?php 
                                             $qp4 = mysqli_query($conn, "SELECT  scan_ke , SUM(qty_afkir) as afkir
                                             FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                              WHERE DATE(b.tgl_scan) = '$qe4'  $filbrand $filmix and id_giling='$idgiling' $filscan and b.criteria = 'RB'  and  b.scan_ke in ('1','2','3')
                                              group by  scan_ke asc
                                              ");
                                                                       
                                              while ($dp4 = mysqli_fetch_array($qp4)) {
                                                $pasokke = $dp4['scan_ke'];
                                                $jumalhafkir = $dp4['afkir'];
                                                if ($pasokke==1){
                                                    echo "X";
                                                    $afk_sb4rbx=$afk_sb4rbx+$jumalhafkir;
                                                    }
                                                    if ($pasokke==2){
                                                        echo "V";
                                                        $afk_sb4rbv=$afk_sb4rbv+$jumalhafkir;
                                                        }
                                                    if ($pasokke>=3){
                                                        echo "Z";
                                                        $afk_sb4rbz=$afk_sb4rbz+$jumalhafkir;
                                                    }
    
                                              }
                                            
                                            ?>
                                        </td>
                                        <td class="text-center">
                                        <?php 
                                             $qp4 = mysqli_query($conn, "SELECT  scan_ke , SUM(qty_afkir) as afkir
                                             FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                              WHERE DATE(b.tgl_scan) = '$qe4'  $filbrand $filmix and id_giling='$idgiling' $filscan and b.criteria = 'SB'  and  b.scan_ke in ('1','2','3')
                                              group by  scan_ke asc
                                              ");
                                                                       
                                              while ($dp4 = mysqli_fetch_array($qp4)) {
                                                $pasokke = $dp4['scan_ke'];
                                                $jumalhafkir = $dp4['afkir'];
                                                if ($pasokke==1){
                                                    echo "X";
                                                    $afk_sb4sbx=$afk_sb4sbx+$jumalhafkir;
                                                    }
                                                    if ($pasokke==2){
                                                        echo "V";
                                                        $afk_sb4sbv=$afk_sb4sbv+$jumalhafkir;
                                                        }
                                                    if ($pasokke>=3){
                                                        echo "Z";
                                                        $afk_sb4sbz=$afk_sb4sbz+$jumalhafkir;
                                                    }
    
                                              }
                                            
                                            ?>
                                        </td>
                                        <td class="text-center">
                                             <?php 
                                          
                                         $qp1 = mysqli_query($conn, "SELECT  scan_ke , (qty_afkir) as afkir,
										  sum(CASE When b.scan_ke = 1 and b.criteria = 'A'  Then 10 Else 0 End)  as scanke1,
                                          sum(CASE When b.scan_ke = 2 and b.criteria = 'A' Then 10 Else 0 End)  as scanke2,
                                          sum(CASE When b.scan_ke >= 3 and b.criteria = 'A' Then 10 Else 0 End)  as scanke3
                                         FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                          WHERE DATE(b.tgl_scan) = '$qe4'  $filbrand $filmix and id_giling='$idgiling' $filscan and b.criteria = 'A'  and  b.scan_ke in ('1','2','3')
                                         
                                          ");
                                                                   
                                         while ($dp1 = mysqli_fetch_array($qp1)) {
                                            $pasokke = $dp1['scan_ke'];
                                             $jumalhacx = $dp1['scanke1'];
											 $jumalhacv = $dp1['scanke2'];
											 $jumalhacz = $dp1['scanke3'];
                                          
                                               
                                                $a4x=$a4x+$jumalhacx;
												 echo "X=".$jumalhacx.'<br>';
                                                
                                               
                                                   
                                                    $a4v=$a4v+$jumalhacv;
													 echo "V=". $jumalhacv.'<br>';
                                                    
                                               
                                                    
                                                    $a4z=$a4z+$jumalhacz;
													echo "Z=".$jumalhacz.'<br>';
                                                

                                          }
                                        
                                        ?>
                                        </td>
                                        <td class="text-center">
                                            <?php 
                                            $qp4 = mysqli_query($conn, "SELECT  scan_ke , SUM(qty_afkir) as afkir
                                            FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                             WHERE DATE(b.tgl_scan) = '$qe4'  $filbrand $filmix and id_giling='$idgiling' $filscan and b.criteria = 'SR'  and  b.scan_ke in ('1','2','3')
                                             group by  scan_ke asc
                                             ");
                                                                      
                                             while ($dp4 = mysqli_fetch_array($qp4)) {
                                               $pasokke = $dp4['scan_ke'];
                                               $jumalhafkir = $dp4['afkir'];
                                               if ($pasokke==1){
                                                echo "X";
                                                $afk_sb4srx=$afk_sb4srx+$jumalhafkir;
                                                }
                                                if ($pasokke==2){
                                                    echo "V";
                                                    $afk_sb4srv=$afk_sb4srv+$jumalhafkir;
                                                    }
                                                if ($pasokke>=3){
                                                    echo "Z";
                                                    $afk_sb4srz=$afk_sb4srz+$jumalhafkir;
                                                }
    
                                             }
                                           
                                           ?>
                                        </td>
                                        <td class="text-center">
                                            <?php 
                                            $qp4 = mysqli_query($conn, "SELECT  scan_ke , SUM(qty_afkir) as afkir
                                            FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                             WHERE DATE(b.tgl_scan) = '$qe4'  $filbrand $filmix and id_giling='$idgiling' $filscan and b.criteria = 'RR'  and  b.scan_ke in ('1','2','3')
                                             group by  scan_ke asc
                                             ");
                                                                      
                                             while ($dp4 = mysqli_fetch_array($qp4)) {
                                               $pasokke = $dp4['scan_ke'];
                                               $jumalhafkir = $dp4['afkir'];
                                               if ($pasokke==1){
                                                echo "X";
                                                $afk_sb4rrx=$afk_sb4rrx+$jumalhafkir;
                                                }
                                                if ($pasokke==2){
                                                    echo "V";
                                                    $afk_sb4rrv=$afk_sb4rrv+$jumalhafkir;
                                                    }
                                                if ($pasokke>=3){
                                                    echo "Z";
                                                    $afk_sb4rrz=$afk_sb4rrz+$jumalhafkir;
                                                }
    
                                             }
                                           
                                           ?>
                                        </td>
                                        <td class="text-center">
                                        <?php 
                                            $qp4 = mysqli_query($conn, "SELECT  scan_ke ,
                                                sum(CASE When scan_ke = 1 Then qty_afkir Else 0 End)  as scanke1,
                                                sum(CASE When b.scan_ke = 2 Then qty_afkir Else 0 End)  as scanke2,
                                                sum(CASE When b.scan_ke >= 3 Then qty_afkir Else 0 End)  as scanke3,
                                             SUM(qty_afkir) as afkir
                                            FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                             WHERE DATE(b.tgl_scan) = '$qe4'  $filbrand $filmix and id_giling='$idgiling' $filscan   and  b.scan_ke in ('1','2','3')
                                              order by scan_ke asc 
                                             ");
                                                                      
                                             while ($dp4 = mysqli_fetch_array($qp4)) {
                                               $pasokke = $dp4['scan_ke'];
                                               $pasokke1 = $dp4['scanke1'];
                                               $pasokke2 = $dp4['scanke2'];
                                               $pasokke3 = $dp4['scanke3'];
                                               $jumalhafkir = $dp4['afkir'];
                                               if ($pasokke1<>0){
                                               echo "X = ".$pasokke1."<br>";
                                               $totrej4x=$totrej4x+$pasokke1;
                                               }
                                               if ( $pasokke2<>0){
                                                   echo "V =".$pasokke2."<br>";
                                                   $totrej4v=$totrej4v+$pasokke2;
                                                   }
                                               if ($pasokke3<>0){
                                                   echo "Z = ".$pasokke3;
                                                   $totrej4z=$totrej4z+$pasokke3;
                                               }
    
    
                                             }
                                           
                                           ?>
                                        </td>
                              
                                    <!-- 5 -->
                                    <?php
                             
                             $hasil_cart5 = mysqli_query($conn, "SELECT b.id_giling,b.nama_giling, a.nama_puscater, b.group_giling,
                             count(b.id_giling) as totproduksi,
                             sum(b.qty_afkir) as totafkir,
                             SUM(criteria = 'RB') as sb,
                             SUM(criteria = 'SB') as ob,
                             SUM(criteria = 'A') as cn,
                             SUM(criteria = 'SR') as cor,
                             SUM(criteria = 'RR') as sr,
                            sum(CASE When b.criteria='RB' Then qty_afkir Else 0 End)  as asb,
                            sum(CASE When b.criteria='SB' Then qty_afkir Else 0 End ) as aob,                     
                            sum(CASE When b.criteria='A' Then 10 Else 0 End ) as acn,
                            sum(CASE When b.criteria='SR' Then qty_afkir Else 0 End ) as acor,
                            sum(CASE When b.criteria='RR' Then qty_afkir Else 0 End ) as asr                      
                             
                            FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                             WHERE DATE(b.tgl_scan) = '$qe5'  $filbrand $filmix and b.id_giling='$idgiling' $filscan
                             GROUP by b.id_giling
                             order by b.group_giling,b.code_timbang,b.id_giling asc                   
                             
                             ");
 
 
                             $no1 = 1;   
                             $afk_sb5rbx = "0";
                             $afk_sb5rbv = "0";
                             $afk_sb5rbz = "0";
                             $afk_sb5sbx = "0";
                             $afk_sb5sbv = "0";
                             $afk_sb5sbz = "0";
                             $afk_sb5srx = "0";
                             $afk_sb5srv = "0";
                             $afk_sb5srz = "0";
                             $afk_sb5rrx = "0";
                             $afk_sb5rrv = "0";
                             $afk_sb5rrz = "0";
                             $afk_sb5=0;
                             $afk_ob5 = "0";
                             $afk_n5= "0";
                             $afk_or5 = "0";
                             $afk_sr5 = "0"; 
                             $totafkir5 = "0";                        
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
                                         <?php 
                                          $qp5 = mysqli_query($conn, "SELECT  scan_ke , SUM(qty_afkir) as afkir
                                          FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                           WHERE DATE(b.tgl_scan) = '$qe5'  $filbrand $filmix and id_giling='$idgiling' $filscan and b.criteria = 'RB'  and  b.scan_ke in ('1','2','3')
                                           group by  scan_ke asc
                                           ");
                                                                    
                                           while ($dp5 = mysqli_fetch_array($qp5)) {
                                             $pasokke = $dp5['scan_ke'];
                                             $jumalhafkir = $dp5['afkir'];
                                             if ($pasokke==1){
                                                 echo "X";
                                                 $afk_sb5rbx=$afk_sb5rbx+$jumalhafkir;
                                                 }
                                                 if ($pasokke==2){
                                                     echo "V";
                                                     $afk_sb5rbv=$afk_sb5rbv+$jumalhafkir;
                                                     }
                                                 if ($pasokke>=3){
                                                     echo "Z";
                                                     $afk_sb5rbz=$afk_sb5rbz+$jumalhafkir;
                                                 }
 
                                           }
                                         
                                         ?>
                                     </td>
                                     <td class="text-center">
                                     <?php 
                                          $qp5 = mysqli_query($conn, "SELECT  scan_ke , SUM(qty_afkir) as afkir
                                          FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                           WHERE DATE(b.tgl_scan) = '$qe5'  $filbrand $filmix and id_giling='$idgiling' $filscan and b.criteria = 'SB'  and  b.scan_ke in ('1','2','3')
                                           group by  scan_ke asc
                                           ");
                                                                    
                                           while ($dp5 = mysqli_fetch_array($qp5)) {
                                             $pasokke = $dp5['scan_ke'];
                                             $jumalhafkir = $dp5['afkir'];
                                             if ($pasokke==1){
                                                 echo "X";
                                                 $afk_sb5sbx=$afk_sb5sbx+$jumalhafkir;
                                                 }
                                                 if ($pasokke==2){
                                                     echo "V";
                                                     $afk_sb5sbv=$afk_sb5sbv+$jumalhafkir;
                                                     }
                                                 if ($pasokke>=3){
                                                     echo "Z";
                                                     $afk_sb5sbz=$afk_sb5sbz+$jumalhafkir;
                                                 }
 
                                           }
                                         
                                         ?>
                                     </td>
                                     <td class="text-center">
                                          <?php 
                                         
                                         $qp1 = mysqli_query($conn, "SELECT  scan_ke , (qty_afkir) as afkir,
										  sum(CASE When b.scan_ke = 1 and b.criteria = 'A'  Then 10 Else 0 End)  as scanke1,
                                          sum(CASE When b.scan_ke = 2 and b.criteria = 'A' Then 10 Else 0 End)  as scanke2,
                                          sum(CASE When b.scan_ke >= 3 and b.criteria = 'A' Then 10 Else 0 End)  as scanke3
                                         FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                          WHERE DATE(b.tgl_scan) = '$qe5'  $filbrand $filmix and id_giling='$idgiling' $filscan and b.criteria = 'A'  and  b.scan_ke in ('1','2','3')
                                         
                                          ");
                                                                   
                                         while ($dp1 = mysqli_fetch_array($qp1)) {
                                            $pasokke = $dp1['scan_ke'];
                                             $jumalhacx = $dp1['scanke1'];
											 $jumalhacv = $dp1['scanke2'];
											 $jumalhacz = $dp1['scanke3'];
                                          
                                               
                                                $a5x=$a5x+$jumalhacx;
												 echo "X=".$jumalhacx.'<br>';
                                                
                                               
                                                   
                                                    $a5v=$a5v+$jumalhacv;
													 echo "V=". $jumalhacv.'<br>';
                                                    
                                               
                                                    
                                                    $a5z=$a5z+$jumalhacz;
													echo "Z=".$jumalhacz.'<br>';
                                                

                                          }
                                        
                                        ?>
                                     </td>
                                     <td class="text-center">
                                         <?php 
                                         $qp5 = mysqli_query($conn, "SELECT  scan_ke , SUM(qty_afkir) as afkir
                                         FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                          WHERE DATE(b.tgl_scan) = '$qe5'  $filbrand $filmix and id_giling='$idgiling' $filscan and b.criteria = 'SR'  and  b.scan_ke in ('1','2','3')
                                          group by  scan_ke asc
                                          ");
                                                                   
                                          while ($dp4 = mysqli_fetch_array($qp4)) {
                                            $pasokke = $dp5['scan_ke'];
                                            $jumalhafkir = $dp5['afkir'];
                                            if ($pasokke==1){
                                             echo "X";
                                             $afk_sb5srx=$afk_sb5srx+$jumalhafkir;
                                             }
                                             if ($pasokke==2){
                                                 echo "V";
                                                 $afk_sb5srv=$afk_sb5srv+$jumalhafkir;
                                                 }
                                             if ($pasokke>=3){
                                                 echo "Z";
                                                 $afk_sb5srz=$af5_sb5srz+$jumalhafkir;
                                             }
 
                                          }
                                        
                                        ?>
                                     </td>
                                     <td class="text-center">
                                         <?php 
                                         $qp5 = mysqli_query($conn, "SELECT  scan_ke , SUM(qty_afkir) as afkir
                                         FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                          WHERE DATE(b.tgl_scan) = '$qe5'  $filbrand $filmix and id_giling='$idgiling' $filscan and b.criteria = 'RR'  and  b.scan_ke in ('1','2','3')
                                          group by  scan_ke asc
                                          ");
                                                                   
                                          while ($dp5 = mysqli_fetch_array($qp5)) {
                                            $pasokke = $dp5['scan_ke'];
                                            $jumalhafkir = $dp5['afkir'];
                                            if ($pasokke==1){
                                             echo "X";
                                             $afk_sb5rrx=$afk_sb5rrx+$jumalhafkir;
                                             }
                                             if ($pasokke==2){
                                                 echo "V";
                                                 $afk_sb5rrv=$afk_sb5rrv+$jumalhafkir;
                                                 }
                                             if ($pasokke>=3){
                                                 echo "Z";
                                                 $afk_sb5rrz=$afk_sb5rrz+$jumalhafkir;
                                             }
 
                                          }
                                        
                                        ?>
                                     </td>
                                     <td class="text-center">
                                     <?php 
                                         $qp5 = mysqli_query($conn, "SELECT  scan_ke ,
                                             sum(CASE When scan_ke = 1 Then qty_afkir Else 0 End)  as scanke1,
                                             sum(CASE When b.scan_ke = 2 Then qty_afkir Else 0 End)  as scanke2,
                                             sum(CASE When b.scan_ke >= 3 Then qty_afkir Else 0 End)  as scanke3,
                                          SUM(qty_afkir) as afkir
                                         FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                          WHERE DATE(b.tgl_scan) = '$qe5'  $filbrand $filmix and id_giling='$idgiling' $filscan   and  b.scan_ke in ('1','2','3')
                                           order by scan_ke asc 
                                          ");
                                                                   
                                          while ($dp5 = mysqli_fetch_array($qp5)) {
                                            $pasokke = $dp5['scan_ke'];
                                            $pasokke1 = $dp5['scanke1'];
                                            $pasokke2 = $dp5['scanke2'];
                                            $pasokke3 = $dp5['scanke3'];
                                            $jumalhafkir = $dp5['afkir'];
                                            if ($pasokke1<>0){
                                            echo "X = ".$pasokke1."<br>";
                                            $totrej5x=$totrej5x+$pasokke1;
                                            }
                                            if ( $pasokke2<>0){
                                                echo "V =".$pasokke2."<br>";
                                                $totrej5v=$totrej5v+$pasokke2;
                                                }
                                            if ($pasokke3<>0){
                                                echo "Z = ".$pasokke3;
                                                $totrej5z=$totrej5z+$pasokke3;
                                            }
 
 
                                          }
                                        
                                        ?>
                                     </td>
                               
                                    <!-- 6 -->
                                    <?php
                             $hasil_cart6 = mysqli_query($conn, "SELECT b.id_giling,b.nama_giling, a.nama_puscater, b.group_giling,
                             count(b.id_giling) as totproduksi,
                             sum(b.qty_afkir) as totafkir,
                             SUM(criteria = 'RB') as sb,
                             SUM(criteria = 'SB') as ob,
                             SUM(criteria = 'A') as cn,
                             SUM(criteria = 'SR') as cor,
                             SUM(criteria = 'RR') as sr,
                            sum(CASE When b.criteria='RB' Then qty_afkir Else 0 End)  as asb,
                            sum(CASE When b.criteria='SB' Then qty_afkir Else 0 End ) as aob,                     
                            sum(CASE When b.criteria='A' Then 10 Else 0 End ) as acn,
                            sum(CASE When b.criteria='SR' Then qty_afkir Else 0 End ) as acor,
                            sum(CASE When b.criteria='RR' Then qty_afkir Else 0 End ) as asr                      
                             
                            FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                             WHERE DATE(b.tgl_scan) = '$qe6'  $filbrand $filmix and b.id_giling='$idgiling' $filscan
                             GROUP by b.id_giling
                             order by b.group_giling,b.code_timbang,b.id_giling asc                   
                             
                             ");
 
 
                             $no1 = 1;   
                             $afk_sb6rbx = "0";
                             $afk_sb6rbv = "0";
                             $afk_sb6rbz = "0";
                             $afk_sb6sbx = "0";
                             $afk_sb6sbv = "0";
                             $afk_sb6sbz = "0";
                             $afk_sb6srx = "0";
                             $afk_sb6srv = "0";
                             $afk_sb6srz = "0";
                             $afk_sb6rrx = "0";
                             $afk_sb6rrv = "0";
                             $afk_sb6rrz = "0";
                             $afk_sb6=0;
                             $afk_ob6 = "0";
                             $afk_n6= "0";
                             $afk_or6 = "0";
                             $afk_sr6 = "0"; 
                             $totafkir6 = "0";                        
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
                                         <?php 
                                          $qp6 = mysqli_query($conn, "SELECT  scan_ke , SUM(qty_afkir) as afkir
                                          FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                           WHERE DATE(b.tgl_scan) = '$qe6'  $filbrand $filmix and id_giling='$idgiling' $filscan and b.criteria = 'RB'  and  b.scan_ke in ('1','2','3')
                                           group by  scan_ke asc
                                           ");
                                                                    
                                           while ($dp6 = mysqli_fetch_array($qp6)) {
                                             $pasokke = $dp6['scan_ke'];
                                             $jumalhafkir = $dp6['afkir'];
                                             if ($pasokke==1){
                                                 echo "X";
                                                 $afk_sb6rbx=$afk_sb6rbx+$jumalhafkir;
                                                 }
                                                 if ($pasokke==2){
                                                     echo "V";
                                                     $afk_sb6rbv=$afk_sb6rbv+$jumalhafkir;
                                                     }
                                                 if ($pasokke>=3){
                                                     echo "Z";
                                                     $afk_sb6rbz=$afk_sb6rbz+$jumalhafkir;
                                                 }
 
                                           }
                                         
                                         ?>
                                     </td>
                                     <td class="text-center">
                                     <?php 
                                          $qp6 = mysqli_query($conn, "SELECT  scan_ke , SUM(qty_afkir) as afkir
                                          FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                           WHERE DATE(b.tgl_scan) = '$qe6'  $filbrand $filmix and id_giling='$idgiling' $filscan and b.criteria = 'SB'  and  b.scan_ke in ('1','2','3')
                                           group by  scan_ke asc
                                           ");
                                                                    
                                           while ($dp6 = mysqli_fetch_array($qp6)) {
                                             $pasokke = $dp6['scan_ke'];
                                             $jumalhafkir = $dp6['afkir'];
                                             if ($pasokke==1){
                                                 echo "X";
                                                 $afk_sb6sbx=$afk_sb6sbx+$jumalhafkir;
                                                 }
                                                 if ($pasokke==2){
                                                     echo "V";
                                                     $afk_sb6sbv=$afk_sb6sbv+$jumalhafkir;
                                                     }
                                                 if ($pasokke>=3){
                                                     echo "Z";
                                                     $afk_sb6sbz=$afk_sb6sbz+$jumalhafkir;
                                                 }
 
                                           }
                                         
                                         ?>
                                     </td>
                                     <td class="text-center">
                                          <?php 
                                         
                                         $qp1 = mysqli_query($conn, "SELECT  scan_ke , (qty_afkir) as afkir,
										  sum(CASE When b.scan_ke = 1 and b.criteria = 'A'  Then 10 Else 0 End)  as scanke1,
                                          sum(CASE When b.scan_ke = 2 and b.criteria = 'A' Then 10 Else 0 End)  as scanke2,
                                          sum(CASE When b.scan_ke >= 3 and b.criteria = 'A' Then 10 Else 0 End)  as scanke3
                                         FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                          WHERE DATE(b.tgl_scan) = '$qe6'  $filbrand $filmix and id_giling='$idgiling' $filscan and b.criteria = 'A'  and  b.scan_ke in ('1','2','3')
                                         
                                          ");
                                                                   
                                         while ($dp1 = mysqli_fetch_array($qp1)) {
                                            $pasokke = $dp1['scan_ke'];
                                             $jumalhacx = $dp1['scanke1'];
											 $jumalhacv = $dp1['scanke2'];
											 $jumalhacz = $dp1['scanke3'];
                                          
                                               
                                                $a6x=$a6x+$jumalhacx;
												 echo "X=".$jumalhacx.'<br>';
                                                
                                               
                                                   
                                                    $a6v=$a6v+$jumalhacv;
													 echo "V=". $jumalhacv.'<br>';
                                                    
                                               
                                                    
                                                    $a6z=$a6z+$jumalhacz;
													echo "Z=".$jumalhacz.'<br>';
                                                

                                          }
                                        
                                        ?>
                                     </td>
                                     <td class="text-center">
                                         <?php 
                                         $qp6 = mysqli_query($conn, "SELECT  scan_ke , SUM(qty_afkir) as afkir
                                         FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                          WHERE DATE(b.tgl_scan) = '$qe6'  $filbrand $filmix and id_giling='$idgiling' $filscan and b.criteria = 'SR'  and  b.scan_ke in ('1','2','3')
                                          group by  scan_ke asc
                                          ");
                                                                   
                                          while ($dp6 = mysqli_fetch_array($qp6)) {
                                            $pasokke = $dp6['scan_ke'];
                                            $jumalhafkir = $dp6['afkir'];
                                            if ($pasokke==1){
                                             echo "X";
                                             $afk_sb6srx=$afk_sb6srx+$jumalhafkir;
                                             }
                                             if ($pasokke==2){
                                                 echo "V";
                                                 $afk_sb6srv=$afk_sb6srv+$jumalhafkir;
                                                 }
                                             if ($pasokke>=3){
                                                 echo "Z";
                                                 $afk_sb6srz=$af5_sb6srz+$jumalhafkir;
                                             }
 
                                          }
                                        
                                        ?>
                                     </td>
                                     <td class="text-center">
                                         <?php 
                                         $qp6 = mysqli_query($conn, "SELECT  scan_ke , SUM(qty_afkir) as afkir
                                         FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                          WHERE DATE(b.tgl_scan) = '$qe6'  $filbrand $filmix and id_giling='$idgiling' $filscan and b.criteria = 'RR'  and  b.scan_ke in ('1','2','3')
                                          group by  scan_ke asc
                                          ");
                                                                   
                                          while ($dp6 = mysqli_fetch_array($qp6)) {
                                            $pasokke = $dp6['scan_ke'];
                                            $jumalhafkir = $dp6['afkir'];
                                            if ($pasokke==1){
                                             echo "X";
                                             $afk_sb6rrx=$afk_sb6rrx+$jumalhafkir;
                                             }
                                             if ($pasokke==2){
                                                 echo "V";
                                                 $afk_sb6rrv=$afk_sb6rrv+$jumalhafkir;
                                                 }
                                             if ($pasokke>=3){
                                                 echo "Z";
                                                 $afk_sb6rrz=$afk_sb6rrz+$jumalhafkir;
                                             }
 
                                          }
                                        
                                        ?>
                                     </td>
                                     <td class="text-center">
                                     <?php 
                                         $qp6 = mysqli_query($conn, "SELECT  scan_ke ,
                                             sum(CASE When scan_ke = 1 Then qty_afkir Else 0 End)  as scanke1,
                                             sum(CASE When b.scan_ke = 2 Then qty_afkir Else 0 End)  as scanke2,
                                             sum(CASE When b.scan_ke >= 3 Then qty_afkir Else 0 End)  as scanke3,
                                          SUM(qty_afkir) as afkir
                                         FROM timbang_pc AS a inner join timbang_pc_hasil as b on a.code_timbang=b.code_timbang
                                          WHERE DATE(b.tgl_scan) = '$qe6'  $filbrand $filmix and id_giling='$idgiling' $filscan   and  b.scan_ke in ('1','2','3')
                                           order by scan_ke asc 
                                          ");
                                                                   
                                          while ($dp6 = mysqli_fetch_array($qp6)) {
                                            $pasokke = $dp6['scan_ke'];
                                            $pasokke1 = $dp6['scanke1'];
                                            $pasokke2 = $dp6['scanke2'];
                                            $pasokke3 = $dp6['scanke3'];
                                            $jumalhafkir = $dp6['afkir'];
                                            if ($pasokke1<>0){
                                            echo "X = ".$pasokke1."<br>";
                                            $totrej6x=$totrej6x+$pasokke1;
                                            }
                                            if ( $pasokke2<>0){
                                                echo "V =".$pasokke2."<br>";
                                                $totrej6v=$totrej6v+$pasokke2;
                                                }
                                            if ($pasokke3<>0){
                                                echo "Z = ".$pasokke3;
                                                $totrej6z=$totrej6z+$pasokke3;
                                            }
 
 
                                          }
                                        
                                        ?>
                                     </td>
                                    <?php 


                            //     $totRB1=$totRB1+$afk_sb1;
                            //     $totRB2=$totRB2+$afk_sb2;
                            //     $totRB3=$totRB3+$afk_sb3;
                            //     $totRB4=$totRB4+$afk_sb4;
                            //     $totRB5=$totRB5+$afk_sb5;
                            //     $totRB6=$totRB6+$afk_sb6;

                            //     $totSB1=$totSB1+$afk_ob1;
                            //     $totSB2=$totSB2+$afk_ob2;
                            //     $totSB3=$totSB3+$afk_ob3;
                            //     $totSB4=$totSB4+$afk_ob4;
                            //     $totSB5=$totSB5+$afk_ob5;
                            //     $totSB6=$totSB6+$afk_ob6;

                            //      $totA1=$totA1+$afk_n1;
                            //      $totA2=$totA2+$afk_n2;
                            //      $totA3=$totA3+$afk_n3;
                            //      $totA4=$totA4+$afk_n4;
                            //      $totA5=$totA5+$afk_n5;
                            //      $totA6=$totA6+$afk_n6;

                            //  $totSR1=$totSR1+$afk_or1;
                            //  $totSR2=$totSR2+$afk_or2;
                            //  $totSR3=$totSR3+$afk_or3;
                            //  $totSR4=$totSR4+$afk_or4;
                            //  $totSR5=$totSR5+$afk_or5;
                            //  $totSR6=$totSR6+$afk_or6;

                            // $totRR1=$totRR1+$afk_sr1;
                            // $totRR2=$totRR2+$afk_sr2;
                            // $totRR3=$totRR3+$afk_sr3;
                            // $totRR4=$totRR4+$afk_sr4;
                            // $totRR5=$totRR5+$afk_sr5;
                            // $totRR6=$totRR6+$afk_sr6;

                            $totreject1=$totreject1+$totafkir1;
                            $totreject2=$totreject2+$totafkir2;
                            $totreject3=$totreject3+$totafkir3;
                            $totreject4=$totreject4+$totafkir4;
                            $totreject5=$totreject5+$totafkir5;
                            $totreject6=$totreject6+$totafkir6;

                            $totreject=$totreject+$totafkir1+$totafkir2+$totafkir3+$totafkir4+$totafkir5+$totafkir6;
                          ?>
                                    <td class="text-center">
                                        <?php 
										
										$tota1x=$tota1x+$a1x;
										$tota1v=$tota1v+$a1v;
										$tota1z=$tota1z+$a1z;
										
										$tota2x=$tota2x+$a2x;
										$tota2v=$tota2v+$a2v;
										$tota2z=$tota2z+$a2z;
										
										$tota3x=$tota3x+$a3x;
										$tota3v=$tota3v+$a3v;
										$tota3z=$tota3z+$a3z;
										
										$tota4x=$tota4x+$a4x;
										$tota4v=$tota4v+$a4v;
										$tota4z=$tota4z+$a4z;
										
										$tota5x=$tota5x+$a5x;
										$tota5v=$tota5v+$a5v;
										$tota5z=$tota5z+$a5z;
										
										$tota6x=$tota6x+$a6x;
										$tota6v=$tota6v+$a6v;
										$tota6z=$tota6z+$a6z;
										
                                          $totRB1x=$totRB1x+$afk_sb1rbx;
                                          $totRB1v=$totRB1v+$afk_sb1rbv;
                                          $totRB1z=$totRB1z+$afk_sb1rbz;

                                          $totSB1x=$totSB1x+$afk_sb1sbx;
                                          $totSB1v=$totSB1v+$afk_sb1sbv;
                                          $totSB1z=$totSB1z+$afk_sb1sbz;

                                          $totSR1x=$totSR1x+$afk_sb1srx;
                                          $totSR1v=$totSR1v+$afk_sb1srv;
                                          $totSR1z=$totSR1z+$afk_sb1srz;

                                          $totRR1x=$totRR1x+$afk_sb1rrx;
                                          $totRR1v=$totRR1v+$afk_sb1rrv;
                                          $totRR1z=$totRR1z+$afk_sb1rrz;

                                        //   2
                                          $totRB2x=$totRB2x+$afk_sb2rbx;
                                          $totRB2v=$totRB2v+$afk_sb2rbv;
                                          $totRB2z=$totRB2z+$afk_sb2rbz;

                                          $totSB2x=$totSB2x+$afk_sb2sbx;
                                          $totSB2v=$totSB2v+$afk_sb2sbv;
                                          $totSB2z=$totSB2z+$afk_sb2sbz;

                                          $totSR2x=$totSR2x+$afk_sb2srx;
                                          $totSR2v=$totSR2v+$afk_sb2srv;
                                          $totSR2z=$totSR2z+$afk_sb2srz;

                                          $totRR2x=$totRR2x+$afk_sb2rrx;
                                          $totRR2v=$totRR2v+$afk_sb2rrv;
                                          $totRR2z=$totRR2z+$afk_sb2rrz;

                                        // 3
                                          $totRB3x=$totRB3x+$afk_sb3rbx;
                                          $totRB3v=$totRB3v+$afk_sb3rbv;
                                          $totRB3z=$totRB3z+$afk_sb3rbz;

                                          $totSB3x=$totSB3x+$afk_sb3sbx;
                                          $totSB3v=$totSB3v+$afk_sb3sbv;
                                          $totSB3z=$totSB2z+$afk_sb3sbz;

                                          $totSR3x=$totSR3x+$afk_sb3srx;
                                          $totSR3v=$totSR3v+$afk_sb3srv;
                                          $totSR3z=$totSR3z+$afk_sb3srz;

                                          $totRR3x=$totRR3x+$afk_sb3rrx;
                                          $totRR3v=$totRR3v+$afk_sb3rrv;
                                          $totRR3z=$totRR3z+$afk_sb3rrz;
                                        //   4
                                        $totRB4x=$totRB4x+$afk_sb4rbx;
                                        $totRB4v=$totRB4v+$afk_sb4rbv;
                                        $totRB4z=$totRB4z+$afk_sb4rbz;

                                        $totSB4x=$totSB4x+$afk_sb4sbx;
                                        $totSB4v=$totSB4v+$afk_sb4sbv;
                                        $totSB4z=$totSB4z+$afk_sb4sbz;

                                        $totSR4x=$totSR4x+$afk_sb4srx;
                                        $totSR4v=$totSR4v+$afk_sb4srv;
                                        $totSR4z=$totSR4z+$afk_sb4srz;

                                        $totRR4x=$totRR4x+$afk_sb4rrx;
                                        $totRR4v=$totRR4v+$afk_sb4rrv;
                                        $totRR4z=$totRR4z+$afk_sb4rrz;

                                        // 5
                                        $totRB5x=$totRB5x+$afk_sb5rbx;
                                        $totRB5v=$totRB5v+$afk_sb5rbv;
                                        $totRB5z=$totRB5z+$afk_sb5rbz;

                                        $totSB5x=$totSB5x+$afk_sb5sbx;
                                        $totSB5v=$totSB5v+$afk_sb5sbv;
                                        $totSB5z=$totSB5z+$afk_sb5sbz;

                                        $totSR5x=$totSR5x+$afk_sb5srx;
                                        $totSR5v=$totSR5v+$afk_sb5srv;
                                        $totSR5z=$totSR5z+$afk_sb5srz;

                                        $totRR5x=$totRR5x+$afk_sb5rrx;
                                        $totRR5v=$totRR5v+$afk_sb5rrv;
                                        $totRR5z=$totRR5z+$afk_sb5rrz;

                                        // 6
                                        $totRB6x=$totRB6x+$afk_sb6rbx;
                                        $totRB6v=$totRB6v+$afk_sb6rbv;
                                        $totRB6z=$totRB6z+$afk_sb6rbz;

                                        $totSB6x=$totSB6x+$afk_sb6sbx;
                                        $totSB6v=$totSB6v+$afk_sb6sbv;
                                        $totSB6z=$totSB6z+$afk_sb6sbz;

                                        $totSR6x=$totSR6x+$afk_sb6srx;
                                        $totSR6v=$totSR6v+$afk_sb6srv;
                                        $totSR6z=$totSR6z+$afk_sb6srz;

                                        $totRR6x=$totRR6x+$afk_sb6rrx;
                                        $totRR6v=$totRR6v+$afk_sb6rrv;
                                        $totRR6z=$totRR6z+$afk_sb6rrz; 


                                         

                                        $totx=$afk_sb1rbx+$afk_sb1sbx+$afk_sb1srx+$afk_sb1rrx+$afk_sb2rbx+$afk_sb2sbx+$afk_sb2srx+$afk_sb2rrx+$afk_sb3rbx+$afk_sb3sbx+$afk_sb3srx+$afk_sb3rrx+$afk_sb4rbx+$afk_sb4sbx+$afk_sb4srx+$afk_sb4rrx+$afk_sb5rbx+$afk_sb5sbx+$afk_sb5srx+$afk_sb5rrx+$afk_sb6rbx+$afk_sb6sbx+$afk_sb6srx+$afk_sb6rrx;
                                        $totv=$afk_sb1rbv+$afk_sb1sbv+$afk_sb1srv+$afk_sb1rrv+$afk_sb2rbv+$afk_sb2sbv+$afk_sb2srv+$afk_sb2rrv+$afk_sb3rbv+$afk_sb3sbv+$afk_sb3srv+$afk_sb3rrv+$afk_sb4rbv+$afk_sb4sbv+$afk_sb4srv+$afk_sb4rrv+$afk_sb5rbv+$afk_sb5sbv+$afk_sb5srv+$afk_sb5rrv+$afk_sb6rbv+$afk_sb6sbv+$afk_sb6srv+$afk_sb6rrv;
                                        $totz=$afk_sb1rbz+$afk_sb1sbz+$afk_sb1srz+$afk_sb1rrz+$afk_sb2rbz+$afk_sb2sbz+$afk_sb2srz+$afk_sb2rrz+$afk_sb3rbz+$afk_sb3sbz+$afk_sb3srz+$afk_sb3rrz+$afk_sb4rbz+$afk_sb4sbz+$afk_sb4srz+$afk_sb4rrz+$afk_sb5rbz+$afk_sb5sbz+$afk_sb5srz+$afk_sb5rrz+$afk_sb6rbz+$afk_sb6sbz+$afk_sb6srz+$afk_sb6rrz;

                                        $totx1=$afk_sb1rbx+$afk_sb1sbx+$afk_sb1srx+$afk_sb1rrx;
                                        $totv1=$afk_sb1rbv+$afk_sb1sbv+$afk_sb1srv+$afk_sb1rrv;
                                        $totz1=$afk_sb1rbz+$afk_sb1sbz+$afk_sb1srz+$afk_sb1rrz;

                                        $totx2=$afk_sb2rbx+$afk_sb2sbx+$afk_sb2srx+$afk_sb2rrx;
                                        $totv2=$afk_sb2rbv+$afk_sb2sbv+$afk_sb2srv+$afk_sb2rrv;
                                        $totz2=$afk_sb2rbz+$afk_sb2sbz+$afk_sb2srz+$afk_sb2rrz;

                                        $totx3=$afk_sb3rbx+$afk_sb3sbx+$afk_sb3srx+$afk_sb3rrx;
                                        $totv3=$afk_sb3rbv+$afk_sb3sbv+$afk_sb3srv+$afk_sb3rrv;
                                        $totz3=$afk_sb3rbz+$afk_sb3sbz+$afk_sb3srz+$afk_sb3rrz;

                                        $totx4=$afk_sb4rbx+$afk_sb4sbx+$afk_sb4srx+$afk_sb4rrx;
                                        $totv4=$afk_sb4rbv+$afk_sb4sbv+$afk_sb4srv+$afk_sb4rrv;
                                        $totz4=$afk_sb4rbz+$afk_sb4sbz+$afk_sb4srz+$afk_sb4rrz;

                                        $totx5=$afk_sb5rbx+$afk_sb5sbx+$afk_sb5srx+$afk_sb5rrx;
                                        $totv5=$afk_sb5rbv+$afk_sb5sbv+$afk_sb5srv+$afk_sb5rrv;
                                        $totz5=$afk_sb5rbz+$afk_sb5sbz+$afk_sb5srz+$afk_sb5rrz;

                                        $totx6=$afk_sb6rbx+$afk_sb6sbx+$afk_sb6srx+$afk_sb6rrx;
                                        $totv6=$afk_sb6rbv+$afk_sb6sbv+$afk_sb6srv+$afk_sb6rrv;
                                        $totz6=$afk_sb6rbz+$afk_sb6sbz+$afk_sb6srz+$afk_sb6rrz;

                                        $totREJEALL1x=$totREJEALL1x+$totx1;
                                        $totREJEALL1v=$totREJEALL1v+$totv1;
                                        $totREJEALL1z=$totREJEALL1z+$totz1;

                                        $totREJEALL2x=$totREJEALL2x+$totx2;
                                        $totREJEALL2v=$totREJEALL2v+$totv2;
                                        $totREJEALL2z=$totREJEALL2z+$totz2;

                                        $totREJEALL3x=$totREJEALL3x+$totx3;
                                        $totREJEALL3v=$totREJEALL3v+$totv3;
                                        $totREJEALL3z=$totREJEALL3z+$totz3;

                                        $totREJEALL4x=$totREJEALL4x+$totx4;
                                        $totREJEALL4v=$totREJEALL4v+$totv4;
                                        $totREJEALL4z=$totREJEALL4z+$totz4;

                                        $totREJEALL5x=$totREJEALL5x+$totx5;
                                        $totREJEALL5v=$totREJEALL5v+$totv5;
                                        $totREJEALL5z=$totREJEALL5z+$totz5;

                                        $totREJEALL6x=$totREJEALL6x+$totx6;
                                        $totREJEALL6v=$totREJEALL6v+$totv6;
                                        $totREJEALL6z=$totREJEALL6z+$totz6;

						
                                      
                                        echo "X = ".$totx."<br>" ;
                                        echo "V = ".$totv."<br>" ;
                                        echo "Z = ".$totz."<br>" ;
                                        
                                        ?>
                                    </td>  
                                </tr>
                            <?php 
                            $alltotrejectx=$alltotrejectx+$totx;
                            $alltotrejectv=$alltotrejectv+$totv;
                            $alltotrejectz=$alltotrejectz+$totz;
                        }  ?>
                        </tbody>
                        <tfooter class="tfoot-light">
                      
                        <tr>
                        <th class="text-center">Total All</th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                        <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$totRB1x."</u><br>" ;
                                        echo "V <br> &darr; <br> <u>".$totRB1v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$totRB1z."</u><br>" ;?></th>
                            <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$totSB1x."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$totSB1v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$totSB1z."</u><br>" ;?></th>
                            <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$a1x."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$a1v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$a1z."</u><br>" ;?></th>
                            <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$totSR1x."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$totSR1v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$totSR1z."</u><br>" ;?></th>
                            <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$totRR1x."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$totRR1v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$totRR1z."</u><br>" ;?></th>
                            <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$totREJEALL1x."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$totREJEALL1v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$totREJEALL1z."</u><br>" ;?></th>
                              <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$totRB2x."</u><br>" ;
                                        echo "V <br> &darr; <br> <u>".$totRB2v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$totRB2z."</u><br>" ;?></th>
                            <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$totSB2x."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$totSB2v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$totSB2z."</u><br>" ;?></th>
                            <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$a2x."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$a2v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$a2z."</u><br>" ;?></th>
                            <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$totSR2x."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$totSR2v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$totSR2z."</u><br>" ;?></th>
                            <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$totRR2x."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$totRR2v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$totRR2z."</u><br>" ;?></th>
                            <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$totREJEALL2x."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$totREJEALL2v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$totREJEALL2z."</u><br>" ;?></th>
                             <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$totRB3x."</u><br>" ;
                                        echo "V <br> &darr; <br> <u>".$totRB3v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$totRB3z."</u><br>" ;?></th>
                            <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$totSB3x."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$totSB3v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$totSB3z."</u><br>" ;?></th>
                            <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$a3x."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$a3v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$a3z."</u><br>" ;?></th>
                            <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$totSR3x."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$totSR3v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$totSR3z."</u><br>" ;?></th>
                            <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$totRR3x."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$totRR3v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$totRR3z."</u><br>" ;?></th>
                            <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$totREJEALL3x."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$totREJEALL3v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$totREJEALL3z."</u><br>" ;?></th>
                             <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$totRB4x."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$totRB4v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$totRB4z."</u><br>" ;?></th>
                            <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$totSB4x."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$totSB4v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$totSB4z."</u><br>" ;?></th>
                            <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$a4x."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$a4v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$a4z."</u><br>" ;?></th>
                            <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$totSR4x."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$totSR4v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$totSR4z."</u><br>" ;?></th>
                            <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$totRR4x."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$totRR4v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$totRR4z."</u><br>" ;?></th>
                            <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$totREJEALL4x."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$totREJEALL4v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$totREJEALL4z."</u><br>" ;?></th>
                             <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$totRB5x."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$totRB5v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$totRB5z."</u><br>" ;?></th>
                            <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$totSB5x."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$totSB5v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$totSB5z."</u><br>" ;?></th>
                            <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$a5x."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$a5v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$a5z."</u><br>" ;?></th>
                            <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$totSR5x."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$totSR5v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$totSR5z."</u><br>" ;?></th>
                            <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$totRR5x."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$totRR5v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$totRR5z."</u><br>" ;?></th>
                            <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$totREJEALL5x."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$totREJEALL5v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$totREJEALL5z."</u><br>" ;?></th>
                            <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$totRB6x."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$totRB6v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$totRB6z."</u><br>" ;?></th>
                            <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$totSB6x."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$totSB6v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$totSB6z."</u><br>" ;?></th>
                            <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$a6x."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$a6v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$a6z."</u><br>" ;?></th>
                            <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$totSR6x."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$totSR6v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$totSR6z."</u><br>" ;?></th>
                            <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$totRR6x."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$totRR6v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$totRR6z."</u><br>" ;?></th>
                            <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$totREJEALL6x."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$totREJEALL6v."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$totREJEALL6z."</u><br>" ;?></th>
                             <th class="text-center"><?php 
                                        echo "X <br> &darr; <br><u>".$alltotrejectx."</u><br>" ;
                                        echo "V <br> &darr; <br><u>".$alltotrejectv."</u><br>" ;
                                        echo "Z <br> &darr; <br><u>".$alltotrejectz."</u><br>" ;?></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                            </div>
            </div>
        </div><!-- end col -->
    </div><!-- end row -->
</div> <!-- container -->

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