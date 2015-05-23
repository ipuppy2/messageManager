/**
 * 加载图片
 * @param  {[type]} obj [description]
 * @return {[type]}     [description]
 */
function loadImg(mixSelect){

	function Load(mixSelect){
		// this._oImg=new Image();
		this._complete='';
		this._eachData=$(mixSelect).toArray(); // 循环它
		this._beforeLoad=''; // 加载前执行的方法
		this._getSrc=''; // 这个方法返回要加载的图片的地址
		
	}

	Load.prototype={
		toLoad : function (obj){
			this._complete=typeof obj.complete=='function'?obj.complete:false; // 如果有回调函数
			
			this._beforeLoad=typeof obj.beforeLoad=='function'? obj.beforeLoad:false;

			this._getSrc=obj.getSrc; // 返回要加载的地址
			
			// 在这里加载图片
			this._eachImg();
			
		},

		/**
		 * 在这里循环选择器获取的元素
		 * @return {[type]} [description]
		 */
		_eachImg : function (){
			var oThis=this,oImg;
			for(var i=0,iLen=this._eachData.length;i<iLen;i++){
				oImg=new Image();
				
				// 加载前执行的方法
				this._beforeLoad && this._beforeLoad.call(this._eachData[i],i);

				// 加载的地址
				oImg.src=this._getSrc.call(this._eachData[i],i);
				
				document.all?
					(function (iIndex){
							// ie
						oImg.onreadystatechange=function (){
							if('complete'==this.readyState){
								oThis._complete && oThis._complete.call(oThis._eachData[iIndex],this,iIndex);
							}
						}
					})((function (i){return i;})(i))
				:
					// ff
					(function (iIndex){
						oImg.onload=function (){
							if(true==this.complete){
								oThis._complete && oThis._complete.call(oThis._eachData[iIndex],this,iIndex);
							}
						}
					})((function (i){return i;})(i));
			}
		}
	}

	return new Load(mixSelect);
}