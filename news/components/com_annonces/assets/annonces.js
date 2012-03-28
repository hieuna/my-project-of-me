
function element(id){return document.getElementById(id);}

function changer(image_id, image_path) {
	image = element(image_id);
	image.src=image_path;
}

