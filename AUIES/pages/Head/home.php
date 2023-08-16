<div class="content-wrapper">
	<div class="row mt-3">
		<div class="col-lg-8 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-lg-4">
							<h3 class="text-dark font-weight-bold mb-2">Welcome <?php echo $_SESSION['Hname']; ?>! </h3>
							
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Welcome-Card -->
	<!-- section-Card -->
	<div class="row">
		<div class="col-sm-4 flex-column d-flex stretch-card">
			<div class="row flex-grow">
				<div class="col-sm-12 grid-margin stretch-card">

					<div class="card-body">
						<div class="card sale-diffrence-border">
							<div class="card-body">
								<?php
								$d = $_SESSION['Hd'];
								$sql = "select * from section where department='$d'";
								$result = mysqli_query($con, $sql);
								$count = mysqli_num_rows($result)
								?>
								<h2 class="text-dark mb-2 font-weight-bold"><?php echo $count; ?></h2>
								<h4 class="card-title mb-2">Section</h4>
								<small class="text-muted">Total</small>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End section-Card -->

		<!-- Course-Card -->
		<div class="col-sm-4 flex-column d-flex stretch-card">
			<div class="row flex-grow">
				<div class="col-sm-12 grid-margin stretch-card">

					<div class="card-body">
						<div class="card sale-diffrence-border">
							<div class="card-body">
								<?php
								$d = $_SESSION['Hd'];
								$sql = "select * from course where department='$d'";
								$result = mysqli_query($con, $sql);
								$count = mysqli_num_rows($result)
								?>
								<h2 class="text-dark mb-2 font-weight-bold"><?php echo $count; ?></h2>
								<h4 class="card-title mb-2">Course</h4>
								<small class="text-muted">Total</small>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Course-Card -->

	</div>
</div>