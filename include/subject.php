
<?php
if (isset($_GET['id'])) {
	$id = $_GET['id'];
}else{
	redirect("campus.php");
}
	$query = "SELECT * FROM subject WHERE  id = '$id'";
    $res1 = mysqli_query($connection, $query);
    confirmQuery($res1);
    $row = mysqli_fetch_assoc($res1);
    $subject = $row['subject'];
    $alias = $row['alias'];
    $sem=$row['sem'];
    $course=$row['course'];
    $syllabus=$row['syllabus'];
    $handwritten=$row['handwritten'];
    $previousyear=$row['previousyear'];
    $quantum=$row['quantum'];
    $playlist=$row['playlist'];
    $views=$row['views'];
    $nw = $views+1;
    $upq = "UPDATE subject SET views=$nw WHERE id='$id'";
    $res = mysqli_query($connection,$upq);




?>
<h3 class="text-center pt-4"><?php echo $alias.' - '.$subject?></h3>
<hr>

<div style="float: right;"><a class="btn btn-secondary btn-sm"><?php echo $views?> views</a></div>
<div>
	
	<ul>
		<li>
			<h5><u>Syllabus</u></h5>
			<a href="<?php echo $syllabus;?>" target="_blank" class="btn btn-sm btn-warning">View/Download</a>
		</li>
		<li>
			<h5><u>Handwritten Notes</u></h5>
			<a href="<?php echo $handwritten;?>" target="_blank" class="btn btn-sm btn-warning">View/Download</a>
		</li>
		<li>
			<h5><u>Previous Year</u></h5>
			<a href="<?php echo $previousyear;?>" target="_blank" class="btn btn-sm btn-warning">View/Download</a>
		</li>
		<li>
			<h5><u>Quantum</u></h5>
			<a href="<?php echo $quantum;?>" target="_blank" class="btn btn-sm btn-warning">View/Download</a>
		</li>
		<li>
			<h5><u>Video Lectures</u></h5>
			<iframe width="100%" height="315" src="<?php echo $playlist;?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</li>
	</ul>

</div>