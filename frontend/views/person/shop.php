<?php

/* @var $this yii\web\View */

$this->title = '商城';
$this->registerJsFile('@web/js/swiper.min.js',['position'=>\yii\web\View::POS_HEAD]);
$this->registerJsFile('@web/js/jquery-1.10.1.min.js',['position'=>\yii\web\View::POS_HEAD]);
//$this->registerCssFile('@web/css/swiper.min.css',['position'=>\yii\web\View::POS_HEAD]);
?>
<link href="/css/swiper.min.css" rel="stylesheet">
<style>
* {
	margin: 0;
	padding: 0;
}
#topNav {
	width: 100%;
	overflow: hidden;
	font: 16px/32px hiragino sans gb, microsoft yahei, simsun;
	border-bottom:1px solid #f8f8f8;
}
#topNav .swiper-slide {
	padding: 0 5px;
	letter-spacing:2px;
	width:3em;
	text-align:center;
}
#topNav .swiper-slide span{

	transition:all .3s ease;
	display:block;
}
#topNav .active span{
	transform:scale(1.1);
	color:#FF2D2D;
}
/*图片*/
#top img{
	width:100%;
	height:300px;
}
.shop-attr{
	line-height:15px;
	margin: 5%;
	whidth:90%;

}
.item-info{
	border-bottom-style:solid;
	border-bottom-color:#ddd;
	border-bottom-width:1px;
}

.bottom{
	height: 50px;
	width: 100%;
	font-size:23px;
	background-color:red;
/* 	position:abosolute; */
	margin-bottom: 100vh-100px;
	color:white;
	text-align:center;
	line-height:50px;
}

.item-detail{
	width:100%;
	padding:10px;
}
</style>
<style id="style-1-cropbar-clipper">/* Copyright 2014 Evernote Corporation. All rights reserved. */
.en-markup-crop-options {
    top: 18px !important;
    left: 50% !important;
    margin-left: -100px !important;
    width: 200px !important;
    border: 2px rgba(255,255,255,.38) solid !important;
    border-radius: 4px !important;
}

.en-markup-crop-options div div:first-of-type {
    margin-left: 0px !important;
}
.swiper-wrapper-top{
	font-size: 16px;
}
</style>
<script type="text/javascript">
	function showHide()
	{
		document.getElementById("nutrition-text-hide").style.display="inline";
		document.getElementById("nutrition-more").style.display="none";
	}
	function buy()
	{
		confirm("确定购买吗？");
	}
</script>
<div id="topNav" class="swiper-container swiper-container-horizontal swiper-container-free-mode">
  <div class="swiper-wrapper swiper-wrapper-top" style="transition-duration: 300ms; transform: translate3d(0px, 0px, 0px);">
    <div class="swiper-slide active swiper-slide-active" ><span>一月</span></div>
    <div class="swiper-slide swiper-slide-next"><span>二月</span></div>
    <div class="swiper-slide"><span>三月</span></div>
    <div class="swiper-slide"><span>四月</span></div>
    <div class="swiper-slide"><span>五月</span></div>
    <div class="swiper-slide"><span>六月</span></div>
    <div class="swiper-slide"><span>七月</span></div>
    <div class="swiper-slide"><span>八月</span></div>
    <div class="swiper-slide"><span>九月</span></div>
    <div class="swiper-slide"><span>十月</span></div>
    <div class="swiper-slide"><span>月子</span></div>
  </div>
</div>
</div>
<div id="top">
    <img src="../image/food/hezi2.jpg" class="img-responsive" alt="Responsive image">
</div>
<hr/>
<div class="item-info">
    <div class="row shop-attr">
      <div class="col-xs-6"><p class="text-left">孕月盒子</p></div>
      <div class="col-xs-6"><p class="text-left" style="color: red;font-size:22px;"><i>￥198.<span class="">00</span></i></p></div>
    </div>
</div>
<div class="item-detail text-left">
    <h4 class="text-center">一盒在手，营养全有。</h4>
    <p>主要功效：帮助孕期妈妈补充营养、调理身体。
                    根据孕妇怀孕的不同月份所需要的营养，制定不同的五谷食疗磨粉配方并配以各种健康小零食如各种坚果、牛乳片、自发式酸奶、酸角、果干、小饼干等。
                        针对不同怀孕月份可能出现的问题制作孕月手则小卡片。在包装上采用小袋分装，一次一袋简单方便。五谷磨粉食用方式多样可以直接冲饮，可以搭配牛奶、豆浆、粥食等。
    </p>
</div>
<div class="bottom" onclick="buy()">
    确认订购
</div>
<script type="text/javascript">
var mySwiper = new Swiper('#topNav', {
	freeMode: true,
	freeModeMomentumRatio: 0.5,
	slidesPerView: 'auto',

});

swiperWidth = mySwiper.container[0].clientWidth
maxTranslate = mySwiper.maxTranslate();
maxWidth = -maxTranslate + swiperWidth / 2

$(".swiper-container").on('touchstart', function(e) {
	e.preventDefault()
})

mySwiper.on('tap', function(swiper, e) {

//	e.preventDefault()

	slide = swiper.slides[swiper.clickedIndex]
	slideLeft = slide.offsetLeft
	slideWidth = slide.clientWidth
	slideCenter = slideLeft + slideWidth / 2
	// 被点击slide的中心点

	mySwiper.setWrapperTransition(300)

	if (slideCenter < swiperWidth / 2) {
		
		mySwiper.setWrapperTranslate(0)

	} else if (slideCenter > maxWidth) {
		
		mySwiper.setWrapperTranslate(maxTranslate)

	} else {

		nowTlanslate = slideCenter - swiperWidth / 2

		mySwiper.setWrapperTranslate(-nowTlanslate)

	}

	$("#topNav  .active").removeClass('active')

	$("#topNav .swiper-slide").eq(swiper.clickedIndex).addClass('active')

})
</script>
<div>
</div>