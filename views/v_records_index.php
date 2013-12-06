<table id="records" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Product</th>
      <th>Component</th>
      <th>Build Number</th>
      <th>Job Name</th>
      <th>Status</th>
      <th>Build Time</th>
      <th>Created</th>
    </tr>
  </thead>
  <tbody>

  <!-- loop through the records -->
  <?php foreach ($records as $row): ?>
    <tr>
      <td><?= $row['prod_name']; ?></td>
      <td><?= $row['comp_name']; ?></td>
      <td><?= $row['build_num']; ?></td>
      <td><?= $row['job_name']; ?></td>
      <td><?= $row['status']; ?></td>
      <td><?= $row['duration']; ?></td>
      <td><?= date("Y-m-d H:i:s", $row['created']); ?></td>
    </tr>
  <?php endforeach; ?>
  
  </tbody>
</table>