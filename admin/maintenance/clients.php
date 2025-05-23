<?php if ($_settings->chk_flashdata('success')) : ?>
	<script>
		alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
	</script>
<?php endif; ?>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">List of Clients</h3>
		<div class="card-tools">
			<a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-sm btn-primary bg-navy border-0"><span class="fas fa-plus"></span> Create New</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
			<div class="table-responsive">
				<table class="table table-hovered table-striped">
					<colgroup>
						<col width="5%">
						<col width="10%">
						<col width="20%">
						<col width="30%">
						<col width="15%">
						<col width="10%">
						<col width="10%">
					</colgroup>
					<thead>
						<tr class="bg-navy disabled">
							<th>#</th>
							<th>Client ID</th>
							<th>Date Created</th>
							<th>Name</th>
							<th>Contact</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						$qry = $conn->query("SELECT * from `clients`  order by `firstname` asc ");
						while ($row = $qry->fetch_assoc()) :
						?>
							<tr>
								<td class="text-center"><a href="?page=maintenance/clientdetails&id=<?php echo $row['id'] ?>"><?php echo $i++ ?></a></td>
								<td class="text-center"><a href="?page=maintenance/clientdetails&id=<?php echo $row['id'] ?>"><?php echo $row['id'] ?></a></td>
								<td><?php echo date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
								<td><?php echo $row['firstname'] ?>&nbsp;<?php echo $row['lastname'] ?></td>
								<td><?php echo $row['contact'] ?></td>
								<td class="text-center">
									<?php if ($row['status'] == 0) : ?>
										<span class="badge rounded-pill badge-success">Active</span>
									<?php else : ?>
										<span class="badge rounded-pill badge-danger">Inactive</span>
									<?php endif; ?>
								</td>
								<td align="center">
									<button type="button" class="btn btn-sm btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
										Action
										<span class="sr-only">Toggle Dropdown</span>
									</button>
									<div class="dropdown-menu" role="menu">
										<a class="dropdown-item" href="?page=maintenance/clientdetails&id=<?php echo $row['id'] ?>" target="_blank"><span class="fa fa-eye text-dark"></span> View</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item edit_client" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
										<!-- <div class="dropdown-divider"></div>
										<a class="dropdown-item delete_client" href="javascript:void(0)" data-id="<?php //echo $row['id'] 
																													?>"><span class="fa fa-trash text-danger"></span> Delete</a> -->
									</div>
								</td>
							</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#create_new').click(function() {
			uni_modal("<i class='fa fa-plus'></i> Add New Client", 'maintenance/manage_client.php')
		})
		$('.edit_client').click(function() {
			uni_modal("<i class='fa fa-edit'></i> Edit Client's Details", 'maintenance/manage_client.php?id=' + $(this).attr('data-id'))
		})
		$('.delete_client').click(function() {
			_conf("Are you sure to delete this client permanently?", "delete_client", [$(this).attr('data-id')])
		})
		$('.table td,.table th').addClass('px-2 py-1')
		$('.table').dataTable({
			columnDefs: [{
				targets: [3, 4],
				orderable: false
			}],
			initComplete: function(settings, json) {
				$('.table td,.table th').addClass('px-2 py-1')
			}
		});
	})

	function delete_client($id) {
		start_loader();
		$.ajax({
			url: _base_url_ + "classes/Master.php?f=delete_client",
			method: "POST",
			data: {
				id: $id
			},
			dataType: "json",
			error: err => {
				console.log(err)
				alert_toast("An error occured.", 'error');
				end_loader();
			},
			success: function(resp) {
				if (typeof resp == 'object' && resp.status == 'success') {
					location.reload();
				} else {
					alert_toast("An error occured.", 'error');
					end_loader();
				}
			}
		})
	}
</script>