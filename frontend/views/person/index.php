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
    <div id = "due_time"><h4><p class="text-center">预产日期：2018年02月08日</p><h4></div>
    <div><img src="../image/avatar.jpeg" alt="here is avatar" style = "whdth:100px;height:100px" class="img-circle center-block"></div>
    <div><p class="text-center">hello <span>Lina</span></p></div>
    <div><h4><p  class="text-center">孕十周+4天</p></h4></div>
    </div>
</div>
<div id = "nutrition">
    <div class="panel panel-default">
      <div class="panel-heading">营养要点</div>
      <div class="panel-body">
       补叶酸，同时要保证充足的热量和优质蛋白质的供给，还要摄入充足的无机盐、微量元素和适量的维生素，如钙、铁、锌铜、碘及维生素A、维生素D等。
      </div>
    </div>
</div>
<div id ="recipe">
  <div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">推荐食谱</div>
    <div class="media recipe-item">
          <div class="media-left">
              <img class="media-object" style="width:100px;height:100px" src="../image/food/2.jpg" alt="...">
          </div>
          <div class="media-body">
            <h4 class="media-heading">西兰花拌木耳</h4>
            <span class="label label-default">富含纤维</span>
            <span class="label label-default">富含维生素A</span>
            <span class="label label-default">富含维生素C</span>
          </div>
        </div>
        <div class="media recipe-item">
          <div class="media-left">
              <img class="media-object" style="width:100px;height:100px" src="../image/food/1-172.jpg" alt="...">
          </div>
          <div class="media-body">
            <h4 class="media-heading">姜汁菠菜</h4>
            <span class="label label-default">富含纤维</span>
            <span class="label label-default">富含维生素A</span>
            <span class="label label-default">富含维生素C</span>
          </div>
        </div>

    </div>
</div>