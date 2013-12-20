<div class="container">
  <h4>Build Report: Builds by Status</h4>
    The following graph shows the number of builds by status, by date.  Green indicates a Stable build, yellow 
    indicates Unstable and red indicates a Failed build.

  <p>&nbsp;</p>

  <div class="row">
    <div id="graph"></div>
  </div>
  
  <script>
    // Get the data from the controller and convert to JSON
    var data = <?php echo json_encode($data); ?>;
  </script>
</div>
