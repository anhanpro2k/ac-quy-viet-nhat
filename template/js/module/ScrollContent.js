export default function scrollContent() {
    const speed = 300;
	// NẾU CÓ ĐỊA CHỈ ID TRÊN THANH URL THÌ SCROLL XUỐNG
	const hash = window.location.hash;
	if ($(hash).length) scrollToID(hash, speed);
	// TÌM ĐỊA CHỈ ID VÀ SCROLL XUỐNG NẾU CÓ CLASS
	$('.toc_widget_list li').on('click', function (e) {
		e.preventDefault();

		const href = $(this).find('> a').attr('href') || $(this).attr('href');
		const id = href.slice(href.lastIndexOf('#'));
		if ($(id).length) {
			scrollToID(id, speed);
		} else {
			// window.location.replace(`/${id}`);
			window.location.href = href;
		}
	});
	// HÀM SCROLL CHO MƯỢT MÀ
	function scrollToID(id, speed) {
		const offSet = $('.header').outerHeight();
		const section = $(id).offset();
		const targetOffset = section.top - offSet - 20;
		$('html,body').animate({scrollTop: targetOffset}, speed);
	}    
}