jQuery(document).ready(function($) {
	var first_time_after_registration = $("#registration_completetion").val();
	var curren_location = window.location.href;
	var base_url = $('#base_url').val();
	var tracking_id = $("#tracking_id").val();
	var referal = $("#referal").val();
	var login_user_id = $("#login_user_id").val();
	var user_token = localStorage.getItem("token");
	if ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
		if (login_user_id == "" && user_token !== "") {
			$.ajax({
				url: base_url+'account/sign_in/token_sign_in',
				type: 'POST',
				data: {user_token:user_token},
			})
			.done(function(data) {
				console.log(data);
				var jsonresponse = JSON.parse(data);
			})
			.fail(function() {

			})
			.always(function() {

			});		
		}
	}
	
	var current_tracking_id = getParameterByName('tracking_id', curren_location);
	// var live_jancode = "live_jancode";
	// var url = new URL(curren_location);
	var lastPart = curren_location.split("/").pop();


	$('#happy_shopping').on('hidden.bs.modal', function (e) {
	  if (lastPart != 'live_jancode' && tracking_id !='' && current_tracking_id == null && referal =="") {
	  	window.location = base_url+'?tracking_id='+tracking_id;		
	  }else if (lastPart == 'live_jancode' && tracking_id !='' && current_tracking_id == null && referal =="") {
	  	window.location = base_url+'live_jancode?tracking_id='+tracking_id;
	  }
	})
	
	if (first_time_after_registration !="") {
		$("#happy_shopping").modal('show');
		return false;
	}
	
	if (lastPart != 'live_jancode' && tracking_id !='' && current_tracking_id == null && referal =="") {
		window.location = base_url+'?tracking_id='+tracking_id;		
	}else if (lastPart == 'live_jancode' && tracking_id !='' && current_tracking_id == null && referal =="") {
		window.location = base_url+'live_jancode?tracking_id='+tracking_id;
	}


	//setup before functions
	var typingTimer;                //timer identifier
	var doneTypingInterval = 2000;  //time in ms, 5 second for example
	if ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
		$(".voice_suggestion_screen").css({
			display: 'none'
		});
		$(".voice_suggestion_screen").removeClass('d-block').addClass('d-none');
	}
	var userAgent = navigator.userAgent.toLowerCase();
	if (userAgent.search(/iphone|ipad|ipod/) > -1) {
		$(".iphoneSpecial").css({
			position: 'fixed',
  			top: '0',
  			width: '99%'
		});
	}
	$("#product_keyword3").on('click', function (event) {
		if ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
			$("#itemsSearchModal").modal('show');
			$(".product_keyword3").val('');
			$(".recording-instructions").html('');
			$(".product_keyword3").focus();
			$('html, body').animate({
		        scrollTop: $(".container-fluid").offset().top
		    }, 500);
		}
	});

	// $(".product_keyword3").on('change', function (event) {
	// 	$("#product_keyword3").trigger('keyup');		
	// });
	if (userAgent.search(/iphone|ipad|ipod/) > -1) {
		$(".product_keyword3").on('change keyup', function (event) {
			// $(".product_keyword3").trigger('keyup');
			$("#product_keyword3").trigger('keyup');
			$("#product_keyword3").val($(this).val());
			if ($(this).val()=='') {
				$(".recording-instructions").html('');
			}
		});
	}else{
		$(".product_keyword3").on('keyup', function (event) {
			// $(".product_keyword3").trigger('keyup');
			$("#product_keyword3").trigger('keyup');
			$("#product_keyword3").val($(this).val());
			if ($(this).val()=='') {
				$(".recording-instructions").html('');
			}
		});
	}
	
	$("#product_keyword3").on('keyup', function (event) {
	// $("#product_keyword3").keyup(function(event) {
		event.preventDefault();
		var key = event.which;
		var keyword = $("#product_keyword3").val();
		if (key==13) {
			$("#product_keyword3").blur();
			var ua = navigator.userAgent.toLowerCase(); 
			var janCode = $("#product_keyword3").val();
			if (janCode!=="") {
				if (janCode.length==8) {
					janCode = "00000"+janCode
				}
				var can_product_search = $("#can_product_search").val();
				var base_url = $("#base_url").val();
				if (can_product_search == 1) {
					get_affiliate_products(janCode);
					// $.ajax({
					// 	url: base_url+'main_controller/get_yahoo_suggestion/',
					//  	type: 'post',
					//  	data: {
					//   		keyword: janCode
					//  	},
					//  	success: function( data ) {
					//  		get_affiliate_products(janCode);
					//  	},
					//  	error: function(data){
					//  		console.log(data);
					//  	}
					// });					
				}
			}
		}else{
			clearTimeout(typingTimer);
			  typingTimer = setTimeout(
			  	search_by_voice_keyword
			  	, doneTypingInterval);
		}
	});
	

	// function get_rakuten_roducts(barcode) {
	// 	var rakutenRes = {};
	// 	$.ajax({
	// 		url: 'https://app.rakuten.co.jp/services/api/IchibaItem/Search/20170706?applicationId=1020698445083246210&sort=%2BitemPrice&affiliateId=13cd26fa.6f864c06.13cd26fb.0eadff3c&keyword='+barcode,
	// 		type: 'GET'
	// 	})
	// 	.done(function(data) {			
	// 		if (data.count>0) {
	// 			rakutenRes = data;
	// 		}else{
	// 			$("#jan_product_name").html('商品を発見できません。');
	// 			$("#product_image").removeClass('d-block').addClass('d-none');
	// 		}
	// 		console.log('success');			
	// 	})
	// 	.fail(function() {
	// 		console.log("error");
	// 	})
	// 	.always(function() {
	// 		console.log("complete");
	// 	});
	// }
	
	var rakutenPromiz = function(barcode) {
	  return new Promise(function(resolve, reject) {
	    var rakutenRes = {};
	    console.log("Call Rakuten API");
	    var url = 'https://app.rakuten.co.jp/services/api/IchibaItem/Search/20170706?applicationId=1020698445083246210&sort=%2BitemPrice&trakingId=8484848884&hits=5&affiliateId=13cd26fa.6f864c06.13cd26fb.0eadff3c&keyword='+barcode;
	    console.log(url);
	    $.ajax({
	    	url: url,
	    	type: 'GET'
	    })
	    .done(function(data) {
	    	console.log("Rakuten Data");
	    	console.log(data);
	    	resolve(data);		
	    })
	    .fail(function(data) {
	    	console.log("error");
	    })
	    .always(function() {
	    	console.log("complete");
	    });
	   
	  });
	}

	var yahooPromiz = function(barcode) {
	  return new Promise(function(resolve, reject) {
	  	console.log("Call Yahoo API");
	    var yahooRes = {};
	    $.ajax({
	    	url: 'main_controller/yahoo_api/',
	    	type: 'POST',
	    	data: {barcode: barcode}
	    })
	    .done(function(data) {
	    	var yahoo_response = JSON.parse(data);
	    	// console.log(yahoo_response);
	    	resolve(yahoo_response);
	    })
	    .fail(function() {
	    	console.log("error");
	    })
	    .always(function() {

	    });	   
	  });
	}

	var amazonPromiz = function(barcode) {
	  return new Promise(function(resolve, reject) {
	  	console.log("Call Amazon API");
	    var response;
	    var amazonRes = {};
	    $.ajax({
	    	url: 'main_controller/get_amazon_by_api/',
	    	type: 'POST',
	    	data: {barcode: barcode}
	    })
	    .done(function(data) {
	    	// console.log(data);
	    	var dom = parseXml(data);
	    	var jsonData = xml2json(dom, "");
	    	var response = JSON.parse(jsonData);
	    	console.log(response);
	    	resolve(response);
	    })
	    .fail(function() {
	    	console.log("error");
	    })
	    .always(function() {
	    	
	    });	   
	  });
	}


	var amazon_affiliate_commission = 0;
	function get_affiliate_products(barcode) {
		console.log("Called Main Affiliate function");
		$('html, body').animate({
	        scrollTop: $(".compare_table_mobile").offset().top
	    }, 500);
		var var_obje = [];
		var rakuten_data, yahoo_response, rakuten_data;
		var rakutenRes = {};
		var yahooRes = {};
		var amazonRes = {};
		// var productName = "商品が見つかりません。";
		var productName = "該当商品が見つかりません。";
		var productImage = "#";
		var a = 0;
		var login_user_id = $("#login_user_id").val();
		$("#jan_product_name").html('<img src="resource/img/ajax/ajax-loader.gif">');
		$("#jan_product_name2").html('<img src="resource/img/ajax/ajax-loader.gif">');
		$(".product_loading_image").html('<img style=" margin-top: -500px;" align="center" src="resource/img/ajax/loading.gif">');
		$("#comparing_table").css('opacity', '0.4');
		$("#comparing_table_mobile").css('opacity', '0.4');
		$(".product_loading_image_mobile").html('<img style="" align="center" src="resource/img/ajax/Spinner-1s-200px.gif">');
		var amazonImage = null;
		amazonPromiz(barcode).then(function(data) {
			amazonResponse = data;
			console.log("Amazon Row Data");
			console.log(data);
			// alert(amazonResponse.ItemSearchResponse);
			// $("#product_image").html(productImage);
			$(".search_result").text('検索結果');
			$("#onchange_event").val(1);
			$(".product_image_parent").removeClass('d-none').addClass('d-block');
			if (typeof amazonResponse.ItemSearchResponse !== 'undefined' && typeof amazonResponse.ItemSearchResponse.Items.Item !== 'undefined') {
				var totalItems = amazonResponse.ItemSearchResponse.Items.Item.length;
				console.log(amazonResponse.ItemSearchResponse.Items);
				var minPrice = 100000000000;
				console.log(barcode);
				console.log(totalItems);
				// return false;
				if (typeof totalItems !=='undefined') {
					var itemPrice = 0;

					if (typeof amazonResponse.ItemSearchResponse.Items.Item[0].OfferSummary.LowestNewPrice !=='undefined') {
						itemPrice = parseInt(amazonResponse.ItemSearchResponse.Items.Item[0].OfferSummary.LowestNewPrice.Amount);
					}else{
						itemPrice = parseInt(amazonResponse.ItemSearchResponse.Items.Item[0].OfferSummary.LowestUsedPrice.Amount);
					}								
					
					productName = toASCII(amazonResponse.ItemSearchResponse.Items.Item[0].ItemAttributes.Title);
					
					var itemUrl = amazonResponse.ItemSearchResponse.Items.Item[0].DetailPageURL;
					var pricingUrl = amazonResponse.ItemSearchResponse.Items.Item[0].DetailPageURL;
					var lowest_price = itemPrice;
					var brsose_nodes = amazonResponse.ItemSearchResponse.Items.Item[0].BrowseNodes.BrowseNode;
					var small_image = "";
					if (typeof amazonResponse.ItemSearchResponse.Items.Item[0].SmallImage !=='undefined') {
						small_image = amazonResponse.ItemSearchResponse.Items.Item[0].SmallImage.URL
					}else{
						small_image = amazonResponse.ItemSearchResponse.Items.Item[0].ImageSets.ImageSet[0].SmallImage.URL;
					}
					var single_price = 0;
					var merchant_name = "Amazonマーケットプレイス ";
					for (var i = 0; i <totalItems; i++) {
						var checkMin = 0;
						single_price = 0;
						var asin_no = amazonResponse.ItemSearchResponse.Items.Item[i].ASIN;
						if (typeof amazonResponse.ItemSearchResponse.Items.Item[i].Offers.Offer !== 'undefined') {
							
							asin_no = amazonResponse.ItemSearchResponse.Items.Item[i].ASIN;
							checkMin = parseInt(amazonResponse.ItemSearchResponse.Items.Item[i].Offers.Offer.OfferListing.Price.Amount);

							if((typeof amazonResponse.ItemSearchResponse.Items.Item[i].OfferSummary.LowestNewPrice !=='undefined') && (checkMin>parseInt(amazonResponse.ItemSearchResponse.Items.Item[i].OfferSummary.LowestNewPrice.Amount))){
								checkMin = parseInt(amazonResponse.ItemSearchResponse.Items.Item[i].OfferSummary.LowestNewPrice.Amount);
								asin_no = amazonResponse.ItemSearchResponse.Items.Item[i].ASIN;		
							}
							// console.log(checkMin);
							// console.log("Cons2"+merchant_name);
						}else if(typeof amazonResponse.ItemSearchResponse.Items.Item[i].OfferSummary.LowestNewPrice !=='undefined') {
							asin_no = amazonResponse.ItemSearchResponse.Items.Item[i].ASIN;
							checkMin = parseInt(amazonResponse.ItemSearchResponse.Items.Item[i].OfferSummary.LowestNewPrice.Amount);
						}else{
							asin_no = amazonResponse.ItemSearchResponse.Items.Item[i].ASIN;
							checkMin = parseInt(amazonResponse.ItemSearchResponse.Items.Item[i].OfferSummary.LowestUsedPrice.Amount);
						}						
						
						if (parseInt(minPrice)>parseInt(checkMin)) {

							if (typeof amazonResponse.ItemSearchResponse.Items.Item[i].Offers.Offer !== 'undefined') {								
								if((typeof amazonResponse.ItemSearchResponse.Items.Item[i].OfferSummary.LowestNewPrice !=='undefined') && (parseInt(amazonResponse.ItemSearchResponse.Items.Item[i].Offers.Offer.OfferListing.Price.Amount)>parseInt(amazonResponse.ItemSearchResponse.Items.Item[i].OfferSummary.LowestNewPrice.Amount))){
									merchant_name = "Amazonマーケットプレイス  ";		
								}else{
									merchant_name = amazonResponse.ItemSearchResponse.Items.Item[i].Offers.Offer.Merchant.Name;	
								}
							}else{
								merchant_name = "Amazonマーケットプレイス  ";
							}
							if (merchant_name == 'Amazon.co.jp') {
								merchant_name = merchant_name+'<img src="resource/img/checkPrime2_.png">';
							}

							minPrice = checkMin;
							brsose_nodes = amazonResponse.ItemSearchResponse.Items.Item[i].BrowseNodes.BrowseNode;
							// merchant_name = merchant_name;
							// productName = amazonResponse.ItemSearchResponse.Items.Item[i].ItemAttributes.Title;
							if (typeof amazonResponse.ItemSearchResponse.Items.Item[i].MediumImage !=='undefined') {
								productImage = amazonResponse.ItemSearchResponse.Items.Item[i].MediumImage.URL;
								amazonImage = amazonResponse.ItemSearchResponse.Items.Item[i].MediumImage.URL;
							}else{
								if (amazonResponse.ItemSearchResponse.Items.Item[i].ImageSets.ImageSet.length>0) {
									productImage = amazonResponse.ItemSearchResponse.Items.Item[i].ImageSets.ImageSet[0].MediumImage.URL;
									amazonImage = amazonResponse.ItemSearchResponse.Items.Item[i].ImageSets.ImageSet[0].MediumImage.URL;
								}else{
									productImage = amazonResponse.ItemSearchResponse.Items.Item[i].ImageSets.ImageSet.MediumImage.URL;
									amazonImage = amazonResponse.ItemSearchResponse.Items.Item[i].ImageSets.ImageSet.MediumImage.URL;
								}
								
							}
							if (typeof amazonResponse.ItemSearchResponse.Items.Item[i].SmallImage !=='undefined') {
								small_image = amazonResponse.ItemSearchResponse.Items.Item[i].SmallImage.URL
							}else{
								if (amazonResponse.ItemSearchResponse.Items.Item[i].ImageSets.ImageSet.length>0) {
									small_image = amazonResponse.ItemSearchResponse.Items.Item[i].ImageSets.ImageSet[0].SmallImage.URL;
								}else{
									small_image = amazonResponse.ItemSearchResponse.Items.Item[i].ImageSets.ImageSet.SmallImage.URL;
								}
							}
							
							
							itemName = amazonResponse.ItemSearchResponse.Items.Item[i].ItemAttributes.Title;
							pricingUrl = amazonResponse.ItemSearchResponse.Items.Item[i].DetailPageURL;
							itemUrl = amazonResponse.ItemSearchResponse.Items.Item[i].Offers.MoreOffersUrl;
							if (itemUrl == 0) {
								itemUrl = amazonResponse.ItemSearchResponse.Items.Item[i].ItemLinks.ItemLink[3].URL;								
							}
							
						}	

					}

					
					$("#product_image").removeClass('d-none');
					$("#product_image").html('<img class="product_image_design center"  src="'+productImage+'">');
					// console.log(productName);
					$("#jan_product_name").html(productName);
					$("#jan_product_name2").html(productName);
					$.post($('#base_url').val()+'main_controller/get_html/', {item_url: itemUrl}, function(data, textStatus, xhr) {
						// console.log(data);
						// return false;
						var unitPrice = $(data).find('.pricePerUnit');
						
						var num_of_item = 1;
						if (unitPrice.length>0) {

							var pricArray = [minPrice];
							for (var i = 0; i < unitPrice.length; i++) {
								var lastValue = $(unitPrice[i]).text();
								var lasQty = 1;
								lastValue = lastValue.replace( /^\D+/g, '');
								if (lastValue.indexOf("/") > -1) {
									var qty_value = lastValue.split("/");
									qty_value = parseInt(qty_value[1]);
									if (!isNaN(qty_value)) {
										lasQty = qty_value;
									}
								}
								
								// console.log(lasQty);
								// console.log(lastValue);
								lastValue = parseInt(lastValue.replace(/,/g, ''));
								
								if (!isNaN(lastValue)) {
									minPrice = lastValue/lasQty;
									// console.log(minPrice);
								}else{
									
									var num_of_item = 1;
									for (var i = 0; i < product_size_name.length; i++) {
										if (itemName.indexOf(product_size_name[i].unit_name) > -1){
											var slice_val = itemName.split(product_size_name[i].unit_name);

											var string = slice_val[0].slice(-3);
											if (!isNaN(parseInt(string[2]))) {
												num_of_item = parseInt(string.replace(/\D/g,''));
											}
										}
									}
									if (num_of_item>1) {
										if (Math.floor((itemPrice/num_of_item))>20) {
											minPrice = Math.floor(itemPrice/num_of_item);
											// chalinPoint = (chalinPoint*num_of_item);
										}
									}
									
								}
								// console.log(minPrice);
								pricArray.push(minPrice);
							}

							

							var affiliatRate = 0;
							var affiliateCommission = 0;
							// alert("Ahsan Ullah");
							// console.log(brsose_nodes);
							// return false;
							get_commission(brsose_nodes).then(function(data) {
								var node_information = data;
								console.log(node_information.commission_rate);
								if (node_information!=null) {
									affiliateCommission = node_information.commission_rate;
									affiliatRate = node_information.commission_rate*100;
									amazon_affiliate_commission = affiliateCommission;
								}
								
								var affiliatePoint = (minPrice*affiliateCommission);
								// var chalinPoint =  Math.floor(affiliatePoint/2);
								// Charin Point
								var charin_parcentage = $("#charin_pint").val();
								
								// var chalinPoint = (itemPrice*affiliatRate)/100;
								// It was calculate by API ItemPrice, It will be minPrice. Changed at 20200123
								
								

								if (Math.min.apply(null, pricArray)>0) {
									minPrice = Math.min.apply(null, pricArray);
								}else{
									minPrice = minPrice								
								}
								var chalinPoint = (minPrice*affiliatRate)/100;
								
								if (chalinPoint>1000) {
									chalinPoint = 1000;
								}
								
								chalinPoint = (chalinPoint*charin_parcentage)/100;
																
								for (var i = 0; i < product_size_name.length; i++) {
									console.log("before Slice");
									if (toASCII(itemName).indexOf(product_size_name[i].unit_name) > -1){
										var divided_by = product_size_name[i].unit_name;
										// if (divided_by=='P') {							
										// 	divided_by += " ";
										// }
										
										var slice_val = itemName.split(divided_by);
										var string = slice_val[0].slice(-3);
										var string = toASCII(string);
										
										var qty = parseInt(string.replace(/\D/g,''));
										
										if (!isNaN(qty)) {
											num_of_item = parseInt(string);
										}
										
										// if (num_of_item>1) {	
											// if (Math.floor(minPrice/num_of_item)>20) {
												// chalinPoint = (chalinPoint/num_of_item);
												// break;
											// }

										// }
									}
								}								

								var charin_parcentage = $("#charin_pint").val();
								var tracking_id = $("#login_user_id").val();
								var login_message = "";
								if (tracking_id == "") {
									login_message = "会員登録/ログイン後有効";
								}
								chalinPoint = Math.floor(chalinPoint);
								var totaoPoint = (affiliatePoint+chalinPoint);
								var real_price = (parseInt(minPrice-chalinPoint));
								amazonRes['shop_name'] = 'アマゾン';
								amazonRes['product_name'] = itemName;
								amazonRes['barcode'] = barcode;
								amazonRes['asin'] = asin_no;
								amazonRes['product_image'] = productImage;
								amazonRes['small_image'] = small_image;
								amazonRes['merchant_name'] = merchant_name;
								amazonRes['item_qty'] = 0;
								amazonRes['main_price'] = 0;
								amazonRes['price'] = minPrice;
								amazonRes['single_price'] = 0;
								amazonRes['real_price'] = parseInt(real_price);
								amazonRes['totalReview'] = 0;
								amazonRes['reviewAverage'] = 0;	
								amazonRes['affiliateRate'] = affiliatRate;
								amazonRes['affiliatePoint'] = 0;
								amazonRes['shop_point'] = 0;
								amazonRes['chalinPoint'] = chalinPoint;
								amazonRes['login_message'] = login_message;
								amazonRes['itemUrl'] = itemUrl;
								a++;
								if(a>2){
									var_obje = [rakutenRes, yahooRes, amazonRes];
									// console.log(productImage);
									// return false;

									set_affiliate_data(var_obje);
									// set_lowest_ten(rakuten_data, yahoo_response, amazonResponse)
									$("#jan_product_name").html(productName);
									$("#jan_product_name2").html(productName);
									if (productImage !="#") {
										$("#product_image").removeClass('d-none');
										$("#product_image").html('<img class="product_image_design center" src="'+productImage+'">');
										// $("#product_image").attr('src', productImage);
									}else{
										$("#product_image").addClass('d-none')
									}
								}
							});
						}else{
							$("#jan_product_name").html(productName);
							$("#jan_product_name2").html(productName);
							// Charin Point
							var charin_parcentage = $("#charin_pint").val();

							var chalinPoint = (minPrice*affiliatRate)/100;
							if (chalinPoint>1000) {
								chalinPoint = 1000;
							}

							chalinPoint = (chalinPoint*charin_parcentage)/100;
							

							$.post($('#base_url').val()+'main_controller/get_html/', {item_url: pricingUrl}, function(data, textStatus, xhr) {
								var unitPrice = $(data).find('#priceblock_ourprice');
								for (var i = 0; i < unitPrice.length; i++) {
									console.log($(unitPrice[i]).text());
								}
								var num_of_item = 1;
								for (var i = 0; i < product_size_name.length; i++) {
									if (itemName.indexOf(product_size_name[i].unit_name) > -1){
										var slice_val = itemName.split(product_size_name[i].unit_name);
										var string = slice_val[0].slice(-3);
										if (!isNaN(parseInt(string[2]))) {
											num_of_item = parseInt(string.replace(/\D/g,''));
										}
									}
								}
								if (num_of_item>1) {
									if (Math.floor((minPrice/num_of_item))>20) {
										minPrice = Math.floor(minPrice/num_of_item);
										chalinPoint = (chalinPoint/num_of_item);
									}
								}

								var affiliatRate = 0;
								var affiliateCommission = 0;
								// alert("Ahsan Ullah");
								// console.log(brsose_nodes);
								get_commission(brsose_nodes).then(function(data) {
									
									var node_information = data;
									if (node_information!=null) {
										affiliateCommission = node_information.commission_rate;
										affiliatRate = node_information.commission_rate*100;
										amazon_affiliate_commission = affiliateCommission;
									}
									var affiliatePoint = (minPrice*affiliateCommission);
									// var chalinPoint =  Math.floor(affiliatePoint/2);

									var charin_parcentage = $("#charin_pint").val();

									var chalinPoint = (minPrice*affiliatRate)/100;
									if (chalinPoint>1000) {
										chalinPoint = 1000;
									}
									chalinPoint = (chalinPoint*charin_parcentage)/100;

									var tracking_id = $("#login_user_id").val();
									var login_message = "";
									if (tracking_id == "") {
										login_message = "会員登録/ログイン後有効";
									}

									var totaoPoint = (affiliatePoint+chalinPoint);
									var real_price = (parseInt(minPrice-chalinPoint));
									amazonRes['shop_name'] = 'アマゾン';
									amazonRes['product_name'] = itemName;
									amazonRes['barcode'] = barcode;
									amazonRes['asin'] = asin_no;
									amazonRes['product_image'] = productImage;
									amazonRes['small_image'] = small_image;
									amazonRes['merchant_name'] = merchant_name;
									amazonRes['item_qty'] = 0;
									amazonRes['main_price'] = 0;
									amazonRes['price'] = minPrice;
									amazonRes['single_price'] = 0;
									amazonRes['real_price'] = parseInt(real_price);
									amazonRes['totalReview'] = 0;
									amazonRes['reviewAverage'] = 0;	
									amazonRes['affiliateRate'] = affiliatRate;
									amazonRes['affiliatePoint'] = 0;
									amazonRes['shop_point'] = 0;
									amazonRes['chalinPoint'] = chalinPoint;
									amazonRes['login_message'] = login_message;
									amazonRes['itemUrl'] = itemUrl;
									a++;
									if(a>2){
										var_obje = [rakutenRes, yahooRes, amazonRes];
										// console.log(productImage);
										// return false;

										set_affiliate_data(var_obje);
										// set_lowest_ten(rakuten_data, yahoo_response, amazonResponse)
										$("#jan_product_name").html(productName);
										$("#jan_product_name2").html(productName);
										if (productImage !="#") {
											$("#product_image").removeClass('d-none');
											$("#product_image").html('<img class="product_image_design center" src="'+productImage+'">');
											// $("#product_image").attr('src', productImage);
										}else{
											$("#product_image").addClass('d-none')
										}
									}
								});
							});
							
						}		

						
					});
					
					
				}else{
					
					if (typeof amazonResponse.ItemSearchResponse.Items.Item.Offers == 'undefined' && typeof amazonResponse.ItemSearchResponse.Items.Item.OfferSummary =='undefined') {
						amazonRes['shop_name'] = 'アマゾン';
						amazonRes['product_name'] = '';
						amazonRes['barcode'] = barcode;
						amazonRes['asin'] = '';
						amazonRes['product_image'] = '';
						amazonRes['small_image'] = '';
						amazonRes['merchant_name'] = '';
						amazonRes['item_qty'] = 0;
						amazonRes['main_price'] = 0;
						amazonRes['price'] = 0;
						amazonRes['single_price'] = 0;
						amazonRes['real_price'] = 0;
						amazonRes['totalReview'] = 0;
						amazonRes['reviewAverage'] = 0;
						amazonRes['affiliateRate'] = 0;
						amazonRes['affiliatePoint'] = 0;
						amazonRes['shop_point'] = 0;
						amazonRes['chalinPoint'] = 0;
						amazonRes['login_message'] = "";
						amazonRes['itemUrl'] = '#';
						a++;
						// if(a>2){
							var_obje = [rakutenRes, yahooRes, amazonRes];
							set_affiliate_data(var_obje);
							// set_lowest_ten(rakuten_data, yahoo_response, amazonResponse)
							$("#jan_product_name").html(productName);
							$("#jan_product_name2").html(productName);
							// $("#product_image").html('<img class="product_image_design center" src="'+productImage+'">');
							if (productImage !="#") {
								$("#product_image").html('<img class="product_image_design center" src="'+productImage+'">');
							}else{
								$("#product_image").addClass('d-none')
							}
						// }
					}else{
						if (typeof amazonResponse.ItemSearchResponse.Items.Item.Offers !== 'undefined') {
							if (typeof amazonResponse.ItemSearchResponse.Items.Item.Offers.Offer !== 'undefined') {
								itemPrice = parseInt(amazonResponse.ItemSearchResponse.Items.Item.Offers.Offer.OfferListing.Price.Amount);

								if((typeof amazonResponse.ItemSearchResponse.Items.Item.OfferSummary.LowestNewPrice !=='undefined') && (itemPrice>parseInt(amazonResponse.ItemSearchResponse.Items.Item.OfferSummary.LowestNewPrice.Amount))){
									itemPrice = parseInt(amazonResponse.ItemSearchResponse.Items.Item.OfferSummary.LowestNewPrice.Amount);								
								}
							}else if(typeof amazonResponse.ItemSearchResponse.Items.Item.OfferSummary.LowestNewPrice !=='undefined') {
													itemPrice = parseInt(amazonResponse.ItemSearchResponse.Items.Item.OfferSummary.LowestNewPrice.Amount);
							}else{
								itemPrice = parseInt(amazonResponse.ItemSearchResponse.Items.Item.OfferSummary.LowestUsedPrice.Amount);
							}	
							// console.log("Cons2"+merchant_name);
						}else if(typeof amazonResponse.ItemSearchResponse.Items.Item.OfferSummary.LowestNewPrice !=='undefined') {
							itemPrice = parseInt(amazonResponse.ItemSearchResponse.Items.Item.OfferSummary.LowestNewPrice.Amount);
						}else{
							itemPrice = parseInt(amazonResponse.ItemSearchResponse.Items.Item.OfferSummary.LowestUsedPrice.Amount);
						}

						var small_image = "";
						if (typeof amazonResponse.ItemSearchResponse.Items.Item.MediumImage !=='undefined') {
							productImage = amazonResponse.ItemSearchResponse.Items.Item.MediumImage.URL;
							small_image = amazonResponse.ItemSearchResponse.Items.Item.SmallImage.URL;
						}else{
							// productImage = amazonResponse.ItemSearchResponse.Items.Item.ImageSets.ImageSet.MediumImage.URL;
							productImage = amazonResponse.ItemSearchResponse.Items.Item.ImageSets.ImageSet.MediumImage.URL;
							small_image = amazonResponse.ItemSearchResponse.Items.Item.ImageSets.ImageSet.SmallImage.URL;
						}



						if (typeof amazonResponse.ItemSearchResponse.Items.Item.Offers.Offer !== 'undefined') {								
							if((typeof amazonResponse.ItemSearchResponse.Items.Item.OfferSummary.LowestNewPrice !=='undefined') && (parseInt(amazonResponse.ItemSearchResponse.Items.Item.Offers.Offer.OfferListing.Price.Amount)>parseInt(amazonResponse.ItemSearchResponse.Items.Item.OfferSummary.LowestNewPrice.Amount))){
								merchant_name = "Amazonマーケットプレイス  ";		
							}else{
								merchant_name = amazonResponse.ItemSearchResponse.Items.Item.Offers.Offer.Merchant.Name;	
							}
						}else{
							merchant_name = "Amazonマーケットプレイス  ";
						}

						if (merchant_name == 'Amazon.co.jp') {
							merchant_name = merchant_name+'<img src="resource/img/checkPrime2_.png">';
						}
						var asin_no = amazonResponse.ItemSearchResponse.Items.Item.ASIN;
						var imageUrl = productImage;
						var itemName = amazonResponse.ItemSearchResponse.Items.Item.ItemAttributes.Title;
						// var itemUrl = amazonResponse.ItemSearchResponse.Items.Item.DetailPageURL;
						var pricingUrl = amazonResponse.ItemSearchResponse.Items.Item.DetailPageURL;
						// var itemUrl = amazonResponse.ItemSearchResponse.Items.Item.DetailPageURL;
						var itemUrl = amazonResponse.ItemSearchResponse.Items.Item.Offers.MoreOffersUrl;
						if (itemUrl == 0) {
							itemUrl = amazonResponse.ItemSearchResponse.Items.Item.ItemLinks.ItemLink[3].URL;		
							 // itemUrl = amazonResponse.ItemSearchResponse.Items.Item.Offers.MoreOffersUrl;
						}

						var brsose_nodes = amazonResponse.ItemSearchResponse.Items.Item.BrowseNodes.BrowseNode;
						
						var num_of_item = 1;
						for (var i = 0; i < product_size_name.length; i++) {
							if (productName.indexOf(product_size_name[i].unit_name) > -1){
								var slice_val = productName.split(product_size_name[i].unit_name);
								var string = slice_val[0].slice(-3);
								if (!isNaN(parseInt(string[2]))) {
									num_of_item = parseInt(string.replace(/\D/g,''));
								}
							}
						}
						var single_price = itemPrice;
						if (num_of_item>1) {
							if (Math.floor((itemPrice/num_of_item))>20) {
								single_price = Math.floor(itemPrice/num_of_item);
							}
						}

						$("#product_image").removeClass('d-none');
						$("#product_image").html('<img class="product_image_design center" src="'+productImage+'">');
						var affiliatRate = 0;
						var affiliateCommission = 0;
						// alert("Ashan Ullah");
						console.log("Fixing but");
						get_commission(brsose_nodes).then(function(data) {
							var node_information = data;
							if (node_information!=null) {
								affiliateCommission = node_information.commission_rate;
								affiliatRate = node_information.commission_rate*100;
								amazon_affiliate_commission = affiliateCommission;
							}
							$.post($('#base_url').val()+'main_controller/get_html/', {item_url: itemUrl}, function(data, textStatus, xhr) {

								var unitPrice = $(data).find('.pricePerUnit');
								
								
								if (unitPrice.length>0) {
									var pricArray = [minPrice];
									for (var i = 0; i < unitPrice.length; i++) {
										var lastValue = $(unitPrice[i]).text();
										var lasQty = 1;
										lastValue = lastValue.replace( /^\D+/g, '');
										if (lastValue.indexOf("/") > -1) {
											var qty_value = lastValue.split("/");
											qty_value = parseInt(qty_value[1]);
											if (!isNaN(qty_value)) {
												lasQty = qty_value;
											}
										}
										
										// console.log(lasQty);
										// console.log(lastValue);
										lastValue = parseInt(lastValue.replace(/,/g, ''));
										
										if (!isNaN(lastValue)) {
											minPrice = lastValue/lasQty;
											// console.log(minPrice);
										}else{
											
											var num_of_item = 1;
											for (var i = 0; i < product_size_name.length; i++) {
												if (itemName.indexOf(product_size_name[i].unit_name) > -1){
													var slice_val = itemName.split(product_size_name[i].unit_name);

													var string = slice_val[0].slice(-3);
													if (!isNaN(parseInt(string[2]))) {
														num_of_item = parseInt(string.replace(/\D/g,''));
													}
												}
											}
											if (num_of_item>1) {
												if (Math.floor((itemPrice/num_of_item))>20) {
													minPrice = Math.floor(itemPrice/num_of_item);
													// chalinPoint = (chalinPoint*num_of_item);
												}
											}
											
										}
										// console.log(minPrice);
										pricArray.push(minPrice);
									}
									//console.log(pricArray);
									itemPrice = Math.min.apply(null, pricArray);
									//console.log(minPrice);
									var affiliatePoint = (itemPrice*affiliateCommission);
									
									// Charin Point
									var charin_parcentage = $("#charin_pint").val();

									var chalinPoint = (itemPrice*affiliatRate)/100;
									if (chalinPoint>1000) {
										chalinPoint = 1000;
									}
									chalinPoint = Math.floor((chalinPoint*charin_parcentage)/100);

									var login_message = "";
									if (tracking_id == "") {
										login_message = "会員登録/ログイン後有効";
									}
									

									var totaoPoint = (affiliatePoint+chalinPoint);
									var real_price = (parseInt(itemPrice-chalinPoint));
									amazonRes['shop_name'] = 'アマゾン';
									amazonRes['product_name'] = itemName;
									amazonRes['barcode'] = barcode;
									amazonRes['asin'] = asin_no;
									amazonRes['product_image'] = imageUrl;
									amazonRes['small_image'] = small_image;
									amazonRes['merchant_name'] = merchant_name;
									amazonRes['item_qty'] = num_of_item;
									amazonRes['main_price'] = itemPrice;
									amazonRes['price'] = itemPrice;
									amazonRes['single_price'] = single_price;
									amazonRes['real_price'] = parseInt(real_price);
									amazonRes['totalReview'] = 0;
									amazonRes['reviewAverage'] = 0;	
									amazonRes['affiliateRate'] = affiliatRate;
									amazonRes['affiliatePoint'] = 0;
									amazonRes['shop_point'] = 0;
									amazonRes['chalinPoint'] = chalinPoint;
									amazonRes['login_message'] = login_message;
									amazonRes['itemUrl'] = itemUrl;
									a++;
									if(a>2){
										var_obje = [rakutenRes, yahooRes, amazonRes];
										// console.log(productImage);
										// return false;
										set_affiliate_data(var_obje);
										// set_lowest_ten(rakuten_data, yahoo_response, amazonResponse)
										$("#jan_product_name").html(productName);
										$("#jan_product_name2").html(productName);
										// if (productImage !="#") {
											$("#product_image").removeClass('d-none');
											$("#product_image").html('<img class="product_image_design center" src="'+productImage+'">');
											// $("#product_image").attr('src', productImage);
										// }else{
										// 	$("#product_image").addClass('d-none')
										// }
									}
								}else{
																

									$.post($('#base_url').val()+'main_controller/get_html/', {item_url: pricingUrl}, function(data, textStatus, xhr) {
										var unitPrice = $(data).find('.a-size-small');
										var pricArray = [];
										// for (var i = 0; i < unitPrice.length; i++) {
											var lastValue = $(unitPrice[0]).text();
											lastValue = lastValue.replace( /^\D+/g, '');
											lastValue = parseInt(lastValue.replace(/,/g, ''));
											
											if (!isNaN(lastValue)) {
												minPrice = lastValue;
											}else{
												var num_of_item = 1;
												for (var i = 0; i < product_size_name.length; i++) {
													if (itemName.indexOf(product_size_name[i].unit_name) > -1){
														var slice_val = itemName.split(product_size_name[i].unit_name);
														var string = slice_val[0].slice(-3);
														if (!isNaN(parseInt(string[2]))) {
															num_of_item = parseInt(string.replace(/\D/g,''));
														}
													}
												}
												if (Math.floor(itemPrice/num_of_item)>20) {
													minPrice = Math.floor(itemPrice/num_of_item);
													chalinPoint = Math.floor(chalinPoint/num_of_item)

												}		
																							
											}
											// console.log(minPrice);
											pricArray.push(minPrice);
										// }
										itemPrice = Math.min.apply(null, pricArray);
									});
									var affiliatePoint = (itemPrice*affiliateCommission);
									// var chalinPoint =  Math.floor(affiliatePoint/2);

									// Charin Point
									var charin_parcentage = $("#charin_pint").val();

									var chalinPoint = (itemPrice*affiliatRate)/100;
									if (chalinPoint>1000) {
										chalinPoint = 1000;
									}
									chalinPoint = (chalinPoint*charin_parcentage)/100;
									var tracking_id = $("#login_user_id").val();
									var login_message = "";
									if (tracking_id == "") {
										login_message = "会員登録/ログイン後有効";
									}
									
									
									var totaoPoint = (affiliatePoint+chalinPoint);
									var real_price = (parseInt(itemPrice-chalinPoint));
									amazonRes['shop_name'] = 'アマゾン';
									amazonRes['product_name'] = itemName;
									amazonRes['barcode'] = barcode;
									amazonRes['asin'] = asin_no;
									amazonRes['product_image'] = imageUrl;
									amazonRes['small_image'] = small_image;
									amazonRes['merchant_name'] = merchant_name;
									amazonRes['item_qty'] = num_of_item;
									amazonRes['main_price'] = itemPrice;
									amazonRes['price'] = itemPrice;
									amazonRes['single_price'] = single_price;
									amazonRes['real_price'] = parseInt(real_price);
									amazonRes['totalReview'] = 0;
									amazonRes['reviewAverage'] = 0;	
									amazonRes['affiliateRate'] = affiliatRate;
									amazonRes['affiliatePoint'] = 0;
									amazonRes['shop_point'] = 0;
									amazonRes['chalinPoint'] = chalinPoint;
									amazonRes['login_message'] = login_message;
									amazonRes['itemUrl'] = itemUrl;
									a++;
									if(a>2){
										var_obje = [rakutenRes, yahooRes, amazonRes];
										// console.log(productImage);
										// return false;
										set_affiliate_data(var_obje);
										// set_lowest_ten(rakuten_data, yahoo_response, amazonResponse)
										$("#jan_product_name").html(productName);
										$("#jan_product_name2").html(productName);
										// if (productImage !="#") {
											$("#product_image").removeClass('d-none');
											$("#product_image").html('<img class="product_image_design center" src="'+productImage+'">');
											// $("#product_image").attr('src', productImage);
										// }else{
										// 	$("#product_image").addClass('d-none')
										// }
									}
								}

								
							});
							
						});
					}
					
				}	
			}else{
				amazonRes['shop_name'] = 'アマゾン';
				amazonRes['product_name'] = '';
				amazonRes['barcode'] = barcode;
				amazonRes['asin'] = '';
				amazonRes['product_image'] = '';
				amazonRes['small_image'] = '';
				amazonRes['merchant_name'] = '';
				amazonRes['item_qty'] = 0;
				amazonRes['main_price'] = 0;
				amazonRes['price'] = 0;
				amazonRes['single_price'] = 0;
				amazonRes['real_price'] = 0;
				amazonRes['totalReview'] = 0;
				amazonRes['reviewAverage'] = 0;
				amazonRes['affiliateRate'] = 0;
				amazonRes['affiliatePoint'] = 0;
				amazonRes['shop_point'] = 0;
				amazonRes['chalinPoint'] = 0;
				amazonRes['login_message'] = "";
				amazonRes['itemUrl'] = '#';
				a++;
				if(a>2){
					var_obje = [rakutenRes, yahooRes, amazonRes];
					// console.log(productImage);
					// return false;
					set_affiliate_data(var_obje);
					// set_lowest_ten(rakuten_data, yahoo_response, amazonResponse)
					$("#jan_product_name").html(productName);
					$("#jan_product_name2").html(productName);
					if (productImage !="#") {
						$("#product_image").html('<img class="product_image_design center" src="'+productImage+'">');
					}else{
						$("#product_image").addClass('d-none')
					}
				}
			}
				 
		});	
		
		rakutenPromiz(barcode).then(function(data) {
			$("#onchange_event").val(1);
			a++;
			console.log("Raduten Response");
			rakuten_data = data;
			// console.log(rakuten_data.Items[0].Item);
			if (rakuten_data.count>0 && barcode!='49407617') {
				if (productName!="該当商品が見つかりません。") {
					console.log(rakuten_data.Items[0].Item);					
					productName = rakuten_data.Items[0].Item.itemName;
					$("#jan_product_name").html(productName);
					$("#jan_product_name2").html(productName);
				}
				var tracking_id = $("#tracking_id").val();
				var login_user_id = $("#login_user_id").val();
				var login_message = "";
				if (login_user_id == "") {
					login_message = "会員登録/ログイン後有効";
				}
				var imageUrl = "#";
				var small_image = "#";
				if (rakuten_data.Items[0].Item.mediumImageUrls.length>0) {
					imageUrl = rakuten_data.Items[0].Item.mediumImageUrls[0].imageUrl;
					small_image =  rakuten_data.Items[0].Item.smallImageUrls[0].imageUrl;
				}
				
				var item_name = rakuten_data.Items[0].Item.itemName;
				
				var num_of_item = 1;
				var price = parseInt(rakuten_data.Items[0].Item.itemPrice);
				var main_price = parseInt(rakuten_data.Items[0].Item.itemPrice);
				var single_price = parseInt(rakuten_data.Items[0].Item.itemPrice);
				var pointRate = rakuten_data.Items[0].Item.pointRate;
				var affiliateRate = parseInt(rakuten_data.Items[0].Item.affiliateRate);

				var charin_parcentage = $("#charin_pint").val();
				var affiliatePoint = (price*pointRate)/100;
				var shop_point = (price*pointRate)/100;
				var chalinPoint = (price*affiliateRate)/100;
				if (chalinPoint>1000) {
					chalinPoint = 1000;
				}
				chalinPoint = (chalinPoint*charin_parcentage)/100;
				// console.log(chalinPoint);
				// alert(chalinPoint);
				var itemUrl = rakuten_data.Items[0].Item.affiliateUrl;
				var rekten_totalPoint = Math.floor(affiliatePoint)+Math.floor(chalinPoint);
				var realPrice = (price-rekten_totalPoint);
				for (var i = 0; i < product_size_name.length; i++) {

					if (toASCII(item_name).indexOf(product_size_name[i].unit_name) > -1){

						var divided_by = product_size_name[i].unit_name;
						if (divided_by=='P') {
							
							divided_by += " ";
						}
						
						var slice_val = item_name.split(divided_by);
						var string = slice_val[0].slice(-3);
						string = toASCII(string);
						// console.log(string);
						num_of_item = parseInt(string.replace(/\D/g,''));
						// console.log(num_of_item);
						if (num_of_item>1) {
							// num_of_item = parseInt(string.replace(/\D/g,''));
							
							if (Math.floor((single_price/num_of_item))>20) {
								single_price = Math.floor((single_price/num_of_item));
								price = single_price;								
								alPoint = Math.floor((rekten_totalPoint/num_of_item));
								shop_point = Math.floor((affiliatePoint/num_of_item));
								chalinPoint = Math.floor((chalinPoint/num_of_item));
								realPrice = price-(shop_point+chalinPoint);
								break;
							}
						}
					}
				}
				
				var my_param = getParameterByName('pc', itemUrl);
				
				// my_param = my_param
				var moshimo_link = 'http://af.moshimo.com/af/c/click?a_id=1699769&p_id=54&pc_id=54&pl_id=616&s_v='+tracking_id+'&url='+my_param

				// console.log(moshimo_link);

				rakutenRes['shop_name'] = '楽天';
				rakutenRes['product_name'] = rakuten_data.Items[0].Item.itemName;
				rakutenRes['barcode'] = barcode;
				rakutenRes['asin'] = rakuten_data.Items[0].Item.itemCode;
				rakutenRes['product_image'] = imageUrl;		
				rakutenRes['small_image'] = small_image;
				rakutenRes['merchant_name'] = rakuten_data.Items[0].Item.shopName;
				rakutenRes['item_qty'] = num_of_item;
				rakutenRes['main_price'] = main_price;
				rakutenRes['price'] = price;
				rakutenRes['single_price'] = parseInt(single_price);
				rakutenRes['real_price'] = parseInt(realPrice);
				rakutenRes['totalReview'] = parseInt(rakuten_data.Items[0].Item.reviewCount);
				rakutenRes['reviewAverage'] = parseInt(rakuten_data.Items[0].Item.reviewAverage);

				rakutenRes['affiliateRate'] = affiliateRate;
				rakutenRes['affiliatePoint'] = affiliatePoint;
				rakutenRes['shop_point'] = shop_point;
				rakutenRes['chalinPoint'] = parseInt(chalinPoint);
				rakutenRes['login_message'] = login_message;
				rakutenRes['itemUrl'] = moshimo_link;
				if (productImage == "#" && imageUrl!="#") {
					productImage = rakuten_data.Items[0].Item.mediumImageUrls[0].imageUrl;
					$("#product_image").html('<img class="product_image_design center" src="'+imageUrl+'">');
				}
				if(a>2){
					var_obje = [rakutenRes, yahooRes, amazonRes];
					set_affiliate_data(var_obje);
				}
			}else{
				rakutenRes['shop_name'] = '楽天';
				rakutenRes['product_name'] = "";
				rakutenRes['barcode'] = barcode;
				rakutenRes['asin'] = "";
				rakutenRes['product_image'] = '';
				rakutenRes['small_image'] = '';	
				rakutenRes['merchant_name'] = '';	
				rakutenRes['item_qty'] = 0;
				rakutenRes['main_price'] = 0;
				rakutenRes['price'] = 0;
				rakutenRes['single_price'] = 0;
				rakutenRes['real_price'] = 0;
				rakutenRes['totalReview'] = 0;
				rakutenRes['reviewAverage'] = 0;	
				rakutenRes['affiliateRate'] = 0;
				rakutenRes['affiliatePoint'] = 0;
				rakutenRes['shop_point'] = 0;
				rakutenRes['chalinPoint'] = 0;
				rakutenRes['login_message'] = "";

				rakutenRes['itemUrl'] = "#";
				if(a>2){
					var_obje = [rakutenRes, yahooRes, amazonRes];
					set_affiliate_data(var_obje);
					// set_lowest_ten(rakuten_data, yahoo_response, amazonResponse);
					if (productName == "該当商品が見つかりません。") {
						$("#jan_product_name").html(productName);
						$("#jan_product_name2").html(productName);
					}
					
					$("#product_image").html('<img class="product_image_design center" src="'+productImage+'">');
					// $("#product_image").attr('src', productImage);
				}
			}
		});

		yahooPromiz(barcode).then(function(data) {
			$("#onchange_event").val(1);
			yahoo_response = data;

			if (typeof yahoo_response.Error== 'undefined') {

				if (yahoo_response.ResultSet.totalResultsAvailable>0) {
					var yahoo_productName = yahoo_response.ResultSet[0].Result[0].Name;
					itemImage = yahoo_response.ResultSet[0].Result[0].Image.Medium;

					if (productName=="該当商品が見つかりません。") {

						productName = yahoo_productName;

						$("#jan_product_name2").html(productName);
						$("#jan_product_name").html(productName);	
						$("#product_image").removeClass('d-none');
						$("#product_image").html('<img class="product_image_design center"  src="'+itemImage+'">');				
					}
					if (amazonImage == null) {
						productImage = yahoo_response.ResultSet[0].Result[0].Image.Medium; 
					}

					
					var yahoo_itemPrice = yahoo_response.ResultSet[0].Result[0].Price._value;
					small_image = yahoo_response.ResultSet[0].Result[0].Image.Small;
					merchant_name = yahoo_response.ResultSet[0].Result[0].Store.Name;
					
					itemUrl = yahoo_response.ResultSet[0].Result[0].Url;
					reviewRate = yahoo_response.ResultSet[0].Result[0].Review.Rate;
					reviewCount = yahoo_response.ResultSet[0].Result[0].Review.Count;
					affiliatRate = parseInt(yahoo_response.ResultSet[0].Result[0].Affiliate.Rate);			

					var num_of_item = 1;
					var charin_parcentage = $("#charin_pint").val();
					var login_user_id = $("#login_user_id").val();
					var tracking_id = $("#tracking_id").val();
					var login_message = "";
					if (login_user_id == "") {
						login_message = "会員登録/ログイン後有効";
					}
					// var shopPoint = (yahoo_itemPrice*affiliatRate)/100;
					var shopPoint = parseInt(yahoo_response.ResultSet[0].Result[0].Point.Amount);
					// var chalinPoint = (shopPoint*50)/100;
					var chalinPoint = (yahoo_itemPrice*affiliatRate)/100;
					chalinPoint = (chalinPoint*charin_parcentage)/100;
					
					var totalPoint = Math.floor(chalinPoint)+Math.floor(shopPoint);
					var single_price = yahoo_itemPrice;

					for (var i = 0; i < product_size_name.length; i++) {
						if (toASCII(yahoo_productName).indexOf(product_size_name[i].unit_name) > -1){
							
							var divided_by = product_size_name[i].unit_name;
							if (divided_by=='P') {							
								divided_by += " ";
							}
							
							var slice_val = yahoo_productName.split(divided_by);
							var string = slice_val[0].slice(-3);
							var string = toASCII(string);
							// console.log(parseInt(string));
							num_of_item = parseInt(string.replace(/\D/g,''));
							if (isNaN(num_of_item)) {
								num_of_item = parseInt(string);
							}
							
							if (num_of_item>1) {	
								if (Math.floor(single_price/num_of_item)>20) {
									shopPoint = (shopPoint/num_of_item);
									chalinPoint = (chalinPoint/num_of_item);
									totalPoint = Math.floor(chalinPoint)+Math.floor(shopPoint);
									single_price = Math.floor((single_price/num_of_item));
									yahoo_itemPrice = single_price;
									break;
								}

							}
						}
					}

					var realPrice = yahoo_itemPrice-totalPoint;

					yahooRes['shop_name'] = 'ヤフー';
					yahooRes['product_name'] = yahoo_productName;
					yahooRes['barcode'] = barcode;
					yahooRes['asin'] = yahoo_response.ResultSet[0].Result[0].Code;
					yahooRes['product_image'] = itemImage;
					yahooRes['small_image'] = small_image;
					yahooRes['merchant_name'] = merchant_name;
					yahooRes['item_qty'] = num_of_item;
					yahooRes['main_price'] = parseInt(yahoo_itemPrice);
					yahooRes['price'] = parseInt(yahoo_itemPrice);
					yahooRes['single_price'] = single_price;
					yahooRes['real_price'] = parseInt(realPrice);
					yahooRes['totalReview'] = parseInt(reviewCount);
					yahooRes['reviewAverage'] = parseInt(reviewRate);
					yahooRes['affiliateRate'] = Math.round(affiliatRate);
					yahooRes['affiliatePoint'] = shopPoint;
					yahooRes['shop_point'] = shopPoint;
					yahooRes['chalinPoint'] = chalinPoint;
					yahooRes['login_message'] = login_message;
					yahooRes['itemUrl'] = itemUrl;
					// alert(productImage);
					// if (productImage =="#") {
						// $("#product_image").removeClass('d-none');
						// $("#product_image").html('<img class="product_image_design center"  src="'+itemImage+'">');
					// }else{
					// 	$("#product_image").addClass('d-none')
					// }
					a++;
					if(a>2){
						var_obje = [rakutenRes, yahooRes, amazonRes];
						set_affiliate_data(var_obje);
						// alert(productImage)
						if (productImage =="#") {
							$("#product_image").removeClass('d-none');
							$("#product_image").html('<img class="product_image_design center"  src="'+itemImage+'">');
						}					
					}
				}else{
					yahooRes['shop_name'] = 'ヤフー';
					yahooRes['product_name'] = "";
					yahooRes['barcode'] = barcode;
					yahooRes['asin'] = "";
					yahooRes['product_image'] = "";
					yahooRes['small_image'] = '';
					yahooRes['merchant_name'] = '';
					yahooRes['item_qty'] = 0;
					yahooRes['main_price'] = 0;
					yahooRes['price'] = 0;
					yahooRes['single_price'] = 0;
					yahooRes['real_price'] = 0;
					yahooRes['totalReview'] = 0;
					yahooRes['reviewAverage'] = 0;
					yahooRes['affiliateRate'] = 0;
					yahooRes['affiliatePoint'] = 0;
					yahooRes['shop_point'] = 0;
					yahooRes['chalinPoint'] = 0;
					yahooRes['login_message'] = "";
					yahooRes['itemUrl'] = '#';
					a++;
					if(a>2){
						var_obje = [rakutenRes, yahooRes, amazonRes];
						set_affiliate_data(var_obje);
						if (productName=="該当商品が見つかりません。") {
							console.log("Print Product Name Yahoo");
							$("#jan_product_name").html(productName);
							$("#jan_product_name2").html(productName);

						}
						
						if (productImage !="#") {
							$("#product_image").removeClass('d-none');
							$("#product_image").html('<img height="220" style="max-width: 200px;"  src="'+productImage+'">');
						}
						
					}
				}				
			}else{
				yahooRes['shop_name'] = 'ヤフー';
				yahooRes['product_name'] = "";
				yahooRes['barcode'] = barcode;
				yahooRes['asin'] = "";
				yahooRes['product_image'] = "";
				yahooRes['small_image'] = '';
				yahooRes['merchant_name'] = '';
				yahooRes['item_qty'] = 0;
				yahooRes['main_price'] = 0;
				yahooRes['price'] = 0;
				yahooRes['single_price'] = 0;
				yahooRes['real_price'] = 0;
				yahooRes['totalReview'] = 0;
				yahooRes['reviewAverage'] = 0;
				yahooRes['affiliateRate'] = 0;
				yahooRes['affiliatePoint'] = 0;
				yahooRes['shop_point'] = 0;
				yahooRes['chalinPoint'] = 0;
				yahooRes['login_message'] = "";
				yahooRes['itemUrl'] = '#';
				a++;
				if(a>2){
					var_obje = [rakutenRes, yahooRes, amazonRes];
					set_affiliate_data(var_obje);
					if (productName=="該当商品が見つかりません。") {
						$("#jan_product_name").html(productName);
						$("#jan_product_name2").html(productName);
					}
					
					if (productImage !="#") {
						$("#product_image").removeClass('d-none');
						$("#product_image").html('<img height="220" style="max-width: 200px;"  src="'+productImage+'">');
					}
					
				}
			}
			
		});		
	}

	function set_lowest_ten(rakutenData, yahooData, amazonData) {
		// console.log(rakutenData);
		// return false;
		var allProduct = [];
		var rakutenArray = {};
		var amazonArray = {};
		var yahooArray = {};
		var countYahoo = yahooData.ResultSet.totalResultsReturned;
		// console.log(amazonData);
		// return false;
		if (rakutenData.count>0) {
			for (var i = 0; i <rakutenData.Items.length; i++) {
				var pointRate = rakutenData.Items[i].Item.pointRate;
				var itemPrice = rakutenData.Items[i].Item.itemPrice;
				var affiliateRate = rakutenData.Items[i].Item.affiliateRate;
				var affiliatePoint = (itemPrice*affiliateRate)/100;
				var chalinPoint = (itemPrice*affiliateRate)/200;
				
				
				var points = (itemPrice*pointRate)/100;

				var itemUrl = rakutenData.Items[i].Item.affiliateUrl;
				var rekten_totalPoint = affiliatePoint+chalinPoint;
				
				var realPrice = itemPrice-rekten_totalPoint;
				var raku_product_image = "#";
				if (rakutenData.Items[i].Item.smallImageUrls.length>0) {
					raku_product_image = rakutenData.Items[i].Item.smallImageUrls[0].imageUrl;
				}
				
				allProduct.push({shop_name:'楽天',item_price:itemPrice, real_price:parseInt(realPrice),
					affiliate_rate: affiliateRate,
					merchant_name: rakutenData.Items[i].Item.shopName,
				 	shop_point:affiliatePoint,
				 	chalin_point:chalinPoint,
				 	product_image: raku_product_image,
				 	product_name: rakutenData.Items[i].Item.itemName,
				 	product_url: rakutenData.Items[i].Item.affiliateUrl

				 });
			}
		}
		

		if (countYahoo>0) {
			for (var i = 1; i < countYahoo; i++) {
				var itemPrice = yahooData.ResultSet[0].Result[i].Price._value;
				var affiliatRate = Math.round(yahooData.ResultSet[0].Result[i].Affiliate.Rate);				
				var points = yahooData.ResultSet[0].Result[i].Point.Amount;
				var shopPoint = (itemPrice*affiliatRate)/100;
				var chalinPoint = (itemPrice*affiliatRate)/200;
				var totalPoint = chalinPoint+shopPoint;
				var realPrice = itemPrice-totalPoint;
				var shopPoint = (itemPrice*affiliatRate)/100;
				var chalinPoint = (itemPrice*affiliatRate)/200;
				var totalPoint = Math.floor(chalinPoint)+Math.floor(shopPoint);

				allProduct.push({shop_name:'ヤフー',item_price:parseInt(itemPrice),
				real_price:parseInt(realPrice),
				affiliate_rate: affiliatRate,
				merchant_name: yahooData.ResultSet[0].Result[i].Store.Name,
			 	shop_point:shopPoint,
			 	chalin_point:chalinPoint,
			 	product_image: yahooData.ResultSet[0].Result[i].Image.Small,
				product_name: yahooData.ResultSet[0].Result[i].Name,
				product_url: yahooData.ResultSet[0].Result[i].Url
			 });
			}
		}

		if (typeof amazonData.ItemSearchResponse !== 'undefined' && typeof amazonData.Items.Item !== 'undefined') {
			
			// console.log(amazonData);
			var totalCount = amazonData.Items.Item.length;
			var totalItems = amazonData.Items.Item.length;
			
			var affiliateRate = 0;
			var base_url = $('#base_url').val();
			var data_obj = [];
			
			if (typeof totalItems !=='undefined'){
					var productName = "";
					var brsose_nodes = amazonData.Items.Item[0].BrowseNodes.BrowseNode;
					// console.log(items);
					var letestNode = "";
					for (var i = 0; i <totalItems; i++) {
						productName = "";
						// console.log('Value Of I: '+i);
						// console.log(amazonData.Items.Item[i]);
						var brsose_nodes = amazonData.Items.Item[i].BrowseNodes.BrowseNode;
						// console.log(brsose_nodes);
						// var itemPrice = 0;
						// if (typeof amazonData.Items.Item[i].OfferSummary.LowestNewPrice !=='undefined') {
						// 	itemPrice = parseInt(amazonData.Items.Item[i].OfferSummary.LowestNewPrice.Amount);
						// }else{
						// 	itemPrice = parseInt(amazonData.Items.Item[i].OfferSummary.LowestUsedPrice.Amount);
						// }

						var itemPrice = 0;	
						
						
						var single_price = 0;	
						// console.log(amazonResponse.Items.Item);
						if (typeof amazonData.Items.Item[i].Offers.Offer !== 'undefined') {
							
							
							itemPrice = parseInt(amazonData.Items.Item[i].Offers.Offer.OfferListing.Price.Amount);

							if((typeof amazonData.Items.Item[i].OfferSummary.LowestNewPrice !=='undefined') && (itemPrice>parseInt(amazonResponse.Items.Item[i].OfferSummary.LowestNewPrice.Amount))){
								itemPrice = parseInt(amazonData.Items.Item[i].OfferSummary.LowestNewPrice.Amount);								
							}
							// console.log("Cons2"+merchant_name);
						}else if(typeof amazonData.Items.Item[i].OfferSummary.LowestNewPrice !=='undefined') {
							itemPrice = parseInt(amazonData.Items.Item[i].OfferSummary.LowestNewPrice.Amount);
						}else{
							itemPrice = parseInt(amazonData.Items.Item[i].OfferSummary.LowestUsedPrice.Amount);
						}
						
						var merchant_name = "";
						if (typeof amazonData.Items.Item[i].Offers.Offer !== 'undefined') {								
							if((typeof amazonData.Items.Item[i].OfferSummary.LowestNewPrice !=='undefined') && (parseInt(amazonData.Items.Item[i].Offers.Offer.OfferListing.Price.Amount)>parseInt(amazonData.Items.Item[i].OfferSummary.LowestNewPrice.Amount))){
								merchant_name = "Amazonマーケットプレイス";		
							}else{
								merchant_name = amazonData.Items.Item[i].Offers.Offer.Merchant.Name;	
							}
						}else{
							merchant_name = "Amazonマーケットプレイス";
						}

						var smallImg = amazonData.Items.Item[i].SmallImage.URL; 
						var productUrl = amazonData.Items.Item[i].DetailPageURL;
												
						productName = amazonData.Items.Item[i].ItemAttributes.Title;

						affiliatRate = amazon_affiliate_commission*100;
						var chalinPoint = (itemPrice*affiliatRate)/200;
				    	// console.log(chalinPoint)
				    	var real_price = (parseInt(itemPrice-chalinPoint));
				    	
				    	allProduct.push({shop_name:'アマゾン',item_price:itemPrice,
				    		real_price:parseInt(real_price),
				    		affiliate_rate: affiliatRate,
				    		merchant_name: merchant_name,
				    	 	shop_point:0,
				    	 	chalin_point:chalinPoint,
				     	 	product_image: smallImg,
				     		product_name: productName,
				     		product_url: productUrl
				    	 });


				    		// set_lowest_ten444(allProduct);
						
						// get_commission(brsose_nodes).then(function(data) {	

						// // console.log(data);
						
				  //   	});
						
					}
					// console.log(allProduct);
				
				
			}else{
				var brsose_nodes = amazonData.Items.Item.BrowseNodes.BrowseNode;
				if (typeof brsose_nodes.length !=='undefined') {
					// if (brsose_nodes.length>1) {
					// 	var brsose_node_id = brsose_nodes[1].BrowseNodeId;
					// }else{
						var brsose_node_id = brsose_nodes[0].BrowseNodeId;
					// }
					
				}else{
					var brsose_node_id = brsose_nodes.BrowseNodeId;
				}
				var base_url = $("#base_url").val();
				// $.getJSON(base_url+'resource/js/amazon_commission_rate.json', function(data) { 
					    var itemPrice = 0;	
					    
					    
					    var single_price = 0;	
					    // console.log(amazonResponse.Items.Item);
					    if (typeof amazonData.Items.Item.Offers.Offer !== 'undefined') {
					    	
					    	
					    	itemPrice = parseInt(amazonData.Items.Item.Offers.Offer.OfferListing.Price.Amount);

					    	if((typeof amazonData.Items.Item.OfferSummary.LowestNewPrice !=='undefined') && (itemPrice>parseInt(amazonData.Items.Item.OfferSummary.LowestNewPrice.Amount))){
					    		itemPrice = parseInt(amazonData.Items.Item.OfferSummary.LowestNewPrice.Amount);								
					    	}
					    	// console.log("Cons2"+merchant_name);
					    }else if(typeof amazonData.Items.Item.OfferSummary.LowestNewPrice !=='undefined') {
					    	itemPrice = parseInt(amazonData.Items.Item.OfferSummary.LowestNewPrice.Amount);
					    }else{
					    	itemPrice = parseInt(amazonData.Items.Item.OfferSummary.LowestUsedPrice.Amount);
					    }

					    // var affiliatRate = newItem[0].commission_rate*100;
					    var productImage ="";
					    var small_image = "";
					    if (typeof amazonData.Items.Item.MediumImage !=='undefined') {
					    	productImage = amazonData.Items.Item.MediumImage.URL;
					    	small_image = amazonData.Items.Item.SmallImage.URL;
					    }else{
					    	productImage = amazonData.Items.Item.ImageSets.ImageSet[0].MediumImage.URL;
					    	small_image = amazonData.Items.Item.ImageSets.ImageSet[0].SmallImage.URL;
					    }

				    	var merchant_name = "";
				    	if (typeof amazonData.Items.Item.Offers.Offer !== 'undefined') {								
				    		if((typeof amazonData.Items.Item.OfferSummary.LowestNewPrice !=='undefined') && (parseInt(amazonData.Items.Item.Offers.Offer.OfferListing.Price.Amount)>parseInt(amazonData.Items.Item.OfferSummary.LowestNewPrice.Amount))){
				    			merchant_name = "Amazonマーケットプレイス";		
				    		}else{
				    			merchant_name = amazonData.Items.Item.Offers.Offer.Merchant.Name;	
				    		}
				    	}else{
				    		merchant_name = "Amazonマーケットプレイス";
				    	}
				    	// get_commission(brsose_nodes).then(function(data) {
						
						// var node_information = data;
						var affiliatRate = amazon_affiliate_commission*100;
						// console.log("amazon_affiliate_commission: "+affiliatRate);
				    	var chalinPoint = (itemPrice*affiliatRate)/200;
				    	// console.log(chalinPoint)
				    	var real_price = (parseInt(itemPrice-chalinPoint));
				    	
				    	allProduct.push({shop_name:'アマゾン',item_price:itemPrice,
				    		real_price:parseInt(real_price),
				    		affiliate_rate: affiliatRate,
				    		merchant_name: merchant_name,
				    	 	shop_point:0,
				    	 	chalin_point:chalinPoint,
				     	 	product_image: productImage,
				     		product_name: amazonData.Items.Item.ItemAttributes.Title,
				     		product_url: amazonData.Items.Item.DetailPageURL
				    	 });
				    	// console.log(allProduct);
						// set_lowest_ten444(allProduct);
					// });
			}	

		}
		set_lowest_ten(allProduct);
	}

	function set_lowest_ten(data) {
		// console.log(data);
		
		data.sort(function(a,b){
		   if(a.real_price > b.real_price){ return 1}
		    if(a.real_price < b.real_price){ return -1}
		      return 0;
		});


		// console.log(data);
		// return false;
		var tableHtml = "";

		if (data.length>0) {
			if (data.length>9) {
				for (var i = 0; i < 10; i++) {
					// return false;
					// var affiliatePoint = parseInt(response[i].affiliatePoint);
					var affiliateRate = data[i].affiliate_rate;
					var shopPoint = Math.floor(data[i].shop_point);
					var chalinPoint = Math.floor(data[i].chalin_point);
					var itemPrice = Math.floor(data[i].item_price);
					var realPrice = Math.floor(itemPrice-(chalinPoint+shopPoint));
					var merchant_name = data[i].merchant_name
					var product_name = '<a target="_blank" href="'+data[i].product_url+'">'+data[i].product_name+'</a>';

					// if (merchant_name) {}
					if (shopPoint % 1 != 0) {
						shopPoint = shopPoint.toFixed(1);
					}
					if (chalinPoint % 1 != 0) {
						chalinPoint = chalinPoint.toFixed(1);
					}
					var product_image = "";
					if (data[i].product_image != "#") {
						product_image = '<img src="'+data[i].product_image+'">';
					}
					tableHtml += '<tr>'
						tableHtml += '<td style="border-left: 0;">'+(i+1)+' 位 '+data[i].shop_name+'</td>';
						// tableHtml += '<td><button style="width:110px;" class="btn btn-default btn_link  btn-lg">'+data[i].shop_name+'</button><span style="margin-left: 15px;">'+affiliateRate+'%<span></td>';
						// tableHtml += '<td> <div class="col-md-3 float-left">'+product_image+'</div><div class="col-md-9 float-left"><span style="font-size:18px;"> '+merchant_name+'</span><br>'+product_name+'</div></td>';
						tableHtml += '<td style=" background-color: #CCFFCC;" class="text-center">¥'+realPrice.toLocaleString('en')+'</td>';
						tableHtml += '<td class="text-center">¥'+itemPrice.toLocaleString('en'); +'</td>';
						tableHtml += '<td  class="text-center">'+Math.floor( shopPoint)+'</td>';
						tableHtml += '<td style=" background-color: #CCFFCC;" class="text-center">'+Math.floor( chalinPoint)+'</td>';
						tableHtml += '<td class="text-center" style="vertical-align: middle;"><button attr-btn-link="'+data[i].product_url+'" attr-product-name="'+data[i].product_name+'" attr-shop-point="'+shopPoint+'" attr-barcode="'+data[i].barcode+'" attr-shop-name="'+data[i].shop_name+'" attr-product-price="'+itemPrice+'" attr-charin-point="'+chalinPoint+'" class="btn btn-warning btn-lg" id="amazon_itemUrl" style="">購入へ</button></td>';
						
					tableHtml += '<tr>'
				}
			}else{
				for (var i = 0; i < data.length; i++) {
					// return false;
					var affiliateRate = data[i].affiliate_rate;
					var shopPoint = data[i].shop_point;
					// var chalinPoint = data[i].chalin_point;
					var chalinPoint = Math.floor(data[i].chalin_point);
					var itemPrice = data[i].item_price;
					// var realPrice = data[i].real_price;
					var realPrice = itemPrice-chalinPoint;
					var merchant_name = data[i].merchant_name
					var product_name = '<a target="_blank" href="'+data[i].product_url+'">'+data[i].product_name+'</a>';

					if (shopPoint % 1 != 0) {
						shopPoint = shopPoint.toFixed(1);
					}
					if (chalinPoint % 1 != 0) {
						chalinPoint = chalinPoint.toFixed(1);
					}
					var product_image = "";
					if (data[i].product_image != "#") {
						product_image = '<img src="'+data[i].product_image+'">';
					}
					tableHtml += '<tr>'
						tableHtml += '<td style="border-left: 0;">'+(i+1)+' 位</td>';
						tableHtml += '<td><button style="width:110px;" class="btn btn-default btn_link  btn-lg">'+data[i].shop_name+'</button><span style="margin-left: 15px;">'+affiliateRate+'%<span></td>';
						tableHtml += '<td> <div class="col-md-3 float-left">'+product_image+'</div><div class="col-md-9 float-left"><span style="font-size:18px;"> '+merchant_name+'</span><br>'+product_name+'</div></td>';
						tableHtml += '<td class="text-center">¥'+realPrice.toLocaleString('en')+'</td>';
						tableHtml += '<td class="text-center">'+Math.floor(shopPoint)+'</td>';
						tableHtml += '<td class="text-center">'+Math.floor( chalinPoint)+'</td>';
						tableHtml += '<td class="text-center">¥'+itemPrice.toLocaleString('en'); +'</td>';
						
					tableHtml += '<tr>'					
				}
			}
			
			$( "#lowest_ten_table" ).html( tableHtml );
		}
	}

	function set_affiliate_data(response) {
		$(".product_loading_image").html('');
		$("#comparing_table").css('opacity', '1');
		$("#comparing_table_mobile").css('opacity', '1');
		$(".product_loading_image_mobile").html('');
		// $("#mobile_compare_table").css({
		// 	opacity: '0.4'
		// });
		$('html, body').animate({
	        scrollTop: $(".compare_table_mobile").offset().top
	    }, 500);
		var search_result = $("#jan_product_name").text();
		// console.log(search_result);
		// alert("Okay");
		// return false;

		response.sort(function(a,b){
		   if(a.real_price > b.real_price){ return 1}
		    if(a.real_price < b.real_price){ return -1}
		      return 0;
		});
		if (response.length>0) {
			var tableHtml = '';
			var tableHtml2 = '';
			tableHtml += '<tr>';
				tableHtml += '<th nowrap style="width: 3%" class="align-middle text-center">順位</th>';
				tableHtml += '<th colspan="2" class="align-middle text-center">ショップ名</th>';
				tableHtml += '<th nowrap class="align-middle text-center" style="background-color: #CBEBF6; width: 3%">実質<br>価格</th>';
				tableHtml += '<th nowrap style="width: 3%" class="align-middle text-center">価格<br>(税込)</th>';
				tableHtml += '<th nowrap class="align-middle text-center" style="width: 5%">ショップ<br>ポイント</th>';
				tableHtml += '<th nowrap class="align-middle text-center"  style="background-color: #CBEBF6; width: 5%">チャリン<sup>2</sup><br>ポイント<br>（D.P）</th>';
				tableHtml += '<th nowrap style="width: 3%" class="align-middle text-center">サイト</th>';
			tableHtml += '</tr>';

			// Mobir Version Table
			tableHtml2 += '<tr>';
				tableHtml2 += '<th nowrap class="align-middle text-center" style="border-left: 0; border-top:0; background-color: white;">ショップ</th>';
				tableHtml2 += '<th nowrap class="align-middle text-center" style="border-right: 0; border-top: 0; background-color: #CCFFCC;">実質価格</th>';
				tableHtml2 += '<th nowrap class="align-middle text-center" style="border-right: 0; border-top: 0;background-color: white; ">価格<br>(税込)</th>';
				
				tableHtml2 += '<th style="background-color: white; " nowrap class="align-middle text-center">ショップP</th>';
				tableHtml2 += '<th style=" background-color: #CCFFCC; " nowrap class="align-middle text-center">チャリン<sup>2</sup>P</th>';
				tableHtml2 += '<th style="background-color: white; border-top-right-radius:20px; " nowrap class="align-middle text-center">サイト</th>';
			tableHtml2 += '</tr>';

			var totalReview = 0;
			var totalAvg = 0;
			var realPrice = 0;
			var most_loest_price = parseInt(response[0].price);
			if (most_loest_price<1) {
				most_loest_price = parseInt(response[1].price);
			}
			if (most_loest_price<1) {
				most_loest_price = parseInt(response[2].price);
			}
			// var most_loest_price = response[0].price;
			var productPrice = 0;
			var productRealPrice = 0;
			var move = 0; 
			
			
			for (var i = 0; i <3; i++) {					
					productPrice = Math.round(response[i].price).toLocaleString('en');
					productRealPrice = Math.round(response[i].real_price).toLocaleString('en');
					var affiliateRate = parseInt(response[i].affiliateRate)+'%';
					var affiliatePoint = parseInt(response[i].affiliatePoint);
					var shopPoint = parseInt(response[i].shop_point);

					var chalinPoint = parseInt(response[i].chalinPoint);
					var small_image = '<img src="'+response[i].small_image+'">';
					var merchant_name = response[i].merchant_name;
					var name_url = '<a target="_blank" href="'+response[i].itemUrl+'" class="purchage_product" style="font-size:14px;text-decoration: underline; color: green; cursor: pointer;">'+response[i].product_name+'</a>'
					// var name_url = '<a target="_blank" style="font-size:16px;" href="'+response[i].itemUrl+'">'+response[i].product_name+'</a>';
					var totalReview = response[i].totalReview+"件";
					var reviewAverage = response[i].reviewAverage+'点';
					if (most_loest_price>0) {
						var case_mapping = (most_loest_price+(most_loest_price*1.8));
						// var case_mapping = (most_loest_price*1.3);
						// alert(case_mapping)
						// console.log(case_mapping);
						if (response[i].main_price > case_mapping) {
							$("#show_affiliat_parcetage").removeClass('d-block').addClass('d-none');
							$("#show_product_image").removeClass('d-block').addClass('d-none');
							$("#show_affiliat_parcetage").removeClass('d-block').addClass('d-none');
						}
					}
					productPrice = "¥"+productPrice;
					productRealPrice = "¥"+productRealPrice;

					realPrice = productRealPrice;
					// totalReview += response[i].totalReview;
					totalAvg += parseInt(response[i].reviewAverage);
					
					if (chalinPoint> 0 && chalinPoint % 1 != 0) {

						chalinPoint = chalinPoint.toFixed(1);
					}
					if (shopPoint> 0 && shopPoint % 1 != 0) {
						shopPoint = shopPoint.toFixed(1);
					}
					shopPoint = shopPoint.toLocaleString('en');
					chalinPoint = chalinPoint.toLocaleString('en');
					
					if (response[i].product_name !="") {
						move ++;
						tableHtml += '<tr>';
							tableHtml += '<td class="text-center" style="vertical-align: middle;">'+(move)+'位</td>';
							// tableHtml += '<td class="align-middle text-center data_td"> <button class="profite_tabel_btn btn btn-default btn_link btn-lg">'+response[i].shop_name+'</button><span id="show_affiliat_parcetage" style="margin-left: 15px;" class="d-block">'+affiliateRate+'</span></td>';
							tableHtml += '<td nowrap class="align-middle text-center data_td" style="width: 10%"> <button class="profite_tabel_btn btn btn-default btn_link btn-lg">'+response[i].shop_name+'</button></td>';
							tableHtml += '<td class="data_td"><div class="col-md-2 float-left" id="show_product_image">'+small_image+'</div><div class="col-md-10 float-left"><span style="font-size: 18px;">'+merchant_name+'</span><br>'+name_url+'</td>';
							tableHtml += '<td class="text-center data_td" style="background-color: #CBEBF6; vertical-align: middle;">'+productRealPrice.toLocaleString('en')+'</td>';
							tableHtml += '<td class="text-right data_td" style="vertical-align: middle;">'+productPrice.toLocaleString('en')+'</td>';
							tableHtml += '<td class="text-center data_td" style="vertical-align: middle;">'+shopPoint+'</td>';
							tableHtml += '<td class="text-center data_td" style="background-color: #CBEBF6; vertical-align: middle;">'+chalinPoint;
							if (response[i].login_message !="" && chalinPoint>0) {
								tableHtml += '<p style="font-size:11px;" class="text-center text-danger">'+response[i].login_message+'</p>';
							}
							tableHtml += '</td>';
						tableHtml += '<td class="text-center data_td" style="vertical-align: middle;"><a target="_blank" href="'+response[i].itemUrl+'" attr-btn-link="'+response[i].itemUrl+'" attr-product-name="'+response[i].product_name+'" attr-shop-point="'+shopPoint+'" attr-barcode="'+response[i].barcode+'" attr-shop-name="'+response[i].shop_name+'" attr-product-price="'+productPrice+'" attr-charin-point="'+chalinPoint+'" attr-affiliateRate="'+response[i].affiliateRate+'"  attr-asin="'+response[i].asin+'" class="btn btn-warning purchage_product" id="'+response[i].shop_name+'_affiliate" style="">購入へ</a></td>';
						tableHtml += '</tr>';

						// Mobile Table
						tableHtml2 += '<tr>';

								tableHtml2 += '<td class="data_td" nowrap style="border-left: 0; padding:0;"><a target="_blank" href="'+response[i].itemUrl+'" style="width:100%; padding:10px; display:block;" class="text-center">'+move+'位 <span class="data_td">'+response[i].shop_name+'</span></a></td>';
								tableHtml2 += '<td class="text-right data_td" style=" padding:0;background-color: #CCFFCC;"><a target="_blank" href="'+response[i].itemUrl+'" style="width:100%; padding:10px; display:block;"><strong>'+productRealPrice.toLocaleString('en')+'</strong></a></td>';
								tableHtml2 += '<td style="padding:0;" class="text-right data_td"><a target="_blank" href="'+response[i].itemUrl+'" style="width:100%; display:block; padding:10px;" class="text-center">'+productPrice.toLocaleString('en')+'</a></td>';
								tableHtml2 += '<td style="padding:0;" class="text-center data_td"><a target="_blank" href="'+response[i].itemUrl+'" style="width:100%; display:block;padding:10px;">'+shopPoint+'</a></td>';
								// tableHtml2 += '<td class="text-center data_td" style="background-color: #CCFFCC">'+chalinPoint+'</td>';
								tableHtml2 += '<td class="text-center data_td" style="background-color: #CCFFCC;padding:0;"><a target="_blank" href="'+response[i].itemUrl+'" style="width:100%; display:block; padding:10px;">'+chalinPoint;
								// if (response[i].login_message !="" && chalinPoint>0) {
									tableHtml2 += '<p style="font-size:11px;" class="text-center text-danger">'+response[i].login_message+'</p>';
								// }
								tableHtml2 += '</a></td>';
								tableHtml2 += '<td class="text-center data_td" style="padding:10px"><a target="_blank" href="'+response[i].itemUrl+'" attr-btn-link="'+response[i].itemUrl+'" attr-product-name="'+response[i].product_name+'" attr-shop-point="'+shopPoint+'" attr-barcode="'+response[i].barcode+'" attr-shop-name="'+response[i].shop_name+'" attr-product-price="'+productPrice+'" attr-charin-point="'+chalinPoint+'" attr-affiliateRate="'+response[i].affiliateRate+'"  attr-asin="'+response[i].asin+'" class="btn btn-warning btn-sm purchage_product" id="'+response[i].shop_name+'_affiliate" style="">購入へ</a></td>';
						tableHtml2 += '</tr>';
						 
					}
					
				// }
			}

			if (move==1){
				var productPrice = '-';
				var productRealPrice = '-';
				tableHtml += '<tr>';
					tableHtml += '<td class="text-center" style="vertical-align: middle;">'+(move+parseInt(1))+'位</td>';
					tableHtml += '<td class="align-middle text-center data_td"> <button class="profite_tabel_btn btn btn-default btn_link btn-lg">'+response[0].shop_name+'</button></td>';

					tableHtml += '<td class="align-middle text-center data_td" style="b"> 該当なし</td>';
					tableHtml += '<td class="text-center data_td" style="background-color: #CBEBF6">'+productRealPrice.toLocaleString('en')+'</td>';
					tableHtml += '<td class="text-right data_td">'+productPrice+'</td>';
					
					tableHtml += '<td class="text-center data_td">-</td>';
					tableHtml += '<td class="text-center data_td" style="background-color: #CBEBF6">-</td>';
					tableHtml += '<td class="text-center data_td" style="padding:10px"><a  class="btn btn-warning btn-lg" id="amazon_itemUrl" style="">購入へ</a></td>';
				tableHtml += '</tr>';

				// Mobile Table
				tableHtml2 += '<tr>';
					tableHtml2 += '<td nowrap style="border-left: 0;">'+(move+parseInt(1))+'位 <span class="data_td">'+response[0].shop_name+'</span></td>';
					tableHtml2 += '<td class="text-righ data_tdt" style=" background-color: #CCFFCC;"><strong>該当なし</strong></td>';
					tableHtml2 += '<td class="text-right data_td">-</td>';
					tableHtml2 += '<td class="text-center data_td">-</td>';
					tableHtml2 += '<td class="text-center data_td" style="background-color: #CCFFCC">-</td>';
					tableHtml2 += '<td class="text-center data_td" style="padding:10px"><button class="btn btn-default btn_link btn-lg jafa_btn">購入へ</button></td>';
				tableHtml2 += '</tr>';

				tableHtml += '<tr>';
					tableHtml += '<td class="text-center" style="vertical-align: middle;">'+3+'位</td>';
					tableHtml += '<td class="align-middle text-center data_td"> <button class="profite_tabel_btn btn btn-default btn_link btn-lg">'+response[1].shop_name+'</button></td>';

					tableHtml += '<td class="align-middle text-center data_td" style="b"> 該当なし</td>';
					tableHtml += '<td class="text-center data_td" style="background-color: #CBEBF6">'+productRealPrice.toLocaleString('en')+'</td>';
					tableHtml += '<td class="text-right data_td">'+productPrice+'</td>';
					
					tableHtml += '<td class="text-center data_td">-</td>';
					tableHtml += '<td class="text-center data_td" style="background-color: #CBEBF6">-</td>';
					tableHtml += '<td class="text-center data_td" style="padding:10px"><a  class="btn btn-warning btn-lg" id="amazon_itemUrl" style="">購入へ</a></td>';
				tableHtml += '</tr>';

				// Mobile Table
				tableHtml2 += '<tr>';
					tableHtml2 += '<td nowrap style="border-left: 0;">'+3+'位 <span class="data_td">'+response[1].shop_name+'</span></td>';
					tableHtml2 += '<td class="text-right data_td" style=" background-color: #CCFFCC;"><strong>該当なし</strong></td>';
					tableHtml2 += '<td class="text-right data_td">-</td>';
					tableHtml2 += '<td class="text-center data_td">-</td>';
					tableHtml2 += '<td class="text-center data_td" style="background-color: #CCFFCC">-</td>';
					tableHtml2 += '<td class="text-center data_td" style="padding:10px"><button class="btn btn-default btn_link btn-lg jafa_btn">購入へ</button></td>';
				tableHtml2 += '</tr>';

			}
			if (move==2){
				
				productPrice = "¥"+productPrice;
				productRealPrice = "¥"+productRealPrice;
				var productPrice = '該当なし';
				var productRealPrice = '該当なし';

				totalReview += response[0].totalReview;
				totalAvg += parseInt(response[0].reviewAverage);
				var shopName = "";
				if ( response[0].shop_name=='楽天' ) {
					shopName = '<span>楽<br>天</span>';
				}
				if ( response[0].shop_name=='アマゾン' ) {
					shopName = '<span>ア<br><br>マ<br><br>ゾ<br><br>ン</span';
				}
				if ( response[0].shop_name=='ヤフー' ) {
					shopName = '<span>ヤ<br>フ<br>ー</span';
				}
				var affiliateRate = parseInt(response[0].affiliateRate);
				var affiliatePoint = parseInt(response[0].affiliatePoint);
				var shopPoint = parseInt(response[0].shop_point);
				var chalinPoint = parseInt(response[0].chalinPoint);
				if (chalinPoint> 0 && chalinPoint % 1 != 0) {

					chalinPoint = chalinPoint.toFixed(1);
				}

				if (shopPoint>0 && shopPoint % 1 != 0) {
					shopPoint = shopPoint.toFixed(1);
				}

				shopPoint = shopPoint.toLocaleString('en');
				chalinPoint = chalinPoint.toLocaleString('en');
				// return false;
				tableHtml += '<tr>';
					tableHtml += '<td class="text-center" style="vertical-align: middle;">'+(move+parseInt(1))+'位</td>';
					tableHtml += '<td class="align-middle text-center data_td"> <button class="profite_tabel_btn btn btn-default btn_link btn-lg">'+response[0].shop_name+'</button></td>';

					tableHtml += '<td class="align-middle text-center data_td" style="b"> 該当なし</td>';
					tableHtml += '<td class="text-center data_td" style="background-color: #CBEBF6">'+productRealPrice.toLocaleString('en')+'</td>';
					tableHtml += '<td class="text-right data_td">'+productPrice+'</td>';
					
					tableHtml += '<td class="text-center data_td">'+shopPoint+'</td>';
					// tableHtml += '<td class="text-center data_td" style="background-color: #CBEBF6">'+chalinPoint+'</td>';
					tableHtml += '<td class="text-center data_td" style="background-color: #CBEBF6">'+chalinPoint;
					// if (response[i].login_message !="" && chalinPoint>0) {
						tableHtml += '<p style="font-size:11px;" class="text-center text-danger">'+response[0].login_message+'</p>';
					// }
					tableHtml += '</td>';
					tableHtml += '<td class="text-center data_td"><a attr-btn-link="'+response[0].itemUrl+'" attr-product-name="'+response[0].product_name+'" attr-barcode="'+response[0].barcode+'" attr-shop-name="'+response[0].shop_name+'" attr-product-price="'+productPrice+'" attr-affiliateRate="'+affiliateRate+'" attr-charin-point="'+chalinPoint+'" class="btn btn-warning btn-lg" id="'+response[0].shop_name+'_affiliate">購入へ</a></td>';
				tableHtml += '</tr>';

				// Mobile Table
				tableHtml2 += '<tr>';
					tableHtml2 += '<td nowrap style="border-left: 0;">'+(move+parseInt(1))+'位 <span class=" data_td">'+response[0].shop_name+'</span></td>';
					tableHtml2 += '<td class="text-right data_td" style=" background-color: #CCFFCC;"><strong>該当なし</strong></td>';
					tableHtml2 += '<td class="text-right data_td">-</td>';
					tableHtml2 += '<td class="text-center data_td">-</td>';
					tableHtml2 += '<td class="text-center data_td" style="background-color: #CCFFCC">-</td>';
					tableHtml2 += '<td class="text-center data_td" style="padding:10px"><button class="btn btn-default btn_link btn-lg jafa_btn">購入へ</button></td>';
				tableHtml2 += '</tr>';

			}
			totalAvg = (totalAvg/response.length);

			$( "#comparing_table" ).html( tableHtml );
			$( "#mobile_compare_table" ).html( tableHtml2 );
		}else{
			$("#jan_product_name").html("Product Not Found");
		}
	}	

	

	function get_amazon_point(product_category) {
		var percentise = 0;
		// console.log(product_category.toLowerCase());
		switch(product_category.toLowerCase()) {			
		    case 'gift_cards':
		    	percentise = 0;
		        // console.log(product_category);
		        break;
		    case 'video_games':
		    	percentise = 1;
		        break;
		    case 'toys_and_games':
		    	percentise = 1;
		        break;
			case 'video game consoles':
		    	percentise = 1;
		        break;
		    case 'video games & video game consoles':
		    	percentise = 1;
		        break;
		    case 'wine':
		    	percentise = 2
		        break;
		    case 'digital video games':
		    	percentise = 2;
		        break;
		    case 'televisions':
		    	percentise = 2;
		        break;
		    case 'pc':
		    	percentise = 2.5;
		        break;
		    case 'pc components':
		    	percentise = 2.5;
		        break;
		    case 'abis_dvd':
		    	percentise = 2.5;
		        break;
		    case 'dvd & blu-ray':
		    	percentise = 2.5;
		        break;
		    case 'fresh':
		    	percentise = 3;
		        break;
		    case 'toys':
		    	percentise = 3;
		        break;
		    case 'fire tablet devices':
		    	percentise = 4;
		        break;
		    case 'dash buttons':
		    	percentise = 4;
		        break;
		    case 'kindle devices':
		    	percentise = 4;
		        break;
		    case 'physical books':
		    	percentise = 4.5;
		        break;
		    case 'health & personal care':
		    	percentise = 4.5;
		        break;
		    case 'sports':
		    	percentise = 4.5;
		        break;
		    case 'kitchen':
		    	percentise = 4;
		        break;
		    case 'automotive':
		    	percentise = 4.5;
		        break;
		    case 'baby_product':
		    	percentise = 4.5;
		        break;
		    case 'grocery':
		    	percentise = 5;
		        break;
		    case 'digital_music':
		    	percentise = 5;
		        break;
		    case 'physical_music':
		    	percentise = 5;
		        break;
		    case 'handmade':
		    	percentise = 5;
		        break;
		    case 'digital videos':
		    	percentise = 5;
		        break;
		    case 'outdoors':
		    	percentise = 5.5;
		        break;
		    case 'tools':
		    	percentise = 5.5;
		        break;
		    case 'headphones':
		    	percentise = 6;
		        break;
		    case 'beauty':
		    	percentise = 6;
		        break;
		    case 'musical_instruments':
		    	percentise = 6;
		        break;
		    case 'percussion_instruments':
		    	percentise = 6;
		        break;
		    case 'business & industrial supplies':
		    	percentise = 6;
		        break;
		    case 'apparel':
		    	percentise = 7;
		        break;
		    case 'amazon element smart tv (with fire tv)':
		    	percentise = 7;
		        break;
		    case 'amazon fire tv devices':
		    	percentise = 7;
		        break;
		    case 'jewelry':
		    	percentise = 7;
		        break;
		    case 'luggage':
		    	percentise = 7;
		        break;
		    case 'shoes':
		    	percentise = 7;
		        break;
		    case 'handbags & accessories':
		    	percentise = 7;
		        break;
		    case 'bag':
		    	percentise = 7;
		        break;
		    case 'auto_accessory':
		    	percentise = 7;
		        break;
		    case 'watches':
		    	percentise = 7;
		        break;
		    case 'amazon_echo_device':
		    	percentise = 7;
		        break;
		    case 'furniture':
		    	percentise = 8;
		        break;
		    case 'home_furniture_and_decor':
		    	percentise = 8;
		        break;
		    case 'home':
		    	percentise = 8;
		        break;
		    case 'home_improvement':
		    	percentise = 8;
		        break;
		    case 'lawn & garden':
		    	percentise = 8;
		        break;
		    case 'pet_supplies':
		    	percentise = 8;
		        break;
		    case 'pet products':
		    	percentise = 8;
		        break;
		    case 'pantry':
		    	percentise = 8;
		        break;
		    case 'fashion_women':
		    	percentise = 10;
		        break;
		    case 'men & kids private label':
		    	percentise = 10;
		        break;
		    case 'luxury_beauty':
		    	percentise = 10;
		        break;
		    case 'amazon_coin':
		    	percentise = 10;
		        break;		    
		    default:
		    	percentise = 4;
		}
		return percentise;
	}



	function get_amazon_browse_node_commission(browse_node_id) {
		var base_url = $('#base_url').val();
		var result_value = 0;
		$.getJSON(base_url+'resource/js/amazon_commission_rate.json', function(data) {         
		    var data_obj = data[2].data;
		    var newItem = data_obj.filter(function(i) {
		      return i.browse_node_id == browse_node_id; 
		    });
		    set_browse_node(newItem[0].commission_rate*100);
		});
	}
	function set_browse_node(argument) {
		return argument;
		// console.log(argument);
	}

	var get_commission = function(jsonData) {
		var objectDataString = JSON.stringify(jsonData);
	  	return new Promise(function(resolve, reject) {
		    var response;
		    $.ajax({
		    	url: 'main_controller/get_browse_node_commission2/',
		    	type: 'POST',
		    	// dataType: 'json',
		    	data: {node_ids: objectDataString},
		    })
		    .done(function(data) {
		    	
		    	var response = JSON.parse(data);
		    	resolve(response);
		    })
		    .fail(function() {
		    	console.log("error");
		    })
		    .always(function() {
		    	
		    });	   
	  });
	}

	function checkAjaxByJson(jsonData) {
		var objectDataString = JSON.stringify(jsonData);
		// console.log("Test: "+objectDataString);
		// return false;
		$.ajax({
			url: 'main_controller/get_browse_node_commission2/',
			type: 'POST',
			// dataType: 'json',
			data: {node_ids: objectDataString},
		})
		.done(function(data) {
			console.log("Server Data: "+data);
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	}

	var janCode = $("#get_janCode").val();	
	if (janCode!=="") {

		
	    var product_size_name = [];
	    $.get($("#base_url").val()+'main_controller/get_product_size', function(data) {
	    	var resData = JSON.parse(data);
	    	product_size_name = resData;
	    	get_affiliate_products(janCode);
	    });
	    get_affiliate_products(janCode);
	}

	// $(".purchage_product").click(function(event) {
	// 	event.preventDefault();
	// 	alert("Okay");
	// });

	$(document).on("click",".purchage_product222222",function() {
	    var product_name = $(this).attr('attr-product-name');
	    var barcode = $(this).attr('attr-barcode');
	    var shop_name = $(this).attr('attr-shop-name');
	    var btn_link = $(this).attr('attr-btn-link');
	    var price = $(this).attr('attr-product-price');
	    var shop_point = $(this).attr('attr-shop-point');
	    var point = $(this).attr('attr-charin-point');
	    var affiliateRate = $(this).attr('attr-affiliateRate');
	    var asin = $(this).attr('attr-asin');
	    var base_url = $("#base_url").val();
	    $.ajax({
	    	url: base_url+'main_controller/add_purchage',
	    	type: 'POST',
	    	data: {price: price, point: point, shop_point: shop_point, shop_name: shop_name, barcode: barcode, product_name: product_name, affiliate_rate:affiliateRate, asin: asin},
	    })
	    .done(function(data) {
	    	// var userAgent = navigator.userAgent.toLowerCase();
	    	// if (userAgent.search(/android/) > -1) {
	    	// 	// window.open(btn_link);
	    	// 	window.location = btn_link;
	    	// }else{

	    		
	    	// }
	    	console.log("purchage_product");
	    })
	    .fail(function() {
	    	console.log("error");
	    })
	    .always(function() {
	    	console.log("complete");
	    });
	});



	

	function get_all_nodesId() {
		var base_url = $("#base_url").val();
		
		$.ajax({
			url: base_url+'main_controller/get_all_nodes',
			type: 'GET'
		})
		.done(function(data) {
			console.log(data);
			console.log("JsonSuccess");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("JsonComplete");
		});
		
	}
	var items = [];
	function getJsonFromfile(node_ids) {
		// console.log(node_ids.length);
		// return false;
		var base_url = $("#base_url").val();
		$.getJSON(base_url+"resource/js/amazon_commission_rate.json", function( data ) {
		  
		  $.each( data[2].data, function( key, val ) {
		  	// console.log(val.browse_node_id);
		  	// for (var i =0; i<node_ids.length; i++) {
		  	// 	console.log(node_ids[i].BrowseNodeId);
		  	// }
		    items.push({node_id:val.browse_node_id, commission_rate: val.commission_rate});
		  });

		  
		});

	}

	// function test_function() {
	// 	console.log(items);
	// }
	getJsonFromfile();
	var bowseNoceCommission = function(brsose_nodes) {
	  return new Promise(function(resolve, reject) {

	    var response;
	    var amazonRes = {};
	    $.ajax({
	    	url: 'main_controller/get_amazon_by_api/'+barcode,
	    	type: 'GET'
	    })
	    .done(function(data) {
	    	// console.log(data);
	    	// return false;
	    	var dom = parseXml(data);
	    	var jsonData = xml2json(dom, "");
	    	var response = JSON.parse(jsonData);
	    	resolve(response);
	    })
	    .fail(function() {
	    	console.log("error");
	    })
	    .always(function() {
	    	
	    });	   
	  });
	}
	var login_user_id = $('#login_user_id').val();
	$(".introduce_btn").click(function(event) {
		event.preventDefault();

		window.history.pushState(null, null, window.location.href);
		var login_user_id = $('#login_user_id').val();
		if (login_user_id != '') {
			$("#introduce_screen").removeClass('d-none').addClass('d-block');
		}else{
			$(".registration_alert").removeClass('d-none').addClass('d-block');
		}
	});

	// $(".user_login_btn").click(function(event) {
	$(document).on("click",".user_login_btn",function() {
		event.preventDefault();
		window.history.pushState(null, null, window.location.href);
		var base_url = $("#base_url").val();
		var role_id = $(this).attr('attr-user-role');
		var sign_in_username_email = localStorage['sign_in_username_email'];
		var sign_in_password = localStorage['sign_in_password'];
		$("#sign_in_username_email").val(sign_in_username_email);
		$("#sign_in_password").val(sign_in_password);
		var role_name = "";
		if (role_id == 1) {
			role_name = "ジャコス";
		}else if(role_id == 2){
			role_name = "加盟企業";
		}else if(role_id == 3){
			role_name = "会員";
		}

		$( "#sign_in_remember" ).prop( "checked", false );
		if (typeof localStorage['sign_in_password'] !=='undefined' && typeof localStorage['sign_in_username_email'] !=='undefined') {
			$( "#sign_in_remember" ).prop( "checked", true );
		}
		$("#role_name").text(role_name);
		$(".user_login_option").removeClass('d-block').addClass('d-none');
		$(".point_table_aria").removeClass('d-block').addClass('d-none');
		$('.customer_login_screen').removeClass('d-none').addClass('d-block');
		// $.ajax({
		// 	url: base_url+'account/sign_out',
		// 	type: 'GET'
		// })
		// .done(function() {
		// 	console.log("success");
		// })
		// .fail(function() {
		// 	console.log("error");
		// })
		// .always(function() {
		// 	console.log("complete");
		// });
	});

	$("#customer_login_screen_close").click(function(event) {
		event.preventDefault();				
		$(".customer_login_screen ").removeClass('d-block').addClass('d-none');
		// var point_view = $('#point_table_view').val();
		// if (point_view==1) {
		// 	$( "#point_table_btn" ).trigger( "click" );
		// }
		// $('#point_table_view').val(0);
		
	});

	$("#close_introduce_screen").click(function(event) {
		event.preventDefault();
		$("#introduce_screen").removeClass('d-block').addClass('d-none');
		
	});	
	var pos_val = "right bottom";
	var userAgent = navigator.userAgent.toLowerCase();
	// if (userAgent.search(/android/) > -1) {
	if ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
		pos_val = "left bottom";
	}
	// Single Select search_product_name
	// $( "#product_keyword3" ).autocomplete({
	//    	source: function( request, response ) {
	//     	var base_url = $("#base_url").val();	    	
	// 	    $.ajax({
	// 	    	url: base_url+'main_controller/get_yahoo_suggestion/',
	// 	     	type: 'post',
	// 	     	data: {
	// 	      		keyword: request.term
	// 	     	},
	// 	     	success: function( data ) {
	// 	     		var sugg_response = JSON.parse(data);

	// 	      		response(sugg_response);
	// 	     	},
	// 	     	error: function(data){
	// 	     		console.log(data);
	// 	     	}
	// 	    });
	// 	},
	// 	position: { 
	// 		my : "left top",
	// 		at : pos_val
	// 	},		
	//    	select: function (event, ui) {
	//    		event.preventDefault()
	// 	    $('#product_keyword3').val(ui.item.label); // display the selected text
	// 	    $('#selectuser_id').val(ui.item.value); // save selected id to input
	// 	    var ua = navigator.userAgent.toLowerCase(); 
	// 	     $('#product_keyword3').focusout();
	// 	     if (ui.item.jan != "") {
	// 	     	console.log("By JanCode")
	// 	     	console.log(ui.item.jan)
	// 	     	get_affiliate_products(ui.item.jan);
	// 	     	$("#can_product_search").val('0');
	// 	     }else{
	// 	     	console.log("By keyword")
	// 	     	get_affiliate_products(ui.item.label);
	// 	     	$("#can_product_search").val('0');
	// 	     }
	//    	}
	// })
	// .autocomplete( "instance" )._renderItem = function( ul, item ) {
 //      return $( "<li>" )
 //        .append( "<a class='autocomplete_item' href='#'>" + item.label +"</a>" )
 //        .appendTo( ul );
 //    };

	function throttle(f, delay){
	    var timer = null;
	    return function(){
	        var context = this, args = arguments;
	        clearTimeout(timer);
	        timer = window.setTimeout(function(){
	            f.apply(context, args);
	        },
	        delay || 200);
	    };
	}

	function parseXml(xml) {
	   var dom = null;
	   if (window.DOMParser) {
	      try { 
	         dom = (new DOMParser()).parseFromString(xml, "text/xml"); 
	      } 
	      catch (e) { dom = null; }
	   }
	   else if (window.ActiveXObject) {
	      try {
	         dom = new ActiveXObject('Microsoft.XMLDOM');
	         dom.async = false;
	         if (!dom.loadXML(xml)) // parse error ..

	            window.alert(dom.parseError.reason + dom.parseError.srcText);
	      } 
	      catch (e) { dom = null; }
	   }
	   else
	      alert("cannot parse xml string!");
	   return dom;
	}

	$("#registration_alert_close").click(function(event) {
		event.preventDefault();
		$("#purchase_history").css({
			"background-color": '##007bff',
			"border-color": '##007bff',
			"color" : "#fff"
		});
		$("#registration_alert").removeClass('d-block').addClass('d-none');    
	});

	$("#purchase_history").click(function(event) {
		event.preventDefault();

		window.history.pushState(null, null, window.location.href);
		var base_url = $("#base_url").val();
		var role_id = $("#role_id").val();
		$(this).css({
			"background-color": '#FFDE1F',
			"color": 'red',
			// "border-color": '#FFDE1F'
		});
		$.ajax({
			url: base_url+'main_controller/check_login',
			type: 'GET',
		})
		.done(function(data) {
			// alert(role_id);
			// return false;
			if (data) {
				var window_width = $( document ).width();
				var target_url = $("#base_url").val()+'history';
				if (role_id == "") {
					window.open(target_url, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=20,width="+window_width+",height=700");
				}else if(role_id == 1){
					window.location = base_url+"company_category";
				}else{
					window.location = base_url+"company_margine";
				}				
			} else {
				$("#customer_purchase_histry_open").val(1);
				$(".user_login_option").removeClass('d-block').addClass('d-none');
				$('.registration_alert').removeClass('d-none').addClass('d-block');
			}
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
		
	});
	var product_size_name = [];
	$.get($("#base_url").val()+'main_controller/get_product_size', function(data) {
		var resData = JSON.parse(data);
		product_size_name = resData;
	});

	$(".customer_reg_btn").click(function(event) {
		event.preventDefault();
		$(".registration_alert").removeClass('d-block').addClass('d-none');
		$("#customer_reg_btn").trigger('click');

	});

	function getParameterByName(name, url) {
	    if (!url) url = window.location.href;
	    name = name.replace(/[\[\]]/g, '\\$&');
	    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
	        results = regex.exec(url);
	    if (!results) return null;
	    if (!results[2]) return '';
	    return decodeURIComponent(results[2].replace(/\+/g, ' '));
	}

	function toASCII(chars) {
	    var ascii = '';
	    for(var i=0, l=chars.length; i<l; i++) {
	        var c = chars[i].charCodeAt(0);

	        // make sure we only convert half-full width char
	        if (c >= 0xFF00 && c <= 0xFFEF) {
	           c = 0xFF & (c + 0x20);
	        }

	        ascii += String.fromCharCode(c);
	    }

	    return ascii;
	}

	$(document).on("click",".voice_product_select",function(e) {
		e.preventDefault();
		var label = $(this).attr('attr-data-label');
		var value = $(this).attr('attr-data-value');
		var isbn = $(this).attr('attr-data-isbn');
		$("#itemsSearchModal").modal('hide');
		// $("#product_keyword3").val(label);
		$("#onchange_event").val(0);
		$(".recording-instructions").html("")
		$(".voice_suggestion_screen").removeClass('d-block').addClass('d-none');
		if (value !="") {
			get_affiliate_products(value);
		}else if (isbn !="") {}{
			get_affiliate_products(isbn);
		}
		
	});

	$("#forgot_password_screen_close").click(function(event) {
		event.preventDefault();				
		// $(".customer_login_screen").removeClass('d-none').addClass('d-block');				
		$("#member_reg_form").removeClass('d-none').addClass('d-block');				
		$(".forgot_password_screen").removeClass('d-block').addClass('d-none');				
	});
	$(".voice_suggestion_screen_close").click(function(event) {
		event.preventDefault();		
		window.history.back(-1);
		$(".recording-instructions").html('');
		$(".voice_suggestion_screen").removeClass('d-block').addClass('d-none');
		$(".voice_suggestion_screen2").removeClass('d-block').addClass('d-none');		
	});

	$(document).on('click', '.suggestion_screen_close', function(event) {
		event.preventDefault();
		$(".recording-instructions").html('');
		$(".clean_product_name").trigger('click');
		$("#clean_product_name").trigger('click');
		$("#onchange_event").val(1);
		$(".voice_suggestion_screen").removeClass('d-block').addClass('d-none');
		// $(".voice_suggestion_screen2").removeClass('d-block').addClass('d-none');
	});

	$("#login_option_close").click(function(event) {
		event.preventDefault();
		$(".user_login_option").removeClass('d-block').addClass('d-none');
	});

	$(document).on("click",".customer_reg_btn",function(event){
		event.preventDefault();
		$("#sign_up_fullname_error").text("");
		$("#sign_up_username_error").text("");
		$("#username_error").text("");
		$("#email_error").text("");
		$("#password_error").text("");
		$('form').find("input[type=text], textarea, input[type=password], input[type=email], input[type=tel]").val("");
		window.history.pushState(null, null, window.location.href);
		$("#member_reg_form").removeClass('d-none').addClass('d-block');

		$(".customer_login_screen").removeClass('d-block').addClass('d-none');
		$(".point_table_aria").removeClass('d-block').addClass('d-none');
	});

	$("#customer_reg_btn").click(function(event) {
		$('#point_table_view').val(0);
	});

	$("#user_login_btn").click(function(event) {
		$('#point_table_view').val(0);
	});

	$(document).on("click","#login_point_table",function() {

	});

	$('.new_member_reg_form_close').click(function(event) {
		event.preventDefault();
		$('#member_reg_form').removeClass('d-block').addClass('d-none');
		var point_table_view = $("#point_table_view").val();
		if (point_table_view==1) {
			$( "#point_table_btn" ).trigger( "click" );
		}
		$('#point_table_view').val(0);
		// $(".customer_login_screen").removeClass('d-none').addClass('d-block');
	});

	$("#point_table_aria_close").click(function(event) {
		event.preventDefault();
		$("#point_table_btn").css({
			"background-color": '##007bff',
			"border-color": '##007bff',
			"color" : "#fff"
		});
		$('.point_table_aria').removeClass('d-block').addClass('d-none');
	});

	

	$(".close_loged_user_infor").click(function(event) {
		$("#logedin_user_information").removeClass('d-block').addClass('d-none');
	});
	$("#android_open_screen_btn").click(function(event) {
		$("#android_screen").removeClass('d-block').addClass('d-none')
		$("#android_open_screen").removeClass('d-none').addClass('d-block')
	});

	$("#android_camera_screen_btn").click(function(event) {
		$("#android_open_screen").removeClass('d-block').addClass('d-none')
		$("#android_camera_screen").removeClass('d-none').addClass('d-block')
	});

	$("#inistall_android_apps_btn").click(function(event) {
		window.close();
		$("#android_camera_screen").removeClass('d-block').addClass('d-none');

		var main_uri = encodeURI('https://jafa.dev.jacos.jp/compare');
		var ANDROID_SCHEME = 'pic2shop://scan?callback='+main_uri+'%3Fgl%3Dus%26source%3Dmog%26hl%3Den%26source%3Dgp2%26q%3DEAN%26btnProductsHome%3DSearch%2BProducts';
		var ANDROID_PACKAGE = 'com.visionsmarts.pic2shop';
		document.location = 'intent://#Intent;scheme=' + ANDROID_SCHEME + ';package=' + ANDROID_PACKAGE + ';end';
	});

	$("#close_android_open_screen").click(function(event) {
		$("#android_screen").removeClass('d-none').addClass('d-block')
		$("#android_open_screen").removeClass('d-block').addClass('d-none')
	});
	$("#close_android_camera_screen").click(function(event) {
		$("#android_open_screen").removeClass('d-none').addClass('d-block')
		$("#android_camera_screen").removeClass('d-block').addClass('d-none')
	});

	$("#open_iphone_install_btn").click(function(event) {
		$("#iphone_install_screen").removeClass('d-none').addClass('d-block');
		$("#iphone_browsing_screen").removeClass('d-block').addClass('d-none');
	});
	$("#open_app_open_btn").click(function(event) {
		$("#iphone_open_screen").removeClass('d-none').addClass('d-block');
		$("#iphone_install_screen").removeClass('d-block').addClass('d-none');
	});
	$("#open_iphone_camra_btn").click(function(event) {
		$("#iphone_camera_screen").removeClass('d-none').addClass('d-block');
		$("#iphone_open_screen").removeClass('d-block').addClass('d-none');
	});

	$("#open_iphone_jafa_btn").click(function(event) {
		$("#iphone_jafa_screen").removeClass('d-none').addClass('d-block');
		$("#iphone_camera_screen").removeClass('d-block').addClass('d-none');
	});

	$("#open_iphone_last_screen").click(function(event) {
		$("#iphone_last_screen").removeClass('d-none').addClass('d-block');
		$("#iphone_jafa_screen").removeClass('d-block').addClass('d-none');
	});

	$("#go_itune_btn").click(function(event) {
		$("#iphone_last_screen").removeClass('d-block').addClass('d-none');
		pic2shop_iphone_installation()
	});

	$("#close_iphone_browsing").click(function(event) {
		$("#iphone_browsing_screen").removeClass('d-block').addClass('d-none');
	});

	$("#close_iphone_install_screen").click(function(event) {
		$("#iphone_install_screen").removeClass('d-block').addClass('d-none');
	});
	$("#close_iphone_open_screen").click(function(event) {
		$("#iphone_open_screen").removeClass('d-block').addClass('d-none');
	});

	$("#close_iphone_camera_screen").click(function(event) {
		$("#iphone_camera_screen").removeClass('d-block').addClass('d-none');
	});

	$("#close_iphone_jafa_screen").click(function(event) {
		$("#iphone_jafa_screen").removeClass('d-block').addClass('d-none');
	});

	$("#see_case_product").click(function(event) {
		$("#product_case_message").removeClass('d-block').addClass('d-none');
	});

	$("#barcode_reading_btn").click(function(event) {

		$("#barcode_reading_navi").removeClass('d-none').addClass('d-block');
	});

	$("#close_barcode_reading").click(function(event) {
		$("#barcode_reading_navi").removeClass('d-block').addClass('d-none');
	});

	$("#save_introduce").click(function(event) {
		event.preventDefault();
		// alert("Okay");
		// return false;
		var base_url = $("#base_url").val();

		$("#partner_contact_success_aria").removeClass('d-none').addClass('d-block');
		$("#introduce_screen").removeClass('d-block').addClass('d-none');

		var introduce_name =  $('input[name^=introduce_name]').map(function(idx, elem) {
		    return $(elem).val();
		  }).get();
		// var introduce_phone = $("#introduce_phone").val()
		var introduce_phone = $('input[name^=introduce_phone]').map(function(idx, elem) {
		    return $(elem).val();
		  }).get();
		var introduce_email = $('input[name^=introduce_email]').map(function(idx, elem) {
		    return $(elem).val();
		  }).get();

		// var partner_email = $("#introduce_email").val();
		// console.log(introduce_phone);
		// return false;
		if (introduce_name[0] != '' && introduce_phone[0] !='' && introduce_email[0] !='' ) {

			var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
			if(!introduce_email[0].match(mailformat))
			{			
				$("#email_sending_message").html('<p style="font-size:20px;" class="text-danger">メールアドレス形式が不正です。</p>');
				return false;			
			}else{
				$.ajax({
					url: base_url+'main_controller/save_introduce',
					type: 'POST',
					data: {introduce_name: introduce_name, partner_contact: introduce_phone, partner_email: introduce_email},
				})
				.done(function(data) {
					var response = JSON.parse(data);
					var html_data = '';
					if (response.success==1) {
						html_data = '<p style="font-size:20px;" class="text-success">メールが送信されました。</p>';
						html_data += '<ul>';
						for (var i = 0; i < response.data.length; i++) {
							html_data += '<li style="font-size:18px;">'+response.data[i].partner_name+'('+response.data[i].partner_contact+')</li>';
						}
						html_data += '</ul>';
					} else {
						var html_data = response.data;
					}

					$("#email_sending_message").html(html_data);
					
					
					$("#introduce_name0").val('')
					$("#introduce_phone0").val('')
					$("#introduce_email0").val('')
					$("#introduce_name1").val('')
					$("#introduce_phone1").val('')
					$("#introduce_email1").val('')
					$("#introduce_name2").val('')
					$("#introduce_phone2").val('')
					$("#introduce_email2").val('')
					console.log("success");
				})
				.fail(function(data) {
					console.log(data);
				})
				.always(function() {
					console.log("complete");
				});
			}			
			
		}else{
			var html_data = "";
			var val_errors = [];
			if (introduce_name[0] == '') {
				val_errors.push('お名前');
			}
			if (introduce_phone[0] == '') {
				val_errors.push('携帯番号');
			}
			if (introduce_email[0] == '') {
				val_errors.push('メール');
			}
			var string = "";
			for (var i = 1; i <= val_errors.length; i++) {
				string += val_errors[i-1];
				if (i!=val_errors.length) {
					string += '・'
				}
			}
			$("#email_sending_message").html('<p style="font-size:20px;" class="text-danger">'+string+'は必須です。</p>');
			val_errors = [];
			return false;
		}
	});
	$(".partner_list_btn").click(function(event) {
		var base_url = $('#base_url').val();
		// alert(base_url);
		// return false;
		$.ajax({
			url: base_url+'main_controller/get_user_partner',
			type: 'GET',
		})
		.done(function(data) {

			var response = JSON.parse(data);

			var tbleHtml = '';
			tbleHtml += '<thead>';
				tbleHtml += '<tr>';
					tbleHtml += '<th>紹介相手</th>';
					tbleHtml += '<th>携帯番号</th>';
				tbleHtml += '</tr>';
			tbleHtml += '</thead><tbody>';
			for (var i = 0; i <response.length; i++) {
				console.log(response[i].partner_name);
				tbleHtml += '<tr>';
					tbleHtml += '<td>'+response[i].partner_name+'</td>';
					tbleHtml += '<td>'+response[i].partner_contact+'</td>';
				tbleHtml += '</tr>';
			}
			tbleHtml += '</tbody>'
			$('#partner_list').html(tbleHtml);

		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	});

	$(".clean_product_name").click(function(event) {
		$("#itemsSearchModal").modal('hide');
		$(".product_keyword3").val("");
		
		$('html, body').animate({
	        scrollTop: $("#product_keyword3").offset().top
	    }, 500);
		
		$("#comparing_table .data_td").text('');
		$("#mobile_compare_table .data_td").text('');
		$(".product_keyword3").val("");
		$("#product_keyword3").val("");
		$(".recording-instructions").html('');
		$(".product_keyword3").focus();
		
	});

	$("#clean_product_name").click(function(event) {
		$("#product_keyword3").val("");
		$(".purchage_product").attr('href', '#');
		$("#comparing_table .data_td").text('');
		$("#mobile_compare_table .data_td").text('');
		$("#jan_product_name").html('&nbsp');
		$("#jan_product_name2").html('&nbsp');
		$("#can_product_search").val('1');
		$(".product_image_parent").addClass('d-none').removeClass('d-block');

		var html_string = "";
		html_string += "<tr>";	
			html_string += '<th nowrap class="align-middle text-center" style="border-left: 0; border-top:0; background-color: white">ショップ</th>';			        		
			html_string += '<th nowrap class="align-middle text-center" style="border-right: 0; border-top: 0; background-color: #CBEBF6;">実質価格</th>';
			html_string += '<th nowrap class="align-middle text-center" style="border-right: 0; border-top: 0;background-color: white ">価格</th>';
			html_string += '<th style="background-color: white " nowrap class="align-middle text-center">ショップP</th>';
			html_string += '<th style=" background-color: #CBEBF6; " nowrap class="align-middle text-center">チャリン<sup>2</sup>P</th>'
			html_string += '<th style="background-color: white" nowrap class="align-middle text-center">サイト</th>';
		html_string += '</tr>';

		for (var i = 1; i < 4; i++) {
			html_string += '<tr>'
				html_string += '<td style="border-left: 0;">'+i+' 位</td>';
				html_string += '<td style=" background-color: #CBEBF6;"></td>';
				html_string += '<td style=""></td>';
				html_string += '<td style=""></td>';
				html_string += '<td style="background-color: #CBEBF6;"></td>';
				html_string += '<td style="border-right: 0;"></td>';
			html_string += '</tr>';
		}

		$( "#mobile_compare_table" ).html( html_string );

	});

	$("#amazon_gift_pint_btn").click(function(event) {
		event.preventDefault();
		if (permannent_pt>499) {
			$(".point_table_aria").addClass('d-none').removeClass('d-block');
			$("#amazon_gift_pint_aria").addClass('d-block').removeClass('d-none');
		}else{
			$("#condition_less_content_aria").text("500ポイント未満なので、交換できません");
			$(".cornvert_point_condition_less_aria").addClass('d-block').removeClass('d-none');
		}
	});

	$("#amazon_gift_pint_aria_close").click(function(event) {
		event.preventDefault();
		$(".point_table_aria").addClass('d-block').removeClass('d-none');
		$("#amazon_gift_pint_aria").addClass('d-none').removeClass('d-block');

	});

	$("#amazon_gift_pint_purchase_btn44").click(function(event) {
		event.preventDefault();
		$("#amazon_gift_pint_aria").addClass('d-none').removeClass('d-block');
		$("#amazon_gift_pint_purchase_aria").addClass('d-block').removeClass('d-none');
	});
	$("#amazon_gift_pint_purchase_aria_close").click(function(event) {
		$("#amazon_gift_pint_purchase_aria").addClass('d-none').removeClass('d-block');
		$("#amazon_gift_pint_aria").addClass('d-block').removeClass('d-none');
		// $("#amazon_gift_pint_purchase").addClass('d-block').removeClass('d-none');
	});

	
	// $("#amazon_gift_pint_purchase_finish_btn").click(function(event) {
	// 	event.preventDefault();
	// 	alert("Okay");
	// 	// return false;
	// 	$("#amazon_gift_pint_purchase_aria").addClass('d-none').removeClass('d-block');
	// 	$("#cornvert_point_condition_getter_aria").addClass('d-block').removeClass('d-none');
	// });

	$(".partner_contact_success_aria_close").click(function(event) {
		$("#partner_contact_success_aria").addClass('d-none').removeClass('d-block');
		$("#introduce_screen").addClass('d-block').removeClass('d-none');
	});

	$(".sent_password_reset_link_sent_screen_close").click(function(event) {
		event.preventDefault();
		$("#sent_password_reset_link_sent_screen").removeClass('d-block').addClass('d-none');
	});

	$(document).on('click', '.customer_sign_up_btn', function(event) {
		event.preventDefault();
		/* Act on the event */
		var sign_up_fullname = $("#sign_up_fullname").val();
		var sign_up_username = $("#ajax_sign_up_username").val();
		var sign_up_email = $("#sign_up_email").val();
		sign_up_email = sign_up_email.toLowerCase();
		var sign_up_password = $("#ajax_sign_up_password").val();
		var sign_up_passconf = $("#passconf").val();
		var parent_id = $("#parent_id").val();
		// alert(referal);
		// return false;

		// validation
		if (sign_up_fullname == "") {
			$("#sign_up_fullname").focus();
			$("#sign_up_fullname_error").text("お名前は必須です");
			return false;
		}else{
			$("#sign_up_fullname_error").text("");
		}
		if (sign_up_username == "") {
			$("#ajax_sign_up_username").focus();
			$("#sign_up_username_error").text("携帯電話は必須です");
			return false;
		}
		if (sign_up_email == "") {
			$("#sign_up_email").focus();
			return false;
		}
		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

		if(!sign_up_email.match(mailformat))
		{
			$("#").addClass('d-block').removeClass('d-none');
			$("#sign_up_email").focus();
			$("#email_error").text("メールアドレス形式が不正です");
			return false;			
		}else{
			$("#").addClass('d-none').removeClass('d-block');
			$("#email_error").text("");
		}
		if (sign_up_password == "") {
			$("#ajax_sign_up_password").focus();
			return false;
		}
		if (sign_up_passconf == "") {
			$("#passconf").focus();
			return false;
		}
		if (sign_up_passconf !== sign_up_password) {
			$("#").addClass('d-block').removeClass('d-none');
			$("#password_error").text("パスワードが一致しません");
			$("#passconf").focus();
			return false;
		}

		$.ajax({
			url: 'account/sign_up/ajax_sign_up',
			type: 'POST',
			data: {fullname: sign_up_fullname, sign_up_username:sign_up_username, sign_up_email:sign_up_email, sign_up_password:sign_up_password,  passconf:sign_up_passconf, parent_id:parent_id},
		})
		.done(function(data) {
			var response = JSON.parse(data);
			if (response.success == 1) {
				$("#member_reg_form").removeClass('d-block').addClass('d-none');
				$("#activation_email_sent_screen").removeClass('d-none').addClass('d-block');
			}else{
				$("#").addClass('d-block').removeClass('d-none');
				$("#validation_errors").html(response.message);
			}			
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});		
	});

	$(document).on('change', '#ajax_sign_up_username', function(event) {
		event.preventDefault();
		var sign_up_username = $(this).val();

		if (sign_up_username !="") {
			$.ajax({
				url: 'account/sign_up/username_check_exist/'+sign_up_username,
				type: 'GET'
			})
			.done(function(data) {
				var response = JSON.parse(data);
				if (response.success == 1) {
					$("#username_error").text(response.message);
				}else{
					$("#username_error").text("");
				}
				console.log(data);
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
		}
	});

	$(document).on('change', '#sign_up_fullname', function(event) {
		event.preventDefault();
		var sign_up_fullname = $(this).val();
		if (sign_up_fullname == "") {
			
			$("#sign_up_fullname_error").text("お名前は必須です");
		}else{
			$("#sign_up_fullname_error").text("");
		}
	});
	$(document).on('change', '#sign_up_email', function(event) {
		event.preventDefault();
		var sign_up_email = $(this).val();
		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

		if(!sign_up_email.match(mailformat))
		{
			$("#").addClass('d-block').removeClass('d-none');
			$("#sign_up_email").focus();
			$("#email_error").text(sign_up_email+"が間違いです。");
			return false;			
		}else{
			$("#email_error").text("");
		}
		var base_url = $("#base_url").val();
		if (sign_up_email !="") {
			$.ajax({
				url: base_url+'account/sign_up/email_check_exist',
				type: 'POST',
				data: {email: sign_up_email}
			})
			.done(function(data) {
				console.log(data);
				var response = JSON.parse(data);
				if (response.success == 1) {
					$("#email_error").text(response.message);
				}else{
					$("#email_error").text("");
				}
				console.log(data);
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
		}
	});

	$(".activation_email_sent_screen_close").click(function(event) {
		event.preventDefault();
		$("#activation_email_sent_screen").removeClass('d-block').addClass('d-none');
	});

	$(document).on('click', '.customer_login_btn', function(event) {
		event.preventDefault();
		var sign_in_username_email = $("#sign_in_username_email").val();
		var sign_in_password = $("#sign_in_password").val();
		

		if (sign_in_username_email == "") {
			$("#sign_in_username_email").focus();
			return false;
		}
		if (sign_in_password == "") {
			$("#sign_in_password").focus();
			return false;
		}
		var base_url = $("#base_url").val();
		var sign_in_remember = null;
		if($("#sign_in_remember").prop('checked') == true){
		    sign_in_remember = $("#sign_in_remember").val();
		    localStorage['sign_in_username_email'] = sign_in_username_email;
		    localStorage['sign_in_password'] = sign_in_password;
		    // alert(sign_in_password);
		    // return false;
		}else{
			localStorage['sign_in_username_email'] = "";
			localStorage['sign_in_password'] = "";
		}
		// console.log(localStorage['sign_in_password']);
		// console.log(localStorage['sign_in_username_email']);
		if (localStorage['sign_in_password'] != "" && localStorage['sign_in_username_email'] !="") {
			// Check #x
			$( "#sign_in_remember" ).prop( "checked", true );
		}else{
			// Uncheck #x
			$( "#sign_in_remember" ).prop( "checked", false );
		}
						
		$.ajax({
			url: base_url+'account/sign_in/ajax_sign_in',
			type: 'POST',
			data: {sign_in_username_email: sign_in_username_email, sign_in_password:sign_in_password, sign_in_remember:sign_in_remember},
		})
		.done(function(data) {
			console.log(data);
			var jsonresponse = JSON.parse(data);

			var purchase_history = $("#customer_purchase_histry_open").val();
			if (jsonresponse.loged_in == 1) {
				if (purchase_history==1) {
					var target_url = $("#base_url").val()+'history';
					window.open(target_url, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=20,width=1200,height=700");
					if (jsonresponse.user.role_id ==1) {
						// window.location = 'admin_company_point';
						window.location = 'company_category';
					} else {
						window.location = base_url+'?tracking_id='+jsonresponse.tracking_id;
					}
				} else if (jsonresponse.user.role_id ==1) {
					// window.location = 'admin_company_point';
					window.location = 'company_category';
				}else if (jsonresponse.user.role_id ==2) {
					window.location = 'company_margine';
				} else {
					// window.location = '';
					window.location = base_url+'?tracking_id='+jsonresponse.tracking_id;
				}
				
			} else {
				$("#login_message").text(jsonresponse.message)
			}
			console.log(jsonresponse);
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	});
	$(document).on('click', '.forgot_password', function(event) {
		event.preventDefault();
		// alert("Okay");
		// $("#forgot_username_email").focus();
		$(".forgot_password_screen").removeClass('d-none').addClass('d-block');
		// $(".customer_login_screen").removeClass('d-block').addClass('d-none');
		$(".introduce_screen").removeClass('d-block').addClass('d-none');
	});



	

	$(document).on('click', '.sent_password_reset_link', function(event) {
		event.preventDefault();
		var base_url = $("#base_url").val();
		var forgot_username_email = $("#forgot_username_email").val();
		if (forgot_username_email =="") {
			// alert("携帯番号/メール are required");
			$("#forgot_password_error").text("携帯番号は必須です");
			$("#forgot_username_email").focus();
			return false
		}
		$.ajax({
			url: base_url+'account/forgot_password/ajax_forgot_password',
			type: 'POST',
			data: {forgot_username_email: forgot_username_email},
		})
		.done(function(data) {
			var response = JSON.parse(data);
			console.log(response);
			if (response.success == 1) {
				$("#sent_password_reset_link_sent_screen").removeClass('d-none').addClass('d-block');
				$(".forgot_password_screen").removeClass('d-block').addClass('d-none');
				$(".sent_password_reset_message").text(response.message);
			}else{
				$("#forgot_password_error").text(response.message);
			}
			console.log(response.message);
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	});

	
	$(document).on('click', '.change_password', function(event) {
		event.preventDefault();
		$(".change_password_screen").removeClass('d-none').addClass('d-block');
	});

	$(".save_change_password").click(function(event) {
		var base_url = $("#base_url").val();
		var password_new_password = $("#password_new_password").val();
		var password_retype_new_password = $("#password_retype_new_password").val();
		if ($.trim(password_retype_new_password).length < 4 || $.trim(password_new_password).length <4) {
			$("#change_password_error").text('パスワード最小長は4文字です。')
		}else{
			$.ajax({
				url: base_url+'account/account_password/ajax_change_password',
				type: 'POST',
				data: {password_new_password: password_new_password, password_retype_new_password: password_retype_new_password},
			})
			.done(function(data) {
				var response = JSON.parse(data);
				if (response.success == 1) {
					$(".change_password_screen").removeClass('d-block').addClass('d-none');
					$("#sent_password_reset_link_sent_screen").removeClass('d-none').addClass('d-block');
					$(".sent_password_reset_message").text(response.message);
					localStorage['sign_in_password'] = password_new_password;
					$("#sign_in_password").value(password_new_password);
				}
				
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
		}
	});

	$("#change_password_screen_close").click(function(event) {
		$(".change_password_screen").removeClass('d-block').addClass('d-none');
	});

	var permannent_pt = 0;
	var temporary_pt = 0;
	$("#point_table_btn").click(function(event) {
		event.preventDefault();
		window.history.pushState(null, null, window.location.href);
		var user_id = $("#login_user_id").val();
		$("#amazon_gift_pint_btn").removeClass('d-block').addClass('d-none');
		$('.point_table_aria').removeClass('d-none').addClass('d-block');
		var base_url = $("#base_url").val();
		var user_id = $("#login_user_id").val();
		$(this).css({
			"background-color": '#FFDE1F',
			"color": 'red',
			"border-color": '#FFDE1F'
		});
		$.ajax({
			url: base_url+'main_controller/get_user_amazon_point',
			type: 'GET',
		})
		.done(function(data) {
			var response = JSON.parse(data);
			var html_data = "";
			var total_point = 0;
			if (response.success==1) {
				user_temp_point = response.temporary_point==null? 0: response.temporary_point;
				user_perm_point = response.permanent_point==null? 0: response.permanent_point;

				user_temp_point = parseInt(user_temp_point);
				user_perm_point = parseInt(user_perm_point);
				temporary_pt = user_temp_point;
				permannent_pt = user_perm_point;

				var option_data = "";
				var option_value = Math.floor((user_perm_point/500));
				// if (option_value>10) {
					for (var b = 1; b < 11; b++) {
						option_data += '<option value="'+500*b+'">'+500*b+'</option>';
					}
				// }else{
				// 	for (var a = 1; a < (option_value+1); a++) {
				// 		option_data += '<option value="'+500*a+'">'+500*a+'</option>';
				// 	}
				// }
				
				$(".point_convert_amount").html(option_data);
				
				html_data += "<tr>";
					html_data += '<th>ポイント合計</th>';
					html_data += '<th class="text-right" colspan ="2">'+Math.floor(user_temp_point+user_perm_point)+'</th>';
				html_data += "<tr>";
				html_data += "<tr>";
					html_data += '<th>未確定pt</th>';
					html_data += '<th class="text-right" colspan ="2">'+Math.floor(user_temp_point)+'</th>';
				html_data += "<tr>";
				html_data += "<tr>";
					html_data += '<th>確定pt</th>';
					html_data += '<th class="text-right" colspan ="2">'+Math.floor(user_perm_point)+'</th>';
				html_data += "<tr>";
				$("#amazon_gift_pint_btn").removeClass('d-none').addClass('d-block');
			} else {
				html_data += '<tr >';
					html_data+="<td colspan='2' class='text-center'>";
						html_data += '<h4>会員登録をしてください。</h4>'
						// html_data +='<button style="margin-right:10px;" class="btn jafa_btn user_login_btn btn-lg" id="login_point_table">ログイン</button>';
						html_data +='<button class="btn btn-primary customer_reg_btn  btn-lg" id="register_point_table">登録</button>';
					html_data += "</td>"
				html_data += '</tr>';
				
			}
			$("#point_table_dynamic_data").html(html_data);
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
										
	});

	$("#point_convert_amount_text").click(function(event) {
		event.preventDefault();
		$(".text_point_aria").addClass('d-block').removeClass('d-none');

	});

	$(".point_convert_list").click(function(event) {
		var list = $(this).text();
		$("#point_convert_amount_text").val(list);
		$(".text_point_aria").addClass('d-none').removeClass('d-block');
		$(".point_convert_amount").html('<option value="'+list+'">'+list+'</option>');
	});

	$("#amazon_gift_pint_purchase_btn").click(function(event) {
		event.preventDefault();
		
		var req_conver = $(".point_convert_amount").val();
		// alert(req_conver)
		// return false;
		
		if (permannent_pt>499) {
			var base_url = $("#base_url").val();
			if (req_conver > permannent_pt) {
				var customer_match = Math.floor(permannent_pt/500);
				customer_match = (customer_match*500);
				$(".cornvert_point_condition_less_aria").addClass('d-block').removeClass('d-none');
				// ９３０Ｐの確定に対して、１０００Ｐを押した」場合は、ナビ「交換ポイントをご確認ください。
				$(".condition_less_content_aria").text("交換ポイントをご確認ください。");
				// console.log(customer_match);
				return false;
			}
			
			$.ajax({
				url: base_url+'main_controller/convirte_amazon_point',
				type: 'POST',
				data: {req_conver: req_conver},
			})
			.done(function(data) {
				var resData = JSON.parse(data);
				permannent_pt = resData.remaint_permanent_point;
				$(".parmanet_exc_point").text(permannent_pt);
				$(".converted_point").text(resData.conver_point);
				console.log("success");
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			// return false;
			$("#amazon_gift_pint_purchase_aria").addClass('d-none').removeClass('d-block');
			$("#cornvert_point_condition_getter_aria").addClass('d-block').removeClass('d-none');
			$("#amazon_gift_pint_aria").addClass('d-none').removeClass('d-block');
		}else{
			$(".condition_less_content_aria").text("500ポイント未満なので、交換できません");
			$(".cornvert_point_condition_less_aria").addClass('d-block').removeClass('d-none');
		}

	});

	$("#cornvert_point_condition_getter_aria_close").click(function(event) {
		$("#cornvert_point_condition_getter_aria").addClass('d-none').removeClass('d-block');
	});

	$(".cornvert_point_condition_less_aria_close").click(function(event) {

		$("#cornvert_point_condition_less_aria").addClass('d-none').removeClass('d-block');
		$("#amazon_gift_pint_aria").addClass('d-none').removeClass('d-block');
		$(".point_table_aria").addClass('d-block').removeClass('d-none');
	});
	$(".cornvert_point_condition_less_aria_close").click(function(event) {

		$(".cornvert_point_condition_less_aria").addClass('d-none').removeClass('d-block');
		$("#amazon_gift_pint_aria").addClass('d-none').removeClass('d-block');
		$(".point_table_aria").addClass('d-block').removeClass('d-none');
	});

	$(document).on('click', '#login_point_table', function(event) {
		event.preventDefault();
		$("#point_table_view").val(1);
		/* Act on the event */
	});

	$(document).on('click', '#register_point_table', function(event) {
		event.preventDefault();
		$("#point_table_view").val(1);
		/* Act on the event */
	});



	$("#management_tbl_btn").click(function(event) {
		event.preventDefault();
		var base_url = $("#base_url").val();
		var user_id = $("#login_user_id").val();
		// $("#management_tbl_btn").removeClass('d-block').addClass('d-none');
		$('.login_screen').removeClass('d-none').addClass('d-block');
		$.ajax({
			url: base_url+'account/sign_out',
			type: 'GET'
		})
		.done(function() {
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	});

	$("#barcode_scan_option_close").click(function(event) {
	    event.preventDefault();
	    $(".barcode_scan_option").removeClass('d-block').addClass('d-none');
	});

	$(".pic2shop_app_option").click(function(event) {
		event.preventDefault();
		var main_uri = encodeURI('https://jafa.dev.jacos.jp/compare');
		var IOS_SCHEME = 'pic2shop://scan?callback='+main_uri+'%3Fgl%3Dus%26source%3Dmog%26hl%3Den%26source%3Dgp2%26q%3DEAN%26btnProductsHome%3DSearch%2BProducts';
		var IOS_STORE = 'https://itunes.apple.com/app/pic2shop-shop-by-barcode/id308740640?mt=8';
		// var IOS_STORE = 'https://itunes.apple.com/app/pic2shop-shop-by-barcode/id=308740640&mt=8';
		var ANDROID_SCHEME = 'pic2shop://scan?callback='+main_uri+'%3Fgl%3Dus%26source%3Dmog%26hl%3Den%26source%3Dgp2%26q%3DEAN%26btnProductsHome%3DSearch%2BProducts';
		var ANDROID_PACKAGE = 'com.visionsmarts.pic2shop';
		var userAgent = navigator.userAgent.toLowerCase();
		// iPhone端末ならアプリを開くかApp Storeを開く。
		if (userAgent.search(/iphone|ipad|ipod/) > -1) {
			
			window.location = 'pic2shop://scan?callback='+main_uri+'%3Fgl%3Dus%26source%3Dmog%26hl%3Den%26source%3Dgp2%26q%3DEAN%26btnProductsHome%3DSearch%2BProducts';
		}
		// Android端末ならアプリを開くかGoogle Playを開く。
		else if (userAgent.search(/android/) > -1) {
			
			// window.location = 'intent://#Intent;scheme=' + ANDROID_SCHEME + ';package=' + ANDROID_PACKAGE + ';end';
			window.location = ANDROID_SCHEME;
		}else{
			alert("It is only for Mobile");
		}

	});
	$(".webCam_option").click(function(event) {
		event.preventDefault();
		if (_scannerIsRunning) {
		    _scannerIsRunning = false;
		    Quagga.stop();
		    // $('#barcode_scanner').modal('hide');
		    $("#scanner-container").hide();
		}else{
			$("#scanner-container").show();
			// $('#barcode_scanner').modal('show');
			startScanner();
		}

	});
	$("#barcode").click(function(event) {
		$("#barcode").val('');
	});

	$(".profite_tabel_btn").click(function(event) {
		event.preventDefault();
		$(".product_infor_card").removeClass('d-none').addClass('d-block');
	});

	$(".btn-close").click(function(event) {
		$(".product_infor_card").removeClass('d-block').addClass('d-none');
	});	

	$("#close_android_screen").click(function(event) {
		$(".android_screen").removeClass('d-block').addClass('d-none');
	});



	$("#jancode_product_name").keyup(function(event) {
		event.preventDefault();
		var janCode = $(this).val();
		if (event.keyCode==13) {
			$('#jancode_product_name').blur();
		}
	});

	$(document).mouseup(function (e){
		// var hide_enter_outside = $(".point_details_table");
		// var member_reg_form = $("#member_reg_form");
		// if (!hide_enter_outside.is(e.target) && hide_enter_outside.has(e.target).length === 0)
		// {
		//     hide_enter_outside.removeClass('d-block').addClass('d-none');            
		// }
		// // if (!member_reg_form.is(e.target) && member_reg_form.has(e.target).length === 0)
		// // {
		// //     member_reg_form.removeClass('d-block').addClass('d-none');            
		// // }

		// var barcode_scan_option = $(".barcode_scan_option");
		// if (!barcode_scan_option.is(e.target) && barcode_scan_option.has(e.target).length === 0)
		// {
		//     barcode_scan_option.removeClass('d-block').addClass('d-none');            
		// }	

		// var point_table_aria = $(".point_table_aria");
		// if (!point_table_aria.is(e.target) && point_table_aria.has(e.target).length === 0)
		// {
		//     point_table_aria.removeClass('d-block').addClass('d-none');            
		// }
	});



	$(document).mouseup(function (e){
		// var hide_enter_outside = $(".screen_message");
		// if (!hide_enter_outside.is(e.target) && hide_enter_outside.has(e.target).length === 0)
		// {
		//     hide_enter_outside.removeClass('d-block').addClass('d-none');            
		// }
	});



	$(document).mouseup(function (e){
		// var hide_enter_outside = $(".login_screen");
		// var registration_alert = $(".registration_alert");
		// var customer_enter_outside = $(".customer_login_screen");
		// // var forgot_password_screen = $(".forgot_password_screen");
		// var sent_password_reset_link_sent_screen = $("#sent_password_reset_link_sent_screen");
		// var voice_suggestion_screen = $(".voice_suggestion_screen");
		// var change_password_screen = $(".change_password_screen");
		// var amazon_gift_pint_purchase_aria = $("#amazon_gift_pint_purchase_aria");
		// var amazon_gift_pint_aria = $("#amazon_gift_pint_aria");
		// if (!hide_enter_outside.is(e.target) && hide_enter_outside.has(e.target).length === 0)
		// {
		//     hide_enter_outside.removeClass('d-block').addClass('d-none');            
		// }
		// if (!registration_alert.is(e.target) && registration_alert.has(e.target).length === 0)
		// {
		//     registration_alert.removeClass('d-block').addClass('d-none');            
		// }
		// if (!change_password_screen.is(e.target) && change_password_screen.has(e.target).length === 0)
		// {
		//     change_password_screen.removeClass('d-block').addClass('d-none');            
		// }
		// if (!sent_password_reset_link_sent_screen.is(e.target) && sent_password_reset_link_sent_screen.has(e.target).length === 0)
		// {
		//     sent_password_reset_link_sent_screen.removeClass('d-block').addClass('d-none');            
		// }
		// if (!forgot_password_screen.is(e.target) && forgot_password_screen.has(e.target).length === 0)
		// {
		//     forgot_password_screen.removeClass('d-block').addClass('d-none');           
		// }
		// if (!customer_enter_outside.is(e.target) && customer_enter_outside.has(e.target).length === 0)
		// {
		//     customer_enter_outside.removeClass('d-block').addClass('d-none');            
		// }
		// if (!amazon_gift_pint_purchase_aria.is(e.target) && amazon_gift_pint_purchase_aria.has(e.target).length === 0)
		// {
		//     amazon_gift_pint_purchase_aria.removeClass('d-block').addClass('d-none');            
		// }
		// if (!amazon_gift_pint_aria.is(e.target) && amazon_gift_pint_aria.has(e.target).length === 0)
		// {
		//     amazon_gift_pint_aria.removeClass('d-block').addClass('d-none');            
		// }

		// if (!voice_suggestion_screen.is(e.target) && voice_suggestion_screen.has(e.target).length === 0)
		// {
		//     voice_suggestion_screen.removeClass('d-block').addClass('d-none');   
		//     $("#onchange_event").val(1);         
		// }
	});
	
	$(document).mouseup(function (e){
		// var hide_enter_outside = $(".customer_point_table");
		// if (!hide_enter_outside.is(e.target) && hide_enter_outside.has(e.target).length === 0)
		// {
		//     hide_enter_outside.removeClass('d-block').addClass('d-none');
		// }
	});

	$(document).mouseup(function (e){
		// var hide_enter_outside = $("#product_case_message");
		// if (!hide_enter_outside.is(e.target) && hide_enter_outside.has(e.target).length === 0)
		// {
		//     hide_enter_outside.removeClass('d-block').addClass('d-none');
		// }

		// var introduce_screen = $("#introduce_screen");
		// var member_reg_form = $("#member_reg_form");
		// if (!introduce_screen.is(e.target) && introduce_screen.has(e.target).length === 0)
		// {
		//     introduce_screen.removeClass('d-block').addClass('d-none');
		// }

		// if (!member_reg_form.is(e.target) && member_reg_form.has(e.target).length === 0)
		// {
		//     member_reg_form.removeClass('d-block').addClass('d-none');
		// }
	});



	// $(".point_detailsModel").click(function(event) {
	// 	event.preventDefault();
	// 	$(".point_details_table").removeClass('d-none').addClass('d-block'); 
	// });
	$("#close_case_message").click(function(event) {
		event.preventDefault();
		$("#product_case_message").removeClass('d-block').addClass('d-none'); 
	});

	$("#close_iphone_last_screen").click(function(event) {
		event.preventDefault();
		$("#iphone_last_screen").removeClass('d-block').addClass('d-none'); 
	});

	$("#close_point_detail").click(function(event) {
		$(".point_details_table").removeClass('d-block').addClass('d-none');  
	});

	// Start/stop scanner
	$("#barcode_scanning").click(function(event) {
	    event.preventDefault();
	    // var main_uri = encodeURI('https://jafa.dev.jacos.jp');
	    var main_uri = encodeURI(window.location.href);
	    var IOS_SCHEME = 'pic2shop://scan?callback='+main_uri+'%3Fgl%3Dus%26source%3Dmog%26hl%3Den%26source%3Dgp2%26q%3DEAN%26btnProductsHome%3DSearch%2BProducts';
	    var IOS_STORE = 'https://itunes.apple.com/app/pic2shop-shop-by-barcode/id308740640?mt=8';
	    // var IOS_STORE = 'https://itunes.apple.com/app/pic2shop-shop-by-barcode/id=308740640&mt=8';
	    var ANDROID_SCHEME = 'pic2shop://scan?callback='+main_uri+'%3Fgl%3Dus%26source%3Dmog%26hl%3Den%26source%3Dgp2%26q%3DEAN%26btnProductsHome%3DSearch%2BProducts';
	    var ANDROID_PACKAGE = 'com.visionsmarts.pic2shop';

	    // if (_scannerIsRunning) {
	    //     _scannerIsRunning = false;
	    //     Quagga.stop();
	    //     // $('#barcode_scanner').modal('hide');
	    //     $("#scanner-container").hide();
	    // } else {
	    	var userAgent = navigator.userAgent.toLowerCase();
	    	// iPhone端末ならアプリを開くかApp Storeを開く。
	    	if (userAgent.search(/iphone|ipad|ipod/) > -1) {
	    		
	    		window.location = 'pic2shop://scan?callback='+main_uri+'%3Fgl%3Dus%26source%3Dmog%26hl%3Den%26source%3Dgp2%26q%3DEAN%26btnProductsHome%3DSearch%2BProducts';
	    		
	    	}
	    	// Android端末ならアプリを開くかGoogle Playを開く。
	    	else if (userAgent.search(/android/) > -1) {
	    		
	    		// window.location = 'intent://#Intent;scheme=' + ANDROID_SCHEME + ';package=' + ANDROID_PACKAGE + ';end';
	    		window.location = ANDROID_SCHEME;
	    		
	    	}else{
	    		console.log("It is only for Mobile");
	    	}      
	        
	    // }
	});

	// if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
	// 	$('html, body').animate({
	//         scrollTop: $("#second-box").offset().top
	//     }, 500);
	// }
	$(".search_scroll_btn").click(function(event) {
		event.preventDefault();
		$('html, body').animate({
	        scrollTop: $("#second-box").offset().top
	    }, 500);
	});
	// if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
	// 	$('.dubble_point_btn').animate({
	//         scrollTop: $("#second-box").offset().top
	//     }, 500);
	// }

	$.fn.digits = function(){
	   return this.each(function(){
	       $(this).val( $(this).val().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",") );
	   })
	}
	function barcodeScanning() {   	
		$("#barcode_reading_navi").removeClass('d-block').addClass('d-none');
		var main_uri = encodeURI('https://jafa.dev.jacos.jp/compare');
		var IOS_SCHEME = 'pic2shop://scan?callback='+main_uri+'%3Fgl%3Dus%26source%3Dmog%26hl%3Den%26source%3Dgp2%26q%3DEAN%26btnProductsHome%3DSearch%2BProducts';
		var IOS_STORE = 'https://itunes.apple.com/app/pic2shop-shop-by-barcode/id308740640?mt=8';
		// var IOS_STORE = 'https://itunes.apple.com/app/pic2shop-shop-by-barcode/id=308740640&mt=8';
		var ANDROID_SCHEME = 'pic2shop://scan?callback='+main_uri+'%3Fgl%3Dus%26source%3Dmog%26hl%3Den%26source%3Dgp2%26q%3DEAN%26btnProductsHome%3DSearch%2BProducts';
		var ANDROID_PACKAGE = 'com.visionsmarts.pic2shop';
		
		var userAgent = navigator.userAgent.toLowerCase();
		// iPhone端末ならアプリを開くかApp Storeを開く。
		if (userAgent.search(/iphone|ipad|ipod/) > -1) {
			
			window.location = 'pic2shop://scan?callback='+main_uri+'%3Fgl%3Dus%26source%3Dmog%26hl%3Den%26source%3Dgp2%26q%3DEAN%26btnProductsHome%3DSearch%2BProducts';
			
		    // launch_frame.location.href = IOS_SCHEME + '://';
		    setTimeout(function() {
		    	// $("#iphone_browsing_screen").removeClass('d-none').addClass('d-block');
		    	$("#barcode_reading_navi").removeClass('d-none').addClass('d-block');
		    }, 500);
		}
		// Android端末ならアプリを開くかGoogle Playを開く。
		else if (userAgent.search(/android/) > -1) {
			
			// window.location = 'intent://#Intent;scheme=' + ANDROID_SCHEME + ';package=' + ANDROID_PACKAGE + ';end';
			window.location = ANDROID_SCHEME;
			setTimeout(function() {
				$("#barcode_reading_navi").removeClass('d-none').addClass('d-block');
		    	// $("#android_screen").removeClass('d-none').addClass('d-block');
		    }, 500);
		}
		// その他・不明・PCなどの場合はアラート表示
		else {
		    alert('ios/android only');
		}
	}
	$("#pic2shop_download").click(function(event) {
		event.preventDefault();
		$("#barcode_reading_navi").removeClass('d-block').addClass('d-none');
		// var main_uri = encodeURI('https://jafa.dev.jacos.jp/compare');
		// var IOS_SCHEME = 'pic2shop://scan?callback='+main_uri+'%3Fgl%3Dus%26source%3Dmog%26hl%3Den%26source%3Dgp2%26q%3DEAN%26btnProductsHome%3DSearch%2BProducts';
		var IOS_STORE = 'https://itunes.apple.com/app/pic2shop-shop-by-barcode/id308740640?mt=8';

		// var ANDROID_SCHEME = 'pic2shop://scan?callback='+main_uri+'%3Fgl%3Dus%26source%3Dmog%26hl%3Den%26source%3Dgp2%26q%3DEAN%26btnProductsHome%3DSearch%2BProducts';
		// var ANDROID_PACKAGE = 'com.visionsmarts.pic2shop';
		
		var userAgent = navigator.userAgent.toLowerCase();
		// iPhone端末ならアプリを開くかApp Storeを開く。
		if (userAgent.search(/iphone|ipad|ipod/) > -1) {
			
			var IOS_STORE = 'https://itunes.apple.com/app/pic2shop-shop-by-barcode/id308740640?mt=8';
			location.href = IOS_STORE;
		}
		// Android端末ならアプリを開くかGoogle Playを開く。
		else if (userAgent.search(/android/) > -1) {
			
			// window.location = 'intent://#Intent;scheme=' + ANDROID_SCHEME + ';package=' + ANDROID_PACKAGE + ';end';
			// window.location = ANDROID_SCHEME;
			window.location = 'https://play.google.com/store/apps/details?id=com.visionsmarts.pic2shop';
		}
	});
	function direct_barcodeScanning() {
		$("#barcode_reading_navi").removeClass('d-block').addClass('d-none');
		// var main_uri = encodeURI('https://jafa.dev.jacos.jp/compare');
		// var IOS_SCHEME = 'pic2shop://scan?callback='+main_uri+'%3Fgl%3Dus%26source%3Dmog%26hl%3Den%26source%3Dgp2%26q%3DEAN%26btnProductsHome%3DSearch%2BProducts';
		var IOS_STORE = 'https://itunes.apple.com/app/pic2shop-shop-by-barcode/id308740640?mt=8';

		// var ANDROID_SCHEME = 'pic2shop://scan?callback='+main_uri+'%3Fgl%3Dus%26source%3Dmog%26hl%3Den%26source%3Dgp2%26q%3DEAN%26btnProductsHome%3DSearch%2BProducts';
		// var ANDROID_PACKAGE = 'com.visionsmarts.pic2shop';
		
		var userAgent = navigator.userAgent.toLowerCase();
		// iPhone端末ならアプリを開くかApp Storeを開く。
		if (userAgent.search(/iphone|ipad|ipod/) > -1) {
			
			var IOS_STORE = 'https://itunes.apple.com/app/pic2shop-shop-by-barcode/id308740640?mt=8';
			location.href = IOS_STORE;
		}
		// Android端末ならアプリを開くかGoogle Playを開く。
		else if (userAgent.search(/android/) > -1) {
			
			// window.location = 'intent://#Intent;scheme=' + ANDROID_SCHEME + ';package=' + ANDROID_PACKAGE + ';end';
			// window.location = ANDROID_SCHEME;
			window.location = 'https://play.google.com/store/apps/details?id=com.visionsmarts.pic2shop';
		}
	}
	function pic2shop_iphone_installation() {
		var IOS_STORE = 'https://itunes.apple.com/app/pic2shop-shop-by-barcode/id308740640?mt=8';
		location.href = IOS_STORE;
	}

	$("#startButtonddd").click(function(event) {
		event.preventDefault();
		alert("Okay for iPhone");
		// $('#barcode_scanner').modal('show');
		// var arg = {
		//     resultFunction: function(result) {
		//     	console.log(result.code);
		//         $("#product_keyword3").val(result.code);
		//         decoder.stop();
		//         $('#barcode_scanner').modal('hide');
		//         $("#product_keyword3").blur();
		//     }
		// };		
	});

	$("#barcode_scanner_close").click(function(event) {
		var arg = {
		    resultFunction: function(result) {
		    }
		};
		var decoder = $("#webcodecam-canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
		decoder.stop();
		$('#barcode_scanner').modal('hide');
	});

	window.addEventListener('load', function () {
	  let selectedDeviceId;
	  const codeReader = new ZXing.BrowserMultiFormatReader()
	  var audioElement = document.createElement('audio');
	  audioElement.setAttribute('src', 'https://jafa.dev.jacos.jp/beep-07.mp3');
	  // console.log('ZXing code reader initialized')
	  codeReader.getVideoInputDevices()
	    .then((videoInputDevices) => {
	      const sourceSelect = document.getElementById('sourceSelect')
	      // console.log(videoInputDevices.length);
	      if (videoInputDevices.length > 1) {
	      	selectedDeviceId = videoInputDevices[1].deviceId
	        videoInputDevices.forEach((element) => {
	          const sourceOption = document.createElement('option')
	          sourceOption.text = element.label
	          sourceOption.value = element.deviceId
	          sourceSelect.appendChild(sourceOption)
	        })
	        sourceSelect.onchange = () => {
	          selectedDeviceId = sourceSelect.value;
	        };
	        const sourceSelectPanel = document.getElementById('sourceSelectPanel')
	        sourceSelectPanel.style.display = 'block'
	      }else{
	      	selectedDeviceId = videoInputDevices[0].deviceId
	      }

	      var scanner_running = 0;
	      document.getElementById('startButton').addEventListener('click', (e) => {
	      	e.preventDefault()
	      	scanner_running = 1;
	      	window.history.pushState(null, null, window.location.href+'#startButton');
	        codeReader.decodeFromVideoDevice(selectedDeviceId, 'video', (result, err) => {
	          $('#barcode_scanner').modal('show');
	          if (result) {
		          	try {
		          		audioElement.play();
		          		window.navigator.vibrate(200);
		          	}
		          	catch(err) {
		          		console.log(err)
		          	}       	
	          	    
	          	// var successBool = window.navigator.vibrate(pattern);
	          	    // audioElement.pause();
	          		var janCode = result.text;
	          	    $("#product_keyword3").val(result.text);
	          	    codeReader.reset()
	          	    $('#barcode_scanner').modal('hide');
	          	    $("#product_keyword3").blur();
  	    			if (janCode!=="") {
  	    				if (janCode.length==8) {
  	    					janCode = "00000"+janCode
  	    				}

  	     				var base_url = $("#base_url").val();
  	     				scanner_running = 0;
  	     				get_affiliate_products(janCode);

     					
  	    			}
	          }
	          if (err && !(err instanceof ZXing.NotFoundException)) {
	            console.error(err)
	            document.getElementById('result').textContent = err
	          }
	        })
	        // console.log(`Started continous decode from camera with id ${selectedDeviceId}`)
	      })
	      document.getElementById('resetButton').addEventListener('click', () => {
	        // $('.exit_modal').modal('show');

	        // $("#continue_site").click(function(event) {
	        // 	window.history.pushState(null, null, window.location.href);
	        // 	$('.exit_modal').modal('hide');
	        // 	return false;	      		
	        // })
	        // $("#exit_new_site").click(function(event) {
	        // 	$('.exit_modal').modal('hide');
	        	scanner_running = 0;
	        	window.history.back(-1);
	        	// window.history.pushState(null, null, window.location.href);
	        	codeReader.reset()
	        	$('#barcode_scanner').modal('hide');	      		
	        // })
	      })
	      $(window).on('popstate', function(event) {
	      	// if (scanner_running == 1) {

	      		// $('.exit_modal').modal('show');
	      		// $("#continue_site").click(function(event) {
	      		// 	window.history.pushState(null, null, window.location.href);
	      		// 	$('.exit_modal').modal('hide');
	      		// 	return false;	      		
	      		// })
	      		// $("#exit_new_site").click(function(event) {
	      		// 	$('.exit_modal').modal('hide');
	      			scanner_running = 0;
	      			codeReader.reset()
	      			$('#barcode_scanner').modal('hide');	      		
	      		// })
	      	// }
		      	
	      });
	    })
	    .catch((err) => {
	      console.error(err)
	    })
	})

	// iPhone端末ならアプリを開くかApp Storeを開く。
	var base_url = $("#base_url").val();
	var userAgent = navigator.userAgent.toLowerCase();
	if (userAgent.search(/iphone|ipad|ipod/) > -1) {
		console.log("this is iPhone");
		$("#manifest").attr('href', '#');
	}else{
		console.log("It is not Iphone")
		$("#manifest").attr('href', base_url+'resource/pwa/manifest.json');
	}

	function search_by_voice_keyword() {
		console.log("Stop Typing");
		var changevent = $("#onchange_event").val();
		// alert(changevent);
		if (changevent == 0) {
			return false;
		}
		var keywords = $("#product_keyword3").val();		
    	var base_url = $("#base_url").val();
    	if (keywords !="") {
    		$(".recording-instructions").html('<img style="display: block; margin-left: auto; margin-right: auto;" src="resource/img/ajax/Magnify-1s-200px.gif">');
    		$(".voice_suggestion_screen").removeClass('d-none').addClass('d-block');

    		window.history.pushState(null, null, window.location.href);
    		if (userAgent.search(/iphone|ipad|ipod/) > -1) {
    			
		    	$.ajax({
					url: base_url+'main_controller/get_yahoo_suggestion/',
					type: 'post',
					data: {keyword: keywords},
				})
				.done(function(data) {
					var sugg_response = JSON.parse(data);
					sugg_response = Object.values(sugg_response);
					if (sugg_response.length>0) {
						
						var html_string = "<div>";
						html_string += '<div class="card-header info">';
				            html_string += '<p class="">検索結果 <button class="btn btn-warning float-right suggestion_screen_close" id="">戻る</button></p></div>';
						for (var i = 0; i < sugg_response.length; i++) {
							var voice_value = sugg_response[i].jan;
							var isbn_value = sugg_response[i].isbn;

							html_string += "<div class='voice_product_list'>";
							html_string += "<a href='#' attr-data-label='"+sugg_response[i].label+"' attr-data-value='"+voice_value+"' attr-data-isbn='"+isbn_value+"'class='voice_product_select'>"+sugg_response[i].label+"</a>";
							html_string += "</div>";
						}
						html_string += "</div>";
						$(".recording-instructions").html(html_string)
					}else{
						$(".recording-instructions").html("商品が一致しません。");
					}
					console.log(sugg_response);
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
    		}else{
		    	$.ajax({
					url: base_url+'main_controller/get_yahoo_suggestion/',
					type: 'post',
					data: {keyword: keywords},
				})

				.done(function(data) {
					var sugg_response = JSON.parse(data);
					sugg_response = Object.values(sugg_response);
					if (sugg_response.length>0) {
						
						var html_string = "<div>";
						html_string += '<div class="card-header info">';
				            html_string += '<p class="">検索結果 <button class="btn btn-warning float-right suggestion_screen_close" id="">戻る</button></p></div>';
						for (var i = 0; i < sugg_response.length; i++) {
							var voice_value = sugg_response[i].jan;
							var isbn_value = sugg_response[i].isbn;
							html_string += "<div class='voice_product_list'>";
							html_string += "<a href='#' attr-data-label='"+sugg_response[i].label+"' attr-data-value='"+voice_value+"' attr-data-isbn='"+isbn_value+"'class='voice_product_select'>"+sugg_response[i].label+"</a>";
							html_string += "</div>";
						}
						html_string += "</div>";
						$(".recording-instructions").html(html_string)
					}else{
						$(".recording-instructions").html("商品が一致しません。");
					}
					console.log(sugg_response);
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
    		}
    	}else{
    		$(".voice_suggestion_screen").removeClass('d-block').addClass('d-none');
    	}
	}


	$(".back_button").click(function(event) {
		/* Act on the event */
		// window.history.back(1);
		// alert(window.history.length);
		window.history.go(-1);
		// window.history.pushState([], "<name>", window.location.href);

		// window.history.state = null;
		// window.history.replaceState(window.location.href);
	});

	$(window).on('popstate', function(event) {
		$(".card").removeClass('d-block').addClass('d-none');
		$(".modal").modal('hide');
	});

	$(".trams_condition").click(function(event) {
		event.preventDefault()
		window.history.pushState(null, null, window.location.href);
	});

	$(".privacy_policy").click(function(event) {
		event.preventDefault()
		window.history.pushState(null, null, window.location.href);
	});
});
