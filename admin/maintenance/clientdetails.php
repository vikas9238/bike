<?php require_once('../config.php');
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * from `clients` where id = '{$_GET['id']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
    }
}
?>

<!-- Main content -->
<section class="content  text-dark">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 table-responsive">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                First Name
                            </th>
                            <td>
                                <?php echo $firstname ?>
                            </td>
                            <th>
                                Last Name
                            </th>
                            <td>
                                <?php echo $lastname ?>
                            </td>

                        </tr>
                        <tr>
                            <th>
                                Contact
                            </th>
                            <td>
                                <?php echo $contact ?>
                            </td>
                            <th>
                                Email
                            </th>
                            <td>
                                <?php echo $email ?>
                            </td>

                        </tr>
                        <tr>
                            <th>
                                Address
                            </th>
                            <td>
                                <?php echo $address ?>
                            </td>
                            <th>
                                Gender
                            </th>
                            <td>
                                <?php echo $gender ?>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-block">
                    <div class="card-header">
                        <h3 class="card-title">Quotation Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <colgroup>
                                        <col width="8%">
                                        <col width="8%">
                                        <col width="18%">
                                        <col width="20%">
                                        <col width="20%">
                                        <col width="5%">
                                        <col width="5%">
                                        <col width="10%">
                                    </colgroup>
                                    <thead>
                                        <tr class="bg-navy disabled">
                                            <th>#</th>
                                            <th>Order ID</th>
                                            <th>Date Created</th>
                                            <th>Category</th>
                                            <th>Company</th>
                                            <th>Rent Days</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $qry = $conn->query("SELECT b.*,c.category, d.name,q.description from `rent_list` b inner join bike_list q on b.bike_id = q.id inner join categories c on q.category_id = c.id inner join brand_list d on q.brand_id = d.id where b.client_id = '{$_GET['id']}' order by unix_timestamp(b.date_created) desc");
                                        while ($row = $qry->fetch_assoc()) :
                                            foreach ($row as $k => $v) {
                                                $row[$k] = trim(stripslashes($v));
                                            }
                                            $row['description'] = strip_tags(stripslashes(html_entity_decode($row['description'])));
                                        ?>
                                            <tr>
                                                <td class="text-center"><?php echo $i++ ?></td>
                                                <td class="text-center">#<?php echo $row['id'] ?></td>
                                                <td><?php echo date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
                                                <td><?php echo $row['category'] ?></td>
                                                <td class="lh-1"> <?php echo $row['name'] ?></td>
                                                <td class="text-end"><?php echo number_format($row['rent_days']) ?></td>
                                                <td class="text-end"><?php echo number_format($row['amount']) ?></td>
                                                <td class="text-center">
                                                    <?php if ($row['status'] == 0) : ?>
                                                        <span class="badge badge-warning">Pending</span>
                                                    <?php elseif ($row['status'] == 1) : ?>
                                                        <span class="badge badge-primary">Confirmed</span>
                                                    <?php elseif ($row['status'] == 2) : ?>
                                                        <span class="badge badge-danger">Cancel</span>
                                                    <?php elseif ($row['status'] == 3) : ?>
                                                        <span class="badge badge-success">Picked Up</span>
                                                    <?php else : ?>
                                                        <span class="badge badge-success">Returned</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
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
</section>