<?php
$this->title = "详细做法";
?>
</div>
<style>
<!--

-->
.tag{
	width:100%;
	height:60px;
	background-color:pink;
}
.tag span{
	height:30px;
}
.food-attr{
	line-height:15px;
	margin: 5%;
	whidth:90%;
}
.food-intro{
	border-bottom-style:solid;
	border-bottom-width: 1px;
	border-color:#ddd;
}
img{
	max-width:100%;
}

.food-steps img{
	width:100%;
	max-width:320px;
	height:200px;
}
</style>
<div id="top">
    <img src="<?=$data['detail']?>" class="img-responsive" alt="Responsive image">
</div>
<div class="text-center food-intro">
    <h2><?php //echo $data['title']?></h2>
<!--     <div class = "tag"> -->
        <?php //foreach ($data['tags'] as $tag){?>
        <span class="label label-success"><?php //echo $tag?></span>
        <?php //}?>
<!--     </div> -->
<!--     <div class="row food-attr"> -->
<!--       <div class="col-xs-6"><p class="text-left">时间：30~60分钟</p></div> -->
<!--       <div class="col-xs-6"><p class="text-left">难度：30~60分钟</p></div> -->
<!--     </div> -->
</div>
<div>
<!--     <div class="panel panel-default"> -->
      <!-- Default panel contents -->
<!--       <div class="panel-heading text-center">用料</div> -->
      <!-- Table -->
<!--       <table class="table"> -->
<!--        <tr> -->
<!--            <td>排骨</td> -->
<!--            <td>500g</td> -->
<!--        </tr> -->
<!--        <tr> -->
<!--            <td>玉米</td> -->
<!--            <td>1根</td> -->
<!--        </tr> -->
<!--        <tr> -->
<!--            <td>香菇</td> -->
<!--            <td>100g</td> -->
<!--        </tr> -->
<!--        <tr> -->
<!--            <td>香菜</td> -->
<!--            <td>50g</td> -->
<!--        </tr> -->
<!--       </table> -->
<!--     </div> -->
<!-- </div> -->

<!-- <div class="food-steps"> -->
<!--     <div class="panel panel-default"> -->
      <!-- Default panel contents -->
<!--       <div class="panel-heading">步骤</div> -->
      <!-- List group -->
<!--       <ol class="list-group"> -->
<!--          <li class="list-group-item"> -->
<!--             <img src="" class="img-responsive" alt="Responsive image"> -->
<!--             <span>1.很多书科技活动可减少德鲁克说极度恐慌</span> -->
<!--          </li> -->
<!--       </ol> -->
<!-- </div> -->

<!-- <div class="food-steps"> -->
<!--     <div class="panel panel-default"> -->
      <!-- Default panel contents -->
<!--       <div class="panel-heading">步骤</div> -->
      <!-- List group -->
<!--       <ol class="list-group"> -->
         <?php// echo $data['detail']?>
<!--       </ol> -->
<!-- </div> -->
<!-- </div> -->