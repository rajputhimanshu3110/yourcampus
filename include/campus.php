<div class="accordion accordion-flush" id="accordionFlushExample">

<?php 

  $data = course_view();
  while($row = mysqli_fetch_array($data)){
    $id = $row['course_id'];
    $name = $row['name'];
    $target = randToken(5);


?>

  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $target; ?>" aria-expanded="false" aria-controls="flush-collapseOne">
        <?php echo $name; ?>
      </button>
    </h2>
    <div id="<?php echo $target; ?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
<?php 
        $query = "SELECT * FROM semester WHERE course_id = '$id'";
        $res = mysqli_query($connection, $query);

        confirmQuery($res);
while($row = mysqli_fetch_array($res)){
$sname = $row['name'];
$bst = randToken(4);
echo "<button class='btn btn-sm' data-bs-toggle='collapse'  data-bs-target='#{$bst}'>Sem {$sname}</button>";




echo '<div class="collapse" id="'. $bst.'">
  <div class="card card-body">
  <ul>';
    $query = "SELECT * FROM subject WHERE  course = '$id' && sem = '$sname'";
    $res1 = mysqli_query($connection, $query);
    confirmQuery($res1);

    while ($row1 = mysqli_fetch_array($res1)) {
      $subject = $row1['subject'];
      $alias = $row1['alias'];
      $sid = $row1['id'];
      echo "<li><a href='subject.php?id={$sid}' class='btn btn-sm'>{$alias} - {$subject}</a></li>";
    }
    if (mysqli_num_rows($res1)==0) {
      echo 'No record Found';    }
 echo '</ul></div>
</div>';
 } ?>
      </div>
    </div>
  </div>

<?php  } ?>
  </div>




