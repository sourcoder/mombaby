<?php
$this->title = "个人推荐";
?>
<?php 

if( Yii::$app->getSession()->hasFlash('success') ) {
    echo Alert::widget([
        'options' => [
            'class' => 'alert-success', //这里是提示框的class
        ],
        'body' => Yii::$app->getSession()->getFlash('success'), //消息体
    ]);
}
?>
<style>
<!--

-->
.recipe{
	width:100%;
	height:100px;
}
.recipe-item{
	border-bottom-style:solid;
	border-bottom-width: 1px;
	border-color:#ddd;
}
</style>
<div id="head">
<?php 
//处理data中的日期问题
$due_date = $userinfo['due_date'];
$due_date = explode('-', $due_date);
?>
    <div id = "due_time"><h4><p class="text-center">预产日期：<?=$due_date[0]?>年<?=$due_date[1]?>月<?=$due_date[2]?>日</p><h4></div>
    <div><img src="<?=$userinfo['headimgurl']?>" alt="here is avatar" style = "whdth:100px;height:100px" class="img-circle center-block"></div>
    <div><p class="text-center">hello <span><?=$userinfo['nickname']?></span></p></div>
    <div><h4><p  class="text-center">孕<?=$userinfo['current_week']?>周</p></h4></div>
    </div>
</div>
<div id = "nutrition">
    <div class="panel panel-default">
      <div class="panel-heading">营养要点</div>
      <div class="panel-body">
       <?=$nuinfo['nutrition']?>
      </div>
    </div>
</div>
<div id ="recipe">
  <div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">推荐食谱</div>
  <?php foreach ($foods as $food){?>
    <div class="media recipe-item">
          <div class="media-left">
              <img class="media-object" style="width:100px;height:80px" src="<?=$food['image']?>" alt="...">
          </div>
          <div class="media-body">
            <a href = "food?id=<?=$food['id']?>">
              <h3 class="media-heading"><?=$food['title']?></h3>
            </a>
            <h4>
                <?php foreach ($food['tags'] as $tag){?>
                <span class="label label-success text-left" style="padding:3px;margin:5px"><?=$tag?></span>
                <?php }?>
            </h4>
          </div>
        </div>
    <?php }?>        
    </div>
</div>