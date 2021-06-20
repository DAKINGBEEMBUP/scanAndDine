// document.getElementById('button').addEventListener('click', function () {
// document.querySelector('.bg-modal').style.display = 'flex';

// 	$('form').submit(function (e) {
// 		e.preventDefault();
// 	});
// });

document.querySelector('.close').addEventListener('click', function () {
	document.querySelector('.bg-modal').style.display = 'none';
	$('.close').unbind('submit').submit();
});
