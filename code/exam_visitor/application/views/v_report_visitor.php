<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Exam Visit</title>

	<!-- Custom fonts for this template -->
	<link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link
		href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
		rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">

	<!-- Custom styles for this page -->
	<link  href="../../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">
	<!-- Page Wrapper -->
	<div id="wrapper">

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">
				<!-- End of Topbar -->

				<!-- Begin Page Content -->
				<div class="container-fluid">
					<div class="card shadow mb-4">
                                <!-- Card Header - Accordion -->
						<a href="#collapseCardExample" class="d-block card-header py-3 collapsed" data-toggle="collapse"
							role="button" aria-expanded="false" aria-controls="collapseCardExample">
							<h6 class="m-0 font-weight-bold text-primary">ค้นหาข้อมูล</h6>
						</a>
						<!-- Card Content - Collapse -->
						<div class="collapse" id="collapseCardExample">
							<div class="card-body">
								<div>
									<div class="card-body">
										<form action="report_visitor" method="post" >
										<div class="row">
										<div class="col-lg-3">
										</div>
										<div class="col-lg-8">
											<div class="form-group row">
												<label class="col-sm-12 col-lg-2">วันที่ : </label>
												<div class="col-sm-12 col-lg-3">
												<input type="date" class="form-control" name="date_start" value="<?php echo $date_start;?>">
												</div>
												<label for="datepicker" class="col-sm-12 col-lg-2">ถึง </label>
												<div class="col-sm-12 col-lg-3">
												<input type="date" class="form-control" name="date_end" value="<?php echo $date_end;?>">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-12 col-lg-2">เว็บไซต์ : </label>
												<div class="col-sm-12 col-lg-3">
												<input type="text" class="form-control" name="website" value="<?php echo $website;?>">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-12 col-lg-2">เส้นทาง : </label>
												<div class="col-sm-12 col-lg-3">
												<input type="text" class="form-control" name="path" value="<?php echo $path;?>">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-12 col-lg-2">ip address : </label>
												<div class="col-sm-12 col-lg-3">
												<input type="text" class="form-control" name="ipaddress" value="<?php echo $ipaddress;?>">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-12 col-lg-2">ระบบปฏิบัติการ : </label>
												<div class="col-sm-12 col-lg-3">
										<?php
											if($rs_platform->num_rows() > 0){
												foreach($rs_platform->result() as $pf_key=>$pf){
										?>
												<p><input type="checkbox" value="<?php echo $pf->vist_platform;?>" id="pf<?php echo $pf_key;?>" name="platform[]" <?php echo in_array($pf->vist_platform, $platform) ? "checked" : "";?>><label for="pf<?php echo $pf_key;?>"><?php echo $pf->vist_platform;?></label></p>
										<?php
												}
											}
										?>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-12 col-lg-2">บราวเซอร์ : </label>
												<div class="col-sm-12 col-lg-3">
										<?php
											if($rs_brand->num_rows() > 0){
												foreach($rs_brand->result() as $b_key=>$bnd){
										?>
												<p><input type="checkbox" value="<?php echo $bnd->vist_brand;?>" id="brand<?php echo $b_key;?>" name="brand[]" <?php echo in_array($bnd->vist_brand, $brand) ? "checked" : "";?>><label for="brand<?php echo $b_key;?>"><?php echo $bnd->vist_brand;?></label></p>
										<?php
												}
											}
										?>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-12 col-lg-2">MOBILE : </label>
												<div class="col-sm-12 col-lg-3">
												<p><input type="radio" id="is_mobile" name="is_mobile" value="Y" <?php echo $is_mobile=="Y" ? "checked" : "";?>><label for="is_mobile">เป็นอุปกรณ์พกพา</label></p>
												<p><input type="radio" id="not_mobile" name="is_mobile" value="N" <?php echo $is_mobile=="N" ? "checked" : "";?>><label for="not_mobile">ไม่เป็นอุปกรณ์พกพา</label></p>
												<p><input type="radio" id="all" name="is_mobile" value="A" <?php echo $is_mobile=="A" ? "checked" : "";?>><label for="all">ทั้งหมด</label></p>
												</div>
											</div>
											<div class="form-group row">
												<input type="submit" value="ค้นหา" class="btn btn-primary pull-right">
											</div>
										</div>
										</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
						<div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">ประวัติการเยื่ยมชมเว็บไซต์</h6>
                                </div>
						<!-- Card Content - Collapse -->
						<div class="collapse show">
							<div class="card-body">

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>ลำดับ</th>
											<th>วันที่</th>
											<th>เว็บไซต์</th>
											<th>เส้นทาง</th>
											<th>ip address</th>
											<th>ระบบปฏิบัติการ</th>
											<th>บราวเซอร์</th>
											<th>อุปกรณ์พกพา</th>
										</tr>
									</thead>
									<tbody>
				<?php
					if($rs_data->num_rows() > 0){
						$i = 0;
						foreach($rs_data->result() as $row){
				?>
										<tr>
											<td><center><?php echo ++$i;?></center></td>
											<td><?php echo $row->vist_timestamp;?></td>
											<td><?php echo $row->vist_hostname;?></td>
											<td><?php echo $row->vist_pathname;?></td>
											<td><?php echo $row->vist_ip_address;?></td>
											<td><?php echo $row->vist_platform;?></td>
											<td><?php echo $row->vist_brand;?></td>
											<td><?php echo $row->vist_is_mobile == "Y" ? "YES" : "NO";?></td>
										</tr>
				<?php
						}
					}else{
						echo "<tr><td colspan='8'><center>ไม่พบข้อมูล</center></td></tr>";
					}
				?>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>			
								
							</div>
						</div>
					</div>
					<!-- Page Heading -->
				</div>
				<!-- /.container-fluid -->

			</div>
			<!-- End of Main Content -->

			<!-- Footer -->
			<footer class="sticky-footer bg-white">
				<div class="container my-auto">
					<div class="copyright text-center my-auto">
						<span>Copyright &copy; Your Website 2020</span>
					</div>
				</div>
			</footer>
			<!-- End of Footer -->

		</div>
		<!-- End of Content Wrapper -->

	</div>
	<!-- End of Page Wrapper -->

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

	<!-- Logout Modal-->
	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
					<a class="btn btn-primary" href="login.html">Logout</a>
				</div>
			</div>
		</div>
	</div>

	<!-- Bootstrap core JavaScript-->
	<script src="../../assets/vendor/jquery/jquery.min.js"></script>
	<script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="../../assets/js/sb-admin-2.min.js"></script>

	<!-- Page level plugins -->
	<script src="../../assets/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="../../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

	<!-- Page level custom scripts -->
	<script src="../../assets/js/demo/datatables-demo.js"></script>

</body>

</html>