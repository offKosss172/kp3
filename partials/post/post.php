<?php
$sql = "SELECT * FROM `posts`";
	
if($result = $conn->query($sql)):
	foreach($result as $row):
		$categorySQL = "SELECT * FROM categories WHERE id=" . $row['category_id'];
		$categoryResult = $conn->query($categorySQL);
		$category = $categoryResult->fetch_assoc();
		
?>

<div class="col-md-4">
    <div class="blog-entry ftco-animate">
		<a href="#" class="img img-2" style="background-image: url(<?php echo $row['preview'];  ?>);"></a>
		<div class="text text-2 pt-2 mt-3">
		    <span class="category mb-3 d-block"><a href="#"><?php echo $category['title'] ?></a></span>
	        <h3 class="mb-4"><a href="#"><?php echo $row['title'];  ?></a></h3>
	        <p class="mb-4"><?php echo $row['description'];  ?></p>
			<div class="author mb-4 d-flex align-items-center">
	            		<a href="#" class="img" style="background-image: url(/assets/images/person_2.jpg);"></a>
	            		<div class="ml-3 info">
	            			<span>Written by</span>
	            			<h3><a href="#">Dave Lewis</a>, <span>Nov. 28, 2018</span></h3>
	            		</div>
	            	</div>
	<div class="meta-wrap align-items-center">
	    <div class="half order-md-last">
		    <p class="meta">
				<?php
					$likesSQL = 'SELECT count(*) as total FROM user_post_liks WHERE post_id=' . $row['id'];
					$likesResult = $conn->query($likesSQL);
					$likeUserResult = null;
					if(isset($_COOKIE['user'])) {
						$likeUserSQL = 'SELECT count(*) as total FROM user_post_liks WHERE post_id=' . $row['id'] . 'user_id=' . $_COOKIE['user'];
						$likeUserResult = $conn->query($likesSQL);
					}
				?>

		        <span class="likeBtn
				<?php if($likeUserResult->fetch_assoc()['total'] > 0) {
					echo "liked";
				}
				?>
				" data-id="<?php echo $row['id']; ?>"><i class="icon-heart"></i><b><?php echo $likesResult->fetch_assoc()['total']; ?></b></span>
		        <span><i class="icon-eye"></i>100</span>
		        <span><i class="icon-comment"></i>5</span>
		    </p>
	    </div>
	        <div class="half">
		        <p><a href="#" class="btn py-2">Continue Reading <span class="ion-ios-arrow-forward"></span></a></p>
	        </div>
	    </div>
	</div>
	</div>
</div>

<?php 
	endforeach;
endif;

?>

