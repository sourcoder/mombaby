<?php

/* @var $this yii\web\View */

$this->title = '饮食助手';
$this->registerJsFile('@web/js/swiper.min.js',['position'=>\yii\web\View::POS_HEAD]);
$this->registerJsFile('@web/js/jquery-1.10.1.min.js',['position'=>\yii\web\View::POS_HEAD]);
?>
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
	width:3rem;
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
</style>
<script type="text/javascript">
	function showHide()
	{
		document.getElementById("nutrition-text-hide").style.display="inline";
		document.getElementById("nutrition-more").style.display="inline";
	}
</script>
<div id="topNav" class="swiper-container swiper-container-horizontal swiper-container-free-mode">
  <div class="swiper-wrapper" style="transition-duration: 300ms; transform: translate3d(0px, 0px, 0px);">
    <div class="swiper-slide swiper-slide-active"><span>推荐</span></div>
    <div class="swiper-slide swiper-slide-next"><span>热点</span></div>
    <div class="swiper-slide"><span>深圳</span></div>
    <div class="swiper-slide"><span>视频</span></div>
    <div class="swiper-slide"><span>社会</span></div>
    <div class="swiper-slide"><span>娱乐</span></div>
    <div class="swiper-slide"><span>科技</span></div>
    <div class="swiper-slide"><span>问答</span></div>
    <div class="swiper-slide"><span>汽车</span></div>
    <div class="swiper-slide"><span>财经</span></div>
    <div class="swiper-slide"><span>军事</span></div>
    <div class="swiper-slide"><span>体育</span></div>
    <div class="swiper-slide"><span>段子</span></div>
    <div class="swiper-slide"><span>美女</span></div>
    <div class="swiper-slide"><span>国际</span></div>
    <div class="swiper-slide active"><span>趣图</span></div>
    <div class="swiper-slide"><span>健康</span></div>
    <div class="swiper-slide"><span>特产</span></div>
    <div class="swiper-slide"><span>房产</span></div>
  </div>
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
    <div class="nutrition">
    		<div class="nutrition-text-show" >第一步：准备食材。大米适量、羊肉300克、土豆2个、胡萝卜1个、洋葱半个、姜葱适量。
            </div>
            <div class="nutrition-text-hide" id="nutrition-text-hide">第二步：提前将羊肉浸泡1个小时，中间换两次水。（这一步可以去除羊肉的膻味。当然，喜欢羊膻味的朋友，可以省去这一步。）
    第三步：将羊肉剔除筋膜，然后切成1.5厘米大小的块。接下来把羊肉放入一个大碗中，依次放入少许葱末、姜丝、1勺料酒、1勺生抽、1勺老抽，抓匀后腌制20分钟备用。
    第四步：将土豆切块、胡萝卜切块、洋葱切丝备用。
    第五步：锅中倒少许底油，油热后将羊肉放入锅中煸炒至变色。
    第六步：将洋葱放入锅中煸炒出香味。
    第七步：将土豆、胡萝卜放入锅中煸炒匀均。
    第八步：往锅中放入3勺盐、1勺老抽、少半勺白胡椒粉调味，翻炒匀均后即可关火。
    第九步：把米淘洗干净，然后放入少量的水。（水的量比平时蒸饭的量稍少一点）
    第十步：将锅里所有炒好的菜一起倒入电饭锅中，然后盖好盖儿，选择焖饭功能即可。
    第十一步：米饭焖好后翻拌匀均即可盛出开动啦。
            </div>
    		<div class="nutrition-more" id="nutrition-more" onclick="showHide()">更多</div>
    	</div>