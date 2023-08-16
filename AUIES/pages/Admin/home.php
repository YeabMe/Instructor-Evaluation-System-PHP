<div class="content-wrapper">
	<div class="row mt-3">
		<div class="col-lg-8 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-lg-4">
							<h3 class="text-dark font-weight-bold mb-2">Welcome <?php echo $_SESSION['Aname']; ?>! </h3>
							<hr>
							<form action="" method="POST">
								<b><label>Allow students to update their section</label></b>

								<button class="btn btn-primary" type="submit" name="sub">Enable</button>
								<button class="btn btn-primary" type="submit" name="sub2">Disable</button>
							</form><br>
							<?php 
								if (isset($_POST['sub'])) {

									$update = mysqli_query($con, "UPDATE section_update SET sec_upd=1  WHERE No=0") or die(mysqli_error($con));
									
								} else if (isset($_POST['sub2'])) {
									$update = mysqli_query($con, "UPDATE section_update SET sec_upd=0  WHERE No=0") or die(mysqli_error($con));
									
								}
							?>
							<b>
								<?php

								

								$q = "select * from section_update";
								$r = mysqli_query($con, $q);
								$row = $r->fetch_assoc();

								if ($row['sec_upd'] == 1) {
									echo "Section Update on Student is Enabled";
								} else {
									echo "Section Update on Student is Disabled";
								}
								?>
							</b>


						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Welcome-Card -->
	<!-- Instructor-Card -->
	<div class="row">
		<div class="col-sm-4 flex-column d-flex stretch-card">
			<div class="row flex-grow">
				<div class="col-sm-12 grid-margin stretch-card">

					<div class="card-body">
						<div class="card sale-diffrence-border">
							<div class="card-body">
								<?php $sql = "select * from instructor";
								$result = mysqli_query($con, $sql);
								$count = mysqli_num_rows($result)
								?>
								<h2 class="text-dark mb-2 font-weight-bold"><?php echo $count; ?></h2>
								<h4 class="card-title mb-2">Instructor</h4>
								<small class="text-muted">Total</small>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- End Instructor-Card -->
		<!-- Student-Card -->
		<div class="col-sm-4 flex-column d-flex stretch-card">
			<div class="row flex-grow">
				<div class="col-sm-12 grid-margin stretch-card">

					<div class="card-body">
						<div class="card sale-diffrence-border">
							<div class="card-body">
								<?php $sql = "select * from student";
								$result = mysqli_query($con, $sql);
								$count = mysqli_num_rows($result)
								?>
								<h2 class="text-dark mb-2 font-weight-bold"><?php echo $count; ?></h2>
								<h4 class="card-title mb-2">Student</h4>
								<small class="text-muted">Total</small>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Student-Card -->


		<div class="col-sm-4 flex-column d-flex stretch-card">
			<div class="row flex-grow">
				<div class="col-sm-12 grid-margin stretch-card">

					<div class="card-body">
						<div class="card sale-diffrence-border">
							<div class="card-body">
								<?php $sql = "select * from head";
								$result = mysqli_query($con, $sql);
								$count = mysqli_num_rows($result)
								?>
								<h2 class="text-dark mb-2 font-weight-bold"><?php echo $count; ?></h2>
								<h4 class="card-title mb-2">Head</h4>
								<small class="text-muted">Total</small>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-4 flex-column d-flex stretch-card">
			<div class="row flex-grow">
				<div class="col-sm-12 grid-margin stretch-card">
					<div class="card-body">
						<div class="card sale-diffrence-border">
							<div class="card-body">
								<?php $sql = "select * from department";
								$result = mysqli_query($con, $sql);
								$count = mysqli_num_rows($result)
								?>
								<h2 class="text-dark mb-2 font-weight-bold"><?php echo $count; ?></h2>
								<h4 class="card-title mb-2">Department</h4>
								<small class="text-muted">Total</small>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Users-Card -->
		<div class="col-sm-4 flex-column d-flex stretch-card">
			<div class="row flex-grow">
				<div class="col-sm-12 grid-margin stretch-card">
					<div class="card-body">
						<div class="card sale-diffrence-border">
							<div class="card-body">
								<?php $sql = "select * from admins";
								$result = mysqli_query($con, $sql);
								$count = mysqli_num_rows($result)
								?>
								<h2 class="text-dark mb-2 font-weight-bold"><?php echo $count; ?></h2>
								<h4 class="card-title mb-2">Users</h4>
								<small class="text-muted">Total</small>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Users-Card -->
	</div>
</div>