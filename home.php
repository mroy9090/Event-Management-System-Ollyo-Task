<?php
include('header.php');
include('db_conn.php');
?>

<div class="row">
     <div class="table-responsive">
          <table class="table table-bordered" id="searchresult">
               <thead>
                    <tr>
                         <th scope="col">No.</th>
                         <th scope="col">Event Name</th>
                         <th scope="col">Event Date</th>
                         <th scope="col">Event Time</th>
                         <th scope="col">Event Category</th>
                         <th scope="col">Venue</th>
                         <th scope="col">Event Descriuption</th>
                         <th scope="col">Event Ticket Price</th>
                         <th scope="col">Event Ticket Total</th>
                    </tr>
               </thead>
               <tbody>
                    <?php
                    if (isset($_POST['ascending'])) {
                         $count = 0;

                         if ($connect->connect_error) {
                              die("Connection failed: " . $conn->connect_error);
                         }
                         $query = "SELECT * FROM events ORDER BY event_name ";
                         if ($result = $connect->query($query)) {
                              if ($result->num_rows > 0) {
                                   while ($row = $result->fetch_assoc()) {
                                        $count++;
                                        echo "<tr>";
                                        echo "<td>{$count}</td>";
                                        echo "<td>{$row['event_name']}</td>";
                                        echo "<td>{$row['event_date']}</td>";
                                        echo "<td>{$row['event_time']}</td>";
                                        echo "<td>{$row['event_category']}</td>";
                                        echo "<td>{$row['venue_name']}</td>";
                                        echo "<td>{$row['event_decription']}</td>";
                                        echo "<td>{$row['event_ticket_price']}</td>";
                                        echo "<td>{$row['event_ticket_total']}</td>";
                                        echo "</tr>";
                                   }
                              }
                         }
                    } else if (isset($_POST['descending'])) {
                         $count = 0;

                         if ($connect->connect_error) {
                              die("Connection failed: " . $conn->connect_error);
                         }
                         $query = "SELECT * FROM events ORDER BY event_name ";
                         if ($result = $connect->query($query)) {
                              if ($result->num_rows > 0) {
                                   while ($row = $result->fetch_assoc()) {
                                        $count++;
                                        echo "<tr>";
                                        echo "<td>{$count}</td>";
                                        echo "<td>{$row['event_name']}</td>";
                                        echo "<td>{$row['event_date']}</td>";
                                        echo "<td>{$row['event_time']}</td>";
                                        echo "<td>{$row['event_category']}</td>";
                                        echo "<td>{$row['venue_name']}</td>";
                                        echo "<td>{$row['event_decription']}</td>";
                                        echo "<td>{$row['event_ticket_price']}</td>";
                                        echo "<td>{$row['event_ticket_total']}</td>";
                                        echo "</tr>";
                                   }
                              }
                         }
                    } else {
                         $count = 0;

                         if ($connect->connect_error) {
                              die("Connection failed: " . $conn->connect_error);
                         }
                         $query = "SELECT * FROM events";
                         if ($result = $connect->query($query)) {
                              if ($result->num_rows > 0) {
                                   while ($row = $result->fetch_assoc()) {
                                        $count++;
                                        echo "<tr>";
                                        echo "<td>{$count}</td>";
                                        echo "<td>{$row['event_name']}</td>";
                                        echo "<td>{$row['event_date']}</td>";
                                        echo "<td>{$row['event_time']}</td>";
                                        echo "<td>{$row['event_category']}</td>";
                                        echo "<td>{$row['venue_name']}</td>";
                                        echo "<td>{$row['event_decription']}</td>";
                                        echo "<td>{$row['event_ticket_price']}</td>";
                                        echo "<td>{$row['event_ticket_total']}</td>";
                                        echo "</tr>";
                                   }
                              }
                         }
                    }
                    ?>
               </tbody>
          </table>



     </div>

</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>


<?php

?>