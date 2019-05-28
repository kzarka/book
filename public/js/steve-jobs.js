/* Steve jobs' book */

function updateDepth(book, newPage) {

	var page = book.turn('page'),
		pages = book.turn('pages'),
		depthWidth = 16*Math.min(1, page*2/pages);
		newPage = newPage || page;

	if (newPage>3)
		$('.sj-book .p2 .depth').css({
			width: depthWidth,
			left: 20 - depthWidth
		});
	else
		$('.sj-book .p2 .depth').css({width: 0});

		depthWidth = 16*Math.min(1, (pages-page)*2/pages);

	if (newPage<pages-3)
		$('.sj-book .p' + (pages - 1) + ' .depth').css({
			width: depthWidth,
			right: 20 - depthWidth
		});
	else
		$('.sj-book .p' + (pages - 1) + ' .depth').css({width: 0});

}

function loadPage(page, element) {
	let content = '';
	

	$(element).html('<div class="book-content">'+getContent(page)+'</div>');
	$(element).append('<span class="page-number">' + (page - 2) + '</span>');
}

function addPage(page, book) {

	var id, pages = book.turn('pages');

	if (!book.turn('hasPage', page)) {

		var element = $('<div />',
			{'class': 'own-size',
				css: {width: 460, height: 582}
			}).
			html('<div class="loader"></div>');

		if (book.turn('addPage', element, page)) {
			loadPage(page, element);
		}

	}
}

function numberOfViews(book) {

	return book.turn('pages') / 2 + 1;

}

function getViewNumber(book, page) {

	return parseInt((page || book.turn('page'))/2 + 1, 10);

}

function zoomHandle(e) {

	if ($('.sj-book').data().zoomIn)
		zoomOut();
	else if (e.target && $(e.target).hasClass('zoom-this')) {
		zoomThis($(e.target));
	}

}

function zoomThis(pic) {

	var	position, translate,
		tmpContainer = $('<div />', {'class': 'zoom-pic'}),
		transitionEnd = $.cssTransitionEnd(),
		tmpPic = $('<img />'),
		zCenterX = $('#book-zoom').width()/2,
		zCenterY = $('#book-zoom').height()/2,
		bookPos = $('#book-zoom').offset(),
		picPos = {
			left: pic.offset().left - bookPos.left,
			top: pic.offset().top - bookPos.top
		},
		completeTransition = function() {
			$('#book-zoom').unbind(transitionEnd);

			if ($('.sj-book').data().zoomIn) {
				tmpContainer.appendTo($('body'));

				$('body').css({'overflow': 'hidden'});
				
				tmpPic.css({
					margin: position.top + 'px ' + position.left+'px'
				}).
				appendTo(tmpContainer).
				fadeOut(0).
				fadeIn(500);
			}
		};

		$('.sj-book').data().zoomIn = true;

		$('.sj-book').turn('disable', true);

		$(window).resize(zoomOut);
		
		tmpContainer.click(zoomOut);

		tmpPic.load(function() {
			var realWidth = $(this)[0].width,
				realHeight = $(this)[0].height,
				zoomFactor = realWidth/pic.width(),
				picPosition = {
					top:  (picPos.top - zCenterY)*zoomFactor + zCenterY + bookPos.top,
					left: (picPos.left - zCenterX)*zoomFactor + zCenterX + bookPos.left
				};


			position = {
				top: ($(window).height()-realHeight)/2,
				left: ($(window).width()-realWidth)/2
			};

			translate = {
				top: position.top-picPosition.top,
				left: position.left-picPosition.left
			};

			$('.samples .bar').css({visibility: 'hidden'});
			$('#slider-bar').hide();
			
		
			$('#book-zoom').transform(
				'translate('+translate.left+'px, '+translate.top+'px)' +
				'scale('+zoomFactor+', '+zoomFactor+')');

			if (transitionEnd)
				$('#book-zoom').bind(transitionEnd, completeTransition);
			else
				setTimeout(completeTransition, 1000);

		});

		tmpPic.attr('src', pic.attr('src'));

}

function zoomOut() {

	var transitionEnd = $.cssTransitionEnd(),
		completeTransition = function(e) {
			$('#book-zoom').unbind(transitionEnd);
			$('.sj-book').turn('disable', false);
			$('body').css({'overflow': 'auto'});
			moveBar(false);
		};

	$('.sj-book').data().zoomIn = false;

	$(window).unbind('resize', zoomOut);

	moveBar(true);

	$('.zoom-pic').remove();
	$('#book-zoom').transform('scale(1, 1)');
	$('.samples .bar').css({visibility: 'visible'});
	$('#slider-bar').show();

	if (transitionEnd)
		$('#book-zoom').bind(transitionEnd, completeTransition);
	else
		setTimeout(completeTransition, 1000);
}


function moveBar(yes) {
	if (Modernizr && Modernizr.csstransforms) {
		$('#slider .ui-slider-handle').css({zIndex: yes ? -1 : 10000});
	}
}

function setPreview(view) {

	var previewWidth = 115,
		previewHeight = 73,
		previewSrc = 'pages/preview.jpg',
		preview = $(_thumbPreview.children(':first')),
		numPages = (view==1 || view==$('#slider').slider('option', 'max')) ? 1 : 2,
		width = (numPages==1) ? previewWidth/2 : previewWidth;

	_thumbPreview.
		addClass('no-transition').
		css({width: width + 15,
			height: previewHeight + 15,
			top: -previewHeight - 30,
			left: ($($('#slider').children(':first')).width() - width - 15)/2
		});

	preview.css({
		width: width,
		height: previewHeight
	});

	if (preview.css('background-image')==='' ||
		preview.css('background-image')=='none') {

		preview.css({backgroundImage: 'url(' + previewSrc + ')'});

		setTimeout(function(){
			_thumbPreview.removeClass('no-transition');
		}, 0);

	}

	preview.css({backgroundPosition:
		'0px -'+((view-1)*previewHeight)+'px'
	});
}

function isChrome() {

	// Chrome's unsolved bug
	// http://code.google.com/p/chromium/issues/detail?id=128488

	return navigator.userAgent.indexOf('Chrome')!=-1;

}

function getContent(page) {
	if(page == 3) return `<div class="entry-content">
		<p><b>Sự Tích Con Gà Chiến</b></p>
<p>Xưa, có cô thiếu nữ con nhà giàu ở nông thôn. Vì là con một trong nhà cho nên cô ta được ông bà cha mẹ nuông chiều hết mực. Cô không phải ra đồng làm lụng hai sương một nắng như những cô gái nông dân<i> </i>khác. Hằng ngày ở nhà cô chỉ lo ba bữa cơm, nấu ăn rửa chén đi chợ.</p>
<p>Thế rồi, năm nọ bỗng dưng cô phát bịnh nặng và qua đời. Hồn cô xuống âm phủ, thấy mình đứng trước pháp đình của Tòa án âm ty trên cao có Diêm vương, Phán quan và hai bên tả hữu có nhiều quỷ sứ đầu trâu mặt ngựa tay lăm lăm chĩa ba, mặt đằng đằng sát khí bặm trợn dữ dằn.</p>
<p>Phiên tòa bắt đầu. Phán quan dõng dạc đọc cáo trạng:</p>
<p>– Tên Nguyễn Thị Kê, mười bẩy tuổi, con ông Nguyễn Văn Cồ và bà Lê Thị Mái, can tội… “không biết quý trọng hột cơm hột gạo” do người nông phu lao lực làm ra, cậy mình nhiều của, thường ngày ăn không hết, y đã đổ ụp chén cơm thừa xuống đất, chà đạp lên hột cơm trắng. `

if(page == 4) return `Khi rửa chén ở thềm giếng, nhiều lần còn lắng đọng cơm thừa trong chậu nước, thị đã đổ hắt xuống bùn, sinh ra dòi bọ lúc nhúc hôi thối xung quanh giếng nước ăn.</p>
<p>– Thị còn nhiều lần đánh đổ gạo xuống đất, đã không chịu hốt lên, còn lấy chân đá tung tóe rồi lấy chổi quét dập vào đống rác bẩn thỉu. Với bấy nhiêu tội trạng, phán quan âm phủ đề nghị Diêm vương (nghị tội) đày y thị xuống chín địa ngục và sai quỷ sứ mỗi ngày đem vào một chậu dòi bẩn bắt thị phải ăn thay cơm…<i> </i></p>
<p>Cô gái nghe vậy thất kinh hồn vía. Hồi còn ở dương cô ta vốn là người ưa sạch sẽ. Nay nghe sắp phải ăn dòi bọ, hồn cô bỗng lợm giọng muốn mửa.<i>.. </i>và cô bụm miệng khóc òa.</p>
<p>Diêm vương ngồi giữa cất tiếng sang sảng:</p>
<p>– Khóc lóc cũng không chạy được tội! Ta cho phép nhà ngươi có thể nói vài lời trước khi ta tuyên án…<i></i></p>
<p>Cô nàng ráng sức gom thu hết can đảm hiếm hoi của mình, xin nói:`

if(page == 5) return `</p>
<p>– Kính thưa quý tòa! Con xin công nhận có những tội như Phán quan đã nêu. Nhưng con cũng đã hơn mấy chục lần đem tiền, gạo cho người ăn mày nghèo khổ, đã hai mươi lần đi chùa thắp hương trước phật đài, đã hơn mười lần cứu giúp kẻ hoạn nạn.</p>
<p>Diêm Vương bảo Phán quan xem lại sổ Nam Tào đã ghi chép các việc làm trước kia của cô.&nbsp; <i></i></p><p>Xem xong Phán Quan nói:</p>
<p>Quả đúng phạm nhân đã có bố thí cứu khổ và tu thân như trên.</p>
<p>Nghe vậy, sau khi nghị án, Diêm Vương tuyên đọc:</p>
<p>– Phạm nhân Nguyễn Thị Kê, mười bảy năm ở dương trần, đã mười một năm phạm tội rẻ rúng hạt cơm hạt gạo, đổ tháo cơm gạo xuống vũng bùn dơ, sinh ra dòi bọ rúc rỉa. Đáng lẽ y bị tội đầy xuống chín từng địa ngục cho ăn dòi bọ dơ dáy để sám hối lôi xưa. Nhưng xét thấy phạm nhân đã có một phần tu nhân tích đức, cho nên Tòa âm phủ xét cho giảm nhẹ phần nào. `
if(page == 6) return `Toa quyết định cho y lên cõi dương thế đầu thai làm kiếp con gà mái, tìm nhặt ăn hết những hột cơm hột gạo rơi rớt đó đây, vừa để chuộc lại lỗi lầm xưa, vừa khỏỉ phung phí hột cơm hột gạo do người nông phu cần cù lao khổ làm ra.</p>
<p>Sau đấy, nếu thị cần mẫn làm tròn phận sự sẽ được Toà xét lại và cho siêu thăng lên cõi tiên ở Thượng giới.</p>
<p>Bởi có tích đó cho nên ngày nay chúng ta thấy con gà mái thường dẫn đàn gà con tìm kiếm nhặt nhạnh, ăn hết những hột cơm hột gạo rơi vãi ở mọi nơi. Nó đang sửa chữa những hành động phung phí ở kiếp trước, và mong cho kiếp sau sẽ được lên cõi tiên.</p>
<p>(Sưu tầm 1990)</p>`
return ``;
}