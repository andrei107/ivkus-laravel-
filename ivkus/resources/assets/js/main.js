import $ from 'jquery';
window.$ = window.jQuery = $;

$(document).ready(function() {
		/*обертка группы элементов для слайдера*/
		let divBestReceipt = $(".best-receipt-item"),
            divFastReceipt = $(".fast-receipt-item");
			
		for(let i = 0; i < divBestReceipt.length; i+=3) {
			divBestReceipt.slice(i, i+3).wrapAll("<div class='slider-triple-element'></div>");
		}
        for(let i = 0; i < divFastReceipt.length; i+=4) {
			divFastReceipt.slice(i, i+4).wrapAll("<div class='slider-quattro-element'></div>");
		}

		//слайдеры
		let slideIndexBest = 1,
			slideIndexFast = 1;
		const slidesBest = $('.slider-triple-element'),
			prevBest = $('.offer__slider-prev'),
			nextBest = $('.offer__slider-next'),
			slidesFast = $('.slider-quattro-element'),
			prevFast = $('.offer__slider-prev-fast'),
			nextFast = $('.offer__slider-next-fast');

		showBestSlides(slideIndexBest);

		function showBestSlides(n) {
			if (n > slidesBest.length) {
				slideIndexBest = 1;
			}
			if (n < 1) {
				slideIndexBest = slidesBest.length;
			}
			slidesBest.each(function(index, value){
				$(value).css('display', 'none')
			});
			$(slidesBest[slideIndexBest - 1]).css('display', 'flex');
		}

		function plusBestSlides (n) {
			showBestSlides(slideIndexBest += n);
		}
		prevBest.on('click', function(){
			plusBestSlides(-1);
		});
		nextBest.on('click', function(){
			plusBestSlides(1);
		});

		showFastSlides(slideIndexFast);

		function showFastSlides(n) {
			if (n > slidesFast.length) {
				slideIndexFast = 1;
			}
			if (n < 1) {
				slideIndexFast = slidesFast.length;
			}
			slidesFast.each(function(index, value){
				$(value).css('display', 'none')
			});
			$(slidesFast[slideIndexFast - 1]).css('display', 'flex');
		}

		function plusFastSlides (n) {
			showFastSlides(slideIndexFast += n);
		}
		prevFast.on('click', function(){
			plusFastSlides(-1);
		});
		nextFast.on('click', function(){
			plusFastSlides(1);
		});

		//динамика названий
		if ($(window).width() > 950) {
			$('.dark', this).on('mouseover', function () {
				$('.bestItemName', this).stop().animate({
					marginTop: '200px'
				}, 500);
		   });
		   $('.dark',this).on('mouseout', function () {
				$('.bestItemName', this).stop().animate({
					marginTop: '225px'
				}, 500);
		   });

		   $('.dark').on('mouseover', function () {
				$('.fastItemName', this).stop().animate({
				  	marginTop: '160px'
				}, 500);
		   });
		  $('.dark').on('mouseout', function () {
				$('.fastItemName', this).stop().animate({
					marginTop: '175px'
				}, 500);
		   });
		}

        //разметка всех рецептов
		function divedeReceipts(){
			let divAllReceipt = $(".container-receipt a");
			for(let i = 0; i < divAllReceipt.length; i+=3) {
				divAllReceipt.slice(i, i+3).wrapAll("<div class='triple-element'></div>");
			}
		}

		divedeReceipts();

      //табы
      function hideTabContent() {
		$( ".tabcontent" ).each(function() {
 			$(this).addClass('hide');
			$(this).removeClass('advice-content','fade');
		});
		$( ".advice-header-item" ).each(function() {
 			$(this).removeClass('activeHeader');
		});
	}

	function showTabContent(i = 0) {
		var tabcontent = $( ".tabcontent" );
		var firstTab = tabcontent[i];
        $(firstTab).addClass('advice-content','fade');
        $(firstTab).removeClass('hide');
        var adviceHeaderItem =  $( ".advice-header-item" )[i]
        $(adviceHeaderItem).addClass('activeHeader');
    }

    hideTabContent();
    showTabContent();

	$('.advice-header-item').on('click',function(){
		const target = event.target;
		if(target && target.classList.contains('advice-header-item')) {
			$( ".advice-header-item" ).each(function(index,element) {
				if (target == element) {
                    hideTabContent();
                    showTabContent(index);
                }
			});
		}
	})

    //active menu
    $('.mainMenu').each(function (item) {
        if (window.location.href.includes($(this).find('a').attr('href')) && !$(this).hasClass('m-menu')) {
            $(this).addClass("activeMainMenu");
        } else if( $(this).hasClass('m-menu') && window.location.href == 'http://ivkus/') {
            $(this).addClass("activeMainMenu");
        }else {
            $(this).removeClass("activeMainMenu");
        }
    });

	//filters
	$(document).on('change', '.filterSelect', function(){
		var data = [],
            itemData = [],
			elements = $('.filterSelect'),
            pageItems = $('.receipt-item');

		elements.each(function(index, item){
            if($(item).val() != 0) {
                data[$(item).val()] = {
					'operation' :  $(item).find(':selected').data('operation'),
					'value' :  $(item).find(':selected').data('label'),
				}
            }
		});

       function toggleElement(item, filterValue, filterOperation, param){
            if(eval(param + filterOperation + filterValue)) {
                item.closest('a').show()
            }
       }

        pageItems.each(function(index, item){
           $(item).closest('a').hide()
			itemData[index] = {
				'menu': $(item).data('menu'),
				'time': parseInt($(item).data('time')) ,
				'persons': $(item).data('persons'),
				'calories': $(item).data('calories'),
			}

            if(data.T001) {
                toggleElement($(item), data.T001['value'], data.T001['operation'], itemData[index].time);
            } else if(data.M002) {
                toggleElement($(item), data.M002['value'], data.M002['operation'], itemData[index].menu);
            } else if(data.K003) {
                toggleElement($(item), data.K003['value'], data.K003['operation'], itemData[index].calories);
            } else if(data.P004) {
                toggleElement($(item), data.P004['value'], data.P004['operation'], itemData[index].persons);
            } else {
                $(item).closest('a').show()
            }
        })
    })
	//---
	$('.btnfilter').on('click', function() {
        $.ajax({
           method: "POST",
           url: '/filter',
           data: {data: $('.search-data').val()},
           dataType: "json",
           success: function (response) {
				renderElements(response.data);
           }
       });
    })

    $(document).on('click', '.page-link', function(e){
        e.preventDefault();
        var page_number = $(this).data('page-number');
        var current_query;

        if( $(this).data('query') ) {
            current_query = '?' + $(this).data('query');
        }
        else {
            current_query = '';
        }

        $.ajax({
           method: "POST",
           url: '/filter',
           data: {current_query: current_query,
				page_number:page_number,
				data: $('.search-data').val()},
           dataType: "json",
           success: function (response) {
				renderElements(response.data);
           }
        })
    })
});
