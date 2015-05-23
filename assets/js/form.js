$(document).ready(function (){
	
	bindControlInputEvent();

	/**
	 * 解决 ff 下iframe 显示的问题
	 */
	var oIframe=$('iframe.upload-image-frame').each(function (){
		this.contentWindow.location.href=this.src;
	});


});

/**
 * 给 input.input-control 表单绑定某些公共的事件
 * 可传入一个参数:
 * 如果该为一个 对象,则是给该绑定事件,一般是用在动态创建有表单元素时;
 * 如果该参数不是一个对象,则是先对所有的input.input-control 的表单解绑事件,然后再绑定,
 * 这个情况一般用到异步删除有表单的元素时;
 * 如果不传入参数,则是给所有的 input.input-control 绑定事件
 * @return {[type]} [description]
 */
function bindControlInputEvent(){
	
	// input-control-wrap-public-no-style
	// input-placeholder-public-no-style
	// input-control-public-no-style

	// 如果有参数,说明是要给新的 input 对象绑定事件
	// 注意参数必须为一个 jQ 对象
	if(arguments.length){
		// 如果参数为一个对象,则直接使用对象
		// 
		var oControlInput=typeof arguments[0]=='object'?arguments[0]:$('.input-control-public-no-style').off('input.placeholder propertychange.placeholder focus.input_focus blur.input_blur');
	}else{
		// 先解绑事件
		var oControlInput=$('.input-control-public-no-style');
	}



	var oPlaceholder=$('.input-placeholder-public-no-style'), // 占位符
	oControlWrap=$('div.input-control-wrap-public-no-style'),
	iCurrentIndex;
	


	oInput=oControlInput.on('input.placeholder propertychange.placeholder',function (){
		// document.title=''==this.value?1:0;
		''==this.value?oPlaceholder.eq($(this).index('.input-control-public-no-style')).show():oPlaceholder.eq($(this).index('.input-control-public-no-style')).hide();
	}).on('focus.input_focus',function (){
		iCurrentIndex=$(this).index('.input-control-public-no-style');
		oControlWrap.eq(iCurrentIndex).addClass('on-focus-wrap'); // 外围
		oPlaceholder.eq(iCurrentIndex).addClass('on-focus-placeholder'); // 占位符

	}).on('blur.input_blur',function (){
		iCurrentIndex=$(this).index('.input-control-public-no-style');
		oControlWrap.eq(iCurrentIndex).removeClass('on-focus-wrap'); // 外围
		oPlaceholder.eq(iCurrentIndex).removeClass('on-focus-placeholder'); // 占位符
	});
}

/**
 * [ImageUploadList description]
 * @param {[type]} oOpt [description]
 */
function ImageUploadList(oOpt){

	this._sParentSelector=typeof oOpt.parentSelector=='undefined'?'.upload-image-list-wrap':oOpt.parentSelector; // 事件委托的元素

	this._oParent=$(this._sParentSelector);

	this.hideLayerWrap; // 遮罩
	this.imageBtnWrap; // 按钮的外围
	// this.isSetOpacityOnGetElement=true; // 在在获取元素的时候是否设置透明度

}

ImageUploadList.prototype={

	/**
	 * 获取元素
	 * @return {[type]} [description]
	 */
	getElement : function (){

		this.hideLayerWrap=$('div.image-hide-layer');
		this.imageBtnWrap=$('div.image-btn-wrap');

		// this.hideLayerWrap=$(this.hideLayerWrap.toArray());

		if(arguments.length==0 || true===arguments[0]){
			this.hideLayerWrap.css('opacity',0);
			this.imageBtnWrap.css('opacity',0);
		}

		// this.isSetOpacityOnGetElement=false;

		return this;
	},

	/**
	 * 当鼠标移入或移出图片时
	 * @return {[type]} [description]
	 */
	hoverImage : function (){

		var oThis=this,
		oLastBtnWrpa=$(),
		iHideLayerOpa=0.5, // 遮罩的透明度
		iCurrentIndex;
		this._oParent.on('mouseenter','li.image-has-loaded',function (){
			
			iCurrentIndex=$(this).index('li.signle-image-public-wrap-no-style-for-js'); // 获取当前的索引			
			oThis.hideLayerWrap.stop().show().animate({
				opacity:iHideLayerOpa
			}).eq(iCurrentIndex).stop().animate({
				opacity:0
			},{
				complete:function (){
					$(this).hide();
				}
			}).end(); // 获取遮罩
			// oThis.imageBtnWrap=$('div.image-btn-wrap').css('opacity',0); // 获取按钮的外围(这样做不好)

			// 上一个按钮的外围
			oLastBtnWrpa.stop().animate({
				opacity:0
			},{
				complete:function (){
					$(this).hide();
				}
			});

			// 当前的按钮外围
			oLastBtnWrpa=oThis.imageBtnWrap.eq(iCurrentIndex).stop().show().animate({
				opacity:1
			});
		}).on('mouseleave','li.image-has-loaded',function (){

			// 隐藏按钮的外围
			oThis.imageBtnWrap.eq(iCurrentIndex).stop().animate({
				opacity:0
			},{
				complete:function (){
					$(this).hide();
				}
			});

			// 隐藏所有的遮罩
			oThis.hideLayerWrap.stop().animate({opacity:0},{
				complete:function (){
					$(this).hide();
				}
			});
		});

		return this;
	},

	/**
	 * 删除图片
	 * @return {[type]} [description]
	 */
	deleteImage : function (){
		var oThis=this,iIndex;
		this._oParent.on('click.delete_img','a.image-delete-btn',function (){
			// alert(1);
			$('li.image-has-loaded').eq(iIndex=$(this).off('click.delete_img').index('a.image-delete-btn')).fadeOut(function (){
				// 在移除之前先触发一次鼠标移出图片的事件,目的是隐藏遮罩
				$(this).trigger('mouseleave').remove();
				oThis.afterDeleteImage(iIndex); // 移除该图片对应的元素
				// alert(oThis.hideLayerWrap.size());
			});;
		});

		return this;
	},

	/**
	 * 在添加一张图片后
	 * @param  {[type]} oLayer   [遮罩对象]
	 * @param  {[type]} oBtnWrap [按钮对象]
	 * @return {[type]}          [description]
	 */
	afterAddImage : function (oLayer,oBtnWrap){
		// alert(oLayer.size());
		// this.hideLayerWrap.add(oLayer.css('opacity',0));
		// this.imageBtnWrap.add(oBtnWrap.css('opacity',0));

		this.getElement(false);
		// alert(this.hideLayerWrap.size());
	},

	/**
	 * 在删除一张图片后
	 * @return {[type]} [description]
	 */
	afterDeleteImage : function (iIndex){
		var aHide=this.hideLayerWrap.toArray(),
		aBtnWrpa=this.imageBtnWrap.toArray();
		aHide.splice(iIndex,1); // 移除图片对应的元素
		aBtnWrpa.splice(iIndex,1); // 移除图片对应的元素
		
		// 保存移除后的元素
		this.hideLayerWrap=$(aHide);
		this.imageBtnWrap=$(aBtnWrpa);
	}
};
